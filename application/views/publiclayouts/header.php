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

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-white">
            <div class="container">
                <a href="<?php echo base_url();?>" class="navbar-brand">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-2">
                            <img src="<?php echo base_url();?>assets/img/logo-medan.gif" alt="Logo Pemko Medan" class="brand-image img-circle" style="opacity: .8">
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <span class="brand-text font-weight-light">
                                <b>
                                    Pemerintah Kota Medan
                                    <br>
                                    <small style="color: orange;">Biodata Kartu Tanda Penduduk</small>
                                </b>
                            </span>
                        </div>
                    </div>      
                </a>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?php echo $this->userData->email; ?></a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-divider"></li>
                            <li><a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">Logout &nbsp;&nbsp;</a></li>
                        </ul>
                    </li>

                    
                </ul>


            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header" style="padding: 1px .5rem;">
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