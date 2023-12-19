<?php

define( 'THEME_URL',        get_template_directory_uri() );
define( 'THEME_DIR',        get_template_directory() );
define( 'SITE_URL',         home_url('/') );

$current_user_role = null;
$current_user_id = null;
if ( is_user_logged_in() ) {
	$current_user       = wp_get_current_user();
	$current_user_role  = ($current_user->roles)[0];
	$current_user_id    = $current_user->ID;
}
define( 'CURRENT_USER_ID',      $current_user_id );
define( 'CURRENT_USER_ROLE',    $current_user_role );

if ( defined('HIDE_ADMIN_BAR') && HIDE_ADMIN_BAR ) {
	add_filter('show_admin_bar', '__return_false');
}

add_action('acf/init','wwzrds_init_global_acf_constants');
function wwzrds_init_global_acf_constants() {
    define( 'GLOBAL_EXAMPLE_FIELD_VALUE', get_field( 'global_example_field', 'options' ) );
}

require_once THEME_DIR . '/includes/load.php';
require_once THEME_DIR . '/blocks/load.php';
