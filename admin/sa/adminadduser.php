<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $name_surname = $_POST['name_surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $sql = "INSERT INTO users (username, name_surname, email, password) 
        VALUES ('$username', '$name_surname', '$email', '" . md5($password) . "' )";

        // "         username=(:username), email=(:email), name_surname=(:name_surname), password=(:password)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':name_surname', $name_surname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        $query->execute();
        $msg = "User Created Successfully";
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
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


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
            include('includes/header.php')
            ?>
            <?php
            include('includes/leftbar.php')
            ?>



            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h1 class="m-0">Register new user</h1>
                            </div>
                        </div>


                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content" id="content">
                    <div class="row">
                        <div class="col-4 m-3">
                            <div class="card">
                                <div class="card-body ">
                                    <?php if ($error) { ?>
                                        <div class="errorWrap"><strong>ERROR</strong>:
                                            <?php echo htmlentities($error); ?> </div>
                                    <?php } else if ($msg) { ?>
                                        <div class="succWrap"><strong>SUCCESS</strong>:
                                            <?php echo htmlentities($msg); ?> </div>
                                    <?php } ?>
                                    <form method="post">
                                        <div class="modal-input form-outline form-white">
                                            <label class="form-label" for="formWhite">Username</label>
                                            <input type="text" class="form-control text-dark" name="username" autofocus="true" required id="formWhite" />
                                        </div>
                                        <div class="modal-input form-outline form-white">
                                            <label class="form-label" for="formWhite">Name and Surname</label>
                                            <input type="text" class="form-control text-dark" name="name_surname" required id="formWhite" />

                                        </div>

                                        <div class="modal-input form-outline form-white">
                                            <label class="form-label" for="formWhite">Email</label>
                                            <input type="email" class="form-control text-dark" name="email" autofocus="true" required id="formWhite" />

                                        </div>
                                        <div class="modal-input form-outline form-white">
                                            <label class="form-label" for="formWhite">Password</label>
                                            <input type="password" class="form-control text-dark" name="password" required id="formWhite" />

                                        </div>

                                        <input type="submit" value="Register New User" name="submit" class="btn btn-outline-light mt-3" />
                                    </form>
                                    <script>
                                        document.querySelectorAll('.form-outline').forEach((formOutline) => {
                                            new mdb.Input(formOutline).update();
                                        });
                                        document.querySelectorAll('.form-outline').forEach((formOutline) => {
                                            new mdb.Input(formOutline).init();
                                        });
                                    </script>


                                </div>
                            </div>
                        </div>
                        <div class="col-4 pt-3">
                            <div class="card">
                                <div class="card-body ">
                                    <?php
                                        if(isset($_SESSION['success_import'])){
                                            echo '<span class="text-success">' . $_SESSION['success_import'] . '</span>';
                                            unset($_SESSION["success_import"]);
                                        }
                                    if(isset($_SESSION['errors_import'])){
                                        echo '<span class="text-danger">' . $_SESSION['errors_import'] . '</span>';;
                                        unset($_SESSION["errors_import"]);
                                    }

                                    ?>
                                    <form method="post" action="importLeads.php" enctype="multipart/form-data">
                                        <label class="form-label" for="formWhite">Excel of leads</label>
                                         <input type="file" name="leads" id="leads" > <br> <br>
                                        <input type="submit" value="Import new leads" name="submit" class="btn btn-outline-light mt-3" />

                                    </form>



                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container ">
                                <div id="tradingview_ee8a0"></div>

                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                    new TradingView.widget({
                                        "width": "100%",
                                        "height": "480",
                                        "symbol": "COINBASE:BTCUSD",
                                        "interval": "D",
                                        "timezone": "Etc/UTC",
                                        "theme": "dark",
                                        "style": "1",
                                        "locale": "en",
                                        "toolbar_bg": "#f1f3f6",
                                        "enable_publishing": false,
                                        "allow_symbol_change": true,
                                        "container_id": "tradingview_ee8a0"
                                    });
                                </script>
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

    </body>

    </html>
<?php } ?>