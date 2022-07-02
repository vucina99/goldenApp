<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	
	// Code for change password	
	if (isset($_POST['submit'])) {
		$password = md5($_POST['password']);
		$newpassword = md5($_POST['newpassword']);
		$username = $_SESSION['alogin'];
		$sql = "SELECT Password FROM superadmin WHERE UserName=:username and Password=:password";
		$query = $dbh->prepare($sql);
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			$con = "update superadmin set Password=:newpassword where UserName=:username";
			$chngpwd1 = $dbh->prepare($con);
			$chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
			$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
			$chngpwd1->execute();
			$msg = "Your Password succesfully changed";
		} else {
			$error = "Your current password is not valid.";
		}
	}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Edit Profile</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #dd3d36;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
            
            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #5cb85c;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>

            <?php 
            include ('includes/header.php')
            ?>

            <?php 
            include ('includes/leftbar.php')
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="row ">
                        <div class="col-12">
                            <!-- <div class="card"> -->
                            <div class="card-header">
                                <!-- Horizontal Form -->
                                <div class="card card-warning col-sm-6">
                                    <div class="card-header">
                                        <h3 class="card-title">Change password</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                                        <div class="card-body">
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
												<div class="form-group">
														<input type="password" class="form-control" name="password" id="password" 
													placeholder="Old Password"	required>
												</div>
												<div class="hr-dashed"></div>

												<div class="form-group">
														<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" required>
												</div>
												<div class="hr-dashed"></div>

												<div class="form-group">
														<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
												</div>
												<div class="hr-dashed"></div>



												<div class="form-group card-footer">

                                            <button  name="submit" type="submit" class="btn btn-warning">Submit</button>
                                            <a href="dashboard.php" class="btn btn-default float-right">Back</a>													</div>
												
                                            
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->

                        </div>
                    </div>
            </div>
        </div>
        </section>
        </div>
        </section>
        <!-- /.content -->
        </div>

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.js"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <!-- <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script> -->
        <!-- ChartJS -->
        <script src="plugins/chart.js/Chart.min.js"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="dist/js/pages/dashboard2.js"></script>
    </body>

    </html>
	<?php } ?>