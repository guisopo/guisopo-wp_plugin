<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;
class Enqueue
{
  public function register() {
    add_action('admin_enqueue_scripts', array($this, 'enqueue') );
  }

  function enqueue() {
    // enqueue all our scripts
    wp_enqueue_style('main.css', PLUGIN_URL . 'assets/main.css');
    wp_enqueue_script('index.js', PLUGIN_URL . 'assets/index.js');
  }
}