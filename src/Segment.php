<?php

namespace calderawp\mailchimp\segments;


/**
 * Class Segment
 *
 * Best way to handle add/remove emails from segment
 *
 * @package calderawp\mailchimp\segments
 */
class Segment {

	/** @var Segments  */
	protected $api;

	/** @var int  */
	protected $segmentId;

	/** @var string  */
	protected $listId;

	/** @var  array */
	protected $emails;

	/** @var  array */
	protected $members;

	/**
	 * Segment constructor.
	 *
	 * @param Segments $api
	 * @param int $segmentId
	 * @param string $listId
	 */
	public function __construct( Segments $api, int $segmentId, string $listId ) {
		$this->api = $api;
		$this->segmentId = $segmentId;
		$this->listId = $listId;


		$this->setEmails();
	}

	/**
	 * Get flat list of emails in segment
	 *
	 * @return array
	 */
	public function getEmails() : array
	{
		return $this->emails;
	}

	/**
	 * Get all members of segment
	 *
	 * @return array
	 */
	public function getMembers() : array
	{
		return $this->members;
	}

	/**
	 * Add emails to segment
	 *
	 * @param array $emails
	 *
	 * @return array
	 */
	public function addEmails( array  $emails ) : array
	{
		$emails = array_map( 'strtolower', $emails );
		foreach ( $emails as $i => $email ) {
			if( false !== array_search( $email, $this->emails )   ){
				unset( $emails[$i] );
			}
		}

		if( empty( $emails ) ){
			return $this->getEmails();
		}


		$this->api->add( $this->listId, $this->segmentId, $emails );
		$this->setEmails();
		return $this->getEmails();
	}

	/**
	 * Remove emails from segement
	 *
	 * @param array $emails
	 *
	 * @return array
	 */
	public function removeEmails( array  $emails ) : array
	{
		$emails = array_map( 'strtolower', $emails );
		$remove = array_intersect( $this->emails, $emails );

		$this->api->remove( $this->listId, $this->segmentId, $remove );
		$this->setEmails();
		return $this->getEmails();
	}


	/**
	 * Set/reset members and emails
	 */
	protected function setEmails()
	{
		$this->members = $this->api->members( $this->listId, $this->segmentId );
		$this->emails = array_pluck( $this->members, 'email_address' );
		$this->emails = array_map( 'strtolower', $this->emails );

	}

}