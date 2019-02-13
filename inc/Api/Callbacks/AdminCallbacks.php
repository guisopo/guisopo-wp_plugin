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
  
  public function adminCpt() {
    return require_once("$this->plugin_path/templates/cpt.php");
  }

  public function adminTaxonomy() {
    echo '<h1>Taxonomy Admin Board</h1>';
  }

  public function adminWidget() {
    echo '<h1>Widget Admin Board</h1>';
  }

  public function adminGallery() {
    echo '<h1>Gallery Admin Board</h1>';
  }

  public function adminTestimonial() {
    echo '<h1>Testimonial Admin Board</h1>';
  }

  public function adminTemplate() {
    echo '<h1>Template Admin Board</h1>';
  }

  public function adminAuth() {
    echo '<h1>Login Manager</h1>';
  }

  public function adminChat() {
    echo '<h1>Chat Manager</h1>';
  }

  public function adminMembership() {
    echo '<h1>Membership Manager</h1>';
  }
}