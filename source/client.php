<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>tits n ass</title>
</head>

<body>
<center>
<?php

/** establishing variables and client info */
$id = $_GET['id'];
$clientQuery = mysql_query("SELECT * FROM clients WHERE id = '$id'");
$clientData = mysql_fetch_array($clientQuery);

?>

<h1><?php echo $clientData['firstName']." ".$clientData['lastName']; ?> </h1>

<h2>spent a total of $<?php echo $clientData['moneySpent']; ?> on <?php echo $clientData['weightBought']; ?> grams</h2>


<img src="<?php echo $clientData['pictureUrl']; ?>" height="400" width="300" /><br />

<h2>transactions</h2>

<?php

/** showing all transactions for this client */
$transactionQuery = mysql_query("SELECT * FROM transactions WHERE cid = '$id'");

while ($transactionData = mysql_fetch_array($transactionQuery)) {
    $tid = $transactionData['id'];
    echo "<a href=\"transaction.php?id=$tid\">#".$transactionData['id']."</a> - ".$clientData['firstName']." ".$clientData['lastName']." - ".$transactionData['weight']." grams for $".$transactionData['money']."<br />";
}

?>

</center>
</body>
</html>