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
            <a href="<?php echo get_site_url().'/register' ?>" class="btn btn-light rounded-pill fw-bold mt-3 px-4" style="color:#0058ac">Register Now</a>
            <?php endif ?>
        </div>
    </div>
    <div class="text-white w-100" style="position: absolute; bottom: 20px">
        <div class="d-md-flex justify-content-between container align-items-center">
            <div class="initiative-badge bg-white text-dark px-3 py-2 text-center" style="border-radius:20px">
                <small style="font-weight:normal;font-size:13px;color:#0077e9">an initiative by E Product Zone Pvt. Ltd</small>
            </div>
            <div class="d-none d-md-flex">
                <small class="mb-0 me-3">collaborators and their offers</small>
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
                    <small>Latest offers from our collaborators</small>
                </div>
                <a class="view-all-posts-button d-flex align-item-center text-white rounded-pill ps-3 pe-2 py-1" style="text-decoration: none;border: 2px solid white;" href="<?php echo get_site_url() . '/offer' ?>">
                    <small class="d-md-block d-none" style="padding-top:3px">View All</small>
                    <span class="material-icons">keyboard_arrow_right</span>
                </a>
            </div>
            <div class="offer-owl-carousel owl-carousel owl-theme">
                <?php get_template_part('custom/section', 'offer') ?>
            </div>
        </div>
    </div>
    <div class="py-5 company-wrapper" style="background-color: #ebebeb;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3 px-md-3">
                <div>
                    <h5 class="mb-0  font-weight-bold">Collaborator</h5>
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