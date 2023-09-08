<?php

namespace Nrd\App\Hooks\Handlers;

class DeactivationHandler {

	/**
	 * Callback function to perform actions on plugin deactivation.
	 */
	public static function deactivate() {
		// Delete the plugin version option.
		delete_option( 'basic_plugin_version' );

		// Delete any transient data related to the plugin.
		delete_transient( 'basic_plugin_data' );

		// Delete the option storing the next API call time.
		delete_option( 'basic_plugin_next_api_call_time' );

		// Delete the option storing global settings.
		delete_option( 'basic-plugin-global-settings' );
	}
}
