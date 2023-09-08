<?php

namespace Nrd\App\Http\Controllers;

use Nrd\App\Http\Controller;

class RecordsController extends Controller {

	/**
	 * Retrieve and process data for display in a table.
	 */
	public function index() {
		// Get the next scheduled API call time.
		$next_api_call_time = get_option( 'basic_plugin_next_api_call_time' );
		$current_time       = current_time( 'timestamp' );

		// Check if it's time for the next API call.
		if ( $next_api_call_time && $current_time < $next_api_call_time ) {
			// Retrieve data from transient and respond.
			$data = get_transient( 'basic_plugin_data' );
			return $this->response( basic_plugin_get_table_data( $data ) );
		}

		// Delete existing transient and options related to API call time.
		delete_transient( 'basic_plugin_data' );
		delete_option( 'basic_plugin_next_api_call_time' );

		// Perform an API call to fetch data.
		$response = wp_remote_get(
			'https://miusage.com/v1/challenge/2/static/',
			array(
				'timeout' => 30,
			)
		);

		// Retrieve and process the fetched data.
		$data = wp_remote_retrieve_body( $response );
		if ( ! empty( $data ) ) {
			$data               = json_decode( $data );
			$next_api_call_time = $current_time + ( 60 * 60 ); // Schedule next API call in an hour.
			// Store data in transient and update the next API call time.
			set_transient( 'basic_plugin_data', $data, 60 * 60 ); // Store data for an hour.
			update_option( 'basic_plugin_next_api_call_time', $next_api_call_time );
		}

		// Respond with processed data for display.
		return $this->response( basic_plugin_get_table_data( $data ) );
	}
}
