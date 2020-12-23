<?php # Template Name: Company Archive Alliance
get_header();
if (isset($_POST['start_with']) && !empty($_POST['start_with'])) {
    $start_with = $_POST['start_with'];
} else {
    $start_with = '*';
}
if (isset($_POST['servicetype']) && !empty($_POST['servicetype'])) {
    $servicetype = $_POST['servicetype'];
} else {
    $servicetype = '*';
}

$args = array(
    'role'    => 'company', 'order'   => 'ASC', 'paged' => 1,
    'number' => 8
);

$users = get_users($args);

?>
<div class="header-cover" style="
height:200px;
background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero.jpg');
background-size: cover;
background-position: top center;
"></div>
<div class="container">
    <div class="mt-5 mb-5 d-md-flex align-items-center justify-content-between">
        <h5 class="mb-0">Companies</h5>
        <div class="form-group filter-wrapper d-md-flex mb-0 align-items-center">
            <div class="d-flex align-items-center me-2 service-type-wrapper">
                <small class="me-2">Filter by Service Type</small>
                <form method="POST">
                    <select name="servicetype" onchange="this.form.submit()" class="form-control form-control-sm">
                        <option <?php echo ($servicetype == '*') ? 'selected' : null ?> value="*">All</option>
                        <option <?php echo ($servicetype == 'Interior Designing') ? 'selected' : null ?>>Interior Designing</option>
                        <option <?php echo ($servicetype == 'Information Technology') ? 'selected' : null ?>>Information Technology</option>
                        <option <?php echo ($servicetype == 'Web Development') ? 'selected' : null ?>>Web Development</option>
                        <option <?php echo ($servicetype == 'Restaurent') ? 'selected' : null ?>>Restaurent</option>
                        <option <?php echo ($servicetype == 'Real Estate') ? 'selected' : null ?>>Real Estate</option>
                        <option <?php echo ($servicetype == 'Cafe') ? 'selected' : null ?>>Cafe</option>
                    </select>
                </form>
            </div>
            <div class="d-flex align-items-center">
                <small class="me-2">Filter by Alphabet</small>
                <form method="POST">
                    <select name="start_with" class="form-control form-control-sm" onchange="this.form.submit()" style="max-width: 90px;">
                        <option value="*">All</option>
                        <option <?php if ($start_with == 'A') {
                                    echo 'selected';
                                } ?>>A</option>
                        <option <?php if ($start_with == 'B') {
                                    echo 'selected';
                                } ?>>B</option>
                        <option <?php if ($start_with == 'C') {
                                    echo 'selected';
                                } ?>>C</option>
                        <option <?php if ($start_with == 'D') {
                                    echo 'selected';
                                } ?>>D</option>
                        <option <?php if ($start_with == 'E') {
                                    echo 'selected';
                                } ?>>E</option>
                        <option <?php if ($start_with == 'F') {
                                    echo 'selected';
                                } ?>>F</option>
                        <option <?php if ($start_with == 'G') {
                                    echo 'selected';
                                } ?>>G</option>
                        <option <?php if ($start_with == 'H') {
                                    echo 'selected';
                                } ?>>H</option>
                        <option <?php if ($start_with == 'I') {
                                    echo 'selected';
                                } ?>>I</option>
                        <option <?php if ($start_with == 'J') {
                                    echo 'selected';
                                } ?>>J</option>
                        <option <?php if ($start_with == 'K') {
                                    echo 'selected';
                                } ?>>K</option>
                        <option <?php if ($start_with == 'L') {
                                    echo 'selected';
                                } ?>>L</option>
                        <option <?php if ($start_with == 'M') {
                                    echo 'selected';
                                } ?>>M</option>
                        <option <?php if ($start_with == 'N') {
                                    echo 'selected';
                                } ?>>N</option>
                        <option <?php if ($start_with == 'O') {
                                    echo 'selected';
                                } ?>>O</option>
                        <option <?php if ($start_with == 'P') {
                                    echo 'selected';
                                } ?>>P</option>
                        <option <?php if ($start_with == 'Q') {
                                    echo 'selected';
                                } ?>>Q</option>
                        <option <?php if ($start_with == 'R') {
                                    echo 'selected';
                                } ?>>R</option>
                        <option <?php if ($start_with == 'S') {
                                    echo 'selected';
                                } ?>>S</option>
                        <option <?php if ($start_with == 'T') {
                                    echo 'selected';
                                } ?>>T</option>
                        <option <?php if ($start_with == 'U') {
                                    echo 'selected';
                                } ?>>U</option>
                        <option <?php if ($start_with == 'V') {
                                    echo 'selected';
                                } ?>>V</option>
                        <option <?php if ($start_with == 'W') {
                                    echo 'selected';
                                } ?>>W</option>
                        <option <?php if ($start_with == 'X') {
                                    echo 'selected';
                                } ?>>X</option>
                        <option <?php if ($start_with == 'V') {
                                    echo 'selected';
                                } ?>>Y</option>
                        <option <?php if ($start_with == 'Z') {
                                    echo 'selected';
                                } ?>>Z</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="row companies-ajax-wrapper mb-5" data-service_type="<?php echo (isset($servicetype)) ? $servicetype : '*' ?>" data-start_with="<?php echo (isset($start_with)) ? $start_with : '*' ?>" data-page_number='1'>
        <?php
        if (sizeof($users) == 0) { ?>
            <h1 class="text-center fw-bold my-5 py-5" style="opacity: 0.3;">No User Found</h1>
            <?php
        } else {

            foreach ($users as $user) { ?>
                <?php
                $userId = $user->id;
                if (isset($start_with) && $start_with != '*' && (strtoupper($user->first_name[0]) != $start_with)) {
                    continue;
                }
                if (isset($servicetype) && $servicetype != '*' && $servicetype != get_user_meta($userId, 'servicetype')[0]) {
                    continue;
                }
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
                            <h5 class="mb-0"> <?php echo $user->first_name; ?> </h5>
                            <small> <?php echo $user->user_email; ?></small>
                        </div>
                        <img src="<?php echo $imageUrl ?>" width="40px" alt="">
                    </a>
                </div>
            <?php } ?>
            <div class="text-center py-5">
                <button class="btn btn-sm btn-primary" id="load_more_companies_archieve_btn">Load more</button>
            </div>
        <?php } ?>
    </div>
</div>
<?php get_footer() ?>