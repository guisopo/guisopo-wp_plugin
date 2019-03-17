<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

class TemplateController extends BaseController
{
  public $templates;

  public function register() {

    // Interrupt if $activated is false
    if( ! $this->activated( 'templates_manager' ) ) return;
    
    $this->templates = array(
      'page-templates/two-columns-tpl.php'  =>  'Two Columns Layout'
    );

    add_filter( 'theme_page_templates', array( $this, 'custom_template' ) );
  }

  public function custom_template( $templates ) {
    $templates = array_merge($templates, $this->templates);
    return $templates;
  }
}