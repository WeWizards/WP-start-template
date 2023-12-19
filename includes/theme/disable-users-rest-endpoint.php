<?php

add_filter( 'rest_endpoints', 'mytheme_disable_users_rest_endpoint' );
/**
 * Disable REST API user endpoints.
 *
 * @param array $endpoints The original endpoints.
 * @return array The updated endpoints.
 */
function mytheme_disable_users_rest_endpoint( $endpoints ) {
	if ( ! ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) ) {
		if ( isset( $endpoints['/wp/v2/users'] ) ) {
			unset( $endpoints['/wp/v2/users'] );
		}
		if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
			unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
	}

	return $endpoints;
}

