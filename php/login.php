<?php

    require('db.php');
    require('auth_session.php');
    // require('../check_session.php');

    
    // Kreiranje user sesije.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Provera user-a u DB
        if(empty($_POST['username']&& $_POST['password'])){
            return header('Location: ../error.php');
            // echo("Error! Please fill in all required information!<br>");
        }
        header("Location: ../index.php");


        $query    = "SELECT * FROM `users` WHERE username='$username' OR email='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());


        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $row = mysqli_fetch_assoc($result);

            // $_SESSION['ROLE'] = $row['role'];
            // $_SESSION['rrr'] = $row['rrr'];
            $_SESSION['username'] = $username;
            $_SESSION['name_surname'] = $name;
            // $_SESSION['surname'] = $surname;
            $_SESSION['account_balance'] = $account_balance;
            $_SESSION['is_login'] = 'yes';

            // // Admin redirek
            // if($row['role'] == 1){
            //     header('location: ../admin/?result=admin');
            // }
            // User redirekt
            if($row['role'] == 0){
                header('location: ../user/profile.php?result=success');
            }
  

        }
    
   

        else {
            header('location: ../index.php?failedLogIn');

        }

    } else {
    }



?>