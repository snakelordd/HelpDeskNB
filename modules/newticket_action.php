<?php 
session_start();

$message = '';

include_once 'functions.php';

  $t_category = htmlspecialchars(trim($_POST['t_category']));
  $t_theme = htmlspecialchars(trim($_POST['t_theme']));
  $t_describe = htmlspecialchars(trim($_POST['t_describe']));
  $t_file =  htmlspecialchars(trim($_POST['t_inputfile']));
  $location = get_url("modules/newticket.php");
  $client_id = $_SESSION["host"];


  if (isset($_SESSION["host"]) && $_SESSION["auth"] == true) {
    if (insert_db($client_id, $t_category, $t_theme, $t_describe, $t_file)) {
    		$message = 'success';
    		$_SESSION["message"] = $message;
    		if (submit_check()) {
  	  		//header("Location: $location");
  	  		header("Location: {$_SERVER["HTTP_REFERER"]}");
  	  		exit;
  		}
    }
    else $message = 'error';
    }
  else {
    $_SESSION["message"] = false;
    // header("Location: {$_SERVER["HTTP_REFERER"]}");
    // exit;
    echo $_SESSION["message"];
  }

session_destroy();

