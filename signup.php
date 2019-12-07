<?php

	//Username and Password from user
	$userName = $_POST['uName'];
	$password = $_POST['pass'];
	
	//Don't run if a blank username or password were submitted.
	if (!empty($userName) && !empty($password))
	{
		//DB connection vars. 
		//To the students in the group: You'll need to change these to match your DB.
		$db_hostservername = "localhost";
		$db_username = "id10850490_id10698915_dbusercool";
		$db_password = "mydbpasswordfor3750";
		$db_name = "id10850490_wordsprojectdb";
		
		$connection = new mysqli($db_hostservername, $db_username, $db_password, $db_name);
		
		if ($connection->connect_error)
		{
			die ("Connection failed: " . $connection->connect_error);
		}
		
		//To the students in the group: You'll need to change this to match your DB.
		$sql = "SELECT username FROM users WHERE username = ('$userName')";	
		//Run query
		$result = mysqli_query($connection, $sql);
		
		//Save query result as a var
		while($temp = $result->fetch_assoc())
		{
			  $finalResult = $temp["username"];
		}	

		if (!isset($finalResult))
		{
			$finalResult = "";
		}
		
		//Make sure username doesn't already exist in the database
		if ($finalResult == $userName)
		{
			include 'signup.html';
			echo "That username is already taken. Try something different.";
		}
		else
		{
			//Available chars for salt
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*)(';
			
			//Randomly mixes string of available chars for salt
			$mixedChars = str_shuffle($permitted_chars);
			
			//Trims random mixture of possible salt and trims it to 12 chars
			$salt = substr($mixedChars, 0, 12);
								
			//Append user's password with salt
			$saltedPassword = $password;
			$saltedPassword .= $salt;
			
			//Hash the salted user's password
			$hashedString = hash("sha256", $saltedPassword);
			
			//To the students in the group: You'll need to change these two to match your DB.
			$importQuery =	"INSERT INTO users (username, salt, hash) VALUES ('$userName', '$salt', '$hashedString')";
			$fetchQuery = "SELECT * from users WHERE username = ('$userName')";
			//Run queries
			$runImportQuery = mysqli_query($connection, $importQuery);
			$runFetchQuery = mysqli_query($connection, $fetchQuery);
			
			//Verify that import worked
			while($tempTwo = $runFetchQuery->fetch_assoc())
			{
			  $importSuccess = $tempTwo["username"];
			}			
			
			//If the user's hashed password equals the hash found in the DB, they're logged in successfully
			if ($importSuccess == $userName)
			{
				include 'index.html';
				echo "User created successfully.";
			}
			else
			{
				include 'signup.html';
				echo "An error occurred when trying to create user.";
			}
		}
	}
	else
	{
		include 'signup.html';
		echo "Be sure to fill out both the username and password fields.";
	}
	
	die();
?>



	
	



	
	