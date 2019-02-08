<?php
/**
 * @package GuisopoPlugin
 * This BaseController will not interfere with other plugins if the use the same
 * type of variable names o constant
 */

namespace Inc\Base;
use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{
  public function register() {
    add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link') );
  }

  public function settings_link( $links ) {
    // add custom settings link
    $settings_link = '<a href="admin.php?page=guisopo_plugin">Settings</a>';
    array_push( $links, $settings_link);
    return $links;
  }
}