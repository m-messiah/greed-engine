<?php include("_header.php"); ?>

    <title>Пираты клинического моря</title>
  </head>

  <body>
    <? include("_menu.php"); ?>
    <div class="pure-g main-content">
        <? if (array_key_exists('message', $model['game'])) { ?>
        <div class="pure-u-1 message">
            <?= $model['game']['message'] ?>
        </div>
        <? } ?>
        <div class="pure-u-1 code-submit">
            <form action="index.php" method="post">
                <label class="game-label">Код</label>
                <input class="game-input" name="flag" type="text">
                <input class="game-button" type="submit" value="Отправить">
            </form>
        </div>
        <?
            foreach ($model["game"]["tasks"] as $task) {
        ?>
        <div class="pure-u-1 task">
            <p class="task-num"><?= $task["id"] ?></p>
            <p class="task-desc">
                <?= $task["task"] ?></br>
                <span class="gold">Стоимость: <?= $task["weight"] ?></span>
            </p>
        </div>
        <? } ?>
    </div>

  </body>
</html>