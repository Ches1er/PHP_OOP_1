<h2>mainpage</h2>
hello MVC
<?php if($user->auth_currentUser()!=NULL):?>
    Hello <?=$user->auth_currentUser()["login"]?> <a href="/logout">logout</a>
<?php else: ?>
    <br><a href="/register">регистрация</a>
    <br><a href="/login">вход</a>
<?php endif; ?>
