<?php

namespace Nrd\App\Hooks\Handlers;

class ActivationHandler {

	/**
	 * This method called on plugin activation
	 * to create an option named 'basic_plugin_version'.
	 */
	public static function activate() {
		$version = get_option( 'basic_plugin_version' );
		if ( ! $version ) {
			update_option( 'basic_plugin_version', NRD_VERSION );
		}
	}
}
