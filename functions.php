<?php

wp_enqueue_style('style', get_stylesheet_uri());
wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/bootstrap.min.css');
wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/bootstrap.min.js');
wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.css');
wp_enqueue_style('owl-carousel-default', get_template_directory_uri() . '/assets/owlCarousel/owl.theme.default.min.css');
wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.js', array('jquery'));
wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap', 'owl-carousel'));


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
add_action('wp_footer', 'front_page_search');
function front_page_search()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            let searchWrapper = document.querySelector('.search-wrapper');
            let searchButton = searchWrapper.querySelector('.search-button');
            let parentNav = searchWrapper.parentNode.querySelectorAll('.nav-item');
            let suggestionWrapper = searchWrapper.querySelector('.search-suggestion-wrapper');
            let closeButton = document.createElement('span');
            closeButton.setAttribute('class', 'material-icons ms-2 search-close-button');
            closeButton.onclick = function() {
                searchWrapper.removeChild(this);
                searchWrapper.appendChild(searchButton);
                parentNav.forEach(navItem => {
                    navItem.classList.remove('d-none');
                    navItem.classList.add('d-block');
                });
                searchWrapper.querySelector('.search-textbox').value = '';
                searchWrapper.querySelector('.search-textbox').style.display = 'none';
                suggestionWrapper.innerHTML = '';
                document.querySelector('#hero-section > .container').style.filter = "blur(0px)";
                searchWrapper.parentNode.classList.add('ms-auto')
                searchWrapper.parentNode.classList.remove('w-100')
                searchWrapper.classList.remove('flex-grow-1')
            }
            closeButton.innerHTML = 'close';
            searchButton.addEventListener('click', function() {
                document.querySelector('#hero-section > .container').style.filter = "blur(4px)";
                parentNav.forEach(navItem => {
                    navItem.classList.add('d-none');
                });
                searchWrapper.parentNode.classList.remove('ms-auto');
                searchWrapper.parentNode.classList.add('w-100');
                searchWrapper.classList.add('flex-grow-1');
                searchWrapper.querySelector('.search-textbox').style.display = 'block';
                searchWrapper.querySelector('.search-textbox').addEventListener('keyup', function() {
                    if (this.value != '') {
                        let searchingIcon = document.createElement('span');
                        searchingIcon.setAttribute('class', 'material-icons text-dark');
                        searchingIcon.setAttribute('style', 'position:absolute;right:40px;opacity:.2');
                        searchingIcon.innerHTML = 'hourglass_full';
                        searchWrapper.appendChild(searchingIcon);
                        let data = {
                            'searchString': this.value,
                            'action': 'get_searched_company'
                        }
                        jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, (response) => {
                            searchWrapper.removeChild(searchingIcon);
                            suggestionWrapper.innerHTML = '';
                            let users = JSON.parse(response);
                            if (!!searchWrapper.querySelector('.search-close-button')) {
                                if (Object.keys(users).length > 0 && (searchWrapper.querySelector('.search-textbox').value.length > 0)) {
                                    let suggestions = Object.values(users).map((user) => {
                                        let suggestion = document.createElement('a');
                                        suggestion.setAttribute('href', '<?php echo get_site_url() ?>/user/' + user.user_login)
                                        suggestion.setAttribute('class', 'text-end bg-white rounded text-dark p-2 d-block mt-2');
                                        suggestion.style.textDecoration = 'none';
                                        suggestion.innerHTML = user.first_name;
                                        suggestionWrapper.innerHTML = '';
                                        return suggestion;
                                    })
                                    suggestions.forEach(suggestion => {
                                        suggestionWrapper.appendChild(suggestion)
                                    })
                                }
                                console.log(users);
                            };
                        });
                    } else {
                        suggestionWrapper.innerHTML = ''
                    }
                });
                searchWrapper.removeChild(searchButton);
                searchWrapper.appendChild(closeButton);
            });
        })
    </script>
