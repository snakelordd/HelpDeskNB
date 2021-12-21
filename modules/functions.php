<?php

include_once 'config.php';


function get_url($page) {
	return HOST . "/$page";
}





// $preparedStatement = $db->prepare('INSERT INTO table (column) VALUES (:column)');

// $preparedStatement->execute([ 'column' => $unsafeValue ]);

function submit_check() {
	return true;
}

function insert_db($t_category, $t_theme, $t_problem, $t_file = NULL, $t_host = NULL) {

	 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	 // Check connection
	 if ($conn->connect_error) {
	     die("Connection failed: " . $conn->connect_error);
	 }
	 if ($t_file) {
	 	$sql = "INSERT INTO tickets (ticket_category, ticket_theme, ticket_problem, ticket_file)
	 	VALUES ('$t_category', '$t_theme', '$t_problem', '$t_file')";
	 }
	 else {
	 	$sql = "INSERT INTO tickets (ticket_category, ticket_theme, ticket_problem)
	 	VALUES ('$t_category', '$t_theme', '$t_problem')";
	 }


	 if ($conn->query($sql) === TRUE) {
	     return true; //echo "New record created successfully";
	 } else {
	     echo "Error: " . $sql . "<br>" . $conn->error;
	 }

	 $conn->close();
}

function get_status() {}


function set_status() {}


?>