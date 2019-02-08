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

use Inc\Activate;
use Inc\Deactivate;
use Inc\AdminPages;

// We check if the class exists. Safety precation recommended in PHP
if( !class_exists( 'GuisopoPlugin' ) ){

  class GuisopoPlugin
  {
    public $plugin;

    function __construct() {
      $this->plugin = plugin_basename(__FILE__);
    }

    function register() {
      add_action('admin_enqueue_scripts', array($this, 'enqueue') );

      add_action('admin_menu', array($this, 'add_admin_pages') );

      add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link') );
    }

    public function settings_link( $links ) {
      // add custom settings link
      $settings_link = '<a href="admin.php?page=guisopo_plugin">Settings</a>';

      array_push( $links, $settings_link);
      return $links;
    }

    public function add_admin_pages() {
      add_menu_page( 'Guisopo Plugin', 'Guisopo', 'manage_options', 'guisopo_plugin', array($this, 'admin_index'), 'dashicons-store', 110);
    }

    public function admin_index() {
      //require template
      require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }

    protected function create_post_type() {
      add_action( 'init', array( $this, 'custom_post_type') );
    }

    function custom_post_type() {
      register_post_type('book', ['public'=> true, 'label'=> 'Books']);
    }

    function activate() {
      // We don't need require_once because of composer autoload
      // require_once plugin_dir_path(__FILE__) . 'includes/guisopo-plugin-activate.php';
      Activate::activate();
    }

    function enqueue() {
      // enqueue all our scripts
      wp_enqueue_style('main.css', plugins_url('/assets/main.css', __FILE__) );
      wp_enqueue_script('index.js', plugins_url('/assets/index.js', __FILE__) );
    }

  }

  // We store the initialization of the class in a variable because then we can call it in other sections
  $guisopoPlugin = new GuisopoPlugin();
  $guisopoPlugin->register();

  // ACTIVATION
  // __FILE__ is a global variable
  register_activation_hook( __FILE__, array($guisopoPlugin, 'activate') );
  
  // DEACTIVATION
  // We don't need require_once because of composer autoload
  // require_once plugin_dir_path(__FILE__) . 'includes/guisopo-plugin-deactivate.php';
  register_deactivation_hook( __FILE__, array('Deactivate', 'deactivate') );

}