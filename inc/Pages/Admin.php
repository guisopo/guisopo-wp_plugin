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
    $args = [
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'cpt_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'taxonomy_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'media_widget',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'gallery_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'testimonial_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'tempaltes_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'login_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'memebrship_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        [
          'option_group' => 'guisopo_plugin_settings',
          'option_name' => 'chat_manager',  // same exact name of ID of custom field
          'callback'  => array($this->callbacks_manager, 'checkboxSanitize')
        ],
        
      ];

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
    $args = [
        [
          'id' => 'cpt_manager',
          'title' => 'Activate CPT Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'cpt_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
          ],
        [
          'id' => 'taxonomy_manager',
          'title' => 'Activate Taxonomies Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'taxonomy_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'media_widget',
          'title' => 'Activate Media Widget',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'media_widget', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'gallery_manager',
          'title' => 'Activate Gallery Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'gallery_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'testimonial_manager',
          'title' => 'Acitvate Testimonial Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'testimonial_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'templates_manager',
          'title' => 'Acitivate Templates Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'templates_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'login_manager',
          'title' => 'Activate Login Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'login_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'membership_manager',
          'title' => 'Activate Membership Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'membership_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
        [
          'id' => 'chat_manager',
          'title' => 'Activate Chat Manager',
          'callback'  => array($this->callbacks_manager, 'checkboxField'),
          'page'  => 'guisopo_plugin',
          'section' => 'guisopo_admin_index',  //  Same as id of the section to be printed
          'args' => array(
            'label_for' =>  'chat_manager', // Label should always get the ID in order to get that option for the callback
            'class' => 'ui-toggle'
          )
        ],
      ];

      $this->settings->setFields( $args );
  }

}