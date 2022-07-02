<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_GET['delReq']) && isset($_GET['name'])) {

		
		$id = $_GET['delReq'];
		$name = $_GET['name'];

		$sql = "delete from reachout WHERE id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		// $sql2 = "insert into deleteduser (email) values (:name)";
		// $query2 = $dbh->prepare($sql2);
		// $query2->bindParam(':name', $name, PDO::PARAM_STR);
		// $query2->execute();

		$msgWith = "Data Deleted successfully";
	}
	
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Dashboard 2</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">


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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Withdraw requests</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead class="table-hover">
                                            <tr>
                                                <th>#</th>
                                                <th>Contact e-mail</th>
                                                <th>Contact e-name</th>
                                                <th>Contact e-phone</th>
                                            </tr>
                                        </thead>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search by group...">

                                        <tbody id="myTable">
                                            
                                            <?php 
											$sql = "SELECT * FROM `reachout`;";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											//  $sql1 = "SELECT * from  users ";
											// $query1 = $dbh->prepare($sql1);
											// $query1->execute();
											// $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
											// $cnt1 = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlentities($cnt); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($result->contact_email); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($result->contact_name); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($result->contact_phone); ?>
                                                </td>

                                                </td>

                                                <td>
                                                    <a href="reachoutreq.php?delReq=<?php echo $result->id; ?>&name=<?php echo htmlentities($result->contact_email); ?>" onclick="return confirm('Do you want to Delete this request');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
												}
											} ?>
                                        </tbody>

                                    </table>
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

        <script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    </body>

    </html>
    <?php } ?>