<?php
    // session_start();
    // // Zavrsetak sesije
    // if(session_destroy()) {
    //     // Redirecting To Home Page(Login)
    //     header("Location: login.php");
    // }
    // session_start();
    session_destroy();

    header('location: ../index.php');
?>