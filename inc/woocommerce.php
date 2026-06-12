<?php
/**
 * WooCommerce integration & tweaks.
 *
 * @package TechPlugGH
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Remove default WooCommerce wrappers; add our own. */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', function () {
	echo '<div class="wrap py-10 sm:py-14"><div class="woocommerce-page-inner">';
}, 10 );
add_action( 'woocommerce_after_main_content', function () {
	echo '</div></div>';
}, 10 );

/** No WooCommerce sidebar - full-width shop. */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/** Products per row / per page. */
add_filter( 'loop_shop_columns', function () { return 4; } );
add_filter( 'loop_shop_per_page', function () { return 12; } );

/** Archive add-to-cart button label. */
add_filter( 'woocommerce_product_add_to_cart_text', function ( $text, $product ) {
	if ( is_shop() || is_product_category() || is_product_taxonomy() ) {
		return $product && ! $product->is_in_stock() ? __( 'Out of stock', 'techpluggh' ) : __( 'Add to cart', 'techpluggh' );
	}
	return $text;
}, 10, 2 );




/** Move sale flash & rating styling handled in CSS; reposition not required. */

/** Breadcrumb defaults. */
add_filter( 'woocommerce_breadcrumb_defaults', function ( $defaults ) {
	$defaults['delimiter']   = ' <span class="text-aur-muted">/</span> ';
	$defaults['wrap_before'] = '<nav class="tpg-breadcrumb font-mono text-xs uppercase tracking-widest text-aur-muted mb-6">';
	$defaults['wrap_after']  = '</nav>';
	return $defaults;
} );

/** Currency symbol spacing already handled by WC GHS setting. */

/** Default catalog ordering: alphabetical title sort groups products by brand and model. */
add_filter( 'woocommerce_default_catalog_orderby', function () { return 'title'; } );

/** Related products: show 4, matching the shop grid. */
add_filter( 'woocommerce_output_related_products_args', function ( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
} );

/* =========================================================
   Cart system: header count fragment, mini-cart drawer items,
   AJAX add-to-cart styling hooks, WhatsApp cart checkout.
   ========================================================= */

/** Mini-cart drawer item list (also returned as an AJAX fragment). */
function tpg_minicart_items_html() {
	ob_start();
	echo '<div id="tpg-minicart-items">';
	if ( WC()->cart && ! WC()->cart->is_empty() ) {
		foreach ( WC()->cart->get_cart() as $key => $item ) {
			$p = $item['data'];
			if ( ! $p || ! $p->exists() ) { continue; }
			$thumb = $p->get_image( array( 64, 64 ), array( 'class' => 'w-14 h-14 rounded-lg object-contain bg-aur-base border border-aur-line p-1' ) );
			printf(
				'<div class="flex items-center gap-3 py-3 border-b border-aur-line/70">
					<a href="%1$s" class="shrink-0">%2$s</a>
					<div class="min-w-0 flex-1">
						<a href="%1$s" class="block font-display text-[13px] font-semibold text-aur-paper leading-snug line-clamp-2 hover:text-aur-blue">%3$s</a>
						<span class="text-xs text-aur-muted">%4$s &times; %5$s</span>
					</div>
					<a href="%6$s" class="shrink-0 text-aur-muted hover:text-aur-pink p-1" aria-label="%7$s">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/></svg>
					</a>
				</div>',
				esc_url( get_permalink( $p->get_id() ) ),
				$thumb,
				esc_html( $p->get_name() ),
				esc_html( $item['quantity'] ),
				wp_kses_post( wc_price( wc_get_price_to_display( $p ) ) ),
				esc_url( wc_get_cart_remove_url( $key ) ),
				esc_attr__( 'Remove', 'techpluggh' )
			);
		}
		printf(
			'<div class="flex items-center justify-between pt-4 text-sm"><span class="text-aur-muted">%s</span><span class="font-display font-bold gradient-text text-lg">%s</span></div>',
			esc_html__( 'Subtotal', 'techpluggh' ),
			wp_kses_post( WC()->cart->get_cart_subtotal() )
		);
	} else {
		echo '<p class="py-8 text-center text-sm text-aur-muted">' . esc_html__( 'Your cart is empty.', 'techpluggh' ) . '</p>';
	}
	echo '</div>';
	return ob_get_clean();
}

/** Fragments: header count + drawer items refresh on every cart change. */
add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	$fragments['span.tpg-cart-count'] = '<span class="tpg-cart-count" data-count="' . esc_attr( $count ) . '">' . esc_html( $count ) . '</span>';
	$fragments['div#tpg-minicart-items'] = tpg_minicart_items_html();
	return $fragments;
} );

/** Cart page (classic shortcode): swap Proceed to checkout for WhatsApp checkout. */
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action( 'woocommerce_proceed_to_checkout', function () {
	if ( function_exists( 'tpg_wa_cart_url' ) && function_exists( 'tpg_wa_number' ) && tpg_wa_number() ) {
		echo '<a href="' . esc_url( tpg_wa_cart_url() ) . '" class="checkout-button button alt wc-forward" style="width:100%;text-align:center">' . esc_html__( 'Checkout', 'techpluggh' ) . '</a>';
	} else {
		woocommerce_button_proceed_to_checkout();
	}
}, 20 );
