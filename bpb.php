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


  wp_register_script( 'bpb', plugin_dir_url( __FILE__ ) . 'bpb-scripts.js', array( 'jquery' ), '1.0', bpblse );

  wp_enqueue_script( 'bpb', plugin_dir_url( __FILE__ ) . 'bpb-scripts.js', array( 'jquery' ), '1.0', bpblse );

  $ajax_args = array(
    'ajax_url'    => admin_url( 'admin-ajax.php' ), 
    'ajax_nonce'  => wp_create_nonce( 'bpb' ),   
  );
  wp_localize_script( 'bpb', 'bpb_ajax', $ajax_args );
}
add_action( 'admin_enqueue_scripts', 'bpb_enqueue_scripts', 30 );
