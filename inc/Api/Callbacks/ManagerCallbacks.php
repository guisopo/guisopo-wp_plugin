<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{

  public function checkboxSanitize( $input ) {
    
    // return filter_var($input, FILTER_SANITIZE_NUMBERINT);
    return ( isset($input) ? true : false );
  }

  public function adminSectionManager() {
    echo 'Manage the Sections and Features of the plugin within the following list:';
  }

  public function checkboxField( $args ) {
    $name = $args['label_for'];
    $class = $args['class'];
    $checkbox = get_option( $name );
    echo '<input  type="checkbox" 
                    name="' . $name . '" 
                    value="1" 
                    class="' . $class . '" 
                    ' . ( $checkbox ? 'checked' : '') . '>';
  }

}