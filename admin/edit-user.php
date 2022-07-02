<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['adminusername']) == 0) {
    header('location:index.php');
} else {

    if (isset($_GET['edit'])) {
        $editid = $_GET['edit'];
    }
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name_surname = $_POST['name_surname'];
        $create_datetime = $_POST['create_datetime'];
        $postal_code = $_POST['postal_code'];
        $country = $_POST['country'];
        $phone_number = $_POST['phone_number'];
        $account_balance = $_POST['account_balance'];
        $comment = $_POST['comment'];
        $id = $_POST['id'];
        $reqcreate_datetime = date("Y-m-d H:i:s");


        $sql = "UPDATE users SET username=(:username), email=(:email), name_surname=(:name_surname), create_datetime=(:create_datetime), postal_code=(:postal_code), country=(:country), phone_number=(:phone_number), account_balance=(:account_balance), comment=(:comment) WHERE id=(:id)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':name_surname', $name_surname, PDO::PARAM_STR);
        $query->bindParam(':create_datetime', $create_datetime, PDO::PARAM_STR);
        $query->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $query->bindParam(':account_balance', $account_balance, PDO::PARAM_STR);
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);   
        $query->bindParam(':id', $id, PDO::PARAM_STR);

        $query->execute();
        // $msg = "Information Updated Successfully";
        
        $sql1 = "INSERT commentarchive SET username=(:username) , comment=(:comment) , reqcreate_datetime=(:reqcreate_datetime)";
        $query = $dbh->prepare($sql1);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);  
        $query->bindParam(':reqcreate_datetime', $reqcreate_datetime, PDO::PARAM_STR);

        $query->execute();
        // $sql1 = "INSERT INTO comment username=:username , comment=:comment";
        // $query = $dbh->prepare($sql1);
        // $query->bindParam(':username', $username, PDO::PARAM_STR);
        // $query->bindParam(':comment', $comment, PDO::PARAM_STR);
        // $query->execute();
    }

    if (isset($_POST['change_password'])) {
        // header('Location: index.php');
        $password = $_POST['password'];
        $id = $_POST['id'];

        $sql = "UPDATE users SET password=md5(:password) WHERE id=(:id)";

        // $query  =  "UPDATE `users`(password) 
        // VALUES ('" . md5($password) . "')";

        // $sql = "UPDATE `users` SET password= $password";

        $query = $dbh->prepare($sql);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);

        $query->execute();
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
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        $sql = "SELECT * from users where id = :editid";
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
        <?php
        $sql = "SELECT * from users where id = :editid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':editid', $editid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $cnt = 1;
        ?>
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>



            <?php
            include('includes/header.php')
            ?>
            <?php
            include('includes/leftbar.php')
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">

                    <div class="row">

                        <div class="col-12">


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
                                        <h3 class="card-title">Edit user</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form method="post" class="col-md-12" enctype="multipart/form-data" name="imgform">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="inputPassword3" class="col-sm-12 col-form-label">Name and
                                                        Surname</label>

                                                    <input type="text" name="name_surname" class="form-control" id="inputPassword3" value="<?php echo htmlentities($result->name_surname); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="inputPassword3" class="col-sm-12 col-form-label">Date of
                                                        creation</label>

                                                    <input type="text" name="create_datetime" class="form-control" id="inputPassword3" value="<?php echo htmlentities($result->create_datetime); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="inputPassword3" class="col-sm-12 col-form-label">Postal
                                                        code</label>

                                                    <input type="text" name="postal_code" class="form-control" id="inputPassword3" value="<?php echo htmlentities($result->postal_code); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="inputPassword3" class="col-sm-12 col-form-label">Country</label>

                                                    <input type="text" name="country" class="form-control" id="inputPassword3" value="<?php echo htmlentities($result->country); ?>">
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="inputEmail3" class="col-sm-12 col-form-label">Email</label>

                                                    <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo htmlentities($result->email); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="inputEmail3" class="col-sm-12 col-form-label">Username</label>

                                                    <input type="text" name="username" class="form-control" id="inputEmail3" value="<?php echo htmlentities($result->username); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="text" class="col-sm-12 col-form-label">Phone
                                                        Number</label>

                                                    <input type="text" name="phone_number" class="form-control" id="text" value="<?php echo htmlentities($result->phone_number); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="text" class="col-sm-12 col-form-label">Account
                                                        Balance</label>

                                                    <input type="text" name="account_balance" class="form-control" id="text" value="<?php echo htmlentities($result->account_balance); ?>">
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                                        <label for="">Comment:</label>
                                                                        <textarea class="form-control" name="comment" id="comment" type="text" rows="3"><?php echo htmlentities($result->comment); ?></textarea>
                                                                        <input type="hidden" name="id" value="<?php echo htmlentities($result->id); ?>">

                                                                    </div>

                                            <div class="form-group ">
                                                <button name="submit" type="submit" class="btn btn-warning">Submit Changes</button>&nbsp;
                                                <td>

															<?php if ($result->status == 1) { ?>
																<a class="text-white" href="dashboard.php?confirm=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Un-Verify the Account')">Verified &check;</i></a>
															<?php } else { ?>
																<a class="text-white" href="dashboard.php?unconfirm=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Verify the Account')">Unverified <i class="fa fa-times-circle"></i></a>
															<?php } ?>
														</td>
                                                <a href="dashboard.php" class="text-white btn btn-default float-right">Back</a>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <input type="hidden" name="id" value="<?php echo htmlentities($result->id); ?>">
                                                </div>
                                            </div>

                                            <div class="row nav navbar-nav navbar-left">
                                                <li class="dropdown btn btn-default col-md-4">
                                                    <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" role="button">
                                                        Change user password<span class="caret"></span>
                                                    </a>

                                                    <div class="dropdown-menu p-2" id="formLogin">
                                                        <div class="row">
                                                            <div class="container-fluid">
                                                                <form name="change_password" id="change_password" enctype="multipart/form-data" onsubmit="return validateForm()" method="post">
                                                                    <div class="form-group">
                                                                        <label class="">Reset password:</label>

                                                                        <input class="form-control" name="password" id="password" type="password">
                                                                        <input type="hidden" name="id" value="<?php echo htmlentities($result->id); ?>">

                                                                    </div>
                                                                    <input class="btn btn-default col-12" name="change_password" type="submit" value="Change password" id="change_password">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                
                                            </div>

                                        </form>
                                        <br>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal">
                                            Create comments
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <h5 class="text-center"> Create comment</h5> <br>
                                                        <div class="alert alert-danger" role="alert">
                                                           Please enter all fields
                                                        </div>
                                                        <div class="alert alert-success" role="alert">
                                                            Comment successfully posted
                                                        </div>
                                                        <div class="form-group">

                                                                <label for="subjectComm" class="col-sm-12 col-form-label">Subject</label>
                                                                <select name="subjectComm" id="subjectComm" class="form-control">
                                                                    <option value="-1" selected disabled="true">Select subject</option>
                                                                    <?php $sql = "SELECT * from  comment_subjects ";
                                                                    $query = $dbh->prepare($sql);
                                                                    $query->execute();
                                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                    $cnt = 1;
                                                                    if ($query->rowCount() > 0) {
                                                                        foreach ($results as $res) { ?>
                                                                            <option value="<?php echo $res->id; ?>"  ><?php echo htmlentities($res->name); ?> </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                        </div>

                                                        <div class="form-group">

                                                            <label for="statusComm" class="col-sm-12 col-form-label">Status</label>
                                                            <select name="statusComm" id="statusComm" class="form-control">
                                                                <option value="-1" selected disabled="true">Select status</option>
                                                                <?php $sql = "SELECT * from  comment_status ";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $res) { ?>
                                                                        <option value="<?php echo $res->id; ?>"  ><?php echo htmlentities($res->status); ?> </option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">

                                                            <label for="comment" class="col-sm-12 col-form-label">Comment</label>
                                                            <textarea name="commentComm"  id="commentComm" class="bg-dark w-100" cols="30" rows="10"></textarea>
                                                        </div>

                                                        <input type="button" id="setComment" onclick="setCommentFast(<?= $_GET['edit'] ?>)" class="btn btn-outline-light" value="Create comment">



                                                    </div>

                                                </div>
                                            </div>
                                        </div>






                                        <!-- Modal -->
                                        <button type="button" class="btn btn-light" data-toggle="modal" data-target=".bd-example-modal-lg">All comments</button>

                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <h5 class="text-center">All comments</h5> <br>
                                                        <table id="example2" class="table table-bordered table-hover w-100">
                                                            <thead class="table-hover">
                                                            <tr>
                                                                <!-- <th>Username</th> -->
                                                                <th>Subject</th>
                                                                <th>Status</th>

                                                                <th>Comment</th>
                                                            </tr>
                                                            </thead>
                                                            <input class="form-control" id="myInput" type="text" placeholder="Search by country, group...">
                                                            <tbody id="myTable">
                                                            <?php $sql = "SELECT * from  comments left join comment_subjects  on comments.comment_subject_id = comment_subjects.id left join comment_status 
                                                                          on comments.comment_status_id = comment_status.id where comments.user_id = ".$_GET['edit'];
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) {                ?>
                                                                    <tr>
                                                                        <td><?php echo htmlentities($result->name); ?></td>
                                                                        <td><?php echo htmlentities($result->status); ?></td>
                                                                        <td><?php echo htmlentities($result->text); ?></td>


                                                                    </tr>
                                                                    <?php $cnt = $cnt + 1;
                                                                }
                                                            } ?>

                                                            </tfoot>
                                                        </table>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            deposit archive <br>
                            withdraw archive
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
            $(document).ready(function (){
                $('.alert-danger').hide();
                $('.alert-success').hide();
            });
            function setCommentFast(idUser){
              let subject =   $('#subjectComm').val();
              let status =   $('#statusComm').val();
              let comment =   $('#commentComm').val();
              let id = idUser;
                let send =   true;

                console.log(idUser)
              if(subject == null || status == null ||  comment=='' ){
                  $('.alert-danger').show();
                  $('.alert-danger').hide();
              }else{
                  $('.alert-danger').hide();
              }
              $.ajax({
                  method:'POST',
                  url: 'createComment.php',
                  dataType: 'json',
                  data: {subject, status, comment,send ,id},
                  success:function (data){
                    if(data.data == true){
                        $('.alert-success').show();
                    }
                  },
                  error: function (error){
                      console.log(error);
                      $('.alert-danger').hide();
                      $('.alert-danger').show();
                  }
              })
            }
        </script>




    </body>

    </html>
<?php } ?>