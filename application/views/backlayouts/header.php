<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php 
        if (!isset($page_title) || $page_title == "") {
            $page_title = "Empty Name Page";
        }
    ?>
    <title>Administrator || <?php echo $page_title; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?php echo base_url();?>assets/img/logo-medan.gif" type="image/x-icon"/>
    
    <!-- Fonts and icons -->
    <script src="<?php echo base_url();?>assets/theme/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url();?>assets/theme/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/atlantis.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/demo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.min.css">
    <style type="text/css">
        .table td, .table th {
            font-size: 14px;
            border-top-width: 0;
            border-bottom: 1px solid;
            border-color: #ebedf2!important;
            padding: 0 25px!important;
            height: 40px;
            vertical-align: middle!important;
        }

        .table-head-bg-default thead th, .table-striped-bg-default tbody tr:nth-of-type(odd) {
            background: #1f283e!important;
            color: #fff!important;
            border: 0!important;
        }
    </style>
    <script src="<?php echo base_url();?>assets/theme/js/core/jquery.3.2.1.min.js"></script>
    <script>var base_url = '<?php echo base_url();?>';</script>
    <script>var base_url_back = '<?php echo base_url('admin/');?>';</script>
</head>
<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="white">
                
                <a href="<?php echo site_url('admin'); ?>" class="logo">
                    <h4 style="margin-top: 10px;">
                        <img src="<?php echo base_url();?>assets/img/logo-medan.gif" style="height: 38px;" alt="navbar brand" class="navbar-brand">
                        <span style="color: #b9babf;">Administrator</span>
                    </h4>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Menu Top Navbar Header -->
            <?php $this->load->view('backlayouts/menu_top'); ?>
            <!-- End Menu Top Navbar -->
        </div>

        <!-- Main Sidebar Container -->
        <?php $this->load->view('backlayouts/menu_side'); ?>

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title"><?php echo $page_title; ?></h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="<?php echo base_url("admin"); ?>">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>

                            <?php if (isset($breadcrumbs)): ?>
                                <?php foreach ($breadcrumbs as $key => $val): ?>
                                    <li class="separator">
                                        <i class="flaticon-right-arrow"></i>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $val; ?>"><?php echo $key; ?></a>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ul>
                    </div>
