<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
         <meta name="author" content="Marwa El-Manawy <marwa@elmanawy.info>" />
        <link rel="shortcut icon" href="<?php echo site_url() ?>/cdn/about/<?php echo config('favicon') ?>" type="image/x-icon" />
        <title><?php echo config('title') ?> - Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
        <link rel="stylesheet" href="<?php echo STYLE_CSS ?>/bootstrap.css">
        <link rel="stylesheet" href="<?php echo STYLE_CSS ?>/core.css">
        <link rel="stylesheet" href="<?php echo STYLE_CSS ?>/forms.css">
        <link rel="stylesheet" href="<?php echo STYLE_CSS ?>/components.css">
        <link rel="stylesheet" href="<?php echo STYLE_CSS ?>/skins.css">
        <link rel="stylesheet" href="<?php echo STYLE_CSS ?>/custom.css">
        <script src="<?php echo STYLE_JS ?>/jquery-1.11.1.min.js"></script>
    </head>
    <body class="page-body login-page">
        <div class="login-container">
            <div class="row">
                <div class="col-sm-6">
                    <script type="text/javascript">
                        jQuery(document).ready(function ($)
                        {

                            setTimeout(function () {
                                $(".fade-in-effect").addClass('in');
                            }, 1);

                            $("form#login .form-group:has(.form-control):first .form-control").focus();
                        });
                    </script>
                    <!-- Errors container -->
                    <div class="errors-container">

                    </div>
                    <!-- Add class "fade-in-effect" for login form effect -->
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger"><?php echo validation_errors() ?></div>
                    <?php endif ?>

                    <?php echo form_open(false, 'class="login-form fade-in-effect"') ?>
                    <div class="login-header">
                        <a href="<?php echo site_url() ?>" class="logo">
                            <img src="<?php echo site_url() ?>/cdn/about/<?php echo config('logo') ?>" alt="Marwa El-Manawy" width="100" />
                        </a>
                        <p> Dear user, enter your data to login</p>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" value="<?php echo set_value('email') ?>" class="form-control input-dark" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <input type="password" id="inputPassword" name="password" placeholder="Password" class="form-control input-dark" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark  btn-block text-right" value="<?php echo lang('users_login') ?>">
                            <i class="fa-lock"></i>
                             Login
                        </button>
                    </div>
                    <?php echo form_close() ?>                
                </div>
            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src="<?php echo STYLE_JS ?>/bootstrap.min.js"></script>
        <script src="<?php echo STYLE_JS ?>/TweenMax.min.js"></script>
        <script src="<?php echo STYLE_JS ?>/resizeable.js"></script>
        <script src="<?php echo STYLE_JS ?>/joinable.js"></script>
        <script src="<?php echo STYLE_JS ?>/api.js"></script>
        <script src="<?php echo STYLE_JS ?>/toggles.js"></script>
        <script src="<?php echo STYLE_JS ?>/toastr/toastr.min.js"></script>

    </body>
</html>