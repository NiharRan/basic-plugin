<?php

namespace Nrd\App\Hooks\Handlers;

use Nrd\App\Integrations\WpMailSmtp;

class ExternalHandler {

	// This method adds a new tab to the existing admin pages
	public static function addNewTab( $pages = array() ) {
		// Create a new instance of the 'WpMailSmtp' class
		$pages['basic-plugin-admin'] = new WpMailSmtp();

		// Return the modified array of admin pages, now including the new tab
		return $pages;
	}
}
