<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

class WidgetController extends BaseController
{
  public $callbacks;

  public $subpages = array();

  public function register() {

    // Interrupt if $activated is false
    if( ! $this->activated( 'media_widget' ) ) return;

  }

}