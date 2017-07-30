<?php
error_reporting(E_ALL);

$db_name = 'database.txt'; //имя файла с данными счетчика

if(!empty($_POST['name'])) {
    $name = $_POST['name'];
 } else $name = "Visitor";

if(!isset($_COOKIE['name'])) {      //если Нет Куки
    $message = '<p style="color: red; font-weight: bold">The SITE doesn\'t have  $_COOKIE</p>'.'<br>';
    setcookie('name', $name, time()+3600);   // устанавливаем Куки

    if(is_readable($db_name)){    //если файл существует
        file_put_contents($db_name, (((int)file_get_contents($db_name, true))+1));         // записываем новое значение счетчика
        $my_count = (int)file_get_contents($db_name, true);

    } else {
        $my_count = 0;              //если файла нет, создаем значение счетчика
        file_put_contents($db_name, $my_count); // создаем файл, записываем значение
    }
} else {                                  //если куки Есть
    $message = '<p style="color: green; font-weight: bold">The SITE has  $_COOKIE</p>'.'<br>';
    $my_count = (int)file_get_contents($db_name, true); //получаем значение счетчика
}
?>

    <!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>SITE </title>
</head>
<body>
<br>
<p style="color: #138b0d; font-size: 18px; font-weight: 700">Hello, <?=$name?>!</p>
<br>
<form method="POST">
    <input type="text" name="name">
    <input type="submit">

</form>

<p style="margin: auto; width: 30%; padding: 20px; border: solid 5px red;font-size: 18px; font-weight: 500;">
    Number visitors : <?=$my_count?></p>
<br>
<p style="color: forestgreen"> <?php if(isset($message)) { echo $message;} ; ?> </p>
<br>
<p style="color: forestgreen">var_dump $_COOKIE =  <p style="color: #800080"> <?php var_dump ($_COOKIE); ?> </p></p>
<br>
<p style="color: forestgreen">var_dump $_POST =  <p style="color: #800080"> <?php var_dump ($_POST); ?> </p></p>
<br>
<br>
<!--<a href="pattern.php" style="color: red; font-size: 20px; font-weight: bold">Go to the PATTERN</a>-->
<br>
<br>
<br>
<br>

</body>
</html>
