<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
  public function register() {
    add_action('admin_enqueue_scripts', array($this, 'enqueue') );
  }

  function enqueue() {
    // enqueue all our scripts
    wp_enqueue_script('media-upload');
    wp_enqueue_media();
    wp_enqueue_style('main.css', $this->plugin_url . 'assets/mystyle.css');
    wp_enqueue_script('index.js', $this->plugin_url . 'assets/myscript.js');
  }
}