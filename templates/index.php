<? include("_header.php"); ?>
 <title>Пираты клинического моря</title>
</head>
<body>
<div class="pure-g">
    <div class="pure-u-1">
        <img src="/static/img/pirati.jpg" class="pure-img" />
    </div>
    <div class="pure-u-1 mainpage">
        <h1>Пираты Клинического Моря
            <span>Битва за сокровища</span>
        </h1>
        
         <? if (array_key_exists('message', $model)) { ?>
        <div class="pure-u-1 message">
            <?= $model['message'] ?>
        </div>
        <? } ?>
        <form action="index.php" method="post">
            <label class="mainpage_label">Название шлюпки</label>
            <input class="mainpage_input" name="login" type="text">
            <label class="mainpage_label">Волшебное слово</label>
            <input class="mainpage_input" name="password" type="password">
            <input class="mainpage_button" type="submit" value="Шлюпки на воду!">
        </form>
    </div>
</div>
</body>
</html>
