<? include("_header.php"); ?>
 <title>Ошибка</title>
</head>
<body>
<?= array_key_exists('message', $model) ? $model['message'] : '' ?>

<?php include("_footer.php"); ?>
