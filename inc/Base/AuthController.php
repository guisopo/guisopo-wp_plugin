<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

class AuthController extends BaseController
{

  public function register() {
    
   // Interrupt if $activated is false
    if( ! $this->activated( 'login_manager' ) ) return;

    add_action( 'wp_enqueue_scripts', array($this, 'enqueue') );
    add_action( 'wp_head', array($this, 'add_auth_template') );
  }

  public function enqueue() {
    wp_enqueue_style( 'authStyle', $this->plugin_url . 'assets/auth.scss' );
    wp_enqueue_script( 'authScript', $this->plugin_url . 'assets/auth.js' );
  }

  public function add_auth_template() {
    $file = $this->plugin_path . 'templates/auth.php';

    if( file_exists($file) ) {
      load_template( $file, true);
    }
  }


}
