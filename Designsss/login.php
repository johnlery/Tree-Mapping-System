<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Must fill up Username and/or Password!";
		}
	else if(isset($_POST['username'])&&isset($_POST['password']))
	{ 
	// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// Selecting Database
		$db = mysql_select_db("db_mapping", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("SELECT * FROM tbl_admin WHERE password='$password' AND username='$username'", $connection);
		$rows = mysql_num_rows($query);

		//echo $rows;
	if ($rows == 1) { 
		$_SESSION['login_user']=$username; // Initializing Session
		header("location: admin.php"); // Redirecting To Other Page
		} 
	else {
		header("location: index.php?status=error");
		}
		mysql_close($connection); // Closing Connection
	}
	else {
		session_start();
		if(session_destroy()) // Destroying All Sessions
		{
		header("Location: index.php"); // Redirecting To Home Page
		}
	}
	}
?>