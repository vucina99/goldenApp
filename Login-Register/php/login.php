<?php
include_once('db.php');
require('auth_session.php');
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);    
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    // Provera user-a u DB
    if(empty($_POST['username']&& $_POST['password'])){
        return header('Location: ../sign-in-error.php');
        // echo("Error! Please fill in all required information!<br>");
    }
    header("Location: ../../Userdash/");


    $query    = "SELECT * FROM `users` WHERE username='$username' OR email='$username'
                 AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());



    $rows = mysqli_num_rows($result);
    if($rows > 0){
        $row = mysqli_fetch_assoc($result);
        $query    = "UPDATE  `users` SET login= true WHERE username='$username' OR email='$username'
                 AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['user'] = $row;

        if(isset($_SESSION['username'])){
            header('Location: ../../Userdash/index.php?result=success');
        }


    }


    else {
        header('location: ../sign-in-error.php?failedLogIn');

    }

} else {
}

// if (isset($_POST['username'])) {

//     $username = $_POST['username'];
//     $password = md5($_POST['password']);




//     $stmt = $con->prepare("SELECT email, password FROM users WHERE email=? AND password=? ");
//     $stmt->bind_param('ss', $username, $password);
//     $stmt->execute();
//     $stmt->bind_result($username, $password);
//     $stmt->store_result();
//     if ($stmt->num_rows > 0)  //To check if the row exists
//     {
//         $stmt->fetch();
//         $_SESSION['username'] = $username;
//         header("location:../../userdash/index.php");
//     } else {
//         $_SESSION['invalid_details'] = "INVALID USERNAME/PASSWORD Combination!";
//         header('location:../sign-in-error.php?error');
//     }
//     $stmt->close();
// }
?>