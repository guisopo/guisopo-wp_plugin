<?php
/**
 * @package GuisopoPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class TestimonialController extends BaseController
{
  public $callbacks;

  public $subpages = array();

  public function register() {
    
   // Interrupt if $activated is false
   if( ! $this->activated( 'testimonial_manager' ) ) return;

   add_action( 'init', array( $this, 'testimonial_cpt' ) );
   add_action( 'add_meta_boxes', array(  $this, 'add_meta_boxes' ) );
   add_action( 'save_post', array( $this, 'save_meta_box' ) );
  }

  public function testimonial_cpt() {

    $labels = array(
      'name' => 'Testimonials',
      'singular_name' => 'Testimonial'
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-testimonial',
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'supports' => array('title', 'editor')
    );

    register_post_type( 'testimonial', $args);

  }

  public function add_meta_boxes() {
    add_meta_box(
      'testimonial_author', // id
      'Author', // title
      array( $this, 'render_author_box' ),  // callback
      'testimonial',  //screen
      'side', // context
      'default' // priority
    );
  }

  public function render_author_box($post) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'guisopo_testimonial_author', 'guisopo_testimonial_author_nonce' );
    // Use get_post_meta to retrieve an existing value from the database.
    $value = get_post_meta( $post->ID, '_guisopo_testimonial_author_key', true );
    // Display the form, using the current value.
    ?>
    <p>
      <label class="meta-label" for="guisopo_testimonial_author">Author Name</label>
      <input  type="text" 
              id="guisopo_testimonial_author" 
              name="guisopo_testimonial_author"
              class="widefat"
              value="<?php echo esc_attr( $value ); ?>">
    </p>

    <?php
  }

  public function save_meta_box($post_id) {
    // Check if our nonce is set.
    if( !isset( $_POST['guisopo_testimonial_author_nonce'] ) ) {
      return $post_id;
    }

    $nonce = $_POST['guisopo_testimonial_author_nonce'];
    
    // Verify that the nonce is valid.
    if( !wp_verify_nonce( $nonce, 'guisopo_testimonial_author' ) ){
      return $post_id;
    };
    // If this is an autosave, our form has not been submitted,
    // so we don't want to do anything.
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return $post_id;
    }
    // Check the user's permissions
    if( !current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
    }

    $data = sanitize_text_field( $_POST['guisopo_testimonial_author'] ); // same as name field
    update_post_meta($post_id, '_guisopo_testimonial_author_key', $data);

  }

}
