<?
//If there is an active session, hides login button
if (isset($_SESSION['username'])) {
    // Switches the login button with a logout button
    $style = "style='display:none;'";
} else {
    // session_destroy();
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GoldTradeFX | Sign in</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon(1).ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js"></script>
    <script src="https://widgets.goldtradefx.com/crm.widgets.config.js"></script>
    <script src="https://widgets.goldtradefx.com/latest/prf.widgets.js"></script>
    <link
  rel="stylesheet"
  href="https://widgets.goldtradefx.com/latest/prf.widgets.css"
/>
    <style>
    /* Style the video: 100% width and height to cover the entire window */

#myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    /* Add the blur effect */
    filter: blur(10px);
    -webkit-filter: blur(10px);
    min-width: 100%;
    min-height: 100%;
}

    </style>
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Sign in Start -->
    <section class="sign-in-page">
    <video autoplay muted loop id="myVideo">
      <source src="images/videoplayback.mp4" type="video/mp4">
    </video>

        <!-- <div id="container-inside">
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
        </div> -->
        <div class="container p-0 ">
            <div class="row no-gutters height-self-center">
                <div class="col-sm-12 align-self-center  rounded ">
                    <div class="row m-0">
                        <!--<div class="col-lg-4"></div>-->
                        <div class="col-lg-7 sign-in-page-data" style="background-color: #121212f0; border-radius: 15px 50px;" >
                            <div class="sign-in-from">
                                 <h1 class="mb-0 text-left">Sign in</h1> <br>
                                <form class="mt-4" action="php/login.php" method="POST" name="login">
                                    <div class="form-group">
                                        <label for="">E-mail</label>
                                        <input type="text" class="form-control mb-0" name="username" required placeholder="Enter your e-mail" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <a href="pages-recoverpw.php" class="float-right">Forgot password?</a>
                                        <input type="password" class="form-control mb-0" name="password" required placeholder="Password" /> </div>
                                    <div class="d-inline-block w-100">
                                        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        

                                            <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="sign-info text-center">
                                        <button type="submit" class="btn btn-primary d-block w-100 mb-2">Sign in</button>
                                        <span class="text-dark dark-color d-inline-block line-height-2">Don't have an account? <a href="sign-up.php">Sign up</a></span>
                                        <a class="btn btn-primary mt-3" href="../"><i class="ri-home-4-line"></i>Back to Home</a>

                                    </div>
                                    
                                </form>
                                <!--<prf-widget-manager options="{defaultLang:'en', brandId: 1}" ng-app="prf">-->
                                <!--  <prf-login-widget-->
                                <!--    token="my-generated-token"-->
                                <!--    redirect-url="http://goldtradefx.com/Profile/index.html#/?prfToken=my-generated-token&prfRedirectUrl=http://goldtradefx.com/Profile/index.html"-->
                                <!--  ></prf-login-widget>-->
                                <!--  <prf-deposit-widget ng-if="prf.tradingAccount"></prf-deposit-widget>-->
                                <!--</prf-widget-manager>-->
                                <!--<span class="text-dark dark-color d-inline-block line-height-2">Don't have an account? <a href="sign-up.php">Sign up</a></span><br>-->
                                <!--<a class="btn btn-warning mt-3" href="../"><i class="ri-home-4-line"></i>Back to Home</a>-->



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign in END -->
    <?php include('includes/javascripts.php');?>

</body>

</html>
