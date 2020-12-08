<?php # Template Name: Add New Form
get_header();
?>
<div class="wrap">
    <?php
    if (isset($_POST['new_post']) == '1') {
        $post_title = $_POST['post_title'];
        $post_content = $_POST['post_content'];

        $new_post = array(
            'ID' => '',
            'post_author' => $user->ID,
            'post_content' => $post_content,
            'post_title' => $post_title,
            'post_type' => 'offer',
            'post_status' => 'publish'
        );

        $post_id = wp_insert_post($new_post);
        $post = get_post($post_id);
        wp_redirect($post->guid);
    }
    ?>
    <div class="container py-5">
        <h5 class="font-weight-bold text-center">Add New Offer</h5>
        <form method="post" action="" class="mx-auto" style="max-width: 500px;">
            <div class="mt-4">
                <label for="">Offer Title</label>
                <input class="form-control" type="text" name="post_title" size="45" id="input-title" />
            </div>
            <div class="mt-4">
                <label for="">Offer Description</label>
                <textarea class="form-control" rows="5" name="post_content" cols="66" id="text-desc"></textarea>
            </div>
            <input class="form-control" type="hidden" name="new_post" value="1" />
            <input class="form-control btn btn-success mt-4" type="submit" name="submit" value="Post" />
        </form>
    </div>
</div>