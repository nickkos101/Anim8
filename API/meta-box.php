<?php

defined( 'ABSPATH' ) || exit;
define( 'API_VER', '4.2' );
if ( ! defined( 'API_URL' ) )
	define( 'API_URL', plugin_dir_url( __FILE__ ) );
define( 'API_JS_URL', trailingslashit( API_URL . 'js' ) );
define( 'API_CSS_URL', trailingslashit( API_URL . 'css' ) );

if ( ! defined( 'API_DIR' ) )
	define( 'API_DIR', plugin_dir_path( __FILE__ ) );
define( 'API_INC_DIR', trailingslashit( API_DIR . 'inc' ) );
define( 'API_FIELDS_DIR', trailingslashit( API_INC_DIR . 'fields' ) );
define( 'API_CLASSES_DIR', trailingslashit( API_INC_DIR . 'classes' ) );

require_once API_INC_DIR . 'helpers.php';

if ( is_admin() )
{
	require_once API_INC_DIR . 'common.php';

	// Field classes
	foreach ( glob( API_FIELDS_DIR . '*.php' ) as $file )
	{
		require_once $file;
	}

	// Main file
	require_once API_CLASSES_DIR . 'meta-box.php';
}