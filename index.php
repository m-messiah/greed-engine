<?
require_once 'includes/mvc.php';
require_once 'includes/config.php';
session_set_cookie_params(10800);
session_start();

function index()
  {
    if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
        if (isset($_POST['login'])) {
            $login = trim(htmlspecialchars(stripslashes($_POST['login'])));
            if (isset($_POST['password'])) {
                $password = trim(htmlspecialchars(stripslashes($_POST['password'])));
                $data = db_query("SELECT id, password, rate FROM users WHERE login =  ? LIMIT 1", 's', array($login));
                if (count($data) == 0)
                  return view('index', array('message' => 'Пользователь не найден'));
                $data = $data[0];
                if($data['password'] === md5(md5($password)))
                {
                    $_SESSION['login'] = $login;
                    $_SESSION['id'] = $data["id"];
                    header("Location:/");
                    exit;
                } else
                    return view('index', array('message' => 'Вы ввели неправильный пароль'));
            }
        }
        return view('index');
    } else {
        $login=$_SESSION['login'];
        $id = $_SESSION['id'];
        $data = db_query("SELECT login, rate FROM users WHERE id = ? LIMIT 1", 's', array($id));
        if (count($data) > 0) {
            $data = $data[0];
            if ($login === $data["login"]) {
                $game_data = array();
                $game_data['user'] = $login;
                $game_data['rate'] = $data['rate'];
                if (isset($_POST['flag'])) {
                    $flag = trim(htmlspecialchars(stripslashes($_POST['flag'])));
                    $flags = db_query("SELECT weight, posted FROM flags WHERE flag = ? LIMIT 1", 's', array($flag));
                    if (count($flags) == 0) {
                        $game_data['message'] = "Неправильный код";
                    } else {
                        if ($flags[0]['posted']) {
                            $game_data['message'] = "Код уже снят";
                        } else {
                            db_query("UPDATE flags SET uid=?, posted=b'1' WHERE flag = ?", 'ds', array($id, $flag));
                            $game_data["rate"] += $flags[0]['weight'];
                            db_query("UPDATE users SET rate=? WHERE id=?", 'dd', array($game_data["rate"], $id));
                        }
                    }
                }
                $tasks = db_query("SELECT id, task, weight FROM flags WHERE posted=?", "d", array(0));
                $game_data["tasks"] = array();
                foreach ($tasks as $task) {
                    $game_data["tasks"][$task["id"]] = $task;
                }

                return view('game', array('game' => $game_data));
            }
        }
        return view('error', array('message' => 'Неправильная сессия, зайдите заново'));
    }
  }

  index();
?>
