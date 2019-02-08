<?php
/**
 * @package GuisopoPlugin
 */

namespace Inc;
// Used only to register services
// Should never be extended, therefore we use the final type of class
// class anotherClass extends Init won't work
final class Init
{
  /**
   * Store all the classes inside an array
   * @return array full list of classes
   */
  public static function get_services() {
    return [
      //We return the class
      Pages\Admin::class,
      Base\Enqueue::class,
      Base\SettingsLinks::class
    ];
  }

  /**
   * Loop through the classes, initialize them
   * and call register() if it exists
   * @return
   */
  public static function register_services() {
    // We use self instead of $this because it is initialize and static?
    foreach ( self::get_services() as $class) {
      $service = self::instantiate( $class );
      if( method_exists( $service, 'register') ) {
        $service->register();
      }
    }
  }

  /**
   * Initialize the class
   * @param class $class      from the services array
   * @return class instance   new instance of the class
   */
  private static function instantiate( $class ) {
    $service = new $class();
    return $service;
  }
}