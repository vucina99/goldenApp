<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT * FROM admin WHERE UserName=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['adminusername']=$_POST['username'];
    $_SESSION['adminusername_id']=$results[0]->id;
    $_SESSION['admin']=$results[0];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Dashboard</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition dark-mode sidebar-mini overflow-hidden">

        <hr><br><br><br>
        <div class="row justify-content-center align-items-center h-100 align-content-middle">
            <!-- <div class="col-sm-12"> -->
            <hr>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4 ">
                <div class="space-30"></div>

                <div class="card card-primary">
                    <div class="card-header bg-dark">
                        <h1 class="align-items-center">Admin Login</h1>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post">
                        <div class="card-body bg-gray">
                            <div class="form-group">
                                <input type="text" placeholder="Username" name="username" class="form-control" type="text" placeholder="Username" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" required type="password" class="form-control" placeholder="Password">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer bg-gray">
                            <button type="submit" name="login" class="btn btn-dark col-12 text-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
        </div>
        <br><br><br><br>
        <hr>
    </body>

    </html>