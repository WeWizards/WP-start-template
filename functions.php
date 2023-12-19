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

add_action('acf/init','bi_init_global_acf_constants');
function bi_init_global_acf_constants() {
    define( 'GLOBAL_PHONE',              get_field( 'global_phone', 'options' ) );
    define( 'GLOBAL_ADDRESS',            get_field( 'global_address', 'options' ) );
    define( 'GLOBAL_EMAIL',              get_field( 'global_email', 'options' ) );
    define( 'GLOBAL_SOCIALS',            get_field( 'global_socials', 'options' ) );
	define( 'GOOGLE_CAPTCHA_KEY',        get_field( 'google_captcha_key', 'options') );
	define( 'GOOGLE_CAPTCHA_SECRET',     get_field( 'google_captcha_secret', 'options') );
}

require_once THEME_DIR . '/includes/load.php';
require_once THEME_DIR . '/blocks/load.php';
