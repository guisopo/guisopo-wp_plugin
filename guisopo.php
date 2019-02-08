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


// Autoload Composer
if( file_exists( dirname( __FILE__) . '/vendor/autoload.php' ) ) {
  // now with the autoload we can define a namespace and reference that file through its own namespace without requiring the actual file
  require_once dirname( __FILE__) . '/vendor/autoload.php';
}

// We define globally the plugin path so we can reference it in differnt files
define( 'PLUGIN_PATH', plugin_dir_path(__FILE__));
// We define globally the plugin url for the wp_enqueue_script/style methods because the dont accept PLUGIN_PATH
define( 'PLUGIN_URL', plugin_dir_url(__FILE__));

if( class_exists( 'Inc\\Init' ) ) {
  Inc\Init::register_services();
}