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

<div>

<table class="center">
    <thead>
        <tr>
            <th colspan="10">BetTrack</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="createRoom.php">Create A Room</a></td>
            <td><a href="createWallet.php">Create A Wallet</a></td>
			<td><a href="createBet.php">Create A Bet</a></td>
			<td><a href="adjustWallet.php">Adjust Wallet Balance</a></td>
			<td><a href="seeWalBal.php">See Wallet Balance</a></td>
			<td><a href="evalRoom.php">Evaluate A Room</a></td>
			<td><a href="winners.php">Find A Room's Winners</a></td>
			<td><a href="evalWallet.php">Evaluate A Bet</a></td>
        </tr>
    </tbody>
</table>

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
	
	/*$username = $_POST['username'];
	$password = $_POST['password'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
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
				echo "Welcome!";
				$_SESSION["username"] = $_POST['username'];
				
				echo "<a href="."homepage".">Home Page</a>";
				
			}
			else
			{
				echo "Invalid username or password";
			}
		}
	}*/
}
?>
</body>
</html>