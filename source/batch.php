<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>lookin up shit nigs</title>
</head>

<body>
<center>
<?php

/** setting up the batch info and shit */
$id = $_GET['id'];
$batchQuery = mysql_query("SELECT * FROM batch WHERE id = '$id'");
$batchData = mysql_fetch_array($batchQuery);

/** update net profits */
$netProfitBatch = $batchData['moneySold'] - $batchData['boughtFor'];
mysql_query("UPDATE batch SET netProfit = '$netProfitBatch' WHERE id = '$id'");
?>

<h1><?php echo $batchData['amountWeight']; ?> gram batch - bought on <?php echo $batchData['boughtDate']; ?> for <?php echo $batchData['boughtFor']; ?></h1>

<h2>sold <?php echo $batchData['weightSold']; ?> grams for $<?php echo $batchData['moneySold']; ?> - made a total profit of $<?php echo $batchData['netProfit']; ?></h2>

<h1>transactions - <a href="addtransaction.php?bid=<?php echo $id; ?>">add transaction</a></h1>

<?php

/** showing all transactions for this batch */
$transactionQuery = mysql_query("SELECT * FROM transactions WHERE bid = '$id'");

while ($transactionData = mysql_fetch_array($transactionQuery)) {
    $tid = $transactionData['id'];
    
    /** getting the client info */
    $cid = $transactionData['cid'];
    $clientQuery = mysql_query("SELECT * FROM clients WHERE id = '$cid'");
    $clientData = mysql_fetch_array($clientQuery);
    
    echo "<a href=\"transaction.php?id=$tid\">#".$transactionData['id']."</a> - ".$clientData['firstName']." ".$clientData['lastName']." - ".$transactionData['weight']." grams for $".$transactionData['money']."<br />";
}

?>
</center>
</body>
</html>