    <header>
        <span>Привет, <?= $model['game']['user'] ?></span>
        <a href="/logout.php">выйти</a>
        <a href="/index.php">Игра</a>
        <a href="/stat.php">Статистика</a>
        <a href="/rules.php">Правила</a>
        <span>У вас <?= $model['game']['rate'] ?> баллов</span>
    </header>

