<?php
$db =  mysqli_connect("localhost","root","","goldtradrs_new");
;
// SQL query
$strSQL = "SELECT * from users where username = '" . $_SESSION['username'] . "' OR email = '" . $_SESSION['username'] . "'";

// Execute the query (the recordset $rs contains the result)
$rs = mysqli_query($db, $strSQL);
// Loop the recordset $rs
// Each row will be made into an array ($row) using mysqli_fetch_array
?>