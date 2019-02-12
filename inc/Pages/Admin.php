<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Admin extends BaseController
{
  public $settings;

  public $pages = array();
  public $subpages = array();

  public $callbacks;
  public $callbacks_manager;

  public function register() {
    $this->settings = new SettingsApi();

    $this->callbacks = new AdminCallbacks();
    $this->callbacks_manager = new ManagerCallbacks();

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

    $args = array();

    $args[] = array(
      'option_group' => 'guisopo_plugin_settings',
      'option_name' => 'guisopo_plugin', // Should be identical to page arg in setFields
      'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
    );

    $this->settings->setSettings( $args );
  }

  public function setSections() {
    $args = [
        [
          'id' => 'guisopo_admin_index',
          'title' => 'Settings Manager',
          'callback'  => array($this->callbacks_manager, 'adminSectionManager'),
          'page'  => 'guisopo_plugin'
        ]
      ];

      $this->settings->setSections( $args );
  }

  public function setFields() {
    foreach($this->managers as $key => $value) {
      $args[] = array(
                  'id' => $key,
                  'title' => $value,
                  'callback'  => array($this->callbacks_manager, 'checkboxField'),
                  'page'  => 'guisopo_plugin', // Should be identical to the option_name arg of the setSettings
                  'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
                  'args' => array(
                    'option_name' => 'guisopo_plugin',
                    'label_for' =>  $key, // Label should always get the ID in order to get that option for the callback
                    'class' => 'ui-toggle'
                  )
                );
    }

      $this->settings->setFields( $args );
  }

}