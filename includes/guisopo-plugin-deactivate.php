<?php
/**
 * @package GuisopoPlugin
 */

class GuisopoPluginDeactivate
{
  public static function deactivate() {
    flush_rewrite_rules();
  }
}
