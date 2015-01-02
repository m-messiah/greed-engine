<?php include("_header.php"); ?>

    <title>Статистика</title>
  </head>

  <body>
    <? include("_menu.php"); ?>
    <div class="pure-g main-content">
        <div class="pure-u-1 text-page">
            <table>
            <tr><th>Название шлюпки</th><th>Найденное золото</th></tr>
            <?
                foreach ($model["stat"] as $user) {
            ?>
            <tr>
                <td><?= $user["name"] ?></td>
                <td class="gold"><?= $user["rate"] ?></td>
            </tr>
            <? } ?>
            </table>
        </div>
    </div>

  </body>
</html>
