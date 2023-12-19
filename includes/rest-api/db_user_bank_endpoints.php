<?php

add_action( 'rest_api_init', 'db_user_bank_endpoints' );

/**
 * Get user's bank
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function db_user_bank_endpoints( $request ) {
    register_rest_route('wp/v2', 'users/bank', array(
        'methods'             => 'GET',
        'callback'            => 'db_rest_user_bank_handler',
        'permission_callback' => function() {
            return is_user_logged_in();
        },
    ));
}

function db_rest_user_bank_handler( $request = null ) {
    $user     = wp_get_current_user();
    $error    = new WP_Error();

    if ( empty( $user ) ) {
        $error->add( 400, __( 'Invalid user.', 'wp-rest-run' ), ['status' => 400] );
        return $error;
    }

    return new WP_REST_Response( db_calculate_user_store( $user->ID ), 123 );
}
