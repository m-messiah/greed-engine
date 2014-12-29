<?
require_once 'includes/mvc.php';
require_once 'includes/config.php';
session_start();

$login=$_SESSION['login'];
$id = $_SESSION['id'];
$data = db_query("SELECT login, rate FROM users WHERE id = ? LIMIT 1", 's', array($id));
if (count($data) > 0) {
    $data = $data[0];
    if ($login === $data["login"]) {
        $game_data = array();
        $game_data['user'] = $login;
        $game_data['rate'] = $data['rate'];
    }
}
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    header("Location:/");
    exit;
}
return view('rules', array('game' => $game_data))
?>
