<?php

namespace calderawp\mailchimp\segments;


use \DrewM\MailChimp\MailChimp as API;
/**
 * Class Segments
 *
 * Interact with Mailchimp list segments
 *
 * @package calderawp\mailchimp\segments
 */
class Segments extends MailChimp {

	/**
	 * GET All segments for a list
	 *
	 * @param string $listId
	 *
	 * @return array
	 */
	public function segments( string $listId ) : array
	{
		$segments = [];
		$r =  $this->api->get( "lists/$listId/segments" );
		if( isset( $r[ 'segments' ] ) ){
			$segments = $r[ 'segments' ];
		}

		return $segments;
	}

	/**
	 * GET A segment
	 *
	 * @param string $listId
	 * @param string $segmentId
	 *
	 * @return array|false
	 */
	public function segment( string $listId, string $segmentId  )
	{
		return $this->api->get( "lists/$listId/segments/$segmentId" );
	}

	/**
	 * Create a segment
	 *
	 * @param string $listId
	 * @param array $emails
	 * @param string $name
	 *
	 * @return array|false
	 */
	public function create( string $listId, array $emails, string  $name )
	{
		return $this->api->post( "lists/$listId/segments",[
			'static_segment' => $emails,
			'name' => $name
		] );
	}

	/**
	 * Add emails to a segment
	 *
	 * @param string $listId
	 * @param int $segmentId
	 * @param array $emails
	 *
	 * @return array|false
	 */
	public function add( string $listId, int $segmentId, array $emails )
	{
		return $this->api->post( "lists/$listId/segments/$segmentId",[
			'members_to_add' => array_values( $emails )
		]);
	}

	/**
	 * Remove emails from a segment
	 *
	 * @param string $listId
	 * @param int $segmentId
	 * @param array $emails
	 *
	 * @return array|false
	 */
	public function remove( string $listId, int $segmentId, array $emails )
	{
		return $this->api->post( "lists/$listId/segments/$segmentId",[
			'members_to_remove' => array_values( $emails )
		]);
	}

	/**
	 * Get list members
	 *
	 * @param string $listId
	 * @param int $segmentId
	 *
	 * @return array
	 */
	public function members( string  $listId, int $segmentId ) : array
	{
		$members = [];
		$r = $this->api->get("lists/$listId/segments/$segmentId/members" );
		if( isset( $r[ 'members' ] ) ){
			$members = $r[ 'members' ];
		}
		return $members;
	}

	public function delete( int $listId, int $segmentId )
	{
		return $this->api->delete( "lists/$listId/segments/$segmentId" );
	}

}