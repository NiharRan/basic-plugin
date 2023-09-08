<?php

use Nrd\App\Hooks\Handlers\MenuHandler;

/*
 * Add an action to the WordPress admin menu hook to initialize the menu handler.
 */
add_action( 'admin_menu', array( MenuHandler::class, 'init' ) );

/*
 * Action to renew the REST API nonce.
 */
add_action(
	'wp_ajax_basic_plugin/renew_rest_nonce',
	function () {
		// Check if the current user has administrative permissions.
		if ( ! is_admin() ) {
			wp_send_json(
				array(
					'error' => 'You do not have permission to do this',
				),
				403  // HTTP status code for "Forbidden" response.
			);
		}

		// Renew the REST API nonce and send the response.
		wp_send_json(
			array(
				'nonce' => wp_create_nonce( 'wp_rest' ),  // Generate a new nonce.
			),
			200  // HTTP status code for "OK" response.
		);
	}
);
