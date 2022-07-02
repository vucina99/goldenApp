<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['adminusername']) == 0) {
	header('location:index.php');
} else {
if (isset($_GET['delReqWithdraw'])) {
    $id = $_GET['delReqWithdraw'];
    // $name = $_GET['name'];
    $username = $_GET['username'];
    $card_holder = $_GET['card_holder'];
    $amount = $_GET['amount'];
    $reqcreate_datetime = date("Y-m-d H:i:s");

    // obrisi iz tabele withdraw
    $sql = "delete from withdraw WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $memdeposit = 0;


    // ubaci u arhivu
    $sql1 = "INSERT withdrawarchive SET username=:username, card_holder=:card_holder , amount=:amount , reqcreate_datetime=:reqcreate_datetime";
    $query = $dbh->prepare($sql1);
    $query->bindParam('username', $username, PDO::PARAM_STR);
    $query->bindParam('card_holder', $card_holder, PDO::PARAM_STR); 
    $query->bindParam('amount', $amount, PDO::PARAM_STR); 
    $query->bindParam('reqcreate_datetime', $reqcreate_datetime, PDO::PARAM_STR); 
    $query->execute();

    // resetuj withdraw vrednost kao potvrdu o withdrawal request-u
    // $sql2 = "UPDATE users SET withdrawtype=:withdraw WHERE  id=:id";
    // $query = $dbh->prepare($sql2);
    // $query->bindParam(':withdraw', $memdeposit, PDO::PARAM_STR);
    // $query->bindParam(':id', $id, PDO::PARAM_STR);
    // $query->execute();
}
	if (isset($_GET['reset_withdraw'])) {
		$id = intval($_GET['reset_withdraw']);
		$memdeposit = 2;
		$sql = "UPDATE users SET withdrawtype=:withdraw WHERE  id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':withdrawtype', $memdeposit, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();


		$msg = "Ready for new withdraw";

		// $sql2 = "insert into deleteduser (email) values (:name)";
		// $query2 = $dbh->prepare($sql2);
		// $query2->bindParam(':name', $name, PDO::PARAM_STR);
		// $query2->execute();

	}

	// Verify
	if (isset($_REQUEST['unconfirm'])) {
		$aeid = intval($_GET['unconfirm']);
		$memstatus = 1;
		$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $memstatus, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Changes Sucessfully";
	}

	if (isset($_REQUEST['confirm'])) {
		$aeid = intval($_GET['confirm']);
		$memstatus = 0;
		$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $memstatus, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Changes Sucessfully";
	}

	// withdraw confirm
	if (isset($_REQUEST['unconfirm_withdraw'])) {
		$aeid = intval($_GET['unconfirm_withdraw']);
		$memdeposit = 1;
		$sql = "UPDATE users SET withdrawtype=:withdraw WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':withdraw', $memdeposit, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Confirmed";
	}


	if (isset($_REQUEST['confirm_withdraw'])) {
		$aeid = intval($_GET['confirm_withdraw']);
		$memdeposit = 0;
		$sql = "UPDATE users SET withdrawtype=:withdraw WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':withdraw', $memdeposit, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Changes Sucessfully";
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
                                                <th>Username</th>
                                                <th>Name Surname</th>
                                                <th>Amount</th>
                                                <th>Date requested</th>
                                                <!-- <th>Withdraw</th> -->
                                                <th>Archive request</th>
                                            </tr>
                                        </thead>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search by group...">

                                        <tbody id="myTable">
                                            <?php 
											$sql = "SELECT `withdraw`.*, `users`.`withdrawtype`,  `users`.`grupa`
											FROM `withdraw` 
												LEFT JOIN `users` ON `withdraw`.`username` = `users`.`username`;";
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
                                                    <?php echo htmlentities($result->username); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($result->card_holder); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($result->amount); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($result->reqcreate_datetime); ?> </td>
                                                <td hidden>
                                                    <?php echo htmlentities($result->grupa); ?> </td>
            

                                                <!-- withdraw notify -->
                                                <!-- <td>
															
														<?php 
														if ($result->withdrawtype == 1) {
															
															 ?>
																<a href="withdrawlist.php?confirm_withdraw=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Verify Withdraw Request')">Withdraw successful &check;</i></a>
															<?php } if ($result->withdrawtype == 2) { ?>
																<a href="withdrawlist.php?unconfirm_withdraw=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to verify withdraw')"> <i class="fa fa-times-circle"></i></a>
															<?php } ?>

														</td> -->

                                                <!-- deposit notify -->

                                                </td>

                                                <td>
                                                    <!-- <a href="edit-user.php?edit=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                                                    <a href="withdrawlist.php?delReqWithdraw=<?php echo $result->id; echo $result->username; echo $result->card_holder; echo $result->amount;?>&username=<?php echo $result->username; ?> &card_holder=<?php echo $result->card_holder; ?> &amount=<?php echo $result->amount;?>" onclick="return confirm('Do you want to Delete');"><i style="color:red;"class="fa fa-trash" style="color:red">&check;</i></a>&nbsp;&nbsp;

                                                    <!--<a href="withdrawlist.php?delReqWithdraw=<?php echo $result->id; ?>&name=<?php echo htmlentities($result->username); ?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;-->
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