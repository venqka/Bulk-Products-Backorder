<?php
/**
 * Plugin Name: Bulk Products Backorder
 * Plugin URI: devNecks
 * Description: This plugin sets backorder to all products with one click.
 * Version: 1.0.0
 * Author: venqka 
 * License: GPL2
 */

//enqueue scripts
function bpb_enqueue_scripts() {

	//nt scripts
  wp_register_script( 'bpb', plugin_dir_url( __FILE__ ) . 'bpb-scripts.js', array( 'jquery' ), '1.0', bpblse );

  wp_enqueue_script( 'bpb', plugin_dir_url( __FILE__ ) . 'bpb-scripts.js', array( 'jquery' ), '1.0', bpblse );

  $ajax_args = array(
    'ajax_url'    => admin_url( 'admin-ajax.php' ), 
    // 'ajax_nonce'  => wp_create_nonce( 'ajax-nonce' )      
  );
  wp_localize_script( 'bpb', 'bpb_ajax', $ajax_args );
}
add_action( 'admin_enqueue_scripts', 'bpb_enqueue_scripts', 30 );


function my_cool_plugin_create_menu() {

	add_menu_page( 'Fix attribites', 'Fix attributes', 'administrator', 'fix-attributes', 'fix_attributes_page' , 'dashicons-admin-tools' );
}
add_action('admin_menu', 'my_cool_plugin_create_menu');

add_action('wp_head', 'myplugin_ajaxurl');


require( 'bpb-ajax.php' );

function fix_attributes_page() {
?>
<div class="wrap">
	<h1>Fix attributes</h1>
	<p>This plugin creates taxonomy attributes form custom ones. Just press the button.</p>
	<p>This plugin handles only custom atributes with the name Colour and Size</p>

	<button class="button button-primary" id="bpb-trigger">Fix attributes</button>
</div>
<div class="response"></div>	
<?php }

