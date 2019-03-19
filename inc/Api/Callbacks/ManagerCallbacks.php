<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function checkboxSanitize( $input ) {
		// Video 22
		$output = array();
		foreach ( $this->managers as $key => $value ) {
			// Video 23: check first comment
			// The code will work fine if it checks for the value as well as isset() on the checkboxes. 
			// The reason all the checkboxes change to true when there is no existing data (first time activation) 
			// is because the options are set the first time (that part of logic is true), but their values differ 
			// (that is not part of the logic, but should be). The code does not check for values, only if the variable is set. 
			// So instead of $output[$key] = isset( $input[$key] ) ? true : false;, 
			// change it to $output[$key] = ( isset( $input[$key] ) && $input[$key] == 1 ) ? true : false; 
			// and it will work as expected.
			// $output[$key] = ( isset( $input[$key] ) && $input[$key] == 1 ) ? true : false;
			// Same as:
			$output[$key] = ( isset( $input[$key] ) && $input[$key] );
		}
		return $output;
	}

	public function adminSectionManager() {
		echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
	}

	public function checkboxField( $args ) {
		// Video 22
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
    $checkbox = get_option( $option_name );

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checkbox[$name] ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}
}