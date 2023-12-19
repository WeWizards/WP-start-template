<?php

add_action( 'init', 'bi_block_registration' );
function bi_block_registration() {
    foreach(glob(THEME_DIR . '/blocks/*', GLOB_ONLYDIR) as $dir){
        register_block_type( $dir );

        $dir_exploded = explode( '/', $dir );
	    $block = $dir_exploded[ count( $dir_exploded ) - 1 ];

        //Подключение файла functions.php для каждого блока
		if ( file_exists( THEME_DIR . '/blocks/' . $block . '/functions.php' ) ) {
            include_once THEME_DIR . '/blocks/' . $block . '/functions.php';
        }
    }
}
