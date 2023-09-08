<?php

namespace Nrd\App;

class Das_App {

	/**
	 * Plugin instance.
	 *
	 * @var Das_App
	 */
	protected static $instance = null;

	public function __construct() {

		/*
		 * If the current page is the plugin's admin page and the user is an admin,
		 * enqueue scripts and styles using the 'load_assets' method.
		 */
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'basic-plugin-admin' && is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ), 1 );
		}
	}

	/**
	 * Get the main instance of the class (singleton pattern).
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Load additional files and perform actions when the class is loaded.
	 */
	public function load() {
		require_once BASIC_PLUGIN_BASE_PATH . 'app/Hooks/actions.php';
		require_once BASIC_PLUGIN_BASE_PATH . 'app/Hooks/filters.php';

		// Call a function to get global settings.
		basic_plugin_get_global_settings();
	}

	/**
	 * Enqueue CSS and JavaScript assets.
	 */
	public function load_assets() {
		// Enqueue Bootstrap CSS.
		wp_enqueue_style( 'basic_plugin_load_bootstrap', basic_plugin_assets_url( 'css/app.css' ), array(), get_option( 'basic_plugin_version' ) );

		// Enqueue Bootstrap JavaScript.
		wp_enqueue_script(
			'basic_plugin_load_bootstrap',
			basic_plugin_assets_url( 'js/bootstrap.js' ),
			array( 'jquery', 'moment' ),
			get_option( 'basic_plugin_version' )
		);

		// Localize the Bootstrap script with admin variables.
		wp_localize_script( 'basic_plugin_load_bootstrap', 'nrd_app_vars', $this->get_admin_vars() );
	}

	/**
	 * Get admin-related variables for script localization.
	 */
	public function get_admin_vars() {
		return array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'slug'     => BASIC_PLUGIN,
			'rest'     => array(
				'base_url'  => esc_url_raw( rest_url() ),
				'url'       => rest_url( BASIC_PLUGIN . '/v2' ),
				'nonce'     => wp_create_nonce( 'wp_rest' ),
				'namespace' => BASIC_PLUGIN,
				'version'   => 'v2',
			),
			'trans'    => basic_plugin_translations(),
		);
	}
}
