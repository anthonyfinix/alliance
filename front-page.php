<?php get_header() ?>
<section id="hero-section" class="d-flex flex-column justify-content-center align-item-center">
    <div class="container d-flex flex justify-content-center align-items-center call-to-action-comp">
        <div class="float-elem mr-5 d-md-block d-none">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/hero-float-elem.jpg" width="480px" alt="">
            <div></div>
        </div>
        <div class="text-white ms-5">
            <h1>Lets Join our hands</h1>
            <h1>and <span class="fw-bold">Collaborate</span></h1>
            <?php if(!is_user_logged_in()): ?>
            <a href="<?php echo get_site_url().'/register' ?>" class="btn btn-light rounded-pill fw-bold mt-3" style="color:#0058ac">Register</a>
            <?php endif ?>
            <?php if(is_user_logged_in()): ?>
            <a href="<?php echo get_site_url().'/company-archive' ?>" class="btn btn-light rounded-pill fw-bold mt-3" style="color:#0058ac">Contributers</a>
            <?php endif ?>
        </div>
    </div>
    <div class="text-white w-100" style="position: absolute; bottom: 20px">
        <div class="d-flex justify-content-between container">
            <div>
                <small>An Initiative by</small>
                <small>Consultancy Today</small>
            </div>
            <div class="d-flex">
                <small class="mb-0 me-3">Collaboratives and their offers</small>
                <span class="material-icons">arrow_circle_down</span>
            </div>
        </div>
    </div>
</section>
<main style="position: relative;top:100vh;z-index:4">
    <div class="offers-wrapper py-5 bg-primary text-white">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3 px-md-3">
                <div>
                    <h5 class="mb-0 font-weight-bold">Latest Offers</h5>
                    <small>Latest offers companies have to offer</small>
                </div>
                <a class="btn btn-sm btn-light" href="<?php echo get_site_url() . '/offer' ?>">
                    View All
                </a>
            </div>
            <div class="offer-owl-carousel owl-carousel owl-theme">
                <?php get_template_part('custom/section', 'offer') ?>
            </div>
        </div>
    </div>
    <div class="py-5" style="background-color: #ebebeb;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3 px-md-3">
                <div>
                    <h5 class="mb-0  font-weight-bold">Companies</h5>
                    <small>Companies Registered</small>
                </div>
                <a class="btn btn-sm btn-primary" href="<?php echo get_site_url() . '/company-archive' ?>"> View All</a>
            </div>
            <div data-page_number='1' class="row companies-ajax-wrapper">
                <?php get_template_part('custom/section', 'companies') ?>
            </div>
            <div class="mt-5 text-center load-more-button-wrapper">
                <button id="load_more_company_btn" class="btn btn-primary">Load More</button>
            </div>
        </div>
    </div>
    <?php get_footer() ?>