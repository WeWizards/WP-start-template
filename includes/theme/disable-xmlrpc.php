<?php

/* This disables XML-RPC API in WordPress 3.5+, which is enabled by default. */
add_filter( 'xmlrpc_enabled', '__return_false' );

