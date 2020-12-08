<?php get_header() ?>
<section>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</section>
<main>
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
                <a class="btn btn-sm btn-primary" href="<?php echo get_site_url() . '/companyarchive' ?>"> View All</a>
            </div>
            <div class="row">
    
                <?php get_template_part('custom/section', 'companies') ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer() ?>