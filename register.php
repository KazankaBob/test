<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<main class="main">
    <div class="avt"">
        <h1 class="avt2">Регистрация</h1>
        <form method="post" action="">
            <label>Введите логин</label><br>
            <input type="text" name="login" required maxlength="50"><br>
            <label>Введите пароль</label><br>
            <input type="password" name="password" required maxlength="50"><br>
            <label>Введите имя</label><br>
            <input type="text" name="name" required maxlength="50"><br>
            <label>Введите фамилию</label><br>
            <input type="text" name="family" required maxlength="50"><br>
            <label>Введите отчество(при наличии)</label><br>
            <input type="text" name="secname" maxlength="50"><br>
            <label>Введите дату рождения</label><br>
            <input type="date" name="data_rog" required><br>
            <label>Введите государство гражданской принадлежности</label><br>
            <input type="text" name="place_live" required maxlength="50"><br>
            <label>Введите  место рождения полностью</label><br>
            <input type="text" name="place_rog" required maxlength="150"><br>
            <label>Введите номер документа,удостоверяющего личность</label><br>
            <input type="number" min="0"  name="num_doc" required maxlength="50"><br>
            <label>Введите дату выдачи документа,удостоверяющего личность</label><br>
            <input type="date" name="data_vid" required><br>
            <input type="submit" name="submit" value="Зарегистрироваться">
        </form>
    </div>
    <br>
    <br/>
</main>
</body>
</html>

<?php
require_once("mysitedb.php");
if (isset($_POST['login'], $_POST['password'], $_POST['name'],
    $_POST['family'], $_POST['secname'], $_POST['data_rog'],
    $_POST['place_live'], $_POST['data_vid'], $_POST['num_doc'])) // если форма полностью заполнена, то идем дальше
{
    $query = "SELECT * FROM users WHERE login='" . $_POST['login'] . "'"; // запрос на существование введенного логина
    $result = pg_query($link, $query);
    if (pg_num_rows($result) >= 1) {        //если передается хотя бы одна строка, то выводим сообщение
        echo "Пользователь с таким логином уже существует";
    }
    else
    {
        $login = trim(htmlspecialchars(stripslashes($_POST['login']))); //защита
        $password = trim(htmlspecialchars(stripslashes($_POST['password'])));
        $name = trim(htmlspecialchars(stripslashes($_POST['name'])));
        $family = trim(htmlspecialchars(stripslashes($_POST['family'])));
        $secname = trim(htmlspecialchars(stripslashes($_POST['secname'])));
        $data_rog = trim(htmlspecialchars(stripslashes($_POST['data_rog'])));
        $place_live = trim(htmlspecialchars(stripslashes($_POST['place_live'])));
        $place_rog = trim(htmlspecialchars(stripslashes($_POST['place_rog'])));
        $data_vid = trim(htmlspecialchars(stripslashes($_POST['data_vid'])));
        $num_doc = trim(htmlspecialchars(stripslashes($_POST['num_doc'])));
        $password = md5($password);
        $result_ins = pg_query($link, "INSERT INTO users VALUES 
        (DEFAULT,'$family','$name','$secname','$data_rog','$place_live',
        '$place_rog','$data_vid','$num_doc','$login','$password');");
        if ($result_ins)
        {
            echo "Регистрация прошла успешно";
            header('Location:index.php');
        }
        else echo "Ошибка";
    }
}
?>