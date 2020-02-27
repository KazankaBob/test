<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="main">
    <div class="avt">
        <h1 class="avt2">Авторизация</h1>
        <form method="post" action="">
            <label>Введите логин</label><br>
            <input type="text" name="login" required maxlength="50"><br>
            <label>Введите пароль</label><br>
            <input type="password" name="password" required maxlength="50"><br>
            <input type="submit" name="submit" value="Войти"><br>
            <a href="register.php" class="silka">Зарегистрироваться</a><br>
            <a href="index2.php" class="silka2">Заполнить заявление без регистрации</a>
        </form>
    </div>
    <br>
    <br/>
</div>
</body>
</html>

<?php
session_start();
require_once("mysitedb.php");
if (isset($_POST['login'], $_POST['password']))     //если форма заполнена, то идем дальше
{
    $login=$_POST['login'];     //присваиваем переменным значения из формы
    $password=$_POST['password'];
    $password=md5($password);
    $query = "SELECT * FROM users WHERE login='$login' AND password='$password';"; //запрос на существования логина в таблице
    $result = pg_query($link, $query) or die(pg_last_error($link));

    if(pg_num_rows($result)==1) //если передается одна строка, то присваиваем ссесии значение переменной по ключу логин
    {
        $_SESSION['login']=$login;
    }
    else
    {
        echo "Неправильный логин или пароль";
    }
}
if(isset($_SESSION['login']))
{
    $login=$_SESSION['login'];
    echo "Привет $login"."</br>";
    echo "<a href='logout.php'>Выйти</a>";
    header('Location:index2.php'); //перенаправление на главную страницу
}
?>