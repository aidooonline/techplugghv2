<?php if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! taxonomy_exists( 'product_cat' ) ) { return; }
$cats = get_terms( array( 'taxonomy'=>'product_cat','hide_empty'=>true,'number'=>8,'orderby'=>'count','order'=>'DESC' ) );
if ( is_wp_error( $cats ) || ! $cats ) { return; }
?>
<section class="wrap py-16 sm:py-20">
	<div class="flex items-end justify-between mb-8 gap-4">
		<div>
			<span class="eyebrow">Shop by brand</span>
			<h2 class="section-title mt-2">Choose your <span class="gradient-text">brand</span></h2>
		</div>
		<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="menu-link hidden sm:block text-aur-blue">All laptops &rarr;</a>
	</div>
	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
		<?php foreach ( $cats as $cat ) :
			$thumb_id = (int) get_term_meta( $cat->term_id, 'thumbnail_id', true ); ?>
			<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="card-glow group p-5 flex flex-col items-center text-center hover:-translate-y-1 hover:border-aur-blue/50 hover:shadow-glow transition">
				<span class="w-20 h-20 rounded-2xl overflow-hidden bg-gradient-to-br from-aur-elevated to-aur-base flex items-center justify-center mb-3">
					<?php tpg_image_or_placeholder( $thumb_id, 'medium', 'w-full h-full object-cover group-hover:scale-105 transition duration-500' ); ?>
				</span>
				<span class="font-display font-semibold text-sm text-aur-paper group-hover:text-aur-blue transition-colors line-clamp-1"><?php echo esc_html( str_replace( ' Laptops', '', $cat->name ) ); ?></span>
				<span class="text-[11px] text-aur-muted mt-0.5"><?php echo esc_html( $cat->count ); ?> in stock</span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
