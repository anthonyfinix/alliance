<?php

$query = new WP_Query(array(
    'post_type' => 'offer',
    'post_status' => 'publish'
));
while ($query->have_posts()) {
    $query->the_post();
    $userId = get_the_author_id();
    if (gettype(get_user_meta($userId, 'profile_photo')[0]) == 'string') {
        $imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $userId . '/' . get_user_meta($userId, 'profile_photo')[0];
    } else {
        $imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
    }
?>

    <a class="item offer-card" href="<?php echo get_permalink(get_post()) ?>">
        <div class="card card-body m-2" style="height: 100%;">
            <p class="fw-bold"><?php echo get_the_title(); ?></p>
            <small class="font-weight-light"><?php echo get_the_excerpt(); ?></small>
            <div class="d-flex align-items-center justify-content-between  mt-auto">
                <div class="d-flex align-items-center">
                    <div class="me-2 rounded-circle" style="
                    width: 20px;
                    height: 20px;
                    background-image: url('<?php echo $imageUrl ?>');
                    background-size:contain;
                    background-repeat:no-repeat;
                    background-position:center;
                    ">
                    </div>
                    <p class="pt-0 mb-0"><?php echo get_the_author_meta( 'first_name' ) ?></p>
                </div>
                <div class="post_link_icon rounded-circle">
                    <span class="material-icons mb-0">keyboard_arrow_right</span>
                </div>
            </div>
        </div>
    </a>
<?php
}

wp_reset_query()
?>