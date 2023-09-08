<?php

namespace Nrd\App\Http\Controllers;

use Nrd\App\Http\Controller;

class SettingsController extends Controller {

	/**
	 * Retrieve the global settings.
	 */
	public function index() {
		// Get global settings.
		$global_settings = basic_plugin_get_global_settings();

		return $this->response( $global_settings );
	}

	/**
	 * Update the global settings.
	 */
	public function update() {
		$errors = $this->request->validate(
			$this->request->all(),
			array(
				'per_page'            => 'required',
				'date_human_readable' => 'required',
				'emails'              => 'required|array',
			),
			array(
				'per_page.required'            => __( 'Per page value is required', 'basic-plugin' ),
				'date_human_readable.required' => __( 'Date format value is required', 'basic-plugin' ),
				'email.required'               => __( 'Email value is required', 'basic-plugin' ),
				'email.array'                  => __( 'This field is not a array', 'basic-plugin' ),
			)
		);

		if ( count( $errors ) > 0 ) {
			return $this->response( $errors, 403 );
		}

		// Get values from POST data.
		$per_page            = intval( $this->request->get( 'per_page' ) );
		$date_human_readable = sanitize_text_field( $this->request->get( 'date_human_readable' ) );
		$emails              = $this->request->get( 'emails' );
		$message             = '';

		// Validate per_page value.
		if ( $per_page < 1 || $per_page > 5 ) {
			$message = __( 'Per page value must be between 1 and 5', 'basic-plugin' );
		}

		// Check for validation errors.
		if ( ! empty( $message ) ) {
			return $this->error( $message );
		}

		// Sanitize and validate email addresses.
		foreach ( $emails as $key => $email ) {
			if ( ! is_email( $email ) ) {
				$message = __( 'Invalid email format', 'basic-plugin' );
				break;
			}
			$emails[ $key ] = sanitize_email( $email );
		}

		// Check for validation errors after email validation.
		if ( ! empty( $message ) ) {
			return $this->error( $message );
		}

		// Prepare updated global settings data.
		$global_settings = array(
			'per_page'            => $per_page,
			'date_human_readable' => $date_human_readable,
			'emails'              => $emails,
		);

		// Update global settings.
		basic_plugin_set_global_settings( $global_settings );

		// Trigger action for global settings update.
		do_action( 'basic_plugin/global_settings_update', $global_settings );

		return $this->response(
			array(
				'message' => __( 'Global settings data updated successfully', 'basic-plugin' ),
				'data'    => $global_settings,
			)
		);
	}
}
