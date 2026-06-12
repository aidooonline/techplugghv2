<?php if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! taxonomy_exists( 'product_cat' ) ) { return; }
$cats = tpg_brand_terms( 6 );
if ( ! $cats ) { return; }
?>
<section class="wrap py-16 sm:py-20">
	<div class="flex items-end justify-between mb-8 gap-4">
		<div>
			<span class="eyebrow">Shop by brand</span>
			<h2 class="section-title mt-2">Choose your <span class="gradient-text">brand</span></h2>
		</div>
		<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="menu-link hidden sm:block text-aur-blue">All laptops &rarr;</a>
	</div>
	<div class="flex gap-3 sm:gap-4 overflow-x-auto pb-2 -mx-5 px-5 sm:mx-0 sm:px-0 sm:overflow-visible [scrollbar-width:none] [-ms-overflow-style:none]">
		<?php foreach ( $cats as $cat ) :
			$thumb_id = (int) get_term_meta( $cat->term_id, 'thumbnail_id', true ); ?>
			<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="card-glow group shrink-0 w-28 sm:w-auto sm:flex-1 p-4 flex flex-col items-center text-center hover:-translate-y-1 hover:border-aur-blue/50 hover:shadow-glow transition">
				<span class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden bg-gradient-to-br from-aur-elevated to-aur-base flex items-center justify-center mb-3">
					<?php tpg_image_or_placeholder( $thumb_id, 'medium', 'w-full h-full object-cover group-hover:scale-105 transition duration-500' ); ?>
				</span>
				<span class="font-display font-semibold text-sm text-aur-paper group-hover:text-aur-blue transition-colors line-clamp-1"><?php echo esc_html( str_replace( ' Laptops', '', $cat->name ) ); ?></span>
				<span class="text-xs text-aur-muted mt-1"><?php echo esc_html( $cat->count ); ?> in stock</span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
