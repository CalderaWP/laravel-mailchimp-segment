<?php

namespace calderawp\mailchimp\segments;
use calderawp\segmentor\Providers\ServiceProvider;


/**
 * Class SegmentsServiceProvider
 *
 * Makes segments API available to app
 *
 * @package calderawp\mailchimp\segments
 */
class SegmentsServiceProvider  extends ServiceProvider {

	protected $defer = true;

	public function register() {
		$this->app->singleton( MailChimp::class, function () {
			return Factory::segments( config('mailchimp-segments.apiKey') );
		} );
	}


	public function provides() {
		return [ Segments::class ];
	}

}