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
	public static function api( $key  ) : MailChimp
	{
		return new MailChimp( $key );
	}

	/**
	 * @param $key
	 *
	 * @return Lists
	 */
	public static function lists( $key ) : Lists
	{
		return new Lists( static::api( $key ) );
	}

	/**
	 * @param $key
	 *
	 * @return Segments
	 */
	public static function segments( $key ) : Segments
	{
		return new Segments( static::api( $key ) );
	}

	/**
	 * @param string $key
	 * @param string $listId
	 * @param int $segmentId
	 *
	 * @return Segment
	 */
	public static function segment( string $key, string $listId, int $segmentId ) : Segment
	{
		return new Segment( static::segments( $key ), $segmentId, $listId );
	}
}