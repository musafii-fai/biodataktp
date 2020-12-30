<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Biodata Kartu Tanda Penduduk</title>

    <link rel="icon" type="image/png" sizes="16x16" id="titleLogoIcon" href="<?php echo base_url();?>assets/img/logo-medan.gif">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/back/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/back/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

    <style type="text/css">
        .navbar-brand {
            display: inline-block;
            padding-top: .3125rem;
            padding-bottom: .3125rem;
            margin-right: .5rem;
            font-size: 1.25rem;
            line-height: 1;
            white-space: nowrap;
        }
        .layout-top-nav .wrapper .main-header .brand-image {
            margin-top: 0rem;
            margin-right: .2rem;
            height: 40px;
        }
        .main-header {
            border-bottom: 2px solid #c615d2;
            z-index: 1034;
        }
        .content-wrapper {
            background: #e8f6f7;
        }
    </style>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/back/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header" style="padding: 10px .5rem;">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">

                            <div class="card card-outline card-primary">
                                <div class="card-header" style="padding: 0.5rem;">
                                    <center>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 col-2">
                                                <img src="<?php echo base_url();?>assets/img/logo-medan.gif" alt="Logo Pemko Medan" style="height: 55px;">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-10">
                                                <span class="brand-text font-weight-light">
                                                    <h5>
                                                        Aplikasi Biodata Kartu Tanda Penduduk
                                                    </h5>
                                                </span>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </div>

                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="form-login-tab" data-toggle="pill" href="#form-login" role="tab" aria-controls="form-login" aria-selected="true">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="form-signup-tab" data-toggle="pill" href="#form-signup" role="tab" aria-controls="form-signup" aria-selected="false">Sign Up</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body" style="padding: 0.5rem;">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade show active" id="form-login" role="tabpanel" aria-labelledby="form-login-tab">
                                           <div class="card card-outline card-success">
                                                <div class="card-header" style="padding: 0.2rem;">
                                                    <h5>Form Login</h5> 
                                                </div>
                                                <?php echo form_open("",array("id" => "formLogin","class" => "register-form")); ?>
                                                <div class="card-body" style="padding: 0.5rem;">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"/>
                                                        <small id="errorEmail"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
                                                        <small id="errorPassword"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Kode Captcha</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-8" id="image_captcha">
                                                                        <?php echo $captcha_img; ?>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <button type="button" id="reloadCaptcha" title="Reload Captcha" class="btn btn-sm btn-outline-info"><i class="fas fa-sync-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control form-control-sm" name="kode_captcha" id="kode_captcha" placeholder="Kode Captcha"/>
                                                                <small id="errorCaptcha"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="padding: 0.5rem;">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                                <button type="button" id="btnSignIn" class="btn btn-outline-success btn-block">
                                                                    LOGIN
                                                                </button>
                                                            </div>
                                                        </div>      
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="form-signup" role="tabpanel" aria-labelledby="form-signup-tab">
                                            <div class="card card-outline card-warning">
                                                <div class="card-header" style="padding: 0.2rem;">
                                                    <h5>Form Sign Up</h5> 
                                                </div>
                                                <?php echo form_open("",array("id" => "formSignUp","class" => "register-form")); ?>
                                                <div class="card-body" style="padding: 0.5rem;">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password"/>
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="padding: 0.5rem;">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                                <button type="button" id="btnSignUp" class="btn btn-outline-warning btn-block">
                                                                    DAFTAR
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <?php assets_js_public("auth"); ?>

        <!-- Main Footer -->
        <footer class="main-footer" style="border-top: 1px solid #c100ce;">
            <!-- To the right -->
            <!-- <div class="float-right d-none d-sm-inline">
                Anything you want
            </div> -->
            <!-- Default to the left -->
            <strong>Copyright &copy; <a href="https://pemkomedan.go.id/" target="_blank">Pemko Medan</a> 2020 <?php echo date("Y") == "2020" ? "" : " - ".date("Y");?>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url();?>assets/back/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/back/dist/js/adminlte.min.js"></script>
    <!-- PAGE PLUGINS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
</body>

</html>