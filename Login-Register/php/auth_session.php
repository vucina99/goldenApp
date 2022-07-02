<?php

    session_start();

    $_SESSION["rrr"] = 0;
    if(isset($_SESSION["ROLE"]) && $_SESSION["rrr"]) {
        header("Location: index.php");
        exit();
    }
    // else{
    //     // echo $_SESSION['ROLE'];
    //     // header('location: index.php?result=FatalError');

    // }



    

?>