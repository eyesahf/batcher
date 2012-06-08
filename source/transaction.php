<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>cashflow nigga</title>
</head>

<body>

<?php

/** getting the transaction shit */
$id = $_GET['id'];
$dataQuery = mysql_query("SELECT * FROM transactions WHERE id = '$id'");
$data = mysql_fetch_array($dataQuery);

/** getting the client's info and shit */
$cid = $data['cid'];
$clientQuery = mysql_query("SELECT * FROM clients WHERE id = '$cid'");
$clientData = mysql_fetch_array($clientQuery);

?>

<center>

<h1>Transaction #<?php echo $id; ?> - bought on <?php echo $data['date']; ?></h1>

<h2><?php echo $clientData['firstName']." ".$clientData['lastName'] ?> bought <?php echo $data['weight']; ?> grams for $<?php echo $data['money']; ?></h2>

<?php

/** checking if it was bought on spot, and if he has paid */
$amountOwed = $data['money'] - $data['paid'];

if ($data['money'] != $data['paid']) {
    echo "fucking cheap bastard. ".$clientData['firstName']." has paid $".$data['paid']." of the total $".$data['money'].". still owes $".$amountOwed."<br /><br />";
} 

/** checking if there's any notes */
if ($data['notes'] == "") {
    echo "No notes!";
} else {
    echo "Notes:<br />".$data['notes'];
}

?>

<h1><a href="edittransaction.php?id=<?php echo $id; ?>">edit transaction</a></h1>

</center>

</body>
</html>