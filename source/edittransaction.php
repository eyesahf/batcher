<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>edit er' up</title>
</head>

<body>

<?php

/** establishing baseline shit */
$id = $_GET['id'];
$transactionQuery = mysql_query("SELECT * FROM transactions WHERE id = '$id'");
$transactionData = mysql_fetch_array($transactionQuery);

/** getting the clients info... */
$cid = $transactionData['cid'];
$clientQuery = mysql_query("SELECT * FROM clients WHERE id = '$cid'");
$clientData = mysql_fetch_array($clientQuery);

?>

<center>

<h2>Editing transaction #<?php echo $id; ?></h2>
<form method="POST" action="?id=<?php echo $id; ?>&do=edit">
<?php echo $clientData['firstName']." ".$clientData['lastName']." bought ".$transactionData['weight']." grams for $".$transactionData['money']." - "; ?>
He has paid $<input type="text" name="paid" value="<?php echo $transactionData['paid']; ?>" size="1" /> out of a total of $<?php echo $transactionData['money']; ?>
<input type="submit" />
</form>

<?php

$paidValue = $_POST['paid'];

if ($_GET['do'] == "edit") {
    /** updating the transaction info */
    mysql_query("UPDATE transactions SET paid = '$paidValue' WHERE id = '$id'");
}

?>

</center>
</body>
</html>