<?php

// Get global settings or initialize with defaults if not available.
if ( ! function_exists( 'basic_plugin_get_global_settings' ) ) {

	function basic_plugin_get_global_settings() {
		$global_settings = get_option( BASIC_PLUGIN . '-global-settings' );

		if ( ! $global_settings ) {
			// Get the current user's email.
			$current_user = wp_get_current_user();

			// Initialize global settings with default values.
			$global_settings = array(
				'per_page'            => 5,
				'date_human_readable' => 'human-format',
				'emails'              => array(
					$current_user->user_email,
				),
			);

			// Set the initial global settings.
			basic_plugin_set_global_settings( $global_settings );
		}

		return $global_settings;
	}
}

// Save global settings to the options.
if ( ! function_exists( 'basic_plugin_set_global_settings' ) ) {

	function basic_plugin_set_global_settings( $global_settings ) {
		update_option( BASIC_PLUGIN . '-global-settings', $global_settings );
	}
}

// Generate the URL for assets in the plugin.
if ( ! function_exists( 'basic_plugin_assets_url' ) ) {

	function basic_plugin_assets_url( $url ) {
		return BASIC_PLUGIN_BASE_URL . '/assets/' . $url;
	}
}

// Generate the path for views in the plugin.
if ( ! function_exists( 'basic_plugin_views_path' ) ) {

	function basic_plugin_views_path( $url ) {
		return BASIC_PLUGIN_BASE_PATH . '/views/' . $url;
	}
}

// Generate the base URL for the plugin menu.
if ( ! function_exists( 'basic_plugin_menu_url_base' ) ) {

	function basic_plugin_menu_url_base() {
		return apply_filters( 'basic_plugin/menu_url_base', admin_url( 'admin.php?page=basic-plugin-admin#/' ) );
	}
}

// Process and format table data based on global settings.
if ( ! function_exists( 'basic_plugin_get_table_data' ) ) {

	function basic_plugin_get_table_data( $data ) {
		// Get global settings.
		$global_settings = basic_plugin_get_global_settings(
		);

		// Apply filters to the data based on global settings.
		$data = apply_filters( 'basic_plugin/data_records', $data, $global_settings );

		// Format date values in the data.
		foreach ( $data->graph as &$item ) {
			$item->date = date( 'F jS, Y', $item->date );
		}

		// Get a subset of rows based on per_page setting.
		$table_rows = array_slice( $data->table->data->rows, 0, $global_settings['per_page'] );

		// Format date in human-readable format if specified.
		if ( $global_settings['date_human_readable'] == 'human-format' ) {
			foreach ( $table_rows as $row ) {
				$row->date = human_time_diff( $row->date );
			}
		}

		// Update table rows with the formatted subset.
		$data->table->data->rows = $table_rows;

		return $data;
	}
}

// Provide translations for various strings.
if ( ! function_exists( 'basic_plugin_translations' ) ) {

	function basic_plugin_translations() {
		return array(
			'Hello World'                     => __( 'Hello', 'basic-plugin' ),
			'Table'                           => __( 'Table', 'basic-plugin' ),
			'Add '                            => __( 'Add ', 'basic-plugin' ),
			'Save Settings'                   => __( 'Save Settings', 'basic-plugin' ),
			'Remove'                          => __( 'Remove', 'basic-plugin' ),
			'Graph'                           => __( 'Graph', 'basic-plugin' ),
			'Settings'                        => __( 'Settings', 'basic-plugin' ),
			'Top Pages'                       => __( 'Top Pages', 'basic-plugin' ),
			'ID'                              => __( 'ID', 'basic-plugin' ),
			'Url'                             => __( 'Url', 'basic-plugin' ),
			'Title'                           => __( 'Title', 'basic-plugin' ),
			'Pageviews'                       => __( 'Page views', 'basic-plugin' ),
			'Human readable format'           => __( 'Human readable format', 'basic-plugin' ),
			'Unix timestamp'                  => __( 'Unix timestamp', 'basic-plugin' ),
			'Date'                            => __( 'Date', 'basic-plugin' ),
			'Generated using API Graph Data.' => __( 'Generated using API Graph Data.', 'basic-plugin' ),
			'Date format'                     => __( 'Date format', 'basic-plugin' ),
			'Records per page'                => __( 'Records per page', 'basic-plugin' ),
			'Add new email'                   => __( 'Add new email', 'basic-plugin' ),
			'api_data_graph'                  => __( 'This graph is generated using api graph data and chartjs package', 'basic-plugin' ),
			'api_data_table'                  => __( 'Table data fetched from API and formatted according to global settings', 'basic-plugin' ),
			'table_data_setting'              => __( 'Table data controlling settings', 'basic-plugin' ),
			'per_page_note_1'                 => __( 'A numerical input field to set the number of rows to display in a table.', 'basic-plugin' ),
			'per_page_note_2'                 => __( 'It should allow a value between 1 and 5 inclusive. Default to 5 on install.', 'basic-plugin' ),
			'date_format_note_1'              => __( 'A checkbox or radio toggle to change whether the table’s date column', 'basic-plugin' ),
			'date_format_note_2'              => __( 'It control the date in human readable format or as a Unix timestamp. Default to human readable on install.', 'basic-plugin' ),
			'add_new_email_note_1'            => __( 'It is not allow less than 1 and more than 5 emails to be entered.', 'basic-plugin' ),
			'add_new_email_note_2'            => __( 'By default, the WordPress admin email should be pre-populated as one of the emails', 'basic-plugin' ),
		);
	}
}
