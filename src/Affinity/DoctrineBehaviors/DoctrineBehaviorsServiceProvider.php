<?php namespace Affinity\DoctrineBehaviors;

use Illuminate\Support\ServiceProvider;
use Unifik\DoctrineBehaviorsBundle\ORM\Uploadable\UploadableListener;

class DoctrineBehaviorsServiceProvider extends ServiceProvider {

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot() {
    if (!isset($app['doctrine'])) return;
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
    // if (!isset($app['doctrine'])) return;

    $this->package('affinity/doctrine-behaviors');
    $evm = $this->app['doctrine']->getEventManager();

    $public_dir = \public_path();
    $upload_root_dir = $this->app['config']->get('doctrine-behaviors::upload_root_dir', "$public_dir/uploads");
    $upload_web_dir = $this->app['config']->get('doctrine-behaviors::upload_web_dir', "/uploads");
    $uploadable = new UploadableListener($upload_root_dir, $upload_web_dir);
    $evm->addEventSubscriber($uploadable);
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides() {
    return array();
  }

}
