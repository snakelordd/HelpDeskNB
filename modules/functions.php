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

function insert_db($client_id, $t_category, $t_theme, $t_problem, $t_file = NULL) {

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if ($t_file) {
		$sql = "INSERT INTO tickets (client_id, ticket_category, ticket_theme, ticket_problem, ticket_file)
		VALUES ('$client_id','$t_category', '$t_theme', '$t_problem', '$t_file')";
	}
	else {
		$sql = "INSERT INTO tickets (client_id, ticket_category, ticket_theme, ticket_problem)
		VALUES ('$client_id', '$t_category', '$t_theme', '$t_problem')";
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

function get_ip() {
	return $_SERVER['REMOTE_ADDR'];
}

function get_client_id($ip) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$sql = "SELECT `client_id` FROM `clients` WHERE `client_ip` =  '$ip' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result); 
	//while ($row = mysqli_fetch_array($result)) {
	$client_id = $row['client_id'];
	$conn->close();

	return $client_id;

}

function set_client_id($ip, $id) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO clients (client_ip, client_id)
	VALUES ('$ip','$id')";



	if ($conn->query($sql) === TRUE) {
	    return true; //echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

function auth($host) {
	if ($_SESSION["host"] == $host) {
		$_SESSION["auth"] = true;
		return true;
	}
	else {
		if (get_client_id($host)) {
			$_SESSION["host"] = $host;
			$_SESSION["auth"] = true;
			return true;
		}
		else { 
			$_SESSION["auth"] = false;
			return false;
		}
	}
}

?>