<?php 
require "db.php";
require "style.php";
?>

<?php if (isset($_SESSION['logged_user'])) : ?>
Авторизован! <br>
Привет, <?php echo $_SESSION['logged_user']->login; ?>! 
<hr>
<a href = "logout.php" class="login-form">Выйти </a>
<?php else : ?>
Вы не Авторизованы! <br>
<a href = "login.php" class="login-form">Авторизоваться</a> <br>
<a href = "sign-up.php" class="login-form">Регистрация</a>
<?php endif; ?> 