<?php
session_start();
include('../includes/config.php');
require "../../vendor/autoload.php";
if(isset($_POST['submit'])){
    $explodeFile = explode('.' , $_FILES['leads']['name']);

    if(end($explodeFile) !== 'xlsx'){
        $errors[] = 'is not excel file';
    }else{
    $files = $_FILES['leads']['tmp_name'];
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreedSheet = $reader->load($files);
    $workSheet = $spreedSheet->getActiveSheet();
    $errors = [];
    $sql = "INSERT INTO users(username,name_surname,email,phone_number,countryPrefix,countryCode,userId,campaignId,productName,marketingInfo) VALUES (?,?,?,?,?,?,?,?,?,?)";
    foreach ($workSheet->getRowIterator() as $row){
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $data = [];

        foreach ($cellIterator as $cell){
            $data[] = $cell->getValue();
        }
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
        }catch (\mysql_xdevapi\Exception $e){
            $errors[] = $e->getMessage();
        }
    }
    }
    if(count($errors) == 0){
        $_SESSION['success_import'] = 'Success Import Leads';
    }else{
        $_SESSION['errors_import']  = 'Please import excel file with .xlsx extension';
    }

   return header('Location: adminadduser.php');
}