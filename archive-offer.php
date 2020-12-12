<?php get_header() ?>
<div class="header-cover" style="
height:200px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
<div class="container">
    <div class="mt-5 mb-4">
        <h5 class="mb-4">All Offers</h5>
    </div>
    <?php if (have_posts()) :
        while (have_posts()) : the_post();

            $userId = get_the_author_id();
            if (gettype(get_user_meta($userId, 'profile_photo')[0]) == 'string') {
                $imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $userId . '/' . get_user_meta($userId, 'profile_photo')[0];
            } else {
                $imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
            }
    ?>
            <div class="card card-body mb-3" style="height: 100%;">
                <h6><?php the_title(); ?></h6>
                <small><?php the_content(); ?></small>
                <div class="d-flex align-items-center mt-auto">
                    <img src='<?php echo $imageUrl ?>' width="40px" height="40px" class="rounded-circle mr-3" />
                    <h5 class="pt-0 mb-0"><?php echo get_the_author_meta( 'first_name') ?></h5>
                </div>
            </div>
    <?php
        endwhile;
    endif; ?>
    <?php the_posts_pagination() ?>
</div>