<header>
    <div class="pure-menu pure-menu-open pure-menu-horizontal">
        <span class="pure-menu-heading">Привет, <?= $model['game']['user'] ?></span>

        <ul>
            <li class="pure-menu-selected"><a href="/index.php">Игра</a></li>
            <li><a href="/stat.php">Статистика</a></li>
            <li><a href="/rules.php">Правила</a></li>
        </ul>
        <span class="pure-menu-heading gold"><?= $model['game']['rate'] ?> ед. золотых</span>
    </div>
</header>

