<?php

if (isset($_POST['submit'])) {
	global $wpdb;
	$image_url = $_FILES['avatar'];
	$upload_dir = wp_upload_dir();
	$image_data = file_get_contents($image_url['tmp_name']);
	$filename = basename($image_url['name']);
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

	update_user_meta(get_current_user_id(), 'profile_photo', $image_url['name']);
	move_uploaded_file($image_url['tmp_name'], _wp_upload_dir()['basedir'] . '/ultimatemember/' . get_current_user_id() . '/' . $_FILES['avatar']['name']);
}

$user = get_user_by('id', um_profile_id());
$userMeta = get_user_meta(um_profile_id());
$posts = get_posts(array('author' =>  $user->ID, 'post_type' => 'offer',));

if (gettype($userMeta['profile_photo'][0]) == 'string') {
	$imageUrl = get_site_url() . '/wp-content/uploads/ultimatemember/' . $user->ID . '/' . $userMeta['profile_photo'][0];
} else {
	$imageUrl = 'http://localhost/wordpress/wp-content/uploads/2020/12/default_logo.png';
}

?>
<div class="container">
	<div class="card card-body flex-row my-4 align-items-center justify-content-between">
		<div>
			<h5> <span class="font-weight-bold"> Name</span> : <?php echo $user->display_name ?></h5>
			<h5> <span class="font-weight-bold"> Email</span> : <?php echo $user->user_email ?></h5>

		</div>
		<div class="mr-2 rounded-circle" style="
                width: 100px;
                height: 100px;
                background-image: url('<?php echo $imageUrl ?>');
                background-size:contain;
                background-repeat:no-repeat;
                background-position:center;
                ">
		</div>
	</div>
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-description" role="tab">Description</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-contactDetails" role="tab">Contact Details</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-offers" role="tab">Offers</a>
		</li>
		<?php if (get_current_user_id() == $user->ID) : ?>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-update" role="tab">Update Details</a>
			</li>
		<?php endif ?>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-description" role="tabpanel">
			<h5> <span class="font-weight-bold"> Description</span> : <?php echo $userMeta['description'][0] ?></h5>
		</div>
		<div class="tab-pane fade show" id="pills-contactDetails" role="tabpanel">
			<h5> <span class="font-weight-bold"> Email</span> : <?php echo $user->user_email ?></h5>
			<h5> <span class="font-weight-bold"> Address</span> : <?php echo $userMeta['address'][0] ?></h5>
			<h5> <span class="font-weight-bold"> Mobile Number</span> : <?php echo $userMeta['mobile-number'][0] ?></h5>
		</div>
		<div class="tab-pane fade" id="pills-offers" role="tabpanel">
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
		<div class="tab-pane fade show" id="pills-update" role="tabpanel">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<input type="file" accept="image/*" name="avatar" placeholder="Upload Avatar" class="form-control" />

				</div>
				<button class="btn btn-success" name="submit" type="submit">Submit</button>
			</form>
		</div>
		<?php endif ?>
	</div>
</div>