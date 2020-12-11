<?php get_header() ?>
<div class="header-cover" style="
height:150px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
<main>
    <div class="container my-5">
        <h5 class="text-center font-weight-bold mb-2">LOGIN</h5>
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