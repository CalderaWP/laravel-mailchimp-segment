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
	public static function api( $key = null  ) : MailChimp
	{
		if( ! $key ){
			$key = static::getKey();
		}
		return new MailChimp( $key );
	}

	protected static function getKey() : string
	{
		return config('mailchimp-segments.apiKey');
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
	public static function segments( $key = null ) : Segments
	{
		if( ! $key ){
			$key = static::getKey();
		}
		return new Segments( static::api( $key ) );
	}

	/**
	 * @param string $key
	 * @param string $listId
	 * @param int $segmentId
	 *
	 * @return Segment
	 */
	public static function segment(  $key = null, string $listId, int $segmentId ) : Segment
	{
		if( ! $key ){
			$key = static::getKey();
		}
		return new Segment( static::segments( $key ), $segmentId, $listId );
	}
}