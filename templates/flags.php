<?php include("_header.php"); ?>

    <title>Принятые коды</title>
  </head>

  <body>
    <? include("_menu.php"); ?>
        <table>
        <?
            foreach ($model["flags"] as $flag) {
        ?>
        <tr>
            <th><?= $flag["id"] ?></th>
            <td><?= $flag["flag"] ?></td>
            <td><?= $flag["weight"] ?></td>
            <td><?= $flag["login"] ?></td>
        </tr>
        <? } ?>
        </table>

<?php include("_footer.php"); ?>
