<h2>Login</h2>
<?php  if(!empty($errors)): ?>
    <div class="error"><?=$errors?></div>
<?php endif;?>
<form action="/login/handle" method="post">
    <dl>
        <dt>Login:</dt>
        <dd><input type="text" name="login"></dd>

        <dt>Password:</dt>
        <dd><input type="password" name="pass"></dd>
    </dl>
    <input type="submit" value="Login">
</form>