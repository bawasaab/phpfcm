<?php
	if( isset($_POST['token']) ) {


		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "fcm_push";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);

		// Check connection
		if ($conn->connect_error) {
		    // die("Connection failed: " . $conn->connect_error);
			echo json_encode([
				'received_token' => $_POST['token'],
				'connection' => $conn->connect_error
			]);
			die();		    
		} 

		$sql = "INSERT INTO tokens(token) VALUES ( '". $_POST['token'] ."' )"; 
		$flag = 0;
		if ($conn->query($sql) === TRUE) {
		    // echo "New record created successfully";
		    $flag = 1;
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

		if( $flag ) { 
			$status = 'Inserted';
		} else { 
			$status = 'Not inserted';
		}

		echo json_encode([
			'received_token' => $_POST['token'],
			'status' => $status
		]);
	}
?>