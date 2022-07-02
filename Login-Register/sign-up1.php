<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GoldTrade FX | Sign Up</title>
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
        <div class="container p-0">
            <div class="row no-gutters height-self-center">
                <div class="col-sm-12 align-self-center rounded">
                    <div class="row m-0">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 sign-in-page-data" style="background-color: #121212f0; border-radius: 15px 50px;" >
                            <div class="sign-in-from">
                                <h3 class="mb-0 text-left">Sign Up</h3>
                                <!-- <p class="text-center text-dark">Enter your email address and password to access admin panel.</p> -->

                                <form class="mt-4" method="post" name="registration" action="php/register.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-0" name="username" required placeholder="Username" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-0" name="name_surname" required placeholder="Full Name And Surname" />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control mb-0" name="email" required placeholder="Enter e-mail" />
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" name="phone_number" class="form-control mb-0" required placeholder="PhoneNumber">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control mb-0" name="password" required placeholder="Password" />
                                    </div>
                                    <div class="d-inline-block w-100">
                                        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                            <label class="custom-control-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="sign-info text-center">
                                        <button type="submit" class="btn btn-primary d-block w-100 mb-2">Sign Up</button>
                                        <span class="text-dark d-inline-block line-height-2">Already Have Account ? <a href="sign-in.php">Log In</a></span>
                                        <a class="btn btn-primary mt-3" href="../"><i class="ri-home-4-line"></i>Back to Home</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-md-7 text-center sign-in-page-image">
                            <div class="sign-in-detail text-white">
                                <a class="sign-in-logo mb-5" href="#"><img src="images/gtfxlogo.png" class="img-fluid" alt="logo"></a>
                                <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                    <div class="item">
                                        <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                        <h4 class="mb-1 text-white">Manage your orders</h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                    </div>
                                    <div class="item">
                                        <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                        <h4 class="mb-1 text-white">Manage your orders</h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                    </div>
                                    <div class="item">
                                        <img src="images/login/1.png" class="img-fluid mb-4" alt="logo">
                                        <h4 class="mb-1 text-white">Manage your orders</h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign in END -->
<?php include('includes/javascripts.php');?>
</body>

</html>