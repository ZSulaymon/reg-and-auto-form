<?php
require "db.php";
require "style.php";
$data = $_POST;
if (isset($data['do_login']) )
{
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if( $user)
    {
        if (password_verify($data['password'], $user->password))
        {
            $_SESSION['logged_user'] = $user;
            echo '<div style="color:green;" class="login-form"> Вы авторизованы!<br>Можете перейти на <a href="index.php" >главную </a> страницу</div><hr>';
        }else 
        {
            $errors[] = 'Неверно введен пароль!';
        }
    }else
    {
        $errors[] = 'Пользователь с таким логином не найден!';
    }
    
    if (! empty($errors))
    {
        echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
    }
}
?>

<form action = "login.php" method= "POST" class="login-form">

<p>
    <p><strong>Логин </strong>:</p>
    <input type= "text" name = "login" value="<?php echo $data['login']; ?>">
   </p>

<p>
    <p><strong>Пароль </strong>:</p>
    <input type= "text" name = "password" value="<?php echo $data['password']; ?>">
</p>


<p>
        <button type="submit" name="do_login">Войти</button>
</p>
