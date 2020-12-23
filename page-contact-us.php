<?php
get_header();
?>
<div class="wrap">
<div class="header-cover" style="
height:200px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
    <div class="container">
    <h1 class="my-4">Contact Us</h1>
    <div>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
            the_content();
            endwhile;
        endif;
        ?>
    </div>
    </div>
</div>
<?php
get_footer();
?>