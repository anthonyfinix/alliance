<?php

wp_enqueue_style('style', get_stylesheet_uri());


function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

register_nav_menus(
    array(
        'primary-menu' => __('Primary Menu'),
    )
);

function handle_add_more_company(){
    
}

add_action( 'wp_ajax_load_more_company', 'handle_add_more_company' );
