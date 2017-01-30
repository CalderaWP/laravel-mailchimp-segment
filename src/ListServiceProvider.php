<?php

namespace calderawp\mailchimp\segments;
use Illuminate\Support\ServiceProvider;

/**
 * Class ListServiceProvider
 * @package calderawp\mailchimp\segments
 */
class ListServiceProvider extends ServiceProvider {

	protected $defer = true;
	public function register() {
		$this->app->singleton( MailChimp::class, function () {
			return Factory::lists( config('mailchimp-segments.apiKey') );

		} );
	}


	public function provides() {
		return [ Lists::class ];
	}
}