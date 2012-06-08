<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>adder up</title>
</head>

<body>
<center>
<h1>batches > add new batch</h1>
<form method="POST" action="?do=add">
Amount (weight): <input type="text" name="amountWeight"/> grams<br />
Bought for: $<input type="text" name="boughtFor" /><br />
Date bought (dd/mm/yyyy): <input type="text" name="dateBought" /><br />
<input type="submit" value="Add bitch" />
</form><br /><br />

<?php

/** establishing  variables... */
$amountWeight = $_POST['amountWeight'];
$boughtFor = $_POST['boughtFor'];
$dateBought = $_POST['dateBought'];

/** inserting shit into the db */
if ($_GET['do'] == "add") {
    mysql_query("INSERT INTO batch (amountWeight, boughtFor, boughtDate, weightSold, moneySold, netprofit) VALUES('$amountWeight', '$boughtFor', '$dateBought', 'N/A', 'N/A', 'N/A')");
    
    $batchQuery = mysql_query("SELECT * FROM batch WHERE amountWeight = '$amountWeight'");
    $batchData = mysql_fetch_array($batchQuery);
    echo "batch added - <a href=\"batch.php?id=".$batchData['id']."\">view the batch</a>";
}
?>

</center>
</body>
</html>