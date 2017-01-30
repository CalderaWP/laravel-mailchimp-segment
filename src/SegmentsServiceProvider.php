<?php

namespace calderawp\mailchimp\segments;
use calderawp\segmentor\Providers\ServiceProvider;
use \DrewM\MailChimp\MailChimp as API;


/**
 * Class SegmentsServiceProvider
 *
 * Makes segments API available to app
 *
 * @package calderawp\mailchimp\segments
 */
class SegmentsServiceProvider  extends ServiceProvider {


	public function register() {
		$this->app->singleton( MailChimp::class, function () {
			$api = new API(config('mailchimp-segments.apiKey'));
			return new Segments( $api );
		} );
	}


	public function provides() {
		return [ Segments::class ];
	}

}