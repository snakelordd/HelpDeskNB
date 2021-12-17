<?php 

include_once 'functions.php';

  $t_category = htmlspecialchars(trim($_POST['t_category']));
  $t_theme = htmlspecialchars(trim($_POST['t_theme']));
  $t_describe = htmlspecialchars(trim($_POST['t_describe']));
  $t_file =  htmlspecialchars(trim($_POST['t_inputfile']));
  $location = get_url("modules/newticket.php");

  if (insert_db($t_category, $t_theme, $t_describe, $t_file)) {
  	header("Location: $location");
  	exit;
  }


