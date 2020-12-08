<?php
$args = array('role'    => 'company', 'order'   => 'ASC');
$users = get_users($args);
?>
<?php
foreach ($users as $user) { ?>
    <?php $profileUrlSlug = get_user_meta($user->ID,'um_user_profile_url_slug_user_login') ?>
    <a class="col-md-3 my-1 company-card" href="<?php echo get_site_url().'/user/'.$profileUrlSlug[0] ?>">
        <div class="card card-body text-center m-2 align-items-center" style="height: 100%;">
            <?php
            $userId = $user->id;
            $userProfileName = get_user_meta($userId, 'profile_photo')[0];
            if (gettype($userProfileName) == 'string') {
                $imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $userId . '/' . $userProfileName;
            } else {
                $imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
            }
            ?>
            <img src="<?php echo $imageUrl ?>" class="img-fluid mx-auto rounded-circle" width="70px" alt="">
            <div class="my-3">
                <h6> <?php echo $user->first_name; ?> </h6>
                <small> <?php echo $user->user_email; ?></small>
            </div>
            <button class="btn btn-light btn-sm company-view-details-btn mt-auto">View Details</button>
        </div>
    </a>
<?php } ?>