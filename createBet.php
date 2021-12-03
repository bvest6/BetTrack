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
			<td><a class="active" href="createBet.php">Create A Bet</a></td>
			<td><a href="adjustWallet.php">Adjust Wallet Balance</a></td>
			<td><a href="seeWalBal.php">See Wallet Balance</a></td>
			<td><a href="evalRoom.php">Evaluate A Room</a></td>
			<td><a href="winners.php">Find A Room's Winners</a></td>
			<td><a href="evalWallet.php">Evaluate A Bet</a></td>
        </tr>
    </tbody>
</table>

</div>

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "text" id = "betrmid" name = "brmid">
Room ID
<br>
<input type = "text" id = "wid" name = "walid">
Wallet Name
<br>
<input type = "text" id = "expectedresult" name = "expected">
Expected Result
<br>
<input type = "text" id = "betamount" name = "amt">
Bet Amount
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
	
	$rmid = $_POST['brmid'];
	$wid = $_POST['walid'];
	$bexp = $_POST['expected'];
	$bamt = (float) $_POST['amt'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		echo '<div id="action">';
		die("Connection failed: " . mysqli_connect_error() . "</div>");
	}
	else
	{
		if(is_float($bamt) == false or $bamt <= 0)
		{
			echo '<div id="action">Please put a number greater than 0 in as the amount or make your betting amount a number.</div>';
		}
		else
		{
			//Creates the bet
			$reg1 = "INSERT INTO results (RMID,wallet,expected,amt) VALUES ($rmid".", "."'"."$wid"."'".", "."'"."$bexp"."'".", $bamt);";
			$reg2 = mysqli_query($conn,$reg1);
			echo '<div id="action">Your bet is created.</div>';
			//Updates poolamts of the given room
			$reg1 = "SELECT poolamt FROM rooms WHERE RMID = $rmid;";
			$reg2 = mysqli_query($conn,$reg1);
			while($row = mysqli_fetch_array($reg2))
			{
				$reg3 = (float) $row['poolamt'];
			}
			$reg3 = $reg3 + $bamt;
			$reg1 = "UPDATE rooms set poolamt = $reg3 WHERE RMID = $rmid;";
			$reg2 = mysqli_query($conn,$reg1);
			//Updates wallet balances.
			$reg1 = "SELECT balance FROM wallets WHERE walname = "."'"."$wid"."'".";";
			$reg2 = mysqli_query($conn,$reg1);
			while($row = mysqli_fetch_array($reg2))
			{
				$reg3 = (float) $row['balance'];
			}
			$reg3 = $reg3 - $bamt;
			$reg1 = "UPDATE wallets set balance = $reg3 WHERE walname = "."'"."$wid"."'".";";
			$reg2 = mysqli_query($conn,$reg1);
		}
	}
}
?>
</body>
</html>