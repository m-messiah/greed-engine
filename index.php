<?
require_once 'includes/mvc.php';
require_once 'includes/config.php';
session_set_cookie_params(18000);
session_start();
date_default_timezone_set('Asia/Ashkhabad');

function index()
  {
    if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
        if (isset($_POST['login'])) {
            $login = trim(htmlspecialchars(stripslashes($_POST['login'])));
            if (isset($_POST['password'])) {
                $password = trim(htmlspecialchars(stripslashes($_POST['password'])));
                $data = db_query("SELECT id, password, rate FROM users WHERE login =  ? LIMIT 1", 's', array($login));
                if (count($data) == 0)
                  return view('index', array('message' => 'Шлюпка не существует'));
                $data = $data[0];
                if($data['password'] === md5(md5($password)))
                {
                    $_SESSION['login'] = $login;
                    $_SESSION['id'] = $data["id"];
                    header("Location:/");
                    exit;
                } else
                    return view('index', array('message' => 'Неправильное волшебное слово'));
            }
        }
        return view('index');
    } else {
        $login=$_SESSION['login'];
        $id = $_SESSION['id'];
        $data = db_query("SELECT login, name, rate FROM users WHERE id = ? LIMIT 1", 's', array($id));
        if (count($data) > 0) {
            $data = $data[0];
            if ($login === $data["login"]) {
                $game_data = array();
                $game_data['user'] = $data['name'];
                $game_data['rate'] = $data['rate'];
                if (isset($_POST['flag'])) {
                    $flag = trim(htmlspecialchars(stripslashes($_POST['flag'])));
                    file_put_contents("./attempts.log", $login."\t".$flag."\t".date("d M H:i:s")."\n", FILE_APPEND);
                    $flags = db_query("SELECT weight, posted FROM flags WHERE flag = ? LIMIT 1", 's', array($flag));
                    if (count($flags) == 0) {
                        $game_data['message'] = "Неправильный код";
                    } else {
                        if ($flags[0]['posted']) {
                            $game_data['message'] = "Сокровище уже забрали";
                        } else {
                            db_query("UPDATE flags SET uid=?, posted=b'1' WHERE flag = ?", 'ds', array($id, $flag));
                            $game_data["rate"] += $flags[0]['weight'];
                            db_query("UPDATE users SET rate=? WHERE id=?", 'dd', array($game_data["rate"], $id));
                            $game_data['message'] = "Сокровище ваше! Ищите дальше.";
                        }
                    }
                }
                $tasks = db_query("SELECT id, task, weight FROM flags WHERE posted=? ORDER BY id", "d", array(0));
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
