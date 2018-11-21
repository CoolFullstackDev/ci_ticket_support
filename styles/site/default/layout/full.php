<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo config('title') ?></title>
        <meta name="author" content="Marwa El-Manawy <marwa@elmanawy.info>" />
        <meta name="description" content="<?php echo config('meta_description') ?>">
        <meta name="Keywords" content="<?php echo config('meta_keywords') ?>">
       	<link rel="shortcut icon" href="<?php echo site_url() ?>/cdn/about/<?php echo config('favicon') ?>" type="image/x-icon">
        <link href="<?php echo STYLE_CSS ?>/layerslider/css/layerslider.css" rel="stylesheet">
        <link href="<?php echo STYLE_CSS ?>/style.css" rel="stylesheet">
        <link href="<?php echo STYLE_CSS ?>/responsive.css" rel="stylesheet">
    </head>

    <body>
        <!-- Preloader Start -->
            <div id="preloader">
                <div class="boxplus-load"></div>
            </div>

        <!-- ==================== Header Area Start ==================== -->
        <header class="header_area animated">
            <div class="container">
                <div class="row">
                    <!-- Logo Area Start -->
                    <div class="col-md-2">
                        <div class="logo_area">
                            <a href="<?php echo site_url() ?>">
                                <img src="<?php echo site_url() ?>/cdn/about/<?php echo config('logo') ?>" alt="<?php echo config('title') ?>">
                            </a>
                        </div>
                    </div>
                    <!-- Menu Area Start -->
                    <div class="col-md-8">
                        <div class="menu_area text-right">
                            <nav id="nav-menu">
                                <ul id="nav">
                                    <li><a href="<?php echo site_url() ?>">home</a></li>
                                    <li><a href="<?php echo site_url('knowledge_base') ?>">Knowledge Base</a></li>
                                    <li><a href="<?php echo site_url('home/contact') ?>">contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <?php if (!(user())): ?>
                            <div class="client-login">
                                <a href="javascript:popup_switch('login')" class="login"><i class="pe-7s-lock"></i> Login / Register</a>
                            </div>
                        <?php else: ?>
                            <div class="client-log">
                                <a href="<?php echo site_url('dashboard/settings') ?>" class="user-login">
                                    <span>
                                        <?php if (user()->image): ?><img src="<?= base_url() ?>/cdn/users/<?= user()->image ?>" alt="<?= user()->username ?>"> <?php endif ?>
                                        <?php if (!(user()->image)): ?><img src="<?= base_url() ?>/cdn/users/default.png" alt="<?= user()->username ?>"> <?php endif ?>  
                                    </span>
                                </a>
                                <a href="<?= site_url('dashboard/tickets') ?>" class="user-icon"><i class="fa fa-ticket"></i></a>
                                <a href="<?= site_url('account/logout') ?>" class="user-icon power-user"><i class="fa fa-power-off"></i></a>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
        </header>
        <div class="main-content2">
            {layout}
        </div>


        <div class="footer_social_browser_contact_area  clearfix">
            <!-- Browsar-->
            <div class="social_browsar text-center">
                <a href="<?php echo config('facebook') ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="<?php echo config('twitter') ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="<?php echo config('instagram') ?>"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="<?php echo config('google_plus') ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            </div>
            <div class="made_by_text text-center">
                <p>Powered BY <i class="fa fa-heart powered"></i> by <a href="https://elmanawy.info">Marwa El-Manawy</a></p>
            </div>
        </div>


        <?php if (!user()): ?>
            <div class="modal fade" id="loginModel" role="dialog">
                <div class="modal-dialog login-model">
                    <div class="modal-content">

                        <div class="modal-body">
                            <i class="fa fa-times-circle close" aria-hidden="true" data-dismiss="modal"></i>
                            <div class="clearfix"></div><br />
                            <div class="notification error closeable login_errors" style="display: none;"></div>
                            <form class="popup_login" method="post" autocomplete="off">
                                <p class="login-icon">
                                    <i class="pe-7s-user"></i>
                                    <b>Welcome,</b> Login to your account.
                                </p>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Your Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 text-left">
                                            <label class="check-text" for="user-session-remember-me">
                                                <input name="remember" type="checkbox" tabindex="4" value="1" checked="checked"/>
                                                <span class="chk-img"></span>
                                                <a id="remember-button">Remember me</a>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <a href="javascript:popup_switch('forgot')" class="forget-pass">Forget Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button color big">Login
                                        <i class="fa fa-spin fa-spinner login_loading" style="display: none;"></i>
                                    </button>
                                </div>
                            </form>

                            <form class="popup_register" method="post">
                                <p class="login-icon">
                                    <i class="pe-7s-id"></i>
                                    <b>Welcome,</b> New Here!!
                                </p>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password_2" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button color big">Register Now
                                        <i class="fa fa-spin fa-spinner login_loading" style="display: none;"></i>
                                    </button>
                                </div>
                            </form>

                            <form class="popup_forgot" method="post">
                                <p class="login-icon">
                                    <i class="pe-7s-lock"></i>
                                    To recover your password, please write your email address below.
                                </p>
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button color big">Reset Password
                                        <i class="fa fa-spin fa-spinner login_loading" style="display: none;"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <p class="popup_login">Don't you have an account? <a href="javascript:popup_switch('register')">Register
                                    now</a>
                            </p>
                            <p class="popup_forgot">Don't you have an account? <a href="javascript:popup_switch('register')">Register
                                    now</a>
                            </p>
                            <p class="popup_register">Already Member? <a href="javascript:popup_switch('login')">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <!-- ============= All JS ============= -->
        <script> var site_url = '<?= site_url() ?>';</script>
        <script src="<?php echo STYLE_JS ?>/jquery-2.2.4.min.js"></script>
        <script src="<?php echo STYLE_JS ?>/bootstrap.js"></script>
        <script src="<?php echo STYLE_JS ?>/plugins.js"></script>
        <script src="<?php echo STYLE_JS ?>/jquery-printme.min.js"></script>
        <script src="<?php echo STYLE_CSS ?>/layerslider/js/greensock.js"></script>
        <script src="<?php echo STYLE_CSS ?>/layerslider/js/layerslider.transitions.js"></script>
        <script src="<?php echo STYLE_CSS ?>/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
        <script src="<?php echo STYLE_JS ?>/switcher.js"></script>
        <script src="<?php echo STYLE_JS ?>/custom.js"></script>
        <script>
            $(function () {

                $('#layerslider, #layerslider2').layerSlider({
                    autoStart: true,
                    pauseOnHover: true,
                    navPrevNext: false,
                    navButtons: true,
                    navStartStop: true,
                    thumbnailNavigation: false,
                    autoPlayVideos: false,
                    firstLayer: 1,
                    skin: 'v5',
                    skinsPath: '<?php echo STYLE_CSS ?>/layerslider/skins/'

                });

            });

        </script>

    </body>
</html>