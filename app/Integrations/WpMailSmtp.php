<?php

namespace Nrd\App\Integrations;

class WpMailSmtp {

	// Returns the label for the integration
	public function get_label() {
		// Retrieves a translated label using the '__()' function
		return __( 'Basic Plugin', 'basic-plugin' );
	}

	// Returns the link for the integration
	public function get_link() {
		// Calls the 'basic_plugin_menu_url_base()' function to get the link
		return basic_plugin_menu_url_base();
	}
}
