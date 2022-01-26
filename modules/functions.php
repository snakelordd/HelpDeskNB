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

function insert_ticket($client_id, $t_category, $t_theme, $t_problem, $t_file = NULL) {

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

function insert_res($ticket_id, $resolution, $comment = null) {

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if (!$comment) {
		$sql = "INSERT INTO resolution (ticket_id, ticket_resolution)
		VALUES ('$ticket_id','$resolution')";
	}
	else {
		$sql = "INSERT INTO resolution (ticket_id, ticket_resolution, ticket_comment)
		VALUES ('$ticket_id','$resolution', '$comment')";
	}
	if ($conn->query($sql) === TRUE) {
	    return true; //echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

function get_ticket($client_id, $sql = null) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
		die("connction failed: " . $conn->connect_error);
	}
	if ($sql == null) {
		$sql = "SELECT * FROM `tickets` WHERE `client_id` =  '$client_id'";
	}
	
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0)
	{
	    $conn->close();
	    return $result;
	}
	else {
		$conn->close();
		return 'empty';
	}	
}

function get_one_ticket($id) {
	if ($id == null) {
		die;
	}
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
		die("connction failed: " . $conn->connect_error);
		echo 'err2';
	}
	$sql = "SELECT * FROM `tickets` WHERE `ticket_id` =  '$id'";
	$result = mysqli_query($conn, $sql);
	return $result;
}

function get_allTickets($sql=null) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
		die("connction failed: " . $conn->connect_error);
		echo 'err2';
	}
	if ($sql==null) {
		$sql = "SELECT * FROM `tickets`";
	}
	$result = mysqli_query($conn, $sql);
	$conn->close();
	return $result;
}
function sortby() {

	$host = $_SESSION['host_id'];

	if (isset($_GET['sort'])) {
		$sort = $_GET['sort'];
	}
	else if (isset($_SESSION['sort'])) {
		$sort = $_SESSION['sort'];
	}
	else {
		$sql = "SELECT * FROM `tickets` ORDER BY t_date DESC";
		$result = get_allTickets($sql);
		if (!$result) {
			echo 'err';
		}
		return $result;
	}
	switch ($sort) {
		case 'date':
			
			if ($_SESSION['host_id'] == 'admin') {
				$sql = "SELECT * FROM `tickets` ORDER BY t_date DESC";
				$result = get_allTickets($sql);
			}
			else {
				$sql = "SELECT * FROM `tickets` WHERE client_id = '$host' ORDER BY t_date DESC";
				$result = get_ticket($host, $sql);
			}
			return $result;
			break;
		case 'priority':
			
			if ($_SESSION['host_id'] == 'admin') {
				$sql = "SELECT * FROM `tickets` ORDER BY ticket_priority  DESC";
				$result = get_allTickets($sql);
			}
			else {
				$sql = "SELECT * FROM `tickets` WHERE client_id = '$host' ORDER BY ticket_priority DESC";
				$result = get_ticket($host, $sql);
			}
			return $result;
			break;
		case 'category':
			
			if ($_SESSION['host_id'] == 'admin') {
				$sql = "SELECT * FROM `tickets` ORDER BY ticket_category, t_date";
				$result = get_allTickets($sql);
			}
			else {
				$sql = "SELECT * FROM `tickets` WHERE client_id = '$host' ORDER BY ticket_category, t_date";
				$result = get_ticket($host, $sql);
			}
			return $result;
			break;
		case 'status':
			
			if ($_SESSION['host_id'] == 'admin') {
				$sql = "SELECT * FROM `tickets` ORDER BY ticket_status, t_date DESC";
				$result = get_allTickets($sql);
			}
			else {
				$sql = "SELECT * FROM `tickets` WHERE client_id = '$host' ORDER BY ticket_status, t_date DESC";
				$result = get_ticket($host, $sql);
			}
			return $result;
			break;
		case 'author':
			
			if ($_SESSION['host_id'] == 'admin') {
				$sql = "SELECT * FROM `tickets` ORDER BY client_id, t_date DESC";
				$result = get_allTickets($sql);
			}
			else {
				$sql = "SELECT * FROM `tickets` WHERE client_id = '$host' ORDER BY client_id, t_date DESC";
				$result = get_ticket($host, $sql);
			}
			return $result;
			break;
		default:
			$result = get_ticket($_SESSION['host_id']);
			return $result;
			break;
	}
}

function get_tid($client_id, $t_category, $t_theme, $t_problem) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT `ticket_id` FROM `tickets` WHERE `client_id` = '$client_id' AND `ticket_category` = '$t_category' 
												AND `ticket_theme` = '$t_theme' AND `ticket_problem` = '$t_problem' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$ticket_id = $row['ticket_id'];
	$conn->close();
	return $ticket_id;

}
function get_tstatus($t_id) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT `ticket_status` FROM `tickets` WHERE `ticket_id` =  '$t_id' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$t_status = $row['ticket_status']; 
	return $t_status;
}


function set_status($status, $ticket_id) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "UPDATE tickets SET ticket_status = '$status' WHERE ticket_id = '$ticket_id'";

	if ($conn->query($sql) === TRUE) {
	return true; //echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();

}

function get_ip() {
	return $_SERVER['REMOTE_ADDR'];
}

function get_client_id($ip) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

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

function set_priority($priority, $ticket_id) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "UPDATE tickets SET ticket_priority = '$priority' WHERE ticket_id = '$ticket_id'";

	if ($conn->query($sql) === TRUE) {
	return true; //echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();

}

function auth($host) {
	if (isset($_SESSION["host"])) {		
		if ($_SESSION["host"] == $host) {
			$_SESSION["host_id"] = get_client_id($host);
			$_SESSION["auth"] = true;
			return true;
		}
		else {
			if (get_client_id($host)) {
				$_SESSION["host"] = $host;
				$_SESSION["host_id"] = get_client_id($host);
				$_SESSION["auth"] = true;
				return true;
			}
			else { 
				$_SESSION["auth"] = false;
				return false;
			}
		}
	}
	else {
		if (get_client_id($host)) {
			$_SESSION["host"] = $host;
			$_SESSION["host_id"] = get_client_id($host);
			$_SESSION["auth"] = true;
			return true;
			}
		else { 
			$_SESSION["auth"] = false;
			return false;
		}
	}
	
}

function ajax($ticket_id, $priority) {
	if (strlen($priority) <= 1) {
		return 'onClick="myFu(' . $ticket_id .',' . $priority . ');"';
	}
	else {
		return 'onClick="setStatus(' . $ticket_id .  ', \'' . $priority . '\');"';
	}
}

?>