<?php
/**
 * @package GuisopoPlugin
 * This BaseController will not interfere with other plugins if
 * they use the same type of variable names or constant
 */
namespace Inc\Base;

class BaseController
{ 
  public $plugin_path;
  public $plugin_url;
  public $plugin;
  public $managers = array();

  public function __construct() {
    $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2) );
    $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2) );
    $this->plugin = plugin_basename( dirname( __FILE__, 3) ) . '/guisopo.php';

    $this->managers = [
      'cpt_manager'         => 'Activate CPT Manager',
      'taxonomy_manager'    => 'Activate Taxonomies Manager',
      'media_widget'        => 'Activate Media Widget',
      'gallery_manager'     => 'Activate Gallery Manager',
      'testimonial_manager' => 'Activate Custom Templates',
      'templates_manager'   => 'Activate Templates Manager',
      'login_manager'       => 'Activate Login Manager',
      'membership_manager'  => 'Activate Membership Manager',
      'chat_manager'        => 'Activate Chat Manager'
    ];
  }

  public function activated( string $key ) {
    $option = get_option( 'guisopo_plugin' );
    $activated = ( isset( $option[$key] ) && $option[$key] );
    
    return $activated ;
  }
}