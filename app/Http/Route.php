<?php

namespace Nrd\App\Http;

class Route {

	/**
	 * Adds a custom route for the WordPress REST API.
	 *
	 * @param string   $url    The URL for the new route.
	 * @param string   $type   HTTP method(s) for the route (e.g., 'GET', 'POST').
	 * @param callable $args   Callback function for handling the route's logic.
	 */
	public static function add_route( $url, $type, $args ) {
		// Check if the number of arguments is less than 2
		if ( count( $args ) < 2 ) {
			return; // If less than 2 arguments, exit the function
		}

		// Extract the class and method from the arguments array
		$class  = $args[0]; // The first argument is the class name
		$method = $args[1]; // The second argument is the method name

		// Check if the class exists
		if ( ! class_exists( $class ) ) {
			return; // If class doesn't exist, exit the function
		}

		// Create an instance of the class
		$obj = new $class();

		// Check if the method exists within the object
		if ( ! method_exists( $obj, $method ) ) {
			return; // If method doesn't exist in the object, exit the function
		}

		// Replace the first argument with the created object
		$args[0] = $obj;

		// Register a new route with the WordPress REST API.
		register_rest_route(
			BASIC_PLUGIN . '/v2',  // Namespace and version for the route.
			$url,                      // Endpoint URL for the route.
			array(
				'methods'             => $type,  // HTTP method(s) allowed for the route.
				'callback'            => $args,    // Callback function for route logic.
				'permission_callback' => function () {
					// Permission callback to restrict access based on user capabilities.
					return current_user_can( 'manage_options' );
				},
			)
		);
	}
}
