<?php

namespace Nrd\App\Framework;

class Validator {

	private $data     = array();
	private $rules    = array();
	private $messages = array();
	private $errors   = array();

	public function __construct( $data, $rules, $messages ) {
		$this->data     = $data;
		$this->messages = $messages;

		$this->format_validator_data( $rules );
	}

	public function validate() {
		foreach ( $this->rules as $field => $ruleStr ) {
			$rules = explode( '|', $ruleStr );

			foreach ( $rules as $rule ) {
				if ( method_exists( $this, $rule ) ) {
					$this->{$rule}( $field );
				}
			}
		}

		return $this->errors;
	}

	private function required( $field ) {
		if ( ! isset( $this->data[ $field ] ) || empty( $this->data[ $field ] ) ) {
			$this->errors[ $field ] = $this->get_message( "$field.required", "$field is required" );
		}
	}

	private function email( $field ) {
		if ( ! is_email( $this->data[ $field ] ) ) {
			$this->errors[ $field ] = $this->get_message( "$field.email", "$field is a valid email" );
		}
	}

	private function array( $field ) {
		if ( ! is_array( $this->data[ $field ] ) ) {
			$this->errors[ $field ] = $this->get_message( "$field.email", "$field is a valid array" );
		}
	}

	private function format_validator_data( $rules ) {
		foreach ( $rules as $field => $rule_str ) {
			$this->rules[ $field ] = $rule_str;
		}
	}

	private function get_message( $message_key, $default ) {
		if ( isset( $this->messages[ $message_key ] ) ) {
			return $this->messages[ $message_key ];
		}

		return $default;
	}
}
