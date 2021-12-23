<?php
session_start();

include_once 'modules/functions.php'; 
//echo $_SERVER['REMOTE_ADDR'];
 //Запускаем сессии
 //$current_ip = $_SERVER['REMOTE_ADDR'];

if (get_ip() == '127.0.0.1') {
    include_once "modules/header.php";
    $_SESSION["host"] = get_ip();
    $_SESSION["auth"] = true;
}

else $_SESSION["auth"] = false;
// class AuthClass {
//     private $_ip = '127.0.0.1';

//     public function isAuth() {
//         if (isset($_SESSION["is_auth"])) {
//             return $_SESSION["is_auth"]);
//         }
//         else return false;
//     }

//     public function auth($ip) {
//         if ($ip == $this->_login) {
//             $_SESSION["is_auth"] = true;
//             $_SESSION["ip"] = $ip;
//             return true;
//         }
//         else {
//             $_SESSION["is_auth"] = false;
//             return false;        }
//     }

//     public function out() {
//         $_SESSION["is_auth"] = false;
//         return false; 
//     }
// }

// $auth = new AuthClass();


// // echo $current_ip;
// /** 
//  * Класс для авторизации
//  * @author дизайн студия ox2.ru 
//  */ 
// class AuthClass {
//     private $_login = "127.0.0.";
//     //private $_password = '123'; //Устанавливаем логин;
//     //private $_password = "www.ox2.ru"; //Устанавливаем пароль
 
//     /**
//      * Проверяет, авторизован пользователь или нет
//      * Возвращает true если авторизован, иначе false
//      * @return boolean 
//      */
//     public function isAuth() {
//         if (isset($_SESSION["is_auth"])) { //Если сессия существует
//             return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
//         }
//         else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
//     }
     
//     /**
//      * Авторизация пользователя
//      * @param string $login
//      *//// @param string $passwors 
//      //*/
//     public function auth($login) {
//         if ($login == $this->_login) { //Если логин и пароль введены правильно
//             $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
//             $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
//             return true;
//         }
//         else { //Логин и пароль не подошел
//             $_SESSION["is_auth"] = false;
//             return false; 
//         }
//     }
     
//     /**
//      * Метод возвращает логин авторизованного пользователя 
//      */
//     public function getLogin() {
//         if ($this->isAuth()) { //Если пользователь авторизован
//             return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
//         }
//     }
     
     
//     public function out() {
//         $_SESSION = array(); //Очищаем сессию
//         session_destroy(); //Уничтожаем
//     }
// }

// $auth = new AuthClass();
//  //$auth->login = "$current_ip";
// //if (isset($_POST["ip"])) { //Если логин и пароль были отправлены //Если логин и пароль введен не правильно
// if (isset($_POST["login"])) {

// }
 
// if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
//     if ($_GET["is_exit"] == 1) {
//         $auth->out(); //Выходим
//         header("Location: ?is_exit=0"); //Редирект после выхода
//     }
// }
 
// if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:  
//     include_once "modules/header.php";
//     echo "<br/><br/><a href='?is_exit=1'>Выйти</a>"; //Показываем кнопку выхода
// } 
// else { //Если не авторизован, показываем форму ввода логина и пароля
    

//     
// <form method="post" action="">
//     Логин: <input type="text" name="login"
//     value="<?php echo (isset($_POST["login"])) ? $_POST["login"] : null; // Заполняем поле по умолчанию " />
//     <br/>
//     Пароль: <input type="password" name="password" value="" /><br/>
//     <input type="submit" value="Войти" />
// </form>

// <?php 
//} 
//echo $auth->getLogin();























include_once 'modules/footer.php';