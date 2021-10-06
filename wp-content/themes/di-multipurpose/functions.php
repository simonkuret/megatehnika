<?php

// Return if accessed this file directly.
if( ! defined( 'ABSPATH' ) ) {
	return;
}

// Load init.php file.
require_once get_template_directory() . '/inc/init.php';

/*
* Do not edit any code of theme, use child theme instead
*/

/* začetek Woocommerce ikona izdelkov */
function dodaj_ikone(){
	ob_start();
	?><div class="wishlist-cart-wrapper clearfix"><?php
					if ( function_exists( 'YITH_WCWL' ) ) {
						$wishlist_url = YITH_WCWL()->get_wishlist_url();
						?>
						<div class="wishlist-wrapper">
							<a class="quick-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>" title="Wishlist">
								<i class="fa fa-heart"></i>
								<span class="wishlist-value"><?php echo absint( yith_wcwl_count_products() ); ?></span>
							</a>
						</div>
						<?php
					}
					if ( class_exists( 'woocommerce' ) ) : ?>
						<div class="cart-wrapper">
							<div class="estore-cart-views">

								<?php $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url(); ?>

								<a href="<?php echo esc_url( $cart_url ); ?>" class="wcmenucart-contents">
									<i class="fa fa-shopping-cart"></i>
									<span class="cart-value"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
								</a> <!-- quick wishlist end -->

								<div class="my-cart-wrap">
									<!--<div class="my-cart"><?php //esc_html_e( 'Total', 'estore' ); ?></div>-->
									<div class="cart-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div>
								</div>
							</div>

							<?php the_widget( 'WC_Widget_Cart', '' ); ?>
						</div>
					<?php endif; ?>
						</div><?php
}
add_shortcode('izdelkiIkona','dodaj_ikone');
// Ensure cart contents update when products are added to the cart via AJAX
add_filter( 'woocommerce_add_to_cart_fragments', 'estore_woocommerce_header_add_to_cart_fragment' );

function estore_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<div class="estore-cart-views">

		<?php $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url(); ?>

		<a href="<?php echo esc_url( $cart_url ); ?>" class="wcmenucart-contents">
			<i class="fa fa-shopping-cart"></i>
			<span class="cart-value"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
		</a> <!-- quick wishlist end -->
		<div class="my-cart-wrap">
			<!--<div class="my-cart"><?php //esc_html_e( 'Total', 'estore' ); ?></div>-->
			<div class="cart-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div>
		</div>
	</div>
	<?php

	$fragments['div.estore-cart-views'] = ob_get_clean();

	return $fragments;
}
/* konec Woocommerce ikona izdelkov */