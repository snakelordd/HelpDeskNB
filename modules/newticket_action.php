<?php 
session_start();

$message = '';

include_once 'functions.php';

  $t_category = htmlspecialchars(trim($_POST['t_category']));
  $t_theme = htmlspecialchars(trim($_POST['t_theme']));
  $t_describe = htmlspecialchars(trim($_POST['t_describe']));
  $t_file =  htmlspecialchars(trim($_POST['t_inputfile']));
  $location = get_url("modules/newticket.php");


  if (insert_db($t_category, $t_theme, $t_describe, $t_file)) {
  		$message = 'success';
  		$_SESSION["message"] = $message;
  		if (submit_check()) {
	  		//header("Location: $location");
	  		header("Location: {$_SERVER["HTTP_REFERER"]}");
	  		exit;
		}
  }
  else $message = 'error';

session_destroy();


/* session_start();
 
// Инициализация строки с сообщениями об ошибках
$message = '';
 
// Если запрос отправлен методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST"):
  $name = strip_tags($_POST["name"]);
  $age = (int)$_POST["age"];
 
  // Если поле `name` не заполнено
  if(empty($name)):
      $message = 'Поле `Ваше имя` обязательно к заполнению!';
  // Иначе, если поле `age` не заполнено
  elseif(empty($age)):
      $message = 'Поле `Ваш возраст` обязательно к заполнению!';
  // Если поля заполнены, записываем в сессию
  else:
      $_SESSION["name"] = $name;
      $_SESSION["age"] = $age;
  endif;
 
// Иначе берём данные из сессии
else:
    $name = $_SESSION["name"] ?? null;
    $age = $_SESSION["age"] ?? null;
endif;
?>