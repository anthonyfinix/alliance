<?php get_header() ?>
<div class="header-cover" style="
height:150px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
<?php
if (have_posts()) {
        the_content();
} // end if
?>
<?php get_footer() ?>