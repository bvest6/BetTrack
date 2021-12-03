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
			<td><a class="active" href="winners.php">Find A Room's Winners</a></td>
			<td><a href="evalWallet.php">Evaluate A Bet</a></td>
        </tr>
    </tbody>
</table>

</div>

<div id="action">

<form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "text" id = "room" name = "roomnum">
RMID Num
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
	
	$rmid = $_POST['roomnum'];
	
	$conn = mysqli_connect($servername, $user1, $pass1, $dbname);
	if(!$conn)
	{
		echo '<div id="action">';
		die("Connection failed: " . mysqli_connect_error() . "</div>");
	}
	else
	{
		//Gets pool amount of the room
		$amt1 = "SELECT poolamt FROM rooms WHERE RMID = $rmid;";
		$amt2 = mysqli_query($conn,$amt1);
		//while($row = mysqli_fetch_assoc($sha1Pass2))
		while($rowa = mysqli_fetch_array($amt2))
		{
			$amt3 = (float) $rowa['poolamt'];
			//echo "$amt3";
		}
		
		//Gets count of 
		$count1 = "SELECT COUNT(1) FROM results WHERE RMID = $rmid AND eval = 1;";
		$count2 = mysqli_query($conn,$count1);
		//while($row = mysqli_fetch_assoc($count2))
		while($rowb = mysqli_fetch_row($count2))
		{
			$count3 = $rowb[0];
			//echo "$count3";
		}
		$payout = $amt3/$count3;
		
		//Finds winning bets corresponding to the room and prints out the usernames of the winners as well as how much they each get
		$reg1 = "SELECT wallet from results WHERE RMID = $rmid AND eval = 1;";
		$reg2 = mysqli_query($conn,$reg1);
		while($row = mysqli_fetch_array($reg2))
		{
			$reg3 = $row['wallet'];
			//echo "$reg3";
			$reg4 = "SELECT owner from wallets WHERE walname = "."'"."$reg3"."';";
			$reg5 = mysqli_query($conn,$reg4);
			while($row1 = mysqli_fetch_array($reg5))
			{
				$reg6 = (int) $row1['owner'];
				//echo "$reg6";
				$reg7 = "SELECT username FROM user WHERE ID = "."'"."$reg6"."';";
				$reg8 = mysqli_query($conn,$reg7);
				while($row2 = mysqli_fetch_array($reg8))
				{
					$reg9 = $row2['username'];
				}
				echo '<div id="action">';
				echo "Winner: $reg9";
				echo "</div><br>";
			}
		}
		echo '<div id="action">';
		echo "Each winner gets: $payout.";
		echo '</div>';
	}
}
?>
</body>
</html>