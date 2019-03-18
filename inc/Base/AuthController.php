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

  }
  
}
