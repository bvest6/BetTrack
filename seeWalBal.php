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
			<td><a class="active" href="seeWalBal.php">See Wallet Balance</a></td>
			<td><a href="evalRoom.php">Evaluate A Room</a></td>
			<td><a href="winners.php">Find A Room's Winners</a></td>
			<td><a href="evalWallet.php">Evaluate A Bet</a></td>
        </tr>
    </tbody>
</table>

</div>

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "text" id = "name" name = "walname">
Wallet Name
<input type = "submit">
</form>

</div>

<?php

//<td><a href="completeRoom.php">Complete A Room</a></td>

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
	
	$wname = $_POST['walname'];
	//$wamt = (float) $_POST['amount'];
	//$wown = $_POST['walowner'];
	
	//echo gettype($wamt);
	
	/*if(is_float($wamt) == false)
	{
		echo "Please make your betting amount a number.";
	}
	else
	{*/
		$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
		if(!$conn)
		{
			echo '<div id="action">';
			die("Connection failed: " . mysqli_connect_error() . "</div>");
		}
		else
		{
			//Gets wallet balance
			$amt1 = "SELECT balance FROM wallets WHERE walname = "."'"."$wname"."'".";";
			$amt2 = mysqli_query($conn,$amt1);
			//while($row = mysqli_fetch_assoc($sha1Pass2))
			while($row = mysqli_fetch_array($amt2))
			{
				$amt3 = (float) $row['balance'];
			}
			//The collected balance is printed
			echo '<div id="action">';
			echo "The wallet balance is : $amt3";
			echo '</div>';
		}
	//}
}
?>
</body>
</html>