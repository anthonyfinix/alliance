<?php

// get user
$user = get_user_by('id', um_profile_id());
$userMeta = get_user_meta(um_profile_id());
$posts = get_posts(array('author' =>  $user->ID, 'post_type' => 'offer',));
if (isset($_POST['avatar_submit'])) {
	$avatar = $_FILES['avatar'];
	if (isset($avatar['name']) && !empty($avatar['name'])) {
		global $wpdb;
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents($avatar['tmp_name']);
		$filename = basename($avatar['name']);
		if (wp_mkdir_p($upload_dir['path'])) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents($file, $image_data);
		$wp_filetype = wp_check_filetype($filename, null);

		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => sanitize_file_name($filename),
			'post_content' => '',
			'post_status' => 'inherit'
		);

		$attach_id = wp_insert_attachment($attachment, $file);
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata($attach_id, $file);
		wp_update_attachment_metadata($attach_id, $attach_data);

		update_user_meta(get_current_user_id(), 'profile_photo', $avatar['name']);
		move_uploaded_file($avatar['tmp_name'], _wp_upload_dir()['basedir'] . '/ultimatemember/' . get_current_user_id() . '/' . $_FILES['avatar']['name']);
		header("Refresh:0");
	}
}
if (isset($_POST['submit'])) {

	// get input details
	$user_email = $_POST['user_email'];
	$mobile_number = $_POST['mobile_number'];
	$serviceOffered = $_POST['serviceOffered'];
	$address = $_POST['address'];

	if (isset($user_email) && !empty($user_email)) {
		wp_update_user(array(
			'ID' => $user->ID,
			'user_email' => $user_email
		));
		echo '<div class="alert alert-success" role="alert">Email updated</div>';
	}

	if (isset($mobile_number) && !empty($mobile_number)) {
		update_user_meta($user->ID, 'mobile_number', $mobile_number);
		echo '<div class="alert alert-success" role="alert">Mobile Number updated</div>';
	}
	if (isset($serviceOffered) && !empty($serviceOffered)) {
		update_user_meta($user->ID, 'servicesOffered', $serviceOffered);
		echo '<div class="alert alert-success" role="alert">Services and Description updated</div>';
	}
	if (isset($address) && !empty($address)) {
		update_user_meta($user->ID, 'address', $address);
		echo '<div class="alert alert-success" role="alert">Address Updated</div>';
	}
	header("Refresh:0");
}


