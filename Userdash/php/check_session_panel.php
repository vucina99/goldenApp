<?php
    
    // Redirects back to login page if session does not exist
    if (!isset($_SESSION['username'])) {
        header('location: ../Login-Register/sign-in.php?result=NoSession');
    }
    else{
        // header('location: index.php?result=FatalError');
        
    }
?>