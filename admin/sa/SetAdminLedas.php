<?php
session_start();
include('includes/config.php');

if(isset($_POST['sendIsset'])){
    $AllCheckedUserID = $_POST['AllCheckedUserID'];
    $checkAdmin= $_POST['checkAdmin'];

    if(count($AllCheckedUserID) < 1 || !isset($checkAdmin) || !$checkAdmin ){

        header($_SERVER['SERVER_PROTOCOL'] . '500 error');
        header("Content-Type: application/json");
        echo json_encode(['error' => 'error']);
    }
    $sql = 'UPDATE users SET admin_id = '.$checkAdmin.' WHERE id IN ('.implode(',', array_map('intval', $AllCheckedUserID)) . ')';
    $setUsers = $dbh->prepare($sql);
    $setUsers->execute();

    $_SESSION['success_update'] = 'You have successfully assigned a leads ';
    header("Content-Type: application/json");
    echo json_encode(['success' => 'success']);
}