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

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $create_datetime = date("Y-m-d H:i:s");

        $query  =  "INSERT INTO `users`(username, email , name_surname , password , create_datetime) 
                    VALUES ('$username' , '$email' , '$name' , '" . md5($password) . "' , '$create_datetime' )";

        $result   = mysqli_query($con, $query);

        
        if ($result) {
            // provera unosa i redirekt ukoliko je input popunjen:
                if(!empty($_POST['username'] && $_POST['name'] && $_POST['email'] && $_POST['password'])){
                    // return header('Location: ../error.php');
                    // echo("Error! Please fill in all required information!<br>");
                }
                header("Location: ../index.php");

        } else {
            // Polja je neophodno popuniti
                // return header('Location: ../error.php');
                // echo("Error! Please fill in all required information!<br>");
            }
    } else {
}
?>