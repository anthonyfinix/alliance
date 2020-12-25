<?php
// The Query
$user_query = new WP_User_Query(array(
    'role' => 'company',
    'paged' => 1,
    'number' => 8,
    'orderby' => 'registered',
    "order" => 'DESC'
));

// User Loop
if (!empty($user_query->get_results())) {
    foreach ($user_query->get_results() as $user) {
        $userId = $user->id;
        if (get_user_meta($userId, 'account_status')[0] == 'approved') {
            $profileUrlSlug = get_user_meta($user->ID, 'um_user_profile_url_slug_user_login');
            $userProfileName = get_user_meta($userId, 'profile_photo')[0]; ?>
            <div class="col-md-3 my-1 company-card">
                <div class="card card-body text-center m-2 align-items-center shadow" style="height: 100%;">
                    <?php
                    if (gettype($userProfileName) == 'string') {
                        $imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $userId . '/' . $userProfileName;
                    } else {
                        $imageUrl = get_template_directory_uri().'/assets/img/default.png';
                    }
                    ?>
                    <div
                    class="profile-img-cover"
                    style="
                    width:70px;
                    height: 70px;
                    background-image: url('<?php echo $imageUrl ?>');
                    background-size:cover;
                    border-radius:70px;
                    background-position: center
                    ";
                    ></div>
                    <div class="my-3">
                        <h5 class="mb-2"> <?php echo $user->first_name; ?> </h5>
                        <small> <?php echo $user->user_email; ?></small>
                    </div>
                    <a  href="<?php echo get_site_url() . '/user/' . $profileUrlSlug[0] ?>" class="btn btn-light btn-sm company-view-details-btn mt-auto">View Profile</a>
                </div>
            </div>
    <?php }
    }
} else {
    ?>
    <div class="col-12">
    <h3 class="text-center py-5 font-weight-bold" style="opacity: .4;">No Company Registered yet</h3>
    </div>
<?php
}
