<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['adminusername']) == 0) {
    header('location:index.php');
} else {
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
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h1 class="m-0">Welcome Admin </h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <?php

                                        $sql = "SELECT * from  users where admin_id =".$_SESSION['adminusername_id'];
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $bg = $query->rowCount();
                                        ?>
                                        <h3>
                                            <?php echo htmlentities($bg); ?>
                                        </h3>

                                        <p>Number of users</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-down"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <?php
                                        $sql = "SELECT id from deposit";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $bg = $query->rowCount();
                                        ?>
                                        <h3>
                                            <?php echo htmlentities($bg); ?>
                                        </h3>

                                        <p>Deposit requests</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="depositlist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <?php
                                        $sql = "SELECT id from withdraw";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $bg = $query->rowCount();
                                        ?>
                                        <h3>
                                            <?php echo htmlentities($bg); ?>
                                        </h3>

                                        <p>Withdraw requests</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="withdrawlist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>



                            <?php if($_SESSION['admin']->manager != 0){ ?>

                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <?php
                                        $sql = "SELECT * from  users where login = true ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $bg = $query->rowCount();
                                        ?>
                                        <h3>
                                            <?php echo htmlentities($bg); ?>
                                        </h3>

                                        <p>Number of logged users </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#userlist" class="small-box-footer">More info <i class="fas fa-arrow-circle-down"></i></a>
                                </div>
                            </div>



                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <?php
                                        $sql = "SELECT * from  users inner join user_status on users.status = user_status.id where user_status.name LIKE 'New' ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $bg = $query->rowCount();
                                        ?>
                                        <h3>
                                            <?php echo htmlentities($bg); ?>
                                        </h3>

                                        <p>Number of new users</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#userlist" class="small-box-footer">More info <i class="fas fa-arrow-circle-down"></i></a>
                                </div>
                            </div>


                     <?php } ?>


















                            <div class="row">
                                <div class="stat-panel panel-default col-md-12 bg-default text-center text-info">
                                    <p>This window informs you about activities on the site.</p>
                                    <!-- <p>Green tab is the display of messages that user sent you</p> -->
                                </div>
                            </div>

                            <!-- ./col -->
                            <!-- small box -->
                            <!-- <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>65</h3>

                                    <p>Unique Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> -->
                            <!-- ./col -->
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content" id="content">
                    <div class="row">
                        <?php

                        if (isset($_GET['del']) && isset($_GET['name'])) {
                            $id = $_GET['del'];
                            $name = $_GET['name'];

                            $sql = "delete from users WHERE id=:id";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                            $query->execute();

                            $sql2 = "insert into deleteduser (email) values (:name)";
                            $query2 = $dbh->prepare($sql2);
                            $query2->bindParam(':name', $name, PDO::PARAM_STR);
                            $query2->execute();

                            $msg = "Data Deleted successfully";
                        }


                        if (isset($_GET['delReqWithdraw']) && isset($_GET['name'])) {
                            $id = $_GET['delReqWithdraw'];
                            $name = $_GET['name'];

                            $sql = "delete from withdraw WHERE id=:id";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                            $query->execute();

                            // $sql2 = "insert into deleteduser (email) values (:name)";
                            // $query2 = $dbh->prepare($sql2);
                            // $query2->bindParam(':name', $name, PDO::PARAM_STR);
                            // $query2->execute();

                            $msgWith = "Data Deleted successfully";
                        }

                        if (isset($_GET['delReqDeposit']) && isset($_GET['name'])) {
                            $id = $_GET['delReqDeposit'];
                            $name = $_GET['name'];

                            $sql = "delete from deposit WHERE id=:id";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                            $query->execute();

                            // $sql2 = "insert into deleteduser (email) values (:name)";
                            // $query2 = $dbh->prepare($sql2);
                            // $query2->bindParam(':name', $name, PDO::PARAM_STR);
                            // $query2->execute();

                            $msgDep = "Data Deleted successfully";
                        }


                        // Withdraw confirm
                        if (isset($_REQUEST['unconfirm_withdraw'])) {
                            $aeid = intval($_GET['unconfirm_withdraw']);
                            $memwithdraw = 1;
                            $sql = "UPDATE users SET withdrawtype=:withdraw WHERE  id=:aeid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':withdraw', $memwithdraw, PDO::PARAM_STR);
                            $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
                            $query->execute();
                            $msg = "Transaction confirmed";
                        }
                        // if (isset($_REQUEST['unconfirm_withdraw'])) {
                        // 	$aeid = intval($_GET['unconfirm_withdraw']);
                        // 	$memwithdraw = 1;
                        // 	$sql = "UPDATE users SET withdraw=:withdraw WHERE  id=:aeid";
                        // 	$query = $dbh->prepare($sql);
                        // 	$query->bindParam(':withdraw', $memwithdraw, PDO::PARAM_STR);
                        // 	$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
                        // 	$query->execute();
                        // 	$msg = "Changes Sucessfully";
                        // }

                        if (isset($_REQUEST['confirm_withdraw'])) {
                            $aeid = intval($_GET['confirm_withdraw']);
                            $memwithdraw = 0;
                            $sql = "UPDATE users SET withdrawtype=:withdraw WHERE  id=:aeid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':withdraw', $memwithdraw, PDO::PARAM_STR);
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
                            $msg = "Transaction confirmed";
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




                    <?php if($_SESSION['admin']->manager != 0){ ?>




                        <div class="col-12" id="userlist">
                            <div class="card">
                                <div class="card-header">

                                    <div class="d-flex">
                                        <div class="pt-2"><span> Select Admin &nbsp; </span></div>
                                        <select name="AdminCheck" id="AdminCheck" class="form-control w-25">
                                            <option value="-1" selected disabled="true">Select admin</option>
                                            <?php $sql = "SELECT * from  admin ";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <option value="<?php echo $result->id; ?>"><?php echo htmlentities($result->username); ?><?php echo htmlentities($result->name_surname); ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select> &nbsp;
                                        <span class="pt-2">&nbsp;
                                        <?php
                                        if (isset($_SESSION['success_update'])) {
                                            echo '<span class="text-success">' . $_SESSION['success_update'] . '</span>';
                                            unset($_SESSION["success_update"]);
                                        }


                                        ?>
                                    </span>

                                    </div>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <h3 class="card-title">List of Users</h3> <br> <br>
                                    <?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead class="table-hover">
                                        <tr>
                                            <th colspan="2" class="text-center">#</th>
                                            <!-- <th>Username</th> -->
                                            <th>Name Surname</th>
                                            <th>Admin</th>
                                            <th>Country</th>
                                            <th>Email</th>
                                            <!-- <th>Country</th> -->
                                            <th>Phone</th>
                                            <th>Verify</th>
                                            <th>Withdraw confirm</th>
                                            <th>Deposit confirm</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <form action="dashboard.php" method="get">
                                        <div class="search d-flex">

                                            <div class="pr-2">
                                                <input type="text" name="user_id" id="user_id" value="" class="form-control" placeholder="ID user">
                                            </div>


                                            <div class="pr-2">
                                                <input type="text" name="email" id="email" value="" class="form-control" placeholder="Email">
                                            </div>

                                            <div class="pr-2">
                                                <input type="text" name="name_surname" id="name_surname" value="" class="form-control" placeholder="Name Surname">
                                            </div>

                                            <div class="pr-2">
                                                <input type="text" name="country" id="country" value="" class="form-control" placeholder="Country">
                                            </div>


                                            <div class="pr-2">
                                                <select name="status_id" id="status_id" class="form-control  status" >
                                                    <option value="-1" selected disabled="true">Select status</option>
                                                    <?php $sql = "SELECT * from  user_status ";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $resultsSome = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($resultsSome as $resultStatus) { ?>
                                                            <option value="<?php echo $resultStatus->id; ?>"  > <?php echo htmlentities($resultStatus->name); ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select> &nbsp;
                                            </div>

                                            <div class="pr-2">

                                                <select name="admin_id" id="admin_id" class="form-control admin" >
                                                    <option value="-1" selected disabled="true">Select admins</option>
                                                    <?php $sql = "SELECT * from  admin ";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $resultsSome = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($resultsSome as $resultStatus) { ?>
                                                            <option value="<?php echo $resultStatus->id; ?>"  > <?php echo htmlentities($resultStatus->username); ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select> &nbsp;
                                            </div>

                                            <div class="pr-2">
                                                <input type="submit" value="Search" class="btn btn-light" name="search">
                                            </div>
                                            <div>
                                                <a href="dashboard.php"><input type="button" value="Reset filter" class="btn btn-light" name="reset"></a>
                                            </div>



                                        </div>
                                        </form>
                                        <tbody id="myTable">
                                        <?php $sql = "SELECT users.* , admin.username as adminusername from  users inner join admin on users.admin_id = admin.id  where users.admin_id is not null ";
                                        if(isset($_GET['search'])){

                                            $user_id =  $_GET['user_id'];
                                           $name_surname =  $_GET['name_surname'];
                                           $admin_id =  $_GET['admin_id'];
                                           $email =   $_GET['email'];
                                           $status =  $_GET['status_id'];
                                            $country =  $_GET['country'];

                                            if(!empty($_GET['user_id'])){
                                                $sql.= " AND users.id = '$user_id'";
                                            }
                                            if(!empty($_GET['name_surname'])){
                                                $sql.= " AND users.name_surname LIKE '%$name_surname%'";
                                            }
                                            if(isset($_GET['admin_id']) && $_GET['admin_id'] !== -1){
                                                $sql.= " AND users.admin_id = '$admin_id'";
                                            }
                                            if(isset($_GET['status_id']) && $_GET['status_id'] !== -1){
                                                $sql.= " AND users.status = '$status'";
                                            }
//
                                            if(!empty($_GET['email'])){
                                                $sql.= " AND users.email LIKE '%$email%'";
                                            }
                                            if(!empty($_GET['country'])){
                                                $sql.= " AND users.country LIKE '%$country%'";
                                            }

                                        }
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;

                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {				?>
                                                <tr>

                                                    <td class="text-center"><input type="checkbox" name="allUsers"
                                                                                   class="allUsers"
                                                                                   value="<?php echo $result->id; ?>"
                                                                                   id="allUsers"></td>
                                                    <td class="text-center"><a class="text-white"
                                                                               href="edit-user.php?edit=<?php echo $result->id; ?>"><?php echo htmlentities($result->id); ?></a>
                                                    </td>
                                                    <td hidden><?php echo htmlentities($result->username); ?></td>
                                                    <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->name_surname); ?></a></td>
                                                    <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->adminusername); ?></a></td>

                                                    <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->country); ?></a></td>
                                                    <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->email); ?></a></td>
                                                    <td hidden><?php echo htmlentities($result->country); ?></td>
                                                    <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->phone_number); ?></a></td>
                                                    <td hidden><?php echo htmlentities($result->grupa); ?></td>

                                                    <td>

                                                        <?php if ($result->status == 1) { ?>
                                                            <a class="text-white" href="dashboard.php?confirm=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Un-Verify the Account')">Verified &check;</i></a>
                                                        <?php } else { ?>
                                                            <a class="text-white" href="dashboard.php?unconfirm=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Verify the Account')">Unverified <i class="fa fa-times-circle"></i></a>
                                                        <?php } ?>
                                                    </td>

                                                    <!-- withdraw notify -->
                                                    <td>

                                                        <?php if ($result->withdrawtype == 1) { ?>
                                                            <a class="text-white" href="dashboard.php?confirm_withdraw=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Verify Withdraw Request')">Withdraw successful &check;</i></a>
                                                        <?php } else { ?>
                                                            <a class="text-white" href="dashboard.php?unconfirm_withdraw=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to verify withdraw')"> Confirm<i class="fa fa-times-circle"></i></a>
                                                        <?php } ?>

                                                    </td>

                                                    <!-- deposit notify -->
                                                    <td>
                                                        <?php if ($result->deposittype == 1) { ?>
                                                            <a class="text-white" href="dashboard.php?confirm_deposit=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Verify Deposit Request')">Deposit successful &check;</i></a>
                                                        <?php } else { ?>
                                                            <a class="text-white" href="dashboard.php?unconfirm_deposit=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to verify deposit request?')"> Confirm<i class="fa fa-times-circle"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group btn-group-sm">

                                                            <!-- <a class="btn btn-info" href="edit-user.php?edit=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Edit');"><i class="fas fa-eye"></i></a>&nbsp;&nbsp; -->
                                                            <a class="btn btn-danger" href="dashboard.php?del=<?php echo $result->id; ?>&name=<?php echo htmlentities($result->email); ?>" onclick="return confirm('Do you want to Delete');"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                                                        </div>

                                                    </td>
                                                    <td hidden><?php echo htmlentities($result->grupa); ?></td>
                                                    <td>
                                                        <select name="status" id="status" class="form-control w-100 status" onchange="setStatus(<?= $result->id ?> , this)">
                                                            <option value="-1" selected disabled="true">Select status</option>
                                                            <?php $sql = "SELECT * from  user_status ";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $resultsSome = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($resultsSome as $resultStatus) { ?>
                                                                    <option value="<?php echo $resultStatus->id; ?>" <?php if($resultStatus->id ==  $result->status) { ?> selected <?php } ?>  > <?php echo htmlentities($resultStatus->name); ?> </option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select> &nbsp;
                                                    </td>

                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } ?>

                                        </tfoot>
                                    </table>
                                    <br><br>
                                    <button class="btn w-50 btn-outline-light" id="setAdminLeads" onclick="setAdminLeads()">
                                        Save Values
                                    </button>
                                </div>
                            </div>
                        </div>

                           <?php } else{ ?>



                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-left">List of all users</h3>

                                </div>
                                <span class="text-right pr-4"><a href="adminadduser.php">Add User</a></span>

                                <!-- /.card-header -->
                                <div class="card-body ">
                                <?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead class="table-hover">
                                        <tr>
												<th>#</th>
												<!-- <th>Username</th> -->
												<th>Name Surname</th>
												<th>Email</th>
												<th>Created</th>
												<th>Country</th> 
												<th>Phone</th> 
												<th>Withdraw confirm</th>
												<th>Deposit confirm</th>										
												<th>Action</th>
												<th>select</th>
                                                <th>Status</th>
											</tr>
                                        </thead>
                                        <form action="dashboard.php" method="get">
                                            <div class="search d-flex">

                                                <div class="pr-2">
                                                    <input type="text" name="user_id" id="user_id" value="" class="form-control" placeholder="ID user">
                                                </div>


                                                <div class="pr-2">
                                                    <input type="text" name="email" id="email" value="" class="form-control" placeholder="Email">
                                                </div>

                                                <div class="pr-2">
                                                    <input type="text" name="name_surname" id="name_surname" value="" class="form-control" placeholder="Name Surname">
                                                </div>

                                                <div class="pr-2">
                                                    <input type="text" name="country" id="country" value="" class="form-control" placeholder="Country">
                                                </div>


                                                <div class="pr-2">
                                                    <select name="status_id" id="status_id" class="form-control  status" >
                                                        <option value="-1" selected disabled="true">Select status</option>
                                                        <?php $sql = "SELECT * from  user_status ";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $resultsSome = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($resultsSome as $resultStatus) { ?>
                                                                <option value="<?php echo $resultStatus->id; ?>"  > <?php echo htmlentities($resultStatus->name); ?> </option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select> &nbsp;
                                                </div>



                                                <div class="pr-2">
                                                    <input type="submit" value="Search" class="btn btn-light" name="search">
                                                </div>
                                                <div>
                                                    <a href="dashboard.php"><input type="button" value="Reset filter" class="btn btn-light" name="reset"></a>
                                                </div>




                                            </div>
                                        </form>
                                        <tbody id="myTable">
                                        <?php 
                                            $sql = "SELECT * from  users where admin_id =".$_SESSION['adminusername_id'];
                                            // Temporary solution
                                            // $sql = "SELECT * from  users where grupa= '" . $_SESSION['adminusername'] . "'";
                                        if(isset($_GET['search'])){

                                            $user_id =  $_GET['user_id'];
                                            $name_surname =  $_GET['name_surname'];
                                            $admin_id =  $_GET['admin_id'];
                                            $email =   $_GET['email'];
                                            $status =  $_GET['status_id'];
                                            $country =  $_GET['country'];

                                            if(!empty($_GET['user_id'])){
                                                $sql.= " AND users.id = '$user_id'";
                                            }
                                            if(!empty($_GET['name_surname'])){
                                                $sql.= " AND users.name_surname LIKE '%$name_surname%'";
                                            }

                                            if(isset($_GET['status_id']) && $_GET['status_id'] !== -1){
                                                $sql.= " AND users.status = '$status'";
                                            }
//
                                            if(!empty($_GET['email'])){
                                                $sql.= " AND users.email LIKE '%$email%'";
                                            }
                                            if(!empty($_GET['country'])){
                                                $sql.= " AND users.country LIKE '%$country%'";
                                            }

                                        }
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>


                                                        <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->id); ?></a></td>
														<td hidden><?php echo htmlentities($result->username); ?></td>
														<td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->name_surname); ?></a></td>
														<td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->email); ?></a></td>
														<td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->create_datetime); ?></a></td>
														<td><?php echo htmlentities($result->country); ?></td>
														 <td><a class="text-white" href="edit-user.php?edit=<?php echo $result->id; ?>" ><?php echo htmlentities($result->phone_number); ?></a></td>
														<td hidden><?php echo htmlentities($result->grupa); ?></td>



														<!-- withdraw notify -->
														<td>

														<?php if ($result->withdrawtype == 1) { ?>
																<a class="text-white" href="dashboard.php?confirm_withdraw=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Verify Withdraw Request')">Withdraw successful &check;</i></a>
															<?php } else { ?>
																<a class="text-white" href="dashboard.php?unconfirm_withdraw=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to verify withdraw')"> Confirm<i class="fa fa-times-circle"></i></a>
															<?php } ?>

														</td>

														<!-- deposit notify -->
														<td>
														<?php if ($result->deposittype == 1) { ?>
																<a class="text-white" href="dashboard.php?confirm_deposit=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Verify Deposit Request')">Deposit successful &check;</i></a>
															<?php } else { ?>
																<a class="text-white" href="dashboard.php?unconfirm_deposit=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to verify deposit request?')"> Confirm<i class="fa fa-times-circle"></i></a>
															<?php } ?>
														</td>
														</td>

														<td>
                                                        <div class="btn-group btn-group-sm">

															<!-- <a class="btn btn-info" href="edit-user.php?edit=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Edit');"><i class="fas fa-eye"></i></a>&nbsp;&nbsp; -->
                                                            <a class="btn btn-danger" href="dashboard.php?del=<?php echo $result->id; ?>&name=<?php echo htmlentities($result->email); ?>" onclick="return confirm('Do you want to Delete');"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                                                            </div>

                                                        </td>
														<td><input type="checkbox" id="id" name="id" class="text-white"><?php echo htmlentities($result->id); ?></td>
														<td hidden><?php echo htmlentities($result->grupa); ?></td>
                                                        <td>
                                                            <select name="status" id="status" class="form-control w-100" onchange="setStatus(<?= $result->id ?> , this)">
                                                                <option value="-1" selected disabled="true">Select status</option>
                                                                <?php $sql = "SELECT * from  user_status ";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $resultStatus) { ?>
                                                                        <option value="<?php echo $resultStatus->id; ?>" <?php if($resultStatus->id ==  $result->status) { ?> selected <?php } ?>  > <?php echo htmlentities($resultStatus->name); ?> </option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select> &nbsp;
                                                        </td>
													</tr>
											<?php $cnt = $cnt + 1;
												}
											} ?>
                                            
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php }  ?>

                        <!-- ADMIN LIST -->
                        <?php if($_SESSION['admin']->manager != 0){ ?>


                        <div class="col-12" id="adminlist">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">List of all ADMINS  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <!-- <?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?> -->
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead class="table-hover">
                                        <tr>
                                            <th>#</th>
                                            <!-- <th>Username</th> -->
                                            <th>Name Surname</th>
                                            <th>Email</th>

                                            <th>Password</th>
                                        </tr>
                                        </thead>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search by country, group...">
                                        <tbody id="myTable">
                                        <?php $sql = "SELECT * from  admin ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {                ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->username); ?></td>
                                                    <td><?php echo htmlentities($result->email); ?></td>
                                                    <td><?php echo htmlentities($result->password); ?></td>
                                                    <td hidden><?php echo htmlentities($result->grupa); ?></td>



                                                    <td>
                                                        <div class="btn-group btn-group-sm">

                                                            <a class="btn btn-info" href="admin-edit.php?edit=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Edit');"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                                            <a class="btn btn-danger" href="dashboard.php?deladmin=<?php echo $result->id; ?>&name=<?php echo htmlentities($result->email); ?>" onclick="return confirm('Do you want to Delete');"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                                                        </div>

                                                    </td>
                                                    <td hidden><?php echo htmlentities($result->grupa); ?></td>

                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } ?>

                                        </tfoot>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <?php   } ?>
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

        <!-- Extended scripts -->
        <script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function() {
					$('.succWrap').slideUp("slow");
				}, 3000);
			});
		</script>
		<script>
			$(document).ready(function() {
				$("#myInput").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#myTable tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});

            function setAdminLeads() {
                var AllCheckedUserID = [];
                var checkAdmin = $("#AdminCheck").val();

                var sendIsset = true;
                $(".allUsers:checked").each(function () {
                    AllCheckedUserID.push($(this).val());
                });
                if (AllCheckedUserID.length == 0 || checkAdmin == null) {
                    alert('Please mark one admin and at least one leader')
                } else {

                    $.ajax({
                        method: "POST",
                        url: "SetAdminLedas.php",
                        DataType: "json",
                        data: {AllCheckedUserID, checkAdmin, sendIsset},
                        success: function (data) {
                            console.log(data);
                            if (data.success == 'success') {
                                location.reload();
                            }
                        },
                        error: function (error, xhr, status) {
                            console.log(error);
                        }


                    })
                }
            }

            function setStatus(id , item){
                let status = item.value;
                console.log(status);
                $.ajax({
                    method: "POST",
                    url: "setStatus.php",
                    DataType: "json",
                    data: {id,status},
                    success: function (data) {

                    },
                    error: function (error, xhr, status) {
                        console.log(error);
                    }


                })
            }
		</script>
    </body>

    </html>
<?php } ?>