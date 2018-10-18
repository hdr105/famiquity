<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="<?php echo Smart::getKeywords(); ?>" />
        <meta name="description" content="<?php echo Smart::getDescription(); ?>" />
        <meta name="author" content="7thpixel.ca" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title><?php echo Smart::getTitle(); ?></title>

        <link rel="shortcut icon" href="<?php echo Smart::loadImages('favicon.ico'); ?>" />
        <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800">
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('plugins-css.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadAsset('revolution/css/settings.css'); ?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('typography.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('shortcodes/shortcodes.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('style.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('responsive.css'); ?>" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('skins/skin-blue.css'); ?>" data-style="styles"> 
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('select2.min.css'); ?>" data-style="styles">
        <link rel="stylesheet" type="text/css" href="<?php echo Smart::loadCss('multi.select.css'); ?>" data-style="styles">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript" src="<?php echo Smart::loadJs('jquery-1.12.4.min.js'); ?>"></script> 
        <script type="text/javascript" src="<?php echo Smart::loadJs('multi.select.js'); ?>"></script>
        <script>
            var base_url = "<?php echo base_url(); ?>";
            var folder = "";
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div id="pre-loader" class="hidden">
                <!-- <img src="<?php echo Smart::loadImages('pre-loader/loader-01.svg'); ?>" alt=""> -->
            </div>
            <header id="header" class="header transparent">
                <div class="menu">  
                    <!-- menu start -->
                    <nav id="menu" class="mega-menu">
                        <!-- menu list items container -->
                        <section class="menu-list-items">
                            <div class="container"> 
                                <div class="row"> 
                                    <div class="col-lg-12 col-md-12"> 
                                        <!-- menu logo -->
                                        <ul class="menu-logo">
                                            <li>
                                                <a href="<?php echo base_url(); ?>"><img id="logo_img" src="<?php echo Smart::loadImages('logo.png'); ?>" alt="logo"> </a>
                                            </li>
                                        </ul>
                                        <!-- menu links -->
                                        <div class="menu-bar">
                                            <ul class="menu-links">
                                                <?php
                                                if (Smart::isAuthorized() === TRUE):
                                                    $user = Smart::getCurrentUser();
                                                    ?>
                                                    <?php echo Smart::getRoleNavigation($user->role_id); ?>
                                                <?php else: ?>
                                                    <?php echo Smart::getRoleNavigation(); ?>
                                                <?php endif; ?>
                                            </ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </nav>
                    <!-- menu end -->
                </div>
            </header>