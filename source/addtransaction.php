<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>i get money i get bitches</title>
</head>

<body>
<center>
<?php

/** batch queries and shit */
$bid = $_GET['bid'];
$batchquery = mysql_query("SELECT * FROM batch WHERE id='$bid'");
$batchData = mysql_fetch_array($batchquery);

?>

<h1><?php echo $batchData['amountWeight']." gram batch > transactions > add new transaction"; ?></h1>

<?php

/** grabbing the client's names amd shit to populate the dropdown menu */
$dropdownQuery = mysql_query("SELECT * FROM clients");
$options = "";

while($row = mysql_fetch_array($dropdownQuery)){ 
    $id = $row['id']; 
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $options.="<OPTION VALUE=\"$id\">".$firstName." ".$lastName; 
} 

?>

<form method="POST" action="?bid=<?php echo $bid; ?>&do=add">
Choose a client: <select name="clientName" size="">
<OPTION VALUE=0>------------------------
<?=$options?> 
</select><br />
Amount bought: <input type="text" name="amountBought" /> grams<br />
Bought for: $<input type="text" name="boughtFor" /><br />
Date (dd/mm/yyyy): <input type="text" name="date" /><br />
On spot (yes or no): <input type="text" name="onSpot" /><br />
Paid (how much has the client paid so far): <input type="text" name="paid" /><br />
Notes: <br /><textarea cols="50" rows="10" name="notes"></textarea><br />
<input type="submit" />
</form>

<?php

/** establishing variables */
$id = genRandomString();
$clientId = $_POST['clientName'];
$amountBought = $_POST['amountBought'];
$boughtFor = $_POST['boughtFor'];
$date = $_POST['date'];
$onSpot = $_POST['onSpot'];
$paid = $_POST['paid'];
$notes = $_POST['notes'];

/** all the bullshit to add the info to the transaction database */
if ($_GET['bid'] == "$bid" && $_GET['do'] == "add") {
    mysql_query("INSERT INTO transactions (id, cid, bid, weight, money, date, spot, notes, paid) VALUES('$id', '$clientId', '$bid', '$amountBought', '$boughtFor', '$date', '$onSpot', '$notes', '$paid')");
    
    echo "transaction added - go back to the <a href=\"batch.php?id=$bid\">batch</a> or view the <a href=\"transaction.php?id=$id\">transaction</a>";
    
    /** updating the client info */
    $clientQuery = mysql_query("SELECT * FROM clients WHERE id = '$clientId'");
    $clientData = mysql_fetch_array($clientQuery);
    
    $totalWeightClient = $clientData['weightBought'] + $amountBought;
    $totalMoneyClient = $clientData['moneySpent'] + $boughtFor;
    
    mysql_query("UPDATE `clients` SET moneySpent = '$totalMoneyClient', weightBought = '$totalWeightClient' WHERE id = '$clientId'");
    
    /** updating the batch info */
    $batchQuery = mysql_query("SELECT * FROM batch WHERE id = '$bid'");
    $batchData = mysql_fetch_array($batchQuery);
    
    $totalWeightBatch = $batchData['weightSold'] + $amountBought;
    $totalMoneyBatch = $batchData['moneySold'] + $boughtFor;
    mysql_query("UPDATE batch SET moneySold = '$totalMoneyBatch', weightSold = '$totalWeightBatch' WHERE id = '$bid'");
    
    $netProfitBatch = $batchData['moneySold'] - $batchData['boughtFor'];
    mysql_query("UPDATE batch SET netProfit = '$netProfitBatch' WHERE id = '$bid'");
}

?>
</center>
</body>
</html>