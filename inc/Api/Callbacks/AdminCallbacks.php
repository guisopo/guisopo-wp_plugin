<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
  public function adminDashboard() {
    return require_once("$this->plugin_path/templates/admin.php");
  }
  
  public function adminCPT() {
    echo '<h1>CPT Admin Board</h1>';
  }
}