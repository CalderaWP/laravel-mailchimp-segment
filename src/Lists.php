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

	/** @var  int */
	protected  $total;

	/** @var  array */
	protected $lists;

	/**
	 * Get all list from account
	 *
	 * @return array
	 */
	public function getLists()
	{
		if( empty( $this->lists ) ){
			$this->queryForLists();
		}
		return $this->lists;
	}

	/**
	 * Get IDs of all lists in an account
	 *
	 * @return array
	 */
	public function getListIds() : array
	{
		return $this->listReduce( 'id' );

	}

	/**
	 * Get names of all lists in an account
	 *
	 * @return array
	 */
	public function getListNames() : array
	{
		return $this->listReduce( 'name' );

	}

	/**
	 * Get stats for all lists, indexed by list ID
	 *
	 * @return array
	 */
	public function getListStats() : array
	{
		$collection = [];
		$this->getLists();
		if( ! empty( $this->lists ) ){
			foreach (  $this->lists as $list ) {
				$collection[ $list[ 'id' ] ] = $list[ 'stats' ];

			}
		}

		return $collection;
	}


	/**
	 * Reduce list property to single index
	 *
	 * @param string $index
	 *
	 * @return array
	 */
	private function listReduce( string $index  ) : array
	{
		$collection = [];
		$this->getLists();
		if( ! empty( $this->lists ) ){
			$collection = array_pluck( $this->lists, $index );
		}

		return $collection;
	}

	/**
	 * Query for all lists
	 *
	 * @return array
	 */
	public function queryForLists()
	{
		$_lists =  $this->api->get('lists');
		$this->lists = $_lists[ 'lists' ];
		$this->total = $_lists[ 'total_items' ];
		return $this->lists;
	}
}