if (gettype($userMeta['profile_photo'][0]) == 'string') {
	$imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $user->ID . '/' . $userMeta['profile_photo'][0];
} else {
	$imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
}
?>
<div class="container" style="min-height: 80vh;">
	<div class="d-flex flex-row mb-4 align-items-end" style="margin-top:-20px">
		<?php if ($userMeta['profile_photo'][0]) { ?>
			<div class="mr-2 rounded-circle" style="
				width: 100px;
				height: 100px;
				background-image: url('<?php echo $imageUrl ?>');
				background-size:contain;
				background-repeat:no-repeat;
				background-position:center;
				border: 5px solid white;
				background-color: white;
				">
			</div>
		<?php } else { ?>
			<div class="mr-2 rounded-circle" style="
				width: 100px;
				height: 100px;
				background-size:contain;
				background-repeat:no-repeat;
				background-position:center;
				border: 5px solid white;
				background-color: #ababab;
				position:relative
				">
				<form method="POST" style="width:100%"  enctype="multipart/form-data">
					<input type="hidden" name="avatar_submit">
					<span class="material-icons" style="position: absolute;left: calc(50% - 13px);top: calc(50% - 15px)">photo_camera</span>
					<input onchange="form.submit()" type="file" name="avatar" style="border: none;background:none; opacity: 0;position:absolute;top: 0px;
					bottom:0px;left:0px;width:100%"> </input>
				</form>
			</div>
		<?php } ?>
		<div>
			<h1 class="font-weight-light mb-4"> <?php echo $user->display_name ?></h1>
		</div>
	</div>
	<ul class="nav nav-tabs mb-3 mt-5" id="pills-tab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-description" role="tab"> Details</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-offers" role="tab"> Offers</a>
		</li>
		<?php if (get_current_user_id() == $user->ID) : ?>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-update" role="tab"> Update Details</a>
			</li>
		<?php endif ?>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-description" role="tabpanel">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-body border-0">
						<?php if ($userMeta['servicesOffered'][0]) {
							echo $userMeta['servicesOffered'][0];
						} else {
							echo 'No Description and Services provided please click on Update Details';
						}
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-body text-white bg-primary">
						<div class="d-flex align-items-center mb-4">
							<span class="material-icons mr-2">mail</span>
							<p class="mb-0">
								<?php if ($user->user_email) {
									echo $user->user_email;
								} else {
									echo 'Not provided please click on Update Details';
								}
								?>
							</p>
						</div>
						<div class="d-flex align-items-center mb-4">
							<span class="material-icons mr-2">call</span>
							<p class="mb-0">
								<?php if ($userMeta['mobile_number'][0]) {
									echo $userMeta['mobile_number'][0];
								} else {
									echo 'Not provided please click on Update Details';
								}
								?>
							</p>
						</div>
						<div class="d-flex align-items-start">
							<span class="material-icons mr-2">location_pin</span>
							<p class="mb-0">
								<?php if ($userMeta['address'][0]) {
									echo $userMeta['address'][0];
								} else {
									echo 'Not provided please click on Update Details';
								}
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="pills-offers" role="tabpanel">
			<div class="row">
				<div class="col-md-8">
					<?php
					foreach ($posts as $post) {
					?>
						<div class="card card-body my-2">
							<h6 class="font-weight-bold"> <?php echo $post->post_title; ?> </h6>
							<p> <?php echo $post->post_content; ?> </p>
						</div>
					<?php
					}
					?>
				</div>
				<?php if (get_current_user_id() == $user->ID) : ?>
					<div class="col-md-4">
						<div class="card card-body bg-primary text-white">
							<p>Add your latest offers on our website</p>
							<button class="btn btn-light ml-auto" name="submit" type="submit">
								<a href="<?php echo get_site_url() . '/add-new-offer/' ?>"><small class="font-weight-bold">Add New Offer</small></a>
							</button>
						</div>
					</div>
				<?php endif ?>

			</div>
		</div>

		<?php if (get_current_user_id() == $user->ID) : ?>
			<div class="tab-pane fade show" id="pills-update" role="tabpanel">
				<form method="post">
					<div class="row">
						<div class="col-md-8">
							<div class="">
								<div class="form-group">
									<label for="first_name">Company Name</label>
									<input type="text" class="form-control my-2" value="<?php echo $user->first_name ?>" placeholder="Enter new Company Name" name="first_name" />
								</div>
								<div class="form-group">
									<label for="user_email">Email Address</label>
									<input type="text" class="form-control my-2" value="<?php echo $user->user_email ?>" placeholder="Enter new email address" name="user_email" />
								</div>
								<div>
									<label for="mobile_number">Mobile Number</label>
									<input type="text" class="form-control my-2" value="<?php echo $userMeta['mobile_number'][0] ?>" placeholder="Enter new mobile number" name="mobile_number" />
								</div>
								<div>
									<label for="serviceOffered">Description and Service Offered</label>
									<textarea class="form-control my-2" placeholder="Description and Services Offered" name="serviceOffered"><?php print($userMeta['serviceOffered'][0]) ?></textarea>
								</div>
								<div>
									<label for="address">Address</label>
									<textarea type="text" class="form-control my-2" placeholder="New Address" name="address"><?php print($userMeta['address'][0]) ?></textarea>
								</div>
								<!-- <input type="file" class="form-control my-2" placeholder="Update Avatar" name="avatar" accept="image/*" /> -->
							</div>

						</div>
						<div class="col-md-4 text-right">
							<div class="card card-body bg-primary text-white">
								<p>Please fill details and click on update</p>
								<button class="btn btn-light ml-auto" name="submit" type="submit">UPDATE</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		<?php endif ?>
	</div>
</div>