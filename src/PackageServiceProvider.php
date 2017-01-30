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
		\calderawp\mailchimp\segments\PackageServiceProvider::class
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
		$this->registerProviders( $this->packageServices );
	}

	/**
	 * Register a service provider.
	 *
	 * @param  \Illuminate\Support\ServiceProvider|string  $provider
	 * @param  array                                       $options
	 * @param  bool                                        $force
	 *
	 * @return \Illuminate\Support\ServiceProvider
	 */
	protected function registerProvider($provider, array $options = [], $force = false)
	{
		return $this->app->registerDeferredProvider($provider, $options, $force);
	}

	/**
	 * Register multiple service providers.
	 *
	 * @param  array  $providers
	 */
	protected function registerProviders(array $providers)
	{
		foreach ($providers as $provider) {
			$this->registerProvider($provider);
		}
	}
}