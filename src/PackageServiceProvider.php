<?php

namespace calderawp\mailchimp\segments;
use Illuminate\Support\ServiceProvider;


/**
 * Class SegmentServiceProvider
 *
 * Registers this package with the app
 *
 * @package calderawp\mailchimp\segments
 */
class PackageServiceProvider  extends ServiceProvider
{
	protected $defer = false;

	protected $packageServices = [
		\calderawp\mailchimp\segments\ListServiceProvider::class,
		\calderawp\mailchimp\segments\SegmentsServiceProvider::class
	];

	public function boot()
	{
		$this->mergeConfigFrom(__DIR__.'/../config/mailchimp-segments.php', 'mailchimp-segments');
		$this->publishes([
			__DIR__.'/../config/mailchimp-segments.php' => config_path('mailchimp-segments.php'),
		]);
	}

	public function register()
	{
		foreach ( $this->packageServices as $provider) {
			 $this->app->registerDeferredProvider($provider);
		}
	}




}