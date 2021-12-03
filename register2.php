<?php
session_start();
?>
<html>

<?php
if(isset($_SESSION["username"]) == true)
{
	//$logInText = "Log In";
	$logInText = "" . $_SESSION["username"] . "";
}
else
{
	//$logInText = "" . $_SESSION["username"] . "";
	$logInText = "Log In";
}	
?>

<button onclick=""> <?php echo "$logInText"; ?> </button>

<br>

<button onclick="<?php if(isset($_SESSION["username"]) == true){session_unset(); session_destroy();}?>">Log Out</button>

<br>

<a href="BetTracker.php">Log In Page</a>

<body>

<br>

<div>

<?php

$servername = "localhost";
$user1 = "root";
$pass1 = "SIGMAnine9";
$dbname = "BetTrack";
if(isset($_POST['username']) == false)
{
	//$("div").show();
	//document.getElementByID("div").style.display = "visible";
}
else
{
	//$("div").hide();
	//document.getElementByID("div").style.display = "invisible";
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//var_dump($_POST);
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	else
	{
		$password2 = sha1($password);
		//echo $password2;
		//$reg = "INSERT INTO user (username,password,email) VALUES (".'"$username"'.", ".'"$password"'.", ".'"$email"'")";
		/*if(empty($_POST))
		{
			echo "Heman!";
		}*/
		$reg = "INSERT INTO user (username,password,email) VALUES ("."'"."$username"."'".", "."'"."$password2"."'".", "."'"."$email"."'".")";
		if(mysqli_query($conn,$reg))
		{
			echo "You are registered to BetTrack!";	
		}
		else
		{
			echo "You are not registered to BetTrack! Please try again.";
		}	
	}
}
?>
</body>
</html>