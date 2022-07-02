<?php
session_start();
include('includes/config.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $query = $dbh->prepare("UPDATE users SET status = (:status) where id=(:id)");
    $query->bindParam(':status' , $status);
    $query->bindParam(':id' , $id);
    $query->execute();
}