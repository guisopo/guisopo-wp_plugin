<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;
use \Inc\Api\Widgets\MediaWidget;

class WidgetController extends BaseController
{
  public $callbacks;

  public $subpages = array();

  public function register() {

    // Interrupt if $activated is false
    if( ! $this->activated( 'media_widget' ) ) return;

    $media_widget = new MediaWidget();
    $media_widget->register();

  }

}