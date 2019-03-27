<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package GuisopoPlugin
 * 
 */

 // First we made ALWAYS this security check
 // If WP_UNINSTALL_PLUGIN is not defined somebody is trying to acces uninstall.php not via WordPress
 // 
 if( ! definded( 'WP_UNINSTALL_PLUGIN' ) ) {
  die;
 }

 // Clear DB stored data

//  $books = get_post( array( 'post_type' => 'books', 'numberofposts' => -1 ) );
//  foreach($books as $ book) {
//   wp_delete_post($book->ID, true);
//  }

// Access DB via SQL
global $wpdb;
// !!! Check if I need to use prepare() in order to escape variables passed to SQL. page 117 WP book
// !!! Check if I can use $wpdb->delete($table, $where, $where_format); to delete data. page 121 WP book
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'" );
$wpdb->query( "DELETE FROM wp_postsmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );