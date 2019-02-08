<?php
/**
 * @package GuisopoPlugin
 */

 /*
  Plugin Name: Guisopo Plugin
  Plugin URI: http://www.guisopo.com/guisopo
  Description: Tutorial plugin
  Version: 1.0.0
  Author: Guisopo
  Author URI: http://www.guisopo.com
  License: GPLv2 or later
  Text Domain: http://www.guisopo.com/guisopo
  */

  // ABSPATH  is a constant variable defined by WP when initializing WP site and carries
  // itself during the WP installation ONLY IF is the software itself who is accesing the php file.
  // If something else external from the website is accesing those files ABSPATH is not defined
  defined ( 'ABSPATH' ) or die('You cannot acces this file!');


// Require once Composer Autoload
if( file_exists( dirname( __FILE__) . '/vendor/autoload.php' ) ) {
  // now with the autoload we can define a namespace and reference that file through its own namespace without requiring the actual file
  require_once dirname( __FILE__) . '/vendor/autoload.php';
}

/**
 * Code that runs during activation
 * WP requires the activation and deactivation hooks to be called outside a class
 */
function activate_guisopo_plugin() {
  Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_guisopo_plugin');

/**
 * Code that runs during deactivation
 */
function deactivate_guisopo_plugin() {
  Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_guisopo_plugin');

/**
 * Initialize all the core classes of the plugin
 */
if( class_exists( 'Inc\\Init' ) ) {
  Inc\Init::register_services();
}