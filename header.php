<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>High Street Alliance</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="main-header" class="w-100">
        <nav class="navbar navbar-expand-md navbar-dark mx-md-4">
            <a class="navbar-brand d-flex" href="<?php echo get_site_url() ?>">
                <img class="me-2" src="<?php echo get_template_directory_uri() ?>/assets/img/81highsteet.svg" width="50px" height="50px">
                <div>
                    <small style="letter-spacing: 1px;" class="font-weight-light mb-0 d-block">High Street</small>
                    <small style="font-size: 14px;" class="font-weight-light d-block">Alliance</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-md-center">
                    <?php if (!is_front_page()) : ?>
                        <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                            <a class="nav-link mb-0" href="<?php echo get_site_url() ?>">Home</a>
                        </li>
                    <?php endif ?>
                    <?php if (!is_user_logged_in()) : ?>
                        <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                            <a class="nav-link mb-0" href="<?php echo get_site_url() . '/login' ?>">Login</a>
                        </li>
                        <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                            <a class="nav-link mb-0" href="<?php echo get_site_url() . '/register' ?>">Sign Up</a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                        <a class="nav-link mb-0" href="<?php echo get_site_url() . '/company-archive' ?>">Collaborater</a>
                    </li>
                    <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                        <a class="nav-link mb-0" href="<?php echo get_site_url() . '/contact-us' ?>">Contact Us</a>
                    </li>
                    <?php if (is_user_logged_in()) : ?>
                        <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                            <a class="nav-link mb-0" href="<?php echo get_site_url() . '/user' ?>">Profile</a>
                        </li>
                        <li class="nav-item my-circle-btn d-flex align-items-center justify-content-between">
                            <a class="nav-link mb-0" href="<?php echo get_site_url() . '/logout' ?>">Logout</a>
                        </li>
                    <?php endif ?>
                    <?php if (is_front_page()) : ?>
                        <div class="text-white d-md-flex d-none align-items-center search-wrapper" style="position: relative;">
                            <input class="search-textbox form-control" style="display: none;" type="text" />
                            <div class="search-suggestion-wrapper" style="position: absolute;
                        right: 30px;
                        top:45px;
                        max-width:60vw"></div>
                            <span class="material-icons ms-3 search-button">search</span>
                        </div>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>