<?php

namespace calderawp\mailchimp\segments;
use DrewM\MailChimp\MailChimp;


/**
 * Class Factory
 *
 * Factories for the various API abstractions
 *
 * @package calderawp\mailchimp\segments
 */
class Factory {

	/**
	 * @param $key
	 *
	 * @return MailChimp
	 */
	public static function api( $key )
	{
		return new MailChimp( $key );
	}

	/**
	 * @param $key
	 *
	 * @return Lists
	 */
	public static function lists( $key )
	{
		return new Lists( static::api( $key ) );
	}

	/**
	 * @param $key
	 *
	 * @return Segments
	 */
	public static function segments( $key )
	{
		return new Segments( static::api( $key ) );
	}
}