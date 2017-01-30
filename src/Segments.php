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
	 * @param int $listId
	 *
	 * @return array|false
	 */
	public function segments( int $listId )
	{
		return $this->api->get( "lists/$listId/segments" );
	}

	/**
	 * GET A segment
	 *
	 * @param int $listId
	 * @param int $segmentId
	 *
	 * @return array|false
	 */
	public function segment( int $listId, int $segmentId  )
	{
		return $this->api->get( "lists/$listId/segments/$segmentId" );
	}

	/**
	 * Create a segment
	 *
	 * @param int $listId
	 * @param array $emails
	 * @param string $name
	 *
	 * @return array|false
	 */
	public function create( int $listId, array $emails, string  $name )
	{
		return $this->api->post( "lists/$listId/segments",[
			'static_segment' => $emails,
			'name' => $name
		] );
	}

	/**
	 * Add emails to a segment
	 *
	 * @param int $listId
	 * @param int $segmentId
	 * @param array $emails
	 *
	 * @return array|false
	 */
	public function add( int $listId, int $segmentId, array $emails )
	{
		return $this->api->post( "lists/$listId/segments/$segmentId",[
			'members_to_add' => $emails
		]);
	}

	/**
	 * Remove emails from a segment
	 *
	 * @param int $listId
	 * @param int $segmentId
	 * @param array $emails
	 *
	 * @return array|false
	 */
	public function remove( int $listId, int $segmentId, array $emails )
	{
		return $this->api->post( "lists/$listId/segments/$segmentId",[
			'members_to_remove' => $emails
		]);
	}

	public function delete( int $listId, int $segmentId )
	{
		return $this->api->delete( "lists/$listId/segments/$segmentId" );
	}

}