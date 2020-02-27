<?php
session_start();
require_once 'mail.php';//подключение библиотеки отправки почты
require_once("mysitedb.php");//подключение к бд
echo "<div class='link'><img src='2.png' class=\"leftimg2\" alt='gosuslugi'>";
if($_SESSION['login']) // если пользователь авторизован, то выводим его данные в поля для ввода
{
    $query = "SELECT * FROM users where login='" . $_SESSION['login'] . "' LIMIT 1;";
    $result = pg_query($link, $query);
    while ($res = pg_fetch_assoc($result)) {
        $family = $res['family'];
        $name = $res['name'];
        $secname = $res['secname'];
        $data_rog = $res['data_rog'];
        $place_live = $res['place_live'];
        $place_rog = $res['place_rog'];
        $data_vid = $res['data_vid'];
        $pol = $res['pol'];
        $num_doc = $res['num_doc'];
    }
    echo "<label class='fam'> $family </label>";
    echo "<a href='logout.php' class='a'>Выйти</a>";
}
else
{
    echo "<a href='index.php' class='a'>Войти</a>"."<br/>";

}
echo "</div>";
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Заявление</title>
        <link href="style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
    <hr class="hr3">
    <main>
    <div>

        <img src="1.jpg" class="leftimg">
        <h1 class="header">
        Предоставление временного убежища на территории Российской Федерации.
        Оформление и выдача свидетельства о предоставлении временного убежища.
    </h1>
    </div>
    <hr class="hr">
    <h1 class="glav">
        Ваши данные
    </h1>
    <hr>
        <div class="otstyp">
    <h1>
        1. <b class="size">Персональные данные</b>
    </h1>
    <form method="post" enctype="multipart/form-data">
        <div class="family">
        <label>Фамилия</label>
        <input name="family" required type="text" maxlength="50" value="<?php echo $family; ?>"">
        </div>
        <div class="family"">
        <label>Имя</label>
        <input name="name"  class="name" required type="text" maxlength="50" value="<?php echo $name; ?>">
        </div>
        <div class="family">
        <label>Отчество</label>
        <input name="secname" class="secname" required type="text" maxlength="50" value="<?php echo $secname; ?>"><br/>
        </div>
        <div class="family">
        <label>Дата рождения</label>
        <input name="datarog"  class="datarog" type="date" required value="<?php echo $data_rog; ?>"><br/>
        </div>
        <hr>
        <div class="otstyp">
        <h1>
        2. <b class="size">Документ, удостоверяющий личность</b>
        </h1>
        <div class="family">
        <label>Государство  гражданской  принадлежности  (для лиц без гражданства - страна
        прежнего обычного местожительства)</label>
        <input name="placelive" required type="text" maxlength="50" value="<?php echo $place_live; ?>"><br/>
        <label>Место рождения</label>
        <input name="placerog" required type="text" maxlength="50" value="<?php echo $place_rog; ?>"><br/>
        <label>Дата выдачи</label>
        <input name="datavid" type="date" required value="<?php echo $data_vid; ?>"><br/>
        </div>
        <label class="pol">Пол</label><br/><br/>
        <input type=radio value="Мужской" name="pol" required class="radio">
        <label class="pol">Мужской</label>
        <input type=radio value="Женский" name="pol" class="radio">
        <label class="pol">Женский</label><br/>
        <div class="family">
        <label class="num">Номер документа</label>
        <input class="num" name="number" min="0"  required type="number" maxlength="20" value="<?php echo $num_doc; ?>"><br/>
        </div>
        <label class="pol">При отсутствии документа, удостоверяющего личность, загрузите скан-копию документа, прямо или косвенно подтверждающего
            вашу личность</label><br/>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000">
        <input type="file" class="file" name="photo" multiple accept="image/*"><br/>
        </div>
        <hr>
        <div class="otstyp">
        <h1>
            3.  <b class="size">Данные членов семьи, прибывших с вами,
                не достигших 18 лет</b><br/>
        </h1>
            <div class="table">
        <table>

            <tr>
                <td>Фамилия,имя,отчество(при наличии)</td>
                <td>Дата и место рождения</td>
                <td>Степень родства</td>
            </tr>
            <tr>
                <td><input name="name2" maxlength="150"></td>
                <td><input name="datarog2" type="date"></td>
                <td><input name="strod2" maxlength="50"></td>
            </tr>
            <tr>
                <td><input name="name3" maxlength="150"></td>
                <td><input name="datarog3" type="date"></td>
                <td><input name="strod3" maxlength="50"></td>
            </tr>
            <tr>
                <td><input name="name4" maxlength="150"></td>
                <td><input name="datarog4" type="date"></td>
                <td><input name="strod4" maxlength="50"></td>
            </tr>
            <tr>
                <td><input name="name5" maxlength="150"></td>
                <td><input name="datarog5" type="date"></td>
                <td><input name="strod5" maxlength="50"></td>
            </tr>
            <tr>
                <td><input name="name6" maxlength="150"></td>
                <td><input name="datarog6" type="date"></td>
                <td><input name="strod6" maxlength="50"></td>
            </tr>
            <tr>
                <td><input name="name7" maxlength="150"></td>
                <td><input name="datarog7" type="date"></td>
                <td><input name="strod7" maxlength="50"></td>
            </tr>

        </table>
            </div>
        </div>
        <hr>
        <h1 class="glav">
            Выбор органа МВД<br/>
        </h1>
        <hr>
        <div class="otstyp">
        <h1>
            4. <b class="size">Где выхотите получить свидетельство о
                предоставлении временного убежища</b><br/>
        </h1>
            <label class="adress">Выберите адрес</label><br><br>
        <select name="ad" required class="sel">
            <option value="просп. Культуры, 12, корп. 3, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                просп. Культуры, 12, корп. 3, Санкт-Петербург, Россия
            </option>
            <option value="Лужская ул., 9, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                Лужская ул., 9, Санкт-Петербург, Россия
            </option>
            <option value="Колтушское ш., 138А, Всеволожск, Россия">
                Паспортные и миграционные службы;
                Колтушское ш., 138А, Всеволожск, Россия
            </option>
            <option value="Гражданский просп., 90, корп. 8, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                Гражданский просп., 90, корп. 8, Санкт-Петербург, Россия
            </option>
            <option value="ул. Маршала Новикова, 4, корп. 3, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Маршала Новикова, 4, корп. 3, Санкт-Петербург, Россия
            </option>
            <option value="ул. Ильюшина, 18А, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Ильюшина, 18А, Санкт-Петербург, Россия
            </option>
            <option value="ул. Генерала Хрулёва, 15, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Генерала Хрулёва, 15, Санкт-Петербург, Россия
            </option>
            <option value="ул. Передовиков, 3, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Передовиков, 3, Санкт-Петербург, Россия
            </option>
            <option value="Садовая ул., 58В, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                Садовая ул., 58В, Санкт-Петербург, Россия
            </option>
            <option value="ул. Дыбенко, 40, корп. 2, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Дыбенко, 40, корп. 2, Санкт-Петербург, Россия
            </option>
            <option value="просп. Большевиков, 30, корп. 5, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                просп. Большевиков, 30, корп. 5, Санкт-Петербург, Россия
            </option>
            <option value="ул. Новосёлов, 4, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Новосёлов, 4, Санкт-Петербург, Россия
            </option>
            <option value="просп. Большевиков, 59, корп. 3, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                просп. Большевиков, 59, корп. 3, Санкт-Петербург, Россия
            </option>
            <option value="Ленинский просп., 98, корп. 1, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                Ленинский просп., 98, корп. 1, Санкт-Петербург, Россия
            </option>
            <option value="ул. Костюшко, 68, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Костюшко, 68, Санкт-Петербург, Россия
            </option>
            <option value="ул. Ленсовета, 51, корп. 2, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                ул. Ленсовета, 51, корп. 2, Санкт-Петербург, Россия
            </option>
            <option value="просп. Маршала Жукова, 70, корп. 1, Санкт-Петербург, Россия">
                Паспортные и миграционные службы;
                просп. Маршала Жукова, 70, корп. 1, Санкт-Петербург, Россия
            </option>
            <option value="Павловская ул., 1/21, Колпино, Россия">
                Паспортные и миграционные службы;
                Павловская ул., 1/21, Колпино, Россия
            </option>
            <option value="ул. Вячеслава Шишкова, 32/15, Пушкин, Россия">
                Паспортные и миграционные службы;
                ул. Вячеслава Шишкова, 32/15, Пушкин, Россия
            </option>
            <option value="просп. 25 Октября, 7, Гатчина, Россия">
                Паспортные и миграционные службы;
                просп. 25 Октября, 7, Гатчина, Россия
            </option>
        </select><br><br>
        <br/>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A02b7cf99e341cf50c30affa0088fd4889ab3fa6cc5938099c33afcc448b91557&amp;width=544&amp;height=520&amp;lang=ru_RU&amp;scroll=true">
        </script>
        </div>
        <hr>
        <div class="otstyp">
        <input type="checkbox" required>
        <label class="check">Согласие на обработку персональных данных</label><br/>
        <input type="checkbox" required>
        <label class="check">Я и члены моей семьи (лица, находящиеся под моей опекой), не достигшие
        возраста восемнадцати лет,ознакомлены с правами и обязанностями,
        определенными Федеральныи законом от 19 февраля 1993г. №4528-1 "О беженцах"</label><br/>
        </div>
        <input type="submit" class="knopka ">
        <br>
    </form>
    </main>
    <hr><br><br>
    </body>
    </html>

