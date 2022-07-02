<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) != 0) {
    header('location:index.php');
} else {

    if (isset($_GET['edit'])) {
        $editid = $_GET['edit'];
    }
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $group_id = $_POST['group_id'];
        $id = $_POST['id'];

        $sql = "UPDATE admin SET username=(:username), email=(:email) ,  group_id=(:group_id) WHERE id=(:id)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':group_id', $group_id, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $msg = "Information Updated Successfully";
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php 
        $sql = "SELECT * from admin where id = :editid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':editid', $editid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $cnt = 1;


        ?>
        <title>Admin | Edit <?php echo htmlentities($result->username); ?></title>

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
    <?php
		$sql = "SELECT * from admin where id = :editid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':editid', $editid, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		$cnt = 1;
		?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-6">
                            <!-- <div class="card"> -->
                            <div class="card-header">
                            <?php if ($error) { ?>
                                    <div class="errorWrap"><strong>ERROR</strong>:
                                        <?php echo htmlentities($error); ?> </div>
                                <?php } else if ($msg) { ?>
                                    <div class="succWrap"><strong>SUCCESS</strong>:
                                        <?php echo htmlentities($msg); ?> </div>
                                <?php } ?>
                                <!-- Horizontal Form -->
                                <div class="card card-warning">
                                
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Admin : <i><?php echo htmlentities($result->username); ?></i></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form form method="post" class="col-md-12" enctype="multipart/form-data" name="imgform">

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="inputEmail3" class="col-sm-12 col-form-label">Email</label>

                                                    <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo htmlentities($result->email); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="inputEmail3" class="col-sm-12 col-form-label">Username</label>

                                                    <input type="text" name="username" class="form-control" id="inputEmail3" value="<?php echo htmlentities($result->username); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="group_id" class="col-sm-12 col-form-label">Groups</label>
                                                   <select name="group_id" id="group_id" class="form-control">
                                                <option value="-1" selected disabled="true">Select group</option>
                                                <?php $sql = "SELECT * from  groups ";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $resultGroup) { ?>
                                                        <option value="<?php echo $resultGroup->id; ?>" <?php if($resultGroup->id == $result->group_id) { ?> selected <?php }  ?> ><?php echo htmlentities($resultGroup->name); ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select> &nbsp;
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <button name="submit" type="submit" class="btn btn-warning">Submit Changes</button>&nbsp;
                                                <a href="dashboard.php" class="text-white btn btn-default float-right">Back</a>
                                            </div>
                                            <div class="form-group">
														<div class="col-sm-8 col-sm-offset-2">
															<input type="hidden" name="id" value="<?php echo htmlentities($result->id); ?>">
														</div>
													</div>
                                        </form>
                                    </div>

                                </div>
                            </div>

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