<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

class Activate
{
  public static function activate() {
    // create CPT. Find this method only inside the class
    // $this->custom_post_type();
    // flush rewrite rules: tells WP something is happenning in the DB and needs to refresh in order to read the new information
    flush_rewrite_rules();

    $default = array();

    if( ! get_option( 'guisopo_plugin' ) ) {
      update_option( 'guisopo_plugin', $default );
    }

    if( ! get_option( 'guisopo_plugin_cpt' ) ) {
      update_option( 'guisopo_plugin_cpt', $default );
    }

    if( ! get_option( 'guisopo_plugin_tax' ) ) {
      update_option( 'guisopo_plugin_tax', $default );
    }

    

  } 
}