<?php


//Заполнение заявления
if(!empty($_POST['family'] && $_POST['name']    // если форма заполнена, то идем дальше
    && $_POST['secname'] && $_POST['placelive']
    &&  $_POST['datarog'] && $_POST['placerog'])) {
    $lines = file('doc1.docx');//преобразуем файл в массив
    //записываем в определенные строчки файла данные из формы
    $lines[5] = stripslashes(strip_tags($_POST['family'] . " " . $_POST['name'] . " " . $_POST['secname'] . " " . "\r\n"));
    $lines[9] = stripslashes(strip_tags($_POST['placelive'] . "\r\n"));
    $lines[11] = stripslashes(strip_tags($_POST['datarog'] . "\r\n"));
    $lines[12] = stripslashes(strip_tags($_POST['placerog'] . "\r\n"));
    //заполнение необязательных полей
    if (!empty($_POST['name2'] && $_POST['datarog2'] && $_POST['strod2']))
        $lines[15] = stripslashes(strip_tags($_POST['name2'] . ", " . $_POST['datarog2'] . ", " . $_POST['strod2'] . "\r\n"));
    if (!empty($_POST['name3'] && $_POST['datarog3'] && $_POST['strod3']))
        $lines[16] = stripslashes(strip_tags($_POST['name3'] . ", " . $_POST['datarog3'] . ", " . $_POST['strod3'] . "\r\n"));
    if (!empty($_POST['name4'] && $_POST['datarog4'] && $_POST['strod4']))
        $lines[17] = stripslashes(strip_tags($_POST['name4'] . ", " . $_POST['datarog4'] . ", " . $_POST['strod4'] . "\r\n"));
    if (!empty($_POST['name5'] && $_POST['datarog5'] && $_POST['strod5']))
        $lines[18] = stripslashes(strip_tags($_POST['name5'] . ", " . $_POST['datarog5'] . ", " . $_POST['strod5'] . "\r\n"));
    if (!empty($_POST['name6'] && $_POST['datarog6'] && $_POST['strod6']))
        $lines[19] = stripslashes(strip_tags($_POST['name6'] . ", " . $_POST['datarog6'] . ", " . $_POST['strod6'] . "\r\n"));
    if (!empty($_POST['name7'] && $_POST['datarog7'] && $_POST['strod7']))
        $lines[20] = stripslashes(strip_tags($_POST['name7'] . ", " . $_POST['datarog7'] . ", " . $_POST['strod7'] . "\r\n"));
    $zayv = "Statement_" . $_POST['family'] . "_" . $_POST['number'];  // создание имени заявление
    $res1=file_put_contents("file/$zayv.docx", $lines);       //пишем строки в файл и сохраняем в выбранной директиве
}


