<?php

namespace Nrd\App\Http;

use Nrd\App\Framework\Request;

class Controller {

	protected $request = null;

	public function __construct() {
		$this->request = new Request();
	}

	protected function response( $data, $status = 200 ) {
		return new \WP_REST_Response(
			$data,
			$status
		);
	}

	protected function error( $message ) {
		return new \WP_Error(
			403,
			$message
		);
	}
}
