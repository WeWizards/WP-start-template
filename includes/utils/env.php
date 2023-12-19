<?php
/**
 * Checks whether current environment is considered for developing.
 * By default, returns false.
 * To enable development mode, set `WP_ENV` global variable to `'dev'` or `'development'` in your wp-config.php file:
 * ```php
 * define( 'WP_ENV', 'dev' );
 * ```
 *
 * @return bool
 */
function is_development(): bool {
	return defined( 'WP_ENV' ) && ( WP_ENV === 'dev' || WP_ENV === 'development' );
}

function is_production(): bool {
	return defined( 'WP_ENV' ) &&  ( WP_ENV === 'prod' || WP_ENV === 'production' );
}
