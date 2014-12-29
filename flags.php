<?
require_once 'includes/mvc.php';
require_once 'includes/config.php';
session_start();
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    header("Location:/");
    exit;
}
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
$flags = db_query("SELECT flags.id, flags.flag, flags.weight, flags.timestamp, users.login FROM flags, users WHERE flags.posted=? AND flags.uid=users.id ORDER BY flags.id", 'd', array(1));
return view('flags', array('game' => $game_data, 'flags' => $flags))
?>
