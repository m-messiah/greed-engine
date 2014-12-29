<?php include("_header.php"); ?>

    <title>Статистика</title>
  </head>

  <body>
    <? include("_menu.php"); ?>
        <?
            foreach ($model["stat"] as $user) {
        ?>
        <div>
            <p><?= $user["login"] ?></p>
            <span><?= $user["rate"] ?></span>
        </div>
        <? } ?>
    </div>

<?php include("_footer.php"); ?>
