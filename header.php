<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <nav class="bg-primary py-2 px-2 d-md-flex align-items-center text-white d-none">
        <a href="https://www.facebook.com/travelhuge/" target="_blank" class="ml-3 mr-3">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/facebook.svg" width="15px" height="15px" alt="">
        </daiv>
        <a href="https://www.instagram.com/travelhuge/" target="_blank" class="mr-3" >
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/instagram.svg" width="15px" height="15px" alt="">
        </a>
        <a href="https://www.linkedin.com/company/travelhuge-com/" target="_blank" class="mr-3" >
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/linkedin.svg" width="15px" height="15px" alt="">
        </a>
        <div class="mx-4" style="border: 1px solid white;height:15px"></div>
        <div class="d-flex align-items-center">
            <span class="material-icons md-14">mail</span>
             <a href="mailto:support@eproductzone.com"> <small class="mb-0 ml-2 text-white">support@eproductzone.com</small></a>
        </div>
    </nav>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo get_site_url() ?>">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/81highsteet.png" width="50px">
                81 High Street Alliance
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse ml-auto',
                'container_id'    => 'navbarNav',
                'menu_class'      => 'navbar-nav ml-auto',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            )); ?>
        </nav>

    </header>