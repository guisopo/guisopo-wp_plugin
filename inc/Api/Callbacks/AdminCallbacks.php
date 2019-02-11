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

  public function guisopoOptionsGroup( $input ) {
    return $input;
  }

  public function guisopoAdminSection() {
    echo 'Check this section';
  }

  public function guisopoTextExample() {
    $value = esc_attr(  get_option( 'text_example' ) );
    // Name should be identical to the id we gave to the field
    echo '<input  type="text" 
                  class="regular-text" 
                  name="text_example" 
                  value="' . $value . '"
                  placeholder="Write something here">
          </input>';
  }
}