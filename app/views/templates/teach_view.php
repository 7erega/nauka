<article id="home" class="panel">
    <header>
        <h1>Jane Doe</h1>
        <p>Senior Astral Projectionist</p>
    </header>
    <?php
        echo "Ваш email:".$_SESSION['logged_user']."<br>";
    ?>
    <a href="/main/logout">Вийти</a>
</article>