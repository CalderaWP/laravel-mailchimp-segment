<?php

namespace calderawp\mailchimp\segments;
use Illuminate\Support\ServiceProvider;
use \DrewM\MailChimp\MailChimp as API;

/**
 * Class ListServiceProvider
 * @package calderawp\mailchimp\segments
 */
class ListServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton( MailChimp::class, function () {
			$api = new API(config('mailchimp-segments.apiKey'));
			return new Lists( $api );
		} );
	}


	public function provides() {
		return [ Lists::class ];
	}
}