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
            <td><a class="active" href="createRoom.php">Create A Room</a></td>
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

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "text" id = "bet" name = "betdesc">
Bet Desciption
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
	
	$betdesc = $_POST['betdesc'];
	$rmid = rand(1,100000);
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		echo '<div id="action">';
		die("Connection failed: " . mysqli_connect_error() . "</div>");
	}
	else
	{
		//$count1 = "SELECT COUNT(1) FROM rooms WHERE RMID = "."'"."$rmid"."'".";";
		$count1 = "SELECT COUNT(1) FROM rooms WHERE RMID = $rmid;";
		$count2 = mysqli_query($conn,$count1);
		//while($row = mysqli_fetch_assoc($count2))
		$truth = false;
		while($truth == false)
		{
			while($row = mysqli_fetch_row($count2))
			{
				$count3 = $row[0];
				if($count3 >= 1)
				{
					$rmid = rand(1,100000);
				}
			}
			$truth = true;
		}
		//$reg1 = "INSERT INTO rooms (RMID,bet, poolamt) VALUES ("."'"."$rmid"."'".", "."'"."$betdesc"."'".", 0.0);";
		$reg1 = "INSERT INTO rooms (RMID,bet, poolamt) VALUES ($rmid".", "."'"."$betdesc"."'".", 0.0);";
		//echo $reg1;
		$reg2 = mysqli_query($conn,$reg1);
		echo "<div id="."action".">Your room ID number is $rmid </div>";
	}
}
?>
</body>
</html>