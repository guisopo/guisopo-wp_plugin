<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function checkboxSanitize( $input )
	{
		// Video 22
		$output = array();
		foreach ( $this->managers as $key => $value ) {
			// $output[$key] = isset( $input[$key] ) ? true : false;
			// Video 23: check first comment
			// $output[$key] = ( isset( $input[$key] ) && $input[$key] == 1 ) ? true : false;
			// Same as:
			$output[$key] = ( isset( $input[$key] ) && $input[$key] );
		}
		return $output;
	}

	public function adminSectionManager()
	{
		echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
	}

	public function checkboxField( $args )
	{
		// Video 22
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
    $checkbox = get_option( $option_name );

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checkbox[$name] ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}
}