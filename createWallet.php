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
            <td><a class="active" href="createWallet.php">Create A Wallet</a></td>
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

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "text" id = "name" name = "walname">
Wallet Name
<br>
<input type = "text" id = "type" name = "waltype">
Wallet Type (Saving, Spending, or General)
<br>
<input type = "text" id = "owner" name = "walowner">
Wallet Owner
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
	echo $_SESSION["username"];
	
	$wname = $_POST['walname'];
	$wtype = $_POST['waltype'];
	$wown = $_POST['walowner'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		echo '<div id="action">';
		die("Connection failed: " . mysqli_connect_error() . "</div>");
		//echo '<div id="action">Connection failed: </div>';
	}
	else
	{
		//Checks wallet
		$id1 = "SELECT ID FROM user WHERE username = "."'"."$wown"."'".";";
		$id2 = mysqli_query($conn,$id1);
		//while($row = mysqli_fetch_assoc($sha1Pass2))
		while($row = mysqli_fetch_array($id2))
		{
			$id3 = $row['ID'];
		}
		//Creates wallet, the wallet has 0 by default and must be added to in the adjust wallet page to not incur a negative balance
		$reg1 = "INSERT INTO wallets (walname,owner,type,balance) VALUES ("."'"."$wname"."'".", "."$id3".", "."'"."$wtype"."'".",0.0)";
		$reg2 = mysqli_query($conn,$reg1);
		echo '<div id="action">Your wallet is created.</div>';
	}
}
?>
</body>
</html>