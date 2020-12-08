<?php # Template Name: Company Archive
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

<?php get_footer() ?>