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
  }
}
