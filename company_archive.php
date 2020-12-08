<?php # Template Name: Company Archive Alliance
get_header();
?>
<?php
$args = array('role'    => 'company', 'order'   => 'ASC');
$users = get_users($args);
?>
<div class="header-cover" style="
height:200px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
<div class="container">
    <div class="mt-5 mb-2">
        <h5 class="mb-4">Companies</h5>
    </div>
    <div class="row">
        <?php
        foreach ($users as $user) { ?>
            <?php
            $userId = $user->id;
            $userProfileName = get_user_meta($userId, 'profile_photo')[0];
            if (gettype($userProfileName) == 'string') {
                $imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $userId . '/' . $userProfileName;
            } else {
                $imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
            }
            ?>
            <div class="col-md-6 mb-4">
                <a class="company-list-card card flex-row justify-content-between align-items-center card-body mb-3" href="<?php echo get_site_url() . '/user/' . $user->user_login ?>" style="height: 100%;">
                    <div>
                        <h5 class="mb-0"> <?php echo $user->display_name; ?> </h5>
                        <small> <?php echo $user->user_email; ?></small>
                    </div>
                    <img src="<?php echo $imageUrl ?>" width="40px" alt="">
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<? get_footer(); ?>