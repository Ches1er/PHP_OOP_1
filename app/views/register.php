<h2>Register</h2>

<?php  if(!empty($errors)): ?>
    <div class="error"><?=$errors?></div>
<?php endif;?>

<form action="/register/handle" method="post">
    <dl>
        <dt>Login:</dt>
        <dd><input type="text" name="login"
            <?php if(!empty($old["login"])) echo "value='{$old["login"]}'"; ?>
            ></dd>

        <dt>Password:</dt>
        <dd><input type="password" name="pass"
                <?php if(!empty($old["pass"])) echo "value='{$old["pass"]}'"; ?>
            ></dd>

        <dt>Password confirm:</dt>
        <dd><input type="password" name="pass2"
                <?php if(!empty($old["pass2"])) echo "value='{$old["pass2"]}'"; ?>
            ></dd>
    </dl>
    <input type="submit" value="Register">
</form>