<?php
session_start();

include_once 'modules/functions.php'; 
$host = get_ip();
//echo get_tstatus(95);
//$host = '192.168.0.1';
//echo $_SESSION["host"];



//if (get_ip() == '127.0.0.1') {
if (auth($host)) {

    include_once "modules/header.php";
}

else {
    $_SESSION["auth"] = false;
    echo 'sign in please';
}

$result = get_ticket('admin');
while ($row = $result->fetch_assoc())
   {
       // Оператором echo выводим на экран поля таблицы name_blog и text_blog
       echo $row['ticket_id'] . "\n";
       echo $row['client_id'] . "\n";
   }



include_once 'modules/footer.php';