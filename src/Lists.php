<?php


namespace calderawp\mailchimp\segments;


/**
 * Class Lists
 *
 * MailChimp lists
 *
 * @package calderawp\mailchimp\segments
 */
class Lists extends MailChimp {

	protected $lists;
	public function getLists()
	{
		if( empty( $this->lists ) ){
			$this->queryForLists();
		}
		return $this->lists;
	}


	public function queryForLists()
	{
		$this->lists =  $this->api->get('lists');
		return $this->lists;
	}
}