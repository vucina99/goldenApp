<?php

    // require('config.php');
    // DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','goldtradrs_new');
    // Establish database connection.
    try
    {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }

    if(isset($_POST['reachout'])){
        if (!empty($_POST['dont_fill_this'])) {

    echo "Thank you for your lovely spam.";
    exit();
    }   
        $contact_email = $_POST['contact_email'];
        $contact_name = $_POST['contact_name'];
        $contact_phone = $_POST['contact_phone'];
        $reqcreate_datetime = date("Y-m-d H:i:s");

        
        

        $sql = "INSERT INTO reachout (contact_email, contact_name, contact_phone, reqcreate_datetime) 
        VALUES ('$contact_email', '$contact_name', '$contact_phone', '$reqcreate_datetime')"; 
        

        $query = $dbh->prepare($sql);
        $query->bindParam(':contact_email', $contact_email, PDO::PARAM_STR);
        $query->bindParam(':contact_name', $contact_name, PDO::PARAM_STR);
        $query->bindParam(':contact_phone', $contact_phone, PDO::PARAM_STR);
        $query->bindParam(':reqcreate_datetime', $reqcreate_datetime, PDO::PARAM_STR);

        $query->execute();
        
        include_once 'mail.php';
        // header("Location: ../index.php");
    }else{

    }
    ?>