<? include("_header.php"); ?>
 <title>Ошибка</title>
</head>
<body>

<?= array_key_exists('message', $model) ? $model['message'] : '' ?>
<a href="/logout.php">Выйти</a>
  </body>
</html>
