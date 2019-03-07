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
      'Testimonial Options', // title
      array( $this, 'render_features_box' ),  // callback
      'testimonial',  //screen
      'side', // context
      'default' // priority
    );
  }

  public function render_features_box($post) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'guisopo_testimonial', 'guisopo_testimonial_nonce' );
    // Use get_post_meta to retrieve an existing value from the database.
    $data = get_post_meta( $post->ID, '_guisopo_testimonial_key', true );

    $name = isset($data['name']) ? $data['name'] : '' ;
    $email = isset($data['email']) ? $data['email'] : '' ;
    $approved = isset($data['approved']) ? $data['approved'] : false ;
    $featured = isset($data['featured']) ? $data['featured'] : false ;

    // Display the form, using the current value.
    ?>
    <p>
      <label class="meta-label" for="guisopo_testimonial_name">Author Name</label>
      <input  type="text" 
              id="guisopo_testimonial_name" 
              name="guisopo_testimonial_name"
              class="widefat"
              value="<?php echo esc_attr( $name ); ?>">
    </p>
    <p>
      <label class="meta-label" for="guisopo_testimonial_email">Author Email</label>
      <input  type="text" 
              id="guisopo_testimonial_email" 
              name="guisopo_testimonial_email"
              class="widefat"
              value="<?php echo esc_attr( $email ); ?>">
    </p>
    <div class="meta-container">
			<label class="meta-label w-50 text-left" for="guisopo_testimonial_approved">Approved</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline">
          <input  type="checkbox" 
                  id="guisopo_testimonial_approved" 
                  name="guisopo_testimonial_approved" 
                  value="1" 
                  <?php echo $approved ? 'checked' : ''; ?>
          >
					<label for="guisopo_testimonial_approved">
            <div></div>
          </label>
				</div>
			</div>
		</div>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="guisopo_testimonial_featured">Featured</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline">
          <input  type="checkbox" 
                  id="guisopo_testimonial_featured" 
                  name="guisopo_testimonial_featured" 
                  value="1" 
                  <?php echo $featured ? 'checked' : ''; ?>
          >
					<label for="guisopo_testimonial_featured">
            <div></div>
          </label>
				</div>
			</div>
		</div>

    <?php
  }

  public function save_meta_box($post_id) {
    // Check if our nonce is set.
    if( !isset( $_POST['guisopo_testimonial_nonce'] ) ) {
      return $post_id;
    }

    $nonce = $_POST['guisopo_testimonial_nonce'];
    
    // Verify that the nonce is valid.
    if( !wp_verify_nonce( $nonce, 'guisopo_testimonial' ) ){
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

    $data = array(
      'name' => sanitize_text_field( $_POST['guisopo_testimonial_name'] ), // same as input name
      'email' => sanitize_text_field( $_POST['guisopo_testimonial_email'] ),
      'approved' => sanitize_text_field( $_POST['guisopo_testimonial_approved'] ),
      'featured' => sanitize_text_field( $_POST['guisopo_testimonial_featured'] )
    );
    update_post_meta($post_id, '_guisopo_testimonial_key', $data);

  }

}
