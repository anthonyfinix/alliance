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

// load more company


add_action('wp_footer', 'my_action_javascript'); // Write our JS below here

function my_action_javascript()
{ ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            let loadMoreButton = document.querySelector('#load_more_company_btn');
            loadMoreButton.addEventListener('click', () => {
                loadMoreButton.setAttribute('disabled', true);
                loadMoreButton.innerHTML = 'Please Wait';
                let companyWrapper = document.querySelector('.companies-ajax-wrapper');
                let currentPageNumber = parseInt(companyWrapper.dataset.page_number);
                var data = {
                    'action': 'my_action',
                    'currentPage': currentPageNumber,
                };
                jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
                    companyWrapper.dataset.page_number = currentPageNumber + 1;
                    let users = JSON.parse(response);
                    if (Object.keys(users).length > 0) {
                        Object.keys(users).map(userID => {
                            // create a
                            let a = document.createElement('a');
                            a.setAttribute('class', 'col-md-3 my-1 company-card');
                            a.setAttribute('href', '<?php echo get_site_url() ?>/user/' + users[userID].profileUrlSlug);

                            // create card
                            let card = document.createElement('div');
                            card.setAttribute('class', 'card card-body text-center m-2 align-items-center');
                            card.setAttribute('style', 'height: 100%;');
                            // create image
                            let image = document.createElement('img');
                            if (!!users[userID].userProfileName) {
                                image.setAttribute('src', '<?php echo get_site_url() ?>/wp-content/uploads/ultimatemember/' + userID + '/' + users[userID].userProfileName);
                            } else {
                                image.setAttribute('src', '<?php echo get_site_url() ?>/wp-content/uploads//2020/12/default_logo.png');
                            }
                            image.setAttribute('class', 'img-fluid mx-auto rounded-circle');
                            image.setAttribute('width', '70px');
                            // create div
                            let div = document.createElement('div');
                            div.setAttribute('class', 'my-3')
                            div.innerHTML = '<h6>' + users[userID].first_name + '</h6><small>' + users[userID].user_email + '</small>';
                            // create button
                            let button = document.createElement('button');
                            button.setAttribute('class', 'btn btn-light btn-sm company-view-details-btn mt-auto');
                            button.innerHTML = 'View Details';
                            // append in order
                            card.appendChild(image);
                            card.appendChild(div);
                            card.appendChild(button);
                            a.appendChild(card);
                            companyWrapper.appendChild(a);
                        })
                        loadMoreButton.removeAttribute('disabled');
                        loadMoreButton.innerHTML = 'Load more';
                    }else{
                        let p = document.createElement('p')
                        p.innerHTML = 'hurrey you made it to the end';
                        loadMoreButton.parentElement.appendChild(p);
                        loadMoreButton.parentElement.removeChild(loadMoreButton);
                    }


                });
            })
        });
    </script>
<?php }


add_action('wp_ajax_my_action', 'my_action');

function my_action()
{
    global $wpdb; // this is how you get access to the database

    $currentPage = intval($_POST['currentPage']);
    $user_query = new WP_User_Query(array(
        'role' => 'company',
        'number' => 8,
        'paged' => $currentPage + 1,
        'orderby' => 'registered',
        "order" => 'DESC'
    ));
    $response = array();
    foreach ($user_query->get_results() as $user) {
        $response[$user->ID] = array(
            'profileUrlSlug' => get_user_meta($user->ID, 'um_user_profile_url_slug_user_login'),
            'userProfileName' => get_user_meta($user->ID, 'profile_photo')[0],
            'first_name' => $user->first_name,
            'user_email' => $user->user_email,
        );
    }
    print_r(json_encode($response));
    wp_die(); // this is required to terminate immediately and return a proper response
}
