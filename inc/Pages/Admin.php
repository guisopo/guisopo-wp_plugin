<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
  public $settings;
  public $pages = array();
  public $subpages = array();
  public $callbacks;

  public function register() {
    $this->settings = new SettingsApi();

    $this->callbacks = new AdminCallbacks();

    $this->setPages();
    
    $this->setSubpages();

    $this->setSettings();

    $this->setSections();

    $this->setFields();

    $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubpages( $this->subpages )->register();
  }

  public function setPages() {
    $this->pages = [ 
      [
        'page_title' => 'Guisopo Plugin',
        'menu_title' => 'Guisopo',
        'capability' => 'manage_options',
        'menu_slug' => 'guisopo_plugin',
        'callback' => array( $this->callbacks, 'adminDashboard'),
        'icon_url' => 'dashicons-store',
        'position' => 110
      ]
    ];
  }

  public function setSubpages() {
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

  public function setSettings() {
    $args = [
        [
          'option_group' => 'guisopo_options_group',
          'option_name' => 'text_example',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks, 'guisopoOptionsGroup')
        ]
      ];

      $this->settings->setSettings( $args );
  }

  public function setSections() {
    $args = [
        [
          'id' => 'guisopo_admin_index',
          'title' => 'Settings',
          'callback'  => array($this->callbacks, 'guisopoAdminSection'),
          'page'  => 'guisopo_plugin'
        ]
      ];

      $this->settings->setSections( $args );
  }

  public function setFields() {
    $args = [
        [
          'id' => 'text_field',
          'title' => 'Text Field',
          'callback'  => array($this->callbacks, 'guisopoTextExample'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'text_example',
            'class' =>  'Example-Class'
          )
        ]
      ];

      $this->settings->setFields( $args );
  }

}