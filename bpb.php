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


  wp_register_script( 'bpb', plugin_dir_url( __FILE__ ) . 'bpb-scripts.js', array( 'jquery' ), '1.0', false );

  wp_enqueue_script( 'bpb', plugin_dir_url( __FILE__ ) . 'bpb-scripts.js', array( 'jquery' ), '1.0', false );

  $ajax_args = array(
    'ajax_url'    => admin_url( 'admin-ajax.php' ), 
    'ajax_nonce'  => wp_create_nonce( 'bpb' ),   
  );
  wp_localize_script( 'bpb', 'bpb_ajax', $ajax_args );
}
add_action( 'admin_enqueue_scripts', 'bpb_enqueue_scripts', 30 );

function bpb_create_menu() {

  add_menu_page( 'Bulk Products Backorder', 'Bulk Products Backorder', 'administrator', 'bulk-products-backorder', 'bulk_products_backorder' , 'dashicons-admin-tools' );
}
add_action( 'admin_menu', 'bpb_create_menu' );


function bulk_products_backorder() {
?>
<div class="wrap">
  <h1>Bulk Products Backorder</h1>
  <p>This plugin sets backorder to all products with one click.</p>
  <button class="button button-primary" id="bpb-trigger">Set backorder to all products</button>
</div>
<div class="response"></div>  
<?php }

function bpb() {
  
  $products_args = array(
    'post_type'     =>  'product',
    'posts_per_page'  =>  -1
  );

  $products = NEW WP_Query( $products_args );

  ob_start();
  $count = 1;

  while( $products->have_posts() ) {  
    $products->the_post();
    $wc_product = wc_get_product( get_the_ID() );

    $wc_product->set_manage_stock( 'yes' );
    $wc_product->set_backorders( 'notify' );
    $wc_product->save();
   
    echo $count . ' <h2>' . the_title() . '</h2><br/>';
    echo '<hr><br>';
    $count ++;
  }
  $response = ob_get_clean();
  wp_send_json_success( $response );

  wp_die();
}
add_action( 'wp_ajax_bpb', 'bpb' );
// add_action( 'wp_ajax_nopriv_fix_attributes', 'fix_attributes' )