<?php
}

add_action('wp_ajax_get_searched_company', 'get_searched_company');
add_action('wp_ajax_nopriv_get_searched_company', 'get_searched_company');

function get_searched_company()
{
    global $wpdb; // this is how you get access to the database
    $searchString = $_POST['searchString'];
    $query = new WP_User_Query(array(
        'role' => 'company',
        'meta_query' => array(
            array(
                'key' => 'first_name',
                'value' => $searchString,
                'compare' => 'LIKE'
            )
        )
    ));
    $users = $query->get_results();
    $response = array();
    foreach ($users as $key => $user) {
        // check approved or not
        if (get_user_meta($user->data->ID, 'account_status')[0] != 'approved') {
            continue;
        }
        $response[$user->data->ID] = $user->data;
        // add first name
        $response[$user->data->ID]->first_name = get_user_meta($user->data->ID, 'first_name')[0];
        // $response[$user->data->ID]->offers = get_posts(array(
        //     'numberposts'      => 3,
        //     'post_type'        => 'offer'
        // ));
    }
    print_r(json_encode($response));
    wp_die();
}

add_action('wp_footer', 'my_action_javascript'); // Write our JS below here

function my_action_javascript()
{ ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            if (!!document.querySelector('#load_more_company_btn')) {
                let loadMoreButton = document.querySelector('#load_more_company_btn');
                loadMoreButton.addEventListener('click', function() {
                    this.setAttribute('disabled', true);
                    let companyWrapper = document.querySelector('.companies-ajax-wrapper');
                    let currentPageNumber = parseInt(companyWrapper.dataset.page_number);
                    var data = {
                        'action': 'get_next_companies',
                        'currentPage': currentPageNumber,
                        'start_with': companyWrapper.dataset.start_with
                    };
                    jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, (response) => {
                        companyWrapper.dataset.page_number = currentPageNumber + 1;
                        let users = JSON.parse(response);
                        if (Object.keys(users).length > 0) {
                            Object.keys(users).map(userID => {
                                companyWrapper.appendChild(createCompanyHomeCard(users[userID], userID));
                            })
                            this.removeAttribute('disabled');
                            this.innerHTML = 'Load more';
                        } else {
                            let p = document.createElement('p')
                            p.innerHTML = 'hurrey you made it to the end';
                            this.parentElement.appendChild(p);
                            this.parentElement.removeChild(this);
                        }
                    });
                })
            }
            if (!!document.querySelector('#load_more_companies_archieve_btn')) {
                let loadMoreButton = document.querySelector('#load_more_companies_archieve_btn');
                loadMoreButton.addEventListener('click', function() {
                    this.setAttribute('disabled', true);
                    this.innerHTML = 'Please Wait';
                    let companyWrapper = document.querySelector('.companies-ajax-wrapper');
                    let currentPageNumber = parseInt(companyWrapper.dataset.page_number);
                    let serviceType = companyWrapper.dataset.service_type;
                    var data = {
                        'action': 'get_next_companies',
                        'currentPage': currentPageNumber,
                        'start_with': companyWrapper.dataset.start_with,
                        'service_type': serviceType
                    };
                    jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, (response) => {
                        companyWrapper.dataset.page_number = currentPageNumber + 1;
                        let users = JSON.parse(response);
                        if (Object.keys(users).length > 0) {
                            Object.keys(users).map(userID => {
                                companyWrapper.appendChild(createCompanyArchiveCard(users[userID], userID));
                            })
                            this.removeAttribute('disabled');
                            this.innerHTML = 'Load more';
                        } else {
                            let p = document.createElement('p')
                            p.innerHTML = 'hurrey you made it to the end';
                            this.parentElement.appendChild(p);
                            this.parentElement.removeChild(this);
                        }
                    });
                })
            }

            function createCompanyHomeCard(user, userID) {
                // create a
                let a = document.createElement('a');
                a.setAttribute('class', 'col-md-3 my-1 company-card');
                a.setAttribute('href', '<?php echo get_site_url() ?>/user/' + user.profileUrlSlug);

                // create card
                let card = document.createElement('div');
                card.setAttribute('class', 'card card-body text-center m-2 align-items-center');
                card.setAttribute('style', 'height: 100%;');
                // create image
                let image = document.createElement('img');
                if (!!user.userProfileName) {
                    image.setAttribute('src', '<?php echo get_site_url() ?>/wp-content/uploads/ultimatemember/' + userID + '/' + user.userProfileName);
                } else {
                    image.setAttribute('src', '<?php echo get_site_url() ?>/wp-content/uploads//2020/12/default_logo.png');
                }
                image.setAttribute('class', 'img-fluid mx-auto rounded-circle');
                image.setAttribute('width', '70px');
                // create div
                let div = document.createElement('div');
                div.setAttribute('class', 'my-3')
                div.innerHTML = '<h6>' + user.first_name + '</h6><small>' + user.user_email + '</small>';
                // create button
                let button = document.createElement('button');
                button.setAttribute('class', 'btn btn-light btn-sm company-view-details-btn mt-auto');
                button.innerHTML = 'View Details';
                // append in order
                card.appendChild(image);
                card.appendChild(div);
                card.appendChild(button);
                a.appendChild(card);
                return a;
            }

            function createCompanyArchiveCard(user, userID) {
                let card = document.createElement('div');
                card.setAttribute('class', 'col-md-6 mb-4');
                // create a
                let a = document.createElement('a');
                a.setAttribute('class', 'company-list-card card flex-row justify-content-between align-items-center card-body mb-3');
                a.setAttribute('href', '<?php echo get_site_url() ?>/user/' + user.profileUrlSlug);
                // create image
                let image = document.createElement('img');
                if (!!user.userProfileName) {
                    image.setAttribute('src', '<?php echo get_site_url() ?>/wp-content/uploads/ultimatemember/' + userID + '/' + user.userProfileName);
                } else {
                    image.setAttribute('src', '<?php echo get_site_url() ?>/wp-content/uploads//2020/12/default_logo.png');
                }
                image.setAttribute('width', '40px');
                // create div
                let div = document.createElement('div');
                div.setAttribute('class', 'my-3')
                div.innerHTML = '<h6>' + user.first_name + '</h6><small>' + user.user_email + '</small>';
                // append in order
                a.appendChild(div);
                a.appendChild(image);
                card.appendChild(a)
                return card
            }
        });
    </script>
<?php }

add_action('wp_ajax_get_next_companies', 'get_next_company');
add_action('wp_ajax_nopriv_get_next_companies', 'get_next_company');

function get_next_company()
{
    global $wpdb; // this is how you get access to the database

    $currentPage = intval($_POST['currentPage']);
    if (isset($_POST['number']) && !empty($_POST['number'])) {
        $number = intval($_POST['number']);
    } else {
        $number = 8;
    }
    $start_with = '*';
    if (isset($_POST['start_with'])) {
        $start_with = $_POST['start_with'];
    }
    $serviceType = '*';
    if (isset($_POST['service_type'])) {
        $serviceType = $_POST['service_type'];
    }
    $user_query = new WP_User_Query(array(
        'role' => 'company',
        'number' => $number,
        'paged' => $currentPage + 1,
        'orderby' => 'registered',
        "order" => 'DESC'
    ));
    $response = array();
    foreach ($user_query->get_results() as $user) {
        if ($start_with != '*' && $user->first_name[0] != $start_with) {
            continue;
        }
        if ($serviceType != '*') {
            if (!isset(get_user_meta($user->ID, 'servicetype')[0]) || (get_user_meta($user->ID, 'servicetype')[0] != $serviceType)) {
                continue;
            }
        }
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
