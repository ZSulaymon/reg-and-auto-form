<?php
require "db.php";
require "style.php";
$data = $_POST;
if(isset($data['do_signup']))
{
    $errors = array();
    if(trim($data['login'])== '' )
    {
        $errors[]= 'Введите логин';
    }
    if(trim($data['email'])=='' )  
    {
        $errors[]= 'Введите email';
    }
    if($data['password']=='' )
    {
        $errors[] = 'Введите пароль';
    }
    if($data['password_2'] =='' )
    {
        $errors[] = 'Введите повторный пароль!';
    }
   
    if($data['password_2'] !=$data['password'] )
    {
        $errors[] = 'Пароли не совпадают !';
    }
    if ( R::count('users', "login= ?", array ($data['login'])) > 0)
    {
        $errors[] = 'Пользователь с таким логином уже существует';
    }
    if ( R::count('users', "email= ?", array ($data['email'])) > 0)
    {
        $errors[] = 'Пользователь с таким email-ом уже существует';
    }


    if( empty($errors) )
    {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color:blue;" class="login-form">Вы успешно зарегистрированы!</div><hr>';
    }else
    {
        echo '<div style="color:blue;" class="login-form">'.array_shift($errors).'</div><hr>';
    }

}
?>

<form action="sign-up.php" method="POST" class="login-form">

   <p>
    <p><strong> Ваш логин </strong>:</p>
    <input type= "text" name = "login" value="<?php echo $data['login']; ?>">
   </p>

   <p>
   <p><strong> Ваш Email </strong>:</p>
   <input type= "email" name = "email" value="<?php echo $data['email']; ?>">
  </p>

  <p>
    <p><strong> Ваш пароль </strong>:</p>
    <input type= "password" name = "password" value="<?php echo $data['password']; ?>">
   </p>

   <p>
    <p><strong>Введите Ваш пароль еще раз </strong>:</p>
    <input type= "password" name = "password_2" value="<?php echo $data['password_2']; ?>">
   </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
    <p>
    <a href= "login.php"><button>Login</a></button></a>
    </p>
</form>