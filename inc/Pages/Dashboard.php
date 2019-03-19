<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
  public $settings;

  public $pages = array();

  public $callbacks;
  public $callbacks_manager;

  public function register() {
    $this->settings = new SettingsApi();

    $this->callbacks = new AdminCallbacks();
    $this->callbacks_manager = new ManagerCallbacks();

    $this->setPages();

    $this->setSettings();
    $this->setSections();
    $this->setFields();

    $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
  }

  public function setPages() {
    $this->pages = [ 
      [
        'page_title'  => 'Guisopo Plugin',
        'menu_title'  => 'Guisopo',
        'capability'  => 'manage_options',
        'menu_slug'   => 'guisopo_plugin',
        'callback'    => array( $this->callbacks, 'adminDashboard'),
        'icon_url'    => 'dashicons-store',
        'position'    => 110
      ]
    ];
  }

  public function setSettings() {

    $args = array();

    $args[] = array(
      'option_group'  => 'guisopo_plugin_settings',
      'option_name'   => 'guisopo_plugin', // Should be identical to page arg in setFields
      'callback'      => array($this->callbacks_manager, 'checkboxSanitize')
    );

    $this->settings->setSettings( $args );
  }

  public function setSections() {
    $args = [
        [
          'id'        => 'guisopo_admin_index',
          'title'     => 'Settings Manager',
          'callback'  => array($this->callbacks_manager, 'adminSectionManager'),
          'page'      => 'guisopo_plugin'
        ]
      ];

      $this->settings->setSections( $args );
  }

  public function setFields() {
    foreach($this->managers as $key => $value) {
      $args[] = array(
                  'id'        => $key,
                  'title'     => $value,
                  'callback'  => array($this->callbacks_manager, 'checkboxField'),
                  'page'      => 'guisopo_plugin', // Should be identical to the option_name arg of the setSettings
                  'section'   => 'guisopo_admin_index',  //  Same as id of the section to be printed
                  'args' => array(
                    'option_name' => 'guisopo_plugin',
                    'label_for'   =>  $key, // Label should always get the ID in order to get that option for the callback
                    'class'       => 'ui-toggle'
                  )
                );
    }

      $this->settings->setFields( $args );
  }

}