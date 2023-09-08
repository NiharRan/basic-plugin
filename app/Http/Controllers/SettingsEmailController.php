<?php

namespace Nrd\App\Http\Controllers;

use Nrd\App\Http\Controller;

class SettingsEmailController extends Controller {

	/**
	 * Store a new email in global settings.
	 */
	public function store() {
		$errors = $this->request->validate(
			$this->request->all(),
			array(
				'email' => 'required|email',
			),
			array(
				'email.required' => __( 'Email is required', 'basic-plugin' ),
				'email.email'    => __( 'This field is not a valid email', 'basic-plugin' ),
			)
		);

		if ( count( $errors ) > 0 ) {
			return $this->response( $errors, 403 );
		}

		$email = $this->request->get( 'email' );

		// Sanitize the email address.
		$email = sanitize_email( $email );

		// Get global settings.
		$global_settings = basic_plugin_get_global_settings();

		if ( in_array( $email, $global_settings['emails'] ) ) {
			$message = __( 'Email already exists', 'basic-plugin' );
		}

		if ( count( $global_settings['emails'] ) === 5 ) {
			$message = __( 'Cannot add another email. Limit reached.', 'basic-plugin' );
		}

		if ( ! empty( $message ) ) {
			return $this->error( $message );
		}

		// Add the new email and update global settings.
		$global_settings['emails'][] = $email;
		basic_plugin_set_global_settings( $global_settings );

		// Trigger an action for new email added.
		do_action( 'basic_plugin/new_email_added_to_global_settings', $global_settings, $email );

		return $this->response(
			array(
				'message' => __( 'Email added successfully!', 'basic-plugin' ),
				'data'    => $global_settings,
			)
		);
	}

	/**
	 * Remove an email from global settings.
	 */
	public function update() {
		$errors = $this->request->validate(
			$this->request->all(),
			array(
				'key' => 'required',
			),
			array(
				'key.required' => __( 'Key is required', 'basic-plugin' ),
			)
		);
		if ( count( $errors ) > 0 ) {
			return $this->response( $errors, 403 );
		}
		$key = $this->request->get( 'key' );
		// Convert the key to an integer.
		$key = intval( $key );

		// Get global settings.
		$global_settings = basic_plugin_get_global_settings();

		if ( count( $global_settings['emails'] ) === 1 ) {
			$message = __( 'Only one email exists. Cannot delete.', 'basic-plugin' );
		}

		if ( ! empty( $message ) ) {
			return $this->error( $message );
		}

		$emails        = $global_settings['emails'];
		$deleted_email = $emails[ $key ];
		unset( $emails[ $key ] );

		// Re-index the array keys.
		$global_settings['emails'] = array_values( $emails );
		basic_plugin_set_global_settings( $global_settings );

		// Trigger an action for email removed.
		do_action( 'basic_plugin/email_removed_from_global_settings', $global_settings, $deleted_email );

		return $this->response(
			array(
				'message' => __( 'Email removed successfully!', 'basic-plugin' ),
				'data'    => $global_settings,
			)
		);
	}
}
