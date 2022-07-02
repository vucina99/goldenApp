<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send'])){
    $subject = $_POST['subject'];
    $status = $_POST['status'];
    $comment = $_POST['comment'];
    $id = $_POST['id'];

    $query = $dbh->prepare("INSERT INTO comments VALUES (null, :subject , :status , :comment, :user_id)");
    $query->bindParam(':subject' , $subject);
    $query->bindParam(':status' , $status);
    $query->bindParam(':comment' , $comment);
    $query->bindParam(':user_id' , $id);
    $query->execute();

    header("Content-Type: application/json");
    echo json_encode(['data' => true]);
}