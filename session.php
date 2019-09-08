<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection= new MongoClient();
	$db = $connection->blood;
	$collection = $db->donordetail;
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['user'];
	$criteria = array(
				'uname' => $user_check
			);
	$doc = $collection->findOne($criteria);
	$login_session =$doc['uname'];
	if(!isset($login_session)){
	$connection->close(); // Closing Connection
	header('Location: home.php'); // Redirecting To Home Page
	//session_destroy();
	}
	else
	{
		echo "Welcome";
		echo $login_session;
	}
?>