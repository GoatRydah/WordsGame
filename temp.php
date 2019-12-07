if (!empty($userName) && !empty($password))
	{
		
	$db_hostservername = "sql200.epizy.com";
	$db_username = "epiz_24390692";
	$db_password = "MCW7354qZQ1el";
	$db_name = "epiz_24390692_login";
	
	$connection = new mysqli($db_hostservername, $db_username, $db_password, $db_name);
	
	if ($connection->connect_error)
	{
		die ("Connection failed: " . $connection->connect_error);
	}
	
	//SQL statements
	$sql = "SELECT username from users WHERE username = ('$userName')";
    
	$result = mysqli_query($connection, $sql);
	
	if ($result != $userName)
	{
		echo "That username wasn't found in the database.";
		die();
	}
	
	$salt = random_bytes(10);
	
	/*
	for ($i = 0; $i < $len; ++$i) 
	{
        $str .= $chars[rand(0, $l)];
    }
	*/
	
    //$sqlSelect = "SELECT TOP FROM user_name WHERE username = ('$fullname')";
	//$fullNameReturned = mysqli_query($connection, $sqlSelect);
	
	}
	else
	{
		die();
	}
	
	
?> 