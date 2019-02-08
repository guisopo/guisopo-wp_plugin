<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
  public $settings;
  public $pages = array();

  public function __construct() {
    $this->settings = new SettingsApi();
    $this->pages = [ 
      [
        'page_title' => 'Guisopo Plugin',
        'menu_title' => 'Guisopo',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_plugin',
        'callback' => function() {echo '<h1>Hola</h1>'; },
        'icon_url' => 'dashicons-store',
        'position' => 110
      ]
    ];
  }

  public function register() {
    $this->settings->addPages( $this->pages )->register();
  }
}