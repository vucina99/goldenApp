<?php
include_once('dbSec.php');
session_start(); 
//$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
$id = $_SESSION['user']['id'];
$query    = "UPDATE  `users` SET login= false WHERE id='$id' ";
$result = mysqli_query($con, $query) or die(mysql_error());

unset($_SESSION['login']);

//session_destroy(); // destroy session

header("location:../../Login-Register/sign-in.php");
?>