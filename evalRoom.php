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
			<td><a class="active" href="evalRoom.php">Evaluate A Room</a></td>
			<td><a href="winners.php">Find A Room's Winners</a></td>
			<td><a href="evalWallet.php">Evaluate A Bet</a></td>
        </tr>
    </tbody>
</table>

</div>

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "text" id = "room" name = "roomnum">
RMID Num
<br>
<input type = "text" id = "result" name = "roomresult">
Result
<input type = "submit">
</form>

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
	
	$rrmid = $_POST['roomnum'];
	$result = $_POST['roomresult'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		echo '<div id="action">';
		die("Connection failed: " . mysqli_connect_error() . "</div>");
	}
	else
	{
		//Updates result found by using the room number and wallet name used to place the bet
		$reg1 = "UPDATE rooms set actual = "."'"."$result"."'"." WHERE RMID = $rrmid;";
		$reg2 = mysqli_query($conn,$reg1);
		echo '<div id="action">Your room has been evaluated.</div>';
	}
}
?>
</body>
</html>