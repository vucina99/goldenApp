<?php
    require('db.php');

    // insert into the database. 
    // popravi
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);

        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);

        $name = stripslashes($_REQUEST['name_surname']);
        $name = mysqli_real_escape_string($con, $name);

        $phone_number = stripslashes($_REQUEST['phone_number']);
        $phone_number = mysqli_real_escape_string($con, $phone_number);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $create_datetime = date("Y-m-d H:i:s");

        $query  =  "INSERT INTO `users`(username, email , name_surname, phone_number , password , create_datetime) 
                    VALUES ('$username' , '$email' , '$name' , '$phone_number' , '" . md5($password) . "' , '$create_datetime' )";

        $result   = mysqli_query($con, $query);

        
        if ($result) {
            // provera unosa i redirekt ukoliko je input popunjen:
                if(!empty($_POST['username'] && $_POST['name'] && $_POST['email'] && $_POST['password'])){
                    // return header('Location: ../error.php');
                    // echo("Error! Please fill in all required information!<br>");
                }
                header("Location: ../sign-in.php");

        } else {}
    } else {
}
?>