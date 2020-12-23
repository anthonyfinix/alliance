<?php get_header() ?>
<main class="py-1" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;">
    <div class="container mb-5" style="margin-top: 150px;">
        <h5 class="text-center fw-bold mb-2">LOGIN</h5>
        <div class="card card-body mx-auto" style="max-width: 350px;">
            <?php
            if (have_posts()) {
                the_content();
            } // end if
            ?>
        </div>
    </div>
</main>
<?php get_footer() ?>