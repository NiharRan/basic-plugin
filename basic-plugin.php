<?php

/**
 * Plugin Name: Basic Plugin
 * Plugin URI: https://github.com/NiharRan/test-plugin/
 * Description: This is a test plugin developed by Nihar Ranjan Das
 * Version: 0.0.1
 * Author: Nihar Ranjan Das
 * Author URI: https://nihardaily.com/
 * Text Domain: basic-plugin
 * Domain Path:  /languages
 */

use Nrd\App\Das_App;
use Nrd\App\Hooks\Handlers\ActivationHandler;
use Nrd\App\Hooks\Handlers\DeactivationHandler;

defined( 'ABSPATH' ) || exit;

// Define the plugin constant BASIC_PLUGIN if not already defined.
if ( ! defined( 'BASIC_PLUGIN' ) ) {
	define( 'BASIC_PLUGIN', 'basic-plugin' );
}

// Define the plugin version.
define( 'NRD_VERSION', '0.0.1' );

// Define base URL and path constants for the plugin.
define( 'BASIC_PLUGIN_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'BASIC_PLUGIN_BASE_PATH', plugin_dir_path( __FILE__ ) );

// Require the autoloader for loading classes.
require_once 'vendor/autoload.php';

/**
 * Load the text domain for translation.
 */
function basic_plugin_load_text_domain() {
	load_plugin_textdomain( 'basic-plugin', false, basename( __DIR__ ) . '/languages' );
}

// Hook the text domain loading to the plugins_loaded action.
add_action( 'plugins_loaded', 'basic_plugin_load_text_domain' );

/**
 * Function to load the main plugin functionality.
 */
function load_basic_plugin() {
	// Register activation hook to handle plugin activation.
	register_activation_hook( __FILE__, array( ActivationHandler::class, 'activate' ) );

	// Register deactivation hook to handle plugin deactivation.
	register_deactivation_hook( __FILE__, array( DeactivationHandler::class, 'deactivate' ) );

	// Hook to initialize REST API routes.
	add_action(
		'rest_api_init',
		function () {
			require_once BASIC_PLUGIN_BASE_PATH . 'app/routes/api.php';
		}
	);

	// Load plugin functionality in the admin panel.
	if ( is_admin() ) {
		$app = Das_App::instance();
		$app->load();
	}
}

// Hook the main plugin functionality loading to the plugins_loaded action.
add_action( 'plugins_loaded', 'load_basic_plugin' );
