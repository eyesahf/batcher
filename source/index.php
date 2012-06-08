<?php 
error_reporting (E_ALL ^ E_NOTICE);
include "config.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="kushbacon" />

	<title>chamber of secrets.</title>
</head>

<body>
<center>
<h1>Batches - <a href="addbatch.php">add new batch</a></h1>

<?php

/** displaying the batches */
$query = mysql_query("SELECT * FROM batch");

while ($data = mysql_fetch_array($query)) {
    echo $data['amountWeight']." gram batch - <a href=\"batch.php?id=".$data['id']."\">have a looksie</a><br />";
}

?>

<h1>clients - <a href="addclient.php">add a new client</a></h1>

<?php

/** displaying the clients */
$query = mysql_query("SELECT * FROM clients");

while ($data = mysql_fetch_array($query)) {
    echo $data['firstName']." ".$data['lastName']." - <a href=\"client.php?id=".$data['id']."\">look at this nigga</a><br />";
}

?>
</center>
</body>
</html>