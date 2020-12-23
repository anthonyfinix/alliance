<?php get_header() ?>
<main class="py-1" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;">
    <div class="container mb-5" style="margin-top: 120px;">
        <h5 class="text-center font-weight-bold mb-3 text-white">REGISTER</h5>
        <div class="card card-body mx-auto" style="max-width: 600px;">
            <?php
            if (have_posts()) {
                the_content();
            } // end if
            ?>
        </div>
    </div>
</main>
<?php get_footer() ?>