//Заполнение паспортных данных
if(!empty($_POST['family'] && $_POST['name']
    && $_POST['secname'] && $_POST['placelive']
    && $_POST['datarog'] && $_POST['placerog']
    && $_POST['pol'] && $_POST['datavid']
    && $_POST['number'] && $_POST['ad'])) {
    $passport = file('doc3.docx');
    $passport[1] = stripslashes(strip_tags($_POST['family'] . " " . $_POST['name'] . " " . $_POST['secname'] . " " . "\r\n"));
    $passport[3] = stripslashes(strip_tags($_POST['pol'] . "\r\n"));
    $passport[5] = stripslashes(strip_tags($_POST['placelive'] . "\r\n"));
    $passport[7] = stripslashes(strip_tags($_POST['datarog'] . "\r\n"));
    $passport[9] = stripslashes(strip_tags($_POST['placerog'] . "\r\n"));
    $passport[11] = stripslashes(strip_tags($_POST['datavid'] . "\r\n"));
    $passport[13] = stripslashes(strip_tags($_POST['number'] . "\r\n"));
    $passport[16] = stripslashes(strip_tags($_POST['ad'] . "\r\n"));
    $pass = "Passport_" . $_POST['family'] . "_" . $_POST['number'];    //паспорт
    $res2=file_put_contents("file/$pass.docx", $passport);
}

$skan="Copy_".$_POST['family']."_".$_POST['number'];        //присвоение переменной нового имени для загружаемого файла

//сохранение файла
$original_name = $_FILES["photo"]["name"];
//Получить расширение файла
$extension = pathinfo($original_name, PATHINFO_EXTENSION);
//Придумать новое имя файла с расширением загружаемого файла
$new_name = $skan.'.'.$extension;
//и загружаем уже с измененным именем
move_uploaded_file($_FILES["photo"]["tmp_name"],"file/" . $new_name);


//Отправка файлов на почту
if($res1 && $res2) {
    $mail = new Mail;
    $mail->from('dgabdd@222gamaili.com', 'МВД');

// Кому, можно указать несколько адресов через запятую.
    $mail->to('dgabdd@gmail.com', 'МВД');

// Тема письма.
    $mail->subject = 'Заявление на предоставление временного убежища';

// Текст.
    $mail->body = '<h1>от '.$_POST['family'].' '.$_POST['name'].' '.$_POST['secname'].'</h1>';
    $mail->addFile('file/'.$zayv.'.docx');      //добавление файлов
    $mail->addFile('file/'.$pass.'.docx');
    $mail->addFile('file/'.$new_name);


// Отправка.
    $mail->send();
}

?>