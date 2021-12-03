<?php
session_start();
?>
<html>
	<link rel="stylesheet" href="CSSBetTrack.css">
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

<body id="grad1">

<br>

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<h1>Login</h1>
<input type = "text" id = "user" name = "username">
Username
<br>
<input type = "text" id = "pass" name = "password">
Password
<input type = "submit">
</form>
<a href="register.php">Registration Page</a>
<br>

</div>

<?php

/*if(isset($_SESSION["username"]) == false)
{
	$logInText = "Log In";
}*/

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
	//echo $_SESSION["username"];
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		echo '<div id="action">';
		die("Connection failed: " . mysqli_connect_error() . "</div>");
	}
	else
	{
		$sha1Pass1 = "SELECT password FROM user WHERE username = "."'"."$username"."'".";";
		$sha1Pass2 = mysqli_query($conn,$sha1Pass1);
		//while($row = mysqli_fetch_assoc($sha1Pass2))
		while($row = mysqli_fetch_array($sha1Pass2))
		{
			$sha1Pass3 = $row['password'];
			if($sha1Pass3 == sha1($password))
			{
				echo '<div id="action">Welcome!';
				$_SESSION["username"] = $_POST['username'];
				
				echo "<a href="."home.php".">Home Page</a></div>";
				
			}
			else
			{
				echo '<div id="action">Invalid username or password</div>';
			}
		}
	}
}
?>
</body>
</html>