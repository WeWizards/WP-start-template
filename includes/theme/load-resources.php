<?php

add_action('wp_enqueue_scripts', 'wwzrds_load_resources');
function wwzrds_load_resources() {
    $theme_styles_filemane =  '/_dist/css/style.min.css';
    $theme_styles_url = THEME_URL . $theme_styles_filemane;
    $theme_styles_path = THEME_DIR . $theme_styles_filemane;

    $theme_scripts_filename = '/_dist/js/app.min.js';
    $theme_scripts_url = THEME_URL . $theme_scripts_filename;
    $theme_scripts_path = THEME_DIR . $theme_scripts_filename;

    wp_enqueue_style(
        handle: 'wwzrds',
        src: $theme_styles_url,
        ver: filemtime($theme_styles_path)
    );

    wp_enqueue_script(
        handle: 'wwzrds',
        src: $theme_scripts_url,
	    deps: ['jquery'],
        ver: filemtime($theme_scripts_path),
        args: [
			'in_footer' => true,
	    ],
    );

    $backend_data = [
		/* trailing slash */
		'siteUrl'             => SITE_URL,
		/* no trailing slash */
		'themeUrl'            => THEME_URL,
		'ajaxUrl'             => admin_url( 'admin-ajax.php' ),
	];

    wp_localize_script('wwzrds','backendData', $backend_data );
}


/**
 * Enqueues tinyMCE styles
 */
add_action( 'after_setup_theme', 'wwzrds_add_styles_to_tinymce' );
function wwzrds_add_styles_to_tinymce() {
	add_theme_support( 'editor-styles' );
	add_editor_style( '_dist/css/style.min.css' );
	add_editor_style( '_dist/css/editor-style.min.css' );
}


/**
 * Enqueues block editor resources
 */
add_action( 'enqueue_block_editor_assets', 'wwzrds_editor_resources' );
function wwzrds_editor_resources() {
	wp_enqueue_script(
		handle: 'wwzrds',
		src: THEME_URL . '/_dist/js/app.min.js',
		ver: filemtime( THEME_DIR . '/_dist/js/app.min.js' ),
		args: [
			'in_footer' => true,
		],
	);

	wp_enqueue_script(
		'wwzrds-editor',
		THEME_URL . '/_dist/js/editor.min.js',
		ver: filemtime( THEME_DIR . '/_dist/js/editor.min.js' ),
		args: [
			'in_footer' => true,
		],
	);
}


/**
 * Register and enqueue a custom stylesheet and a script in the WordPress admin.
 */
add_action( 'admin_enqueue_scripts', 'wwzrds_enqueue_custom_admin_resources' );
function wwzrds_enqueue_custom_admin_resources() {
	wp_enqueue_style(
		handle: 'wwzrds-admin',
		src: THEME_URL . '/_dist/css/admin.min.css',
		ver: filemtime( THEME_DIR . '/_dist/css/admin.min.css' )
	);

	wp_enqueue_script(
		handle: 'wwzrds-admin',
		src: THEME_URL . '/_dist/js/admin.min.js',
		ver: filemtime( THEME_DIR . '/_dist/js/admin.min.js' ),
		args: [
			'in_footer' => true,
		],
	);
}
