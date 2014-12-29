<?php include("_header.php"); ?>

    <title>Пираты клинического моря</title>
  </head>

  <body>
    <? include("_menu.php"); ?>

    <p><?= $model['game']['message'] ?></p>
    <form action="index.php" method="post">
        <label>Код</label><input name="flag" type="text" size="15" maxlength="15">
        <input type="submit" value="Отправить"><br/><br/>
    </form>
    <div>
        Список заданий:
        <?
            foreach ($model["game"]["tasks"] as $task) {
        ?>
        <div>
            <p><span><?= $task["id"] ?>.</span> <?= $task["task"] ?></p>
            <span>Сложность: <?= $task["weight"] ?></span>
        </div>
        <? } ?>
    </div>

<?php include("_footer.php"); ?>
