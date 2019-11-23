<?php
/*
Plugin Name: BestSeller
Description: Visar 10 Bäst säljande produkter
Version: 1.0
Author: Alexander Maktabi
*/

add_shortcode( 'bestselling_products', 'bestselling_products' );
function bestselling_products($atts){
	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'tax' => 'product_cat',
		'per_cat' => '10',
		'columns' => '3',
	), $atts));

	ob_start();
	// setup query
	$args = array(
		'post_type' 			=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'   => 1,
		'posts_per_page'		=> $per_cat,
		'meta_key' 		 		=> 'total_sales',
		'orderby' 		 		=> 'meta_value_num'
	);

	// set woocommerce columns
	$woocommerce_loop['columns'] = $columns;

	// query database
	$products = new WP_Query( $args );
  // The loop that shows the bestsellers
	if ( $products->have_posts() ) : ?>
		<?php woocommerce_product_loop_start(); ?>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile;  ?>
		<?php woocommerce_product_loop_end(); ?>
	<?php endif;
	wp_reset_postdata();
  // The html output
	return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
}
?>
