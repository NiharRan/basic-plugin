<?php
namespace Nrd\App\Hooks\Handlers;

class MenuHandler {

	public static function init() {
		// Add the main menu page.
		add_menu_page(
			__( 'Basic Plugin', 'basic-plugin' ),
			__( 'Basic Plugin', 'basic-plugin' ),
			'manage_options',
			'basic-plugin-admin',
			array( new self(), 'render' ),
			2
		);

		// Add graph page.
		add_submenu_page(
			'basic-plugin-admin',
			__( 'Graph', 'basic-plugin' ),
			__( 'Graph', 'basic-plugin' ),
			'manage_options',
			'basic-plugin-admin#/graph',
			array( new self(), 'render' )
		);

		// Add settings page
		add_submenu_page(
			'basic-plugin-admin',
			__( 'Settings', 'basic-plugin' ),
			__( 'Settings', 'basic-plugin' ),
			'manage_options',
			'basic-plugin-admin#/settings',
			array( new self(), 'render' )
		);
	}

	/**
	 * Render the plugin's admin page.
	 */
	public static function render() {
		// Enqueue the app's JavaScript.
		wp_enqueue_script(
			'basic_plugin_app_start',
			basic_plugin_assets_url( 'js/app.js' ),
			array( 'basic_plugin_load_bootstrap' ),
			get_option( 'basic_plugin_version' )
		);

		// Get the base URL for the plugin's menu.
		$base_url = basic_plugin_menu_url_base();

		// Get menu items for rendering.
		$menu_items = self::get_menu_items( $base_url );

		// Start output buffering and extract data for the view.
		ob_start() && extract(
			array(
				'base_url'   => $base_url,
				'menu_items' => $menu_items,
			),
			EXTR_SKIP
		);

		// Include the layout view.
		include basic_plugin_views_path( 'layout.php' );

		// Clean and output the buffered content.
		echo ltrim( ob_get_clean() );
	}

	/**
	 * Get menu items for rendering in the admin menu.
	 */
	public static function get_menu_items( $base_url = false ) {
		if ( ! $base_url ) {
			$base_url = basic_plugin_menu_url_base();
		}

		// Define menu items with keys, labels, and links.
		$menu_items = array(
			array(
				'key'   => 'table',
				'label' => __( 'Table', 'basic-plugin' ),
				'link'  => $base_url,
			),
			array(
				'key'   => 'graph',
				'label' => __( 'Graph', 'basic-plugin' ),
				'link'  => $base_url . 'graph',
			),
			array(
				'key'   => 'settings',
				'label' => __( 'Settings', 'basic-plugin' ),
				'link'  => $base_url . 'settings',
			),
		);

		/**
		 * Filter plugin's menu items.
		 *
		 * @param array $menuItems
		 */
		return apply_filters( 'basic_plugin/menu_items', $menu_items );
	}
}
