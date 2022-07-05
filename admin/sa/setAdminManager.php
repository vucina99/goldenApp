<?php
session_start();
include('includes/config.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $admin = $_POST['admin'];
    $query = $dbh->prepare("UPDATE admin SET manager = (:admin) where id=(:id)");
    $query->bindParam(':admin' , $admin);
    $query->bindParam(':id' , $id);
    $query->execute();
}