<?php

use Nrd\App\Http\Controllers\RecordsController;
use Nrd\App\Http\Controllers\SettingsController;
use Nrd\App\Http\Controllers\SettingsEmailController;
use Nrd\App\Http\Route;

// Add a route to retrieve records.
Route::add_route(
	'/records',                    // Endpoint URL for retrieving records.
	WP_REST_Server::READABLE,      // HTTP method: GET.
	array(
		RecordsController::class,   // Controller class.
		'index',                    // Controller method to handle the request.
	)
);

// Add a route to remove an email.
Route::add_route(
	'/remove-email',               // Endpoint URL for removing an email.
	WP_REST_Server::DELETABLE,     // HTTP method: DELETE.
	array(
		SettingsEmailController::class, // Controller class.
		'update',                   // Controller method to handle the request.
	)
);

// Add a route to add an email.
Route::add_route(
	'/add-email',                  // Endpoint URL for adding an email.
	WP_REST_Server::CREATABLE,     // HTTP method: POST.
	array(
		SettingsEmailController::class, // Controller class.
		'store',                    // Controller method to handle the request.
	)
);

// Add a route to retrieve global settings.
Route::add_route(
	'/global-settings',            // Endpoint URL for retrieving global settings.
	WP_REST_Server::READABLE,      // HTTP method: GET.
	array(
		SettingsController::class,  // Controller class.
		'index',                    // Controller method to handle the request.
	)
);

// Add a route to update global settings.
Route::add_route(
	'/global-settings',            // Endpoint URL for updating global settings.
	WP_REST_Server::EDITABLE,      // HTTP method: PUT/PATCH.
	array(
		SettingsController::class,  // Controller class.
		'update',                   // Controller method to handle the request.
	)
);
