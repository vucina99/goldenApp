<?php
session_start();
error_reporting(0);
include('db.php');
include('check_session_panel.php');

if (isset($_POST['deposit'])) {
    $username = $_SESSION['username'];
    $card_number = $_POST['card_number'];
    $card_holder = $_POST['card_holder'];
    $expdate = $_POST['expdate'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['amount'];
    $reqcreate_datetime = date("Y-m-d H:i:s");
    $sql ="INSERT INTO deposit username=(:username), card_number=(:card_number), card_holder=(:card_holder), expdate=(:expade), cvv=(:cvv), amount=(:amount), reqcreate_datetime=(:reqcreate_datetime) ";

    $result   = mysqli_query($con, $query);





    
    $sql ="INSERT INTO deposit username=(:username), card_number=(:card_number), card_holder=(:card_holder), expdate=(:expade), cvv=(:cvv), amount=(:amount), reqcreate_datetime=(:reqcreate_datetime) ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':card_number', $card_number, PDO::PARAM_STR);
    $query->bindParam(':card_holder', $card_holder, PDO::PARAM_STR);
    $query->bindParam(':expdate', $expdate, PDO::PARAM_STR);
    $query->bindParam(':cvv', $cvv, PDO::PARAM_STR);
    $query->bindParam(':amount', $amount, PDO::PARAM_STR);
    $query->bindParam(':reqcreate_datetime', $reqcreate_datetime, PDO::PARAM_STR);
    $query->execute();
    // var_dump($sql);

    // $msg = "Deposit Request Send";
    header("Location: ../wallet-deposit.php");

}
?>