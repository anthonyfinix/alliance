<?php
get_header();
?>
<div class="header-cover" style="
height:200px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
<div class="container py-5">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <?php
            $userId = get_the_author_ID();
            if (gettype(get_user_meta($userId, 'profile_photo')[0]) == 'string') {
                $imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $userId . '/' . get_user_meta($userId, 'profile_photo')[0];
            } else {
                $imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
            }
            ?>
            <div class="d-flex align-item-center mb-4">
                <div class="mr-2 rounded-circle" style="
                width: 20px;
                height: 20px;
                background-image: url('<?php echo $imageUrl ?>');
                background-size:contain;
                background-repeat:no-repeat;
                background-position:center;
                ">
                </div>
                <h6 class="font-weight-bold mb-0"><?php the_author(); ?></h6>
            </div>
            <div class="card card-body">
                <h5 class="font-weight-bold"><?php the_title() ?></h5>
                <p class="font-weight-bold"><?php the_content(); ?></p>
            </div>
    <?php
        endwhile;
    else :
        _e('Sorry, no pages matched your criteria.', 'textdomain');
    endif;
    ?>
</div>
<?php
get_footer();
?>