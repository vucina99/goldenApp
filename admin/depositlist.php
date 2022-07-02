<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['adminusername']) == 0) {
	header('location:index.php');
} else {

// 	if (isset($_GET['delReqDeposit']) && isset($_GET['username'])) {
// 		$id = $_GET['delReqDeposit'];
// 		$username = $_GET['username'];

// 		$sql = "delete from deposit WHERE id=:id";
// 		$query = $dbh->prepare($sql);
// 		$query->bindParam(':id', $id, PDO::PARAM_STR);
// 		$query->execute();

// 		// $sql2 = "insert into deleteduser (email) values (:name)";
// 		// $query2 = $dbh->prepare($sql2);
// 		// $query2->bindParam(':name', $name, PDO::PARAM_STR);
// 		// $query2->execute();

// 		$msgDep = "Data Deleted successfully";
// 	}

if (isset($_GET['delReqDeposit'])) {
    $id = $_GET['delReqDeposit'];
    $username = $_GET['username'];
    $card_number =$_GET['card_number'];
    $card_holder = $_GET['card_holder'];
    // $expdate = $_GET['expdate'];
    // $cvv = $_GET['cvv'];
    $amount = $_GET['amount'];
    $reqcreate_datetime = date("Y-m-d H:i:s");
    $memdeposit = 0;

    // Delete deposit request
    $sql = "delete from deposit WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();

    // ubaci u arhivu
    $sql1 = "INSERT depositarchive SET username=:username, card_number=:card_number, card_holder=:card_holder , amount=:amount , reqcreate_datetime=:reqcreate_datetime";
    $query = $dbh->prepare($sql1);
    $query->bindParam('username', $username, PDO::PARAM_STR);
    $query->bindParam('card_holder', $card_holder, PDO::PARAM_STR); 
    $query->bindParam('card_number', $card_number, PDO::PARAM_STR); 
    $query->bindParam('amount', $amount, PDO::PARAM_STR); 
    $query->bindParam('reqcreate_datetime', $reqcreate_datetime, PDO::PARAM_STR); 
    $query->execute();
}


	if (isset($_GET['reset_deposit'])){
		$id = intval($_GET['reset_deposit']);
		$memdeposit = 2;
		$sql = "UPDATE users SET deposittype=:deposit WHERE  id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':deposittype', $memdeposit, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();


		$msg = "Ready for new deposit";

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

	// Deposit confirm
	if (isset($_REQUEST['unconfirm_deposit'])) {
		$aeid = intval($_GET['unconfirm_deposit']);
		$memdeposit = 1;
		$sql = "UPDATE users SET deposittype=:deposit WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':deposit', $memdeposit, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Pending..";
	}


	if (isset($_REQUEST['confirm_deposit'])) {
		$aeid = intval($_GET['confirm_deposit']);
		$memdeposit = 0;
		$sql = "UPDATE users SET deposittype=:deposit WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':deposit', $memdeposit, PDO::PARAM_STR);
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
                                <h3 class="card-title">Deposit requests</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">
                            <?php if ($msgDep) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msgDep); ?> </div><?php } ?>

                                <table id="dtHorizontalExample" class="table table-bordered table-hover">
                                    <thead class="table-hover">
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Card Holder</th>
                                            <th>Card Number</th>
                                            <th>Exp Date</th>
                                            <th>CVV</th>
                                            <th>Deposit amount</th>
                                            <th>Created</th>

                                            <!-- <th>Deposit</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <input class="form-control" id="myInput" type="text" placeholder="Search by group...">

                                    <tbody id="myTable">
                                        <?php 
											$sql = "SELECT `deposit`.*, `users`.`deposittype`
											FROM `deposit` 
												LEFT JOIN `users` ON `deposit`.`username` = `users`.`username`;";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
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
                                                <?php echo htmlentities($result->card_holder ); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result->card_number ); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result->expdate ); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result->cvv ); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result->amount); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result->reqcreate_datetime ); ?>
                                            </td>
                                            <!-- <td><?php echo htmlentities($result->account_balance); ?></td> -->

                                            <td hidden>
                                                <?php echo htmlentities($result->grupa); ?> </td>
                                            <td hidden>
                                                <?php echo htmlentities($result->country); ?> </td>




                                            </td>

                                            <td>
                                                <!-- <a href="edit-user.php?edit=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                                                <!--<a href="depositlist.php?delReqDeposit=<?php echo $result->id; ?>&username=<?php echo htmlentities($result->username); ?>" onclick="return confirm('Do you want to Delete this request?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;-->
                                                <a href="depositlist.php?delReqDeposit=<?php echo $result->id; echo $result->username; echo $result->card_number; echo $result->card_holder; echo $result->amount;?>&username=<?php echo $result->username; ?>&card_number=<?php echo $result->card_number; ?> &card_holder=<?php echo $result->card_holder; ?> &amount=<?php echo $result->amount;?>" onclick="return confirm('Do you want to Delete');"><i style="color:red;"class="fa fa-trash" style="color:red">&check;</i></a>&nbsp;&nbsp;

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

    <!-- Extended script -->
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