<?php
session_start();

include_once 'modules/functions.php'; 
$host = get_ip();

//$host = '192.168.0.2';
//echo $_SESSION["host"];
//if (get_ip() == '127.0.0.1') {
if (auth($host)) {
    //echo ($_SESSION['host_id']);
    include_once "modules/header.php";

}

else {
    $_SESSION["auth"] = false;
    echo 'sign in please';
}


echo $_SESSION['user_id'];

$result = ticket_search('another');

while ($row = $result->fetch_assoc()) {
    print_r($row);
    echo '<br>';
}
?>


<?php
include_once 'modules/footer.php';
