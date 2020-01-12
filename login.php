<?php
session_start();
error_reporting(0);
if ($_SESSION['username']) {
    header('location:module.php?module=home');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Halaman Login</title>
        <meta name="description" content="Splasher is a Dashboard & Admin Site Responsive Template by hencework." />
        <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Splasher Admin, Splasheradmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
        <meta name="author" content="hencework"/>

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <link rel="icon" type="image/png" href="ico/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="ico/favicon-16x16.png" sizes="16x16" />

        <!-- vector map CSS -->
        <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>



        <!-- Custom CSS -->
        <link href="assets/dist/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->

        <div class="wrapper  pa-0">
            <header class="sp-header">
                <div class="sp-logo-wrap pull-left">
                </div>

                <div class="clearfix"></div>
            </header>

            <!-- Main Content -->
            <div class="page-wrapper pa-0 ma-0 auth-page">
                <div class="container">
                    <!-- Row -->
                    <div class="table-struct full-width full-height">
                        <div class="table-cell vertical-align-middle auth-form-wrap">
                            <div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-30 Text-center">
                                            <h3 class="text-center txt-dark mb-10"> Login Admin
                                            </h3>
                                            <div class="text-center">
                                                <img class="brand-img mr-10" src="img/bpbd.png" alt="brand"/>
                                            </div>
                                            <h6 class="text-center nonecase-font txt-grey">Masukan Username Dan Password</h6>
                                        </div>	
                                        <div class="form-wrap">
                                            <form action="cek_login.php" method="POST">
                                                <div class="form-group">
                                                    <label class="control-label mb-10" for="Username">Username</label>
                                                    <input type="text" name="username" class="form-control" required="" id="Username" placeholder="Enter Username">
                                                </div>
                                                <div class="form-group">
                                                    <label class="pull-left control-label mb-10" for="Password">Password</label>
                                                    <div class="clearfix"></div>
                                                    <input type="password" name="password" class="form-control" required="" id="Password" placeholder="Enter Password">
                                                </div>

                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-orange btn-rounded">Log In<a href="#"></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->	
                </div>

            </div>
            <!-- /Main Content -->

        </div>
        <!-- /#wrapper -->

        <!-- JavaScript -->

        <!-- jQuery -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

        <!-- Slimscroll JavaScript -->
        <script src="assets/dist/js/jquery.slimscroll.js"></script>

        <!-- Init JavaScript -->
        <script src="assets/dist/js/init.js"></script>

    </body>

</html>
