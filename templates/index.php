<? include("_header.php"); ?>
 <title>Пираты клинического моря</title>
</head>
<body>
<h1>Привет, Клиник!</h1>
<h2>Я вычислил твой айпи: <? echo $_SERVER["REMOTE_ADDR"]; ?></h2>
<h3>Бойся!</h3>

<?= array_key_exists('message', $model) ? $model['message'] : '' ?>
<form action="index.php" method="post">
    <label>логин:</label><br/>
  <input name="login" type="text" size="15" maxlength="15"><br/>
    <label>пароль:</label><br/>
  <input name="password" type="password" size="15" maxlength="15"><br/><br/>
  <input type="submit" value="войти"><br/><br/>
</form>

<?php include("_footer.php"); ?>
