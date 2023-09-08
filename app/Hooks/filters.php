<?php

// Import the required namespace
use Nrd\App\Hooks\Handlers\ExternalHandler;

// Check if the constant WPMS_PLUGIN_FILE is defined
if ( defined( 'WPMS_PLUGIN_FILE' ) ) {
	// If the constant is defined, add a filter hook
	add_filter( 'wp_mail_smtp_admin_get_pages', array( ExternalHandler::class, 'addNewTab' ), 10, 1 );
}
