<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class WidgetController extends BaseController
{
  public $callbacks;

  public $subpages = array();

  public function register() {

    // Interrupt if $activated is false
    if( ! $this->activated( 'media_widget' ) ) return;

    $this->settings = new SettingsApi();

    $this->callbacks = new AdminCallbacks();

    $this->setSubpages();

    $this->settings->addSubpages( $this->subpages )->register();
  }

  public function setSubpages() {
    $this->subpages = array(
      array(
        'parent_slug' => 'guisopo_plugin',
        'page_title' => 'Widgets Manager',
        'menu_title' => 'Widgets Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_widget',
        'callback' => array( $this->callbacks, 'adminWidget' )
      )
    );
  }
}