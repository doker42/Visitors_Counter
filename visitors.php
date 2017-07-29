<?php
error_reporting(E_ALL);

function get_content($file_name){    //функция для получения значения счетчика
    $count = (int)file_get_contents($file_name, true);
    return $count;
}

$db_name = 'database.txt'; //имя файла с данными счетчика

if(isset($_POST['name'])  &&  !empty($_POST['name'])) {
    $name = $_POST['name'];
 } else $name = "Visitor";

if(!isset($_COOKIE['name'])) {      //если Нет Куки
    $message = 'None COOKIE'.'<br>';
    setcookie('name', $name, time()+3600);   // устанавливаем Куки

    if(is_readable($db_name)){    //если файл существует
        $my_count = get_content("$db_name");  // получаем значение счетчика
        $my_count = $my_count + 1;             // иттерируем
        $database = fopen($db_name, 'w+');    // открываем и обнуляем файл
        fwrite($database, $my_count);          // записываем новое значение счетчика
    } else {
        $my_count = 0;              //если файла нет, создаем значение счетчика
        $database = fopen($db_name, 'w+');  // создаем файл
        fwrite($database, $my_count);      // записываем значение
    }

} else {                                  //если куки Есть
    $message = 'Hello, $_COOKIE'.'<br>';
    $my_count = get_content("$db_name");   //получаем значение счетчика
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

<p style="border: solid 3px blue;font-size: 18px; font-weight: 500;">
    Number visitors : <?=$my_count?></p>
<br>
<p style="color: forestgreen"> <?php if(isset($message)) { echo $message;} ; ?> </p>
<br>
<p style="color: forestgreen">var_dump $_COOKIE =  <p style="color: #800080"> <?PHP var_dump ($_COOKIE); ?> </p></p>
<br>
<p style="color: forestgreen">var_dump $_POST =  <p style="color: #800080"> <?PHP var_dump ($_POST); ?> </p></p>
<br>
<br>
<!--<a href="pattern.php" style="color: red; font-size: 20px; font-weight: bold">Go to the PATTERN</a>-->
<br>
<br>
<br>
<br>

</body>
</html>
