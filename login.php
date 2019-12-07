<?php

	//Username and Password from user
	$userName = $_POST['uName'];
	$password = $_POST['pass'];
	
	function GoToIndex() 
	{
		sleep(3);
		include 'index.html';
	}
	
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
		
		//Make sure username was indeed found in the database
		if ($finalResult != $userName)
		{
			include 'login2.html';
			echo "GG noob, that username wasn't found in the database.";
		}
		else
		{
			//To the students in the group: You'll need to change these two to match your DB.
			$fetchedSaltQuery =	"SELECT salt from users WHERE username = ('$userName')";
			$fetchedHashQuery = "SELECT hash from users WHERE username = ('$userName')";
			//Run queries
			$saltResult = mysqli_query($connection, $fetchedSaltQuery);
			$hashResult = mysqli_query($connection, $fetchedHashQuery);
			
			//Save query result as a var for salt
			while($tempTwo = $saltResult->fetch_assoc())
			{
			  $fetchedSalt = $tempTwo["salt"];
			}
			
			//Save query result as a var for hash
			while($tempThree = $hashResult->fetch_assoc())
			{
			  $fetchedHash = $tempThree["hash"];
			}
			
			//Append user's password with salt from DB
			$saltedPassword = $password;
			$saltedPassword .= $fetchedSalt;
			
			//Hash the salted user's password
			$hashedString = hash("sha256", $saltedPassword);
			
			//If the user's hashed password equals the hash found in the DB, they're logged in successfully
			if ($hashedString == $fetchedHash)
			{
				echo "Successfully logged in. Welcome.";
				GoToIndex();
			}
			else
			{
				include 'login2.html';
				echo "Password did not match. Sorry, try again.";
			}
		}
	}
	else
	{
		include 'login2.html';
		echo "Be sure to fill out both the username and password fields.";
	}
	
	die();
?>



	
	