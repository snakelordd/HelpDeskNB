<?php
session_start();

include_once 'modules/functions.php'; 
$host = get_ip();
//$host = '192.168.0.2';
//echo $_SESSION["host"];


//if (get_ip() == '127.0.0.1') {
if (auth($host)) {

    include_once "modules/header.php";
}

else {
    $_SESSION["auth"] = false;
    echo 'sign in please';
}


?>



<?php
include_once 'modules/footer.php';