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
  public $subpages = array();

  public function __construct() {
    $this->settings = new SettingsApi();
    $this->pages = [ 
      [
        'page_title' => 'Guisopo Plugin',
        'menu_title' => 'Guisopo',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_plugin',
        'callback' => function() {echo '<h1>Guisopo Plugin</h1>'; },
        'icon_url' => 'dashicons-store',
        'position' => 110
      ]
    ];
    $this->subpages = [
      [ 
        'parent_slug' => 'guisopo_plugin',
        'page_title' => 'Custom Post Types',
        'menu_title' => 'CPT',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_cpt',
        'callback' => function() {echo '<h1>CPT Manager</h1>'; },
      ],
      [ 
        'parent_slug' => 'guisopo_plugin',
        'page_title' => 'Custom Taxonomies',
        'menu_title' => 'Taxonomies',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_taxonomies',
        'callback' => function() {echo '<h1>Taxonomies Manager</h1>'; },
      ],
      [ 
        'parent_slug' => 'guisopo_plugin',
        'page_title' => 'Custom Widgets',
        'menu_title' => 'Widgets',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_widgets',
        'callback' => function() {echo '<h1>Widgets Manager</h1>'; },
      ]
      ];
  }

  public function register() {
    $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubpages( $this->subpages )->register();
  }
}