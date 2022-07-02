<?php
session_start();
error_reporting(0);
include('db.php');
include('check_session_panel.php');

// echo ("test");


if (isset($_POST['personalinfo'])) {
    $name_surname = $_POST['name_surname'];
    // $username = $_SESSION['username'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    // $sql = "UPDATE users SET name_surname=(:name_surname), email=(:email), phone_number(:phone_number), postal_code=(:postal_code), country=(:country) WHERE username = '" . $_SESSION['username'] . "'";

    $sql = "UPDATE users SET  name_surname=(:name_surname), postal_code=(:postal_code), country=(:country) WHERE username = '" . $_SESSION['username'] . "'";

    $query = $dbh->prepare($sql);
    // $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':name_surname', $name_surname, PDO::PARAM_STR);
    $query->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
    $query->bindParam(':country', $country, PDO::PARAM_STR);

    $query->execute();
    header("Location: ../profile-edit.php");

    // $msg = $sql;
}
// UPDATE PASSWORD
if (isset($_POST['passwordreset'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $username = $_SESSION['username'];
    $sql = "SELECT Password FROM users WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "UPDATE users SET Password=(:newpassword) WHERE UserName=(:username)";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $msg = "Your Password succesfully changed";
    } else {
        $error = "Your current password is not valid.";
    }
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 60*60,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    unset($_SESSION['login']);
    session_destroy(); // destroy session
    header("Location: ../profile-edit.php");

}

if (isset($_POST['bankinfo'])) {
    $bank_name = $_POST['bank_name'];
    $acc_number = $_POST['acc_number'];
    // var_dump($acc_number);

    $sql = "UPDATE users SET bank_name=(:bank_name), acc_number=(:acc_number) WHERE username = '" . $_SESSION['username'] . "'";

    $query = $dbh->prepare($sql);
    $query->bindParam(':bank_name', $bank_name, PDO::PARAM_STR);
    $query->bindParam(':acc_number', $acc_number, PDO::PARAM_STR);

    $query->execute();
    header("Location: ../profile-edit.php");

}

if (isset($_POST['contactupdate'])) {
    // $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    // var_dump($acc_number);

    $sql = "UPDATE users SET  phone_number=(:phone_number) WHERE username = '" . $_SESSION['username'] . "'";

    $query = $dbh->prepare($sql);
    // $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);

    $query->execute();
    header("Location: ../profile-edit.php");

}
?>