<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>drugs r' us</title>
</head>

<body>
<center>
<h1>clients > add new client</h1>

<form method="POST" action="?do=add">
First name: <input type="text" name="firstName" /><br />
Last name: <input type="text" name="lastName" /><br />
Phone number: <input type="text" name="phoneNumber" /><br />
Picture URL: <input type="text" name="picURL" /><br />
<input type="submit" />
</form>

<?php
 /** establishing variables... */
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNumber = $_POST['phoneNumber'];
$picURL = $_POST['picURL'];

/** adding to the db */
if ($_GET['do'] == "add") {
    mysql_query("INSERT INTO clients (firstName, lastName, phoneNumber, pictureUrl, moneySpent, weightBought) VALUES('$firstName', '$lastName', '$phoneNumber', '$picURL', 'N/A', 'N/A')");
    
    $clientQuery = mysql_query("SELECT * FROM clients WHERE phoneNumber = '$phoneNumber'");
    $clientData = mysql_fetch_array($clientQuery);
    echo "client added - <a href=\"client.php?id=".$clientData['id']."\">view the client</a>";
}
?>
</center>
</body>
</html>