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

  public function __construct() {
    $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2) );
    $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2) );
    $this->plugin = plugin_basename( dirname( __FILE__, 3) ) . '/guisopo.php';
  }
}