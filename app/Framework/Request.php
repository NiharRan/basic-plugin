<?php

namespace Nrd\App\Framework;

class Request {

	public function all() {
		return $_REQUEST;
	}

	public function get( $key, $default = null ) {
		if ( ! isset( $_REQUEST[ $key ] ) ) {
			return $default;
		}

		return $_REQUEST[ $key ];
	}

	public function __get( $key ) {
		return $this->get( $key );
	}

	public function validate( $data, $rules, $messages ) {
		$validator = new Validator( $data, $rules, $messages );

		return $validator->validate();
	}
}
