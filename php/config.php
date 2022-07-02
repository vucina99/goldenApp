<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','goldtradrs_new');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=localhost;dbname=goldtradrs_new","root", "");
    echo 'uspesno';
}
catch (PDOException $e)
{
    echo 'greska';
exit("Error: " . $e->getMessage());
}
?>
