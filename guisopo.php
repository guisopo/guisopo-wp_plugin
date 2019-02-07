<?php
/**
 * @package GuisopoPlugin
 */

 /*
  Plugin Name: Guisopo Plugin
  Plugin URI: http://www.guisopo.com/Guisopo
  Description: Tutorial plugin
  Version: 1.0.0
  Author: Guisopo
  Author URI: http://www.guisopo.com
  License: GPLv2 or later
  Text Domain: http://www.guisopo.com/Guisopo
  */

// ABSPATH  is a constant variable defined by WP when initializing WP site and carries
  // itself during the WP installation ONLY IF is the software itself who is accesing the php file.
  // If something else external from the website is accesing those files ABSPATH is not defined
  defined ( 'ABSPATH' ) or die('You cannot acces this file!');

// We check if the class exists. Safety precation recommended in PHP
if( class_exists( 'GuisopoPlugin' ) ){

  class GuisopoPlugin
  {
    protected function create_post_type() {
      add_action( 'init', array( $this, 'custom_post_type') );
    }

    function custom_post_type() {
      register_post_type('book', ['public'=> true, 'label'=> 'Books']);
    }

    function activate() {
      require_once plugin_dir_path(__FILE__) . 'includes/guisopo-plugin-activate.php';
      GuisopoPluginActivate::activate;
    }

  }

  // We store the initialization of the class in a variable because then we can call it in other sections
  $guisopoPlugin = new GuisopoPlugin();
  $guisopoPlugin->register();

  // ACTIVATION
  // __FILE__ is a global variable
  register_activation_hook( __FILE__, array($guisopoPlugin, 'activate') );
  
  // DEACTIVATION
  require_once plugin_dir_path(__FILE__) . 'includes/guisopo-plugin-deactivate.php';
  register_deactivation_hook( __FILE__, array('guisopoPluginDeactivate', 'deactivate') );

}

}