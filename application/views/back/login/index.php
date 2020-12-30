<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/signin/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/signin/css/style.css">
    <style type="text/css">
        .main {
            margin-top: 40px;
            background: #b6eaea;
            padding: 20px 0;
        }

        .signin-content {
            padding-top: 62px;
            padding-bottom: 62px;
        }

        .form-submit {
            display: inline-block;
            background: #042138;
            color: #fff;
            border-bottom: none;
            width: auto;
            padding: 15px 39px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            margin-top: 25px;
            cursor: pointer;
        }

        .form-submit:hover {
            background: #042138;
        }
    </style>
</head>
<body style="background: rgb(173 216 251) !important">

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <br>
                <center >
                    <b style="font-size: 14px;">
                        Selamat Datang di Website Aplikasi Biodata Kartu Tanda Penduduk. 
                        <br>
                        Silahkan login di form yang tersedia.
                    </b>
                </center>
                <hr>
                <div class="signin-content" style="margin-top: -60px;">
                    <div class="signin-image">
                        <center>
                            <h3 style="color: #36a3f7; font-size: 20px;">Pemerintah Kota Medan</h3>
                        </center>
                        <figure><img src="<?php echo base_url();?>assets/img/logo-medan.gif" alt="sing up image" class="img-responsive"></figure>  
                        <center style="margin-top: -45px;">
                            <b style="font-size: 14px;">
                                Website Administrator Biodata KTP
                            </b>
                        </center>                
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Form Login</h2>
                        <?php echo form_open("",array("id" => "formLogin","class" => "register-form")); ?>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="email" placeholder="Email"/>
                                <small id="errorEmail"></small>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                                <small id="errorPassword"></small>
                            </div>
                            <div class="form-group">
                                <!-- <label>Kode Captcha</label> -->
                                <table>
                                    <tr>
                                        <td>
                                            <div class="col-md-8" id="image_captcha">
                                                <?php echo $captcha_img; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" id="reloadCaptcha" title="Reload Captcha" class="btn btn-sm btn-outline-info">Reload</button>
                                        </td>
                                    </tr>
                                </table>    
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="kode_captcha" id="kode_captcha" placeholder="Kode Captcha"/>
                                <small id="errorCaptcha"></small>
                            </div>

                            <div class="form-group form-button">
                                <button type="button" id="btnSignIn" class="form-submit">
                                    LOGIN
                                </button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url();?>assets/signin/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url();?>assets/signin/js/main.js"></script>

    <script type="text/javascript">var base_url = '<?php echo base_url("admin/");?>';</script>
    <?php assets_js_back("signin"); ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>