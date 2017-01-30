<?php
/**
 * @TODO What this does
 *
 * @package app
 * Copyright 2017 Josh Pollock <Josh@CalderaWP.com
 */

namespace calderawp\mailchimp\segments;

use \DrewM\MailChimp\MailChimp as API;
/**
 * Class MailChimp
 * @package calderawp\mailchimp\segments
 */
abstract class MailChimp {

	/**
	 * @var API
	 */
	protected $api;
	public function __construct( API $api ) {
		$this->api = $api;
	}
}