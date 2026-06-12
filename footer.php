<?php
/**
 * Footer (v2) + on-page WhatsApp chat box.
 * @package TechPlugGH
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop' );
?>
</main>

<footer class="border-t border-aur-line bg-aur-base mt-20">
	<div class="wrap py-14 grid gap-10 md:grid-cols-2 lg:grid-cols-4">
		<div>
			<?php tpg_logo(); ?>
			<p class="mt-4 text-sm text-aur-muted max-w-xs leading-relaxed">
				<?php esc_html_e( 'Quality UK used laptops for students, professionals and businesses across Ghana. Tested, graded and warranty-backed.', 'techpluggh' ); ?>
			</p>
			<div class="flex gap-3 mt-5">
				<?php
				$socials = array( 'tpg_fb' => 'Facebook', 'tpg_ig' => 'Instagram', 'tpg_tiktok' => 'TikTok', 'tpg_x' => 'X' );
				foreach ( $socials as $key => $name ) {
					$url = tpg_opt( $key );
					if ( $url ) {
						printf( '<a href="%s" target="_blank" rel="noopener" class="chip hover:border-aur-blue hover:text-aur-blue">%s</a>', esc_url( $url ), esc_html( $name ) );
					}
				}
				?>
			</div>
		</div>

		<div>
			<h4 class="text-sm font-display font-semibold text-aur-paper mb-4"><?php esc_html_e( 'Shop', 'techpluggh' ); ?></h4>
			<ul class="space-y-2.5 text-sm text-aur-muted">
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'All laptops', 'techpluggh' ); ?></a></li>
				<?php
				if ( taxonomy_exists( 'product_cat' ) ) {
					$cats = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'number' => 6 ) );
					if ( ! is_wp_error( $cats ) ) {
						foreach ( $cats as $cat ) {
							printf( '<li><a class="hover:text-aur-blue" href="%s">%s</a></li>', esc_url( get_term_link( $cat ) ), esc_html( $cat->name ) );
						}
					}
				}
				?>
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/deals' ) ); ?>"><?php esc_html_e( 'Deals & Offers', 'techpluggh' ); ?></a></li>
			</ul>
		</div>

		<div>
			<h4 class="text-sm font-display font-semibold text-aur-paper mb-4"><?php esc_html_e( 'Help', 'techpluggh' ); ?></h4>
			<ul class="space-y-2.5 text-sm text-aur-muted">
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/how-to-order' ) ); ?>"><?php esc_html_e( 'How to Order', 'techpluggh' ); ?></a></li>
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/warranty-policy' ) ); ?>"><?php esc_html_e( 'Warranty Policy', 'techpluggh' ); ?></a></li>
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/return-policy' ) ); ?>"><?php esc_html_e( 'Return Policy', 'techpluggh' ); ?></a></li>
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/delivery-policy' ) ); ?>"><?php esc_html_e( 'Delivery Policy', 'techpluggh' ); ?></a></li>
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'techpluggh' ); ?></a></li>
				<li><a class="hover:text-aur-blue" href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'techpluggh' ); ?></a></li>
			</ul>
		</div>

		<div>
			<h4 class="text-sm font-display font-semibold text-aur-paper mb-4"><?php esc_html_e( 'Contact', 'techpluggh' ); ?></h4>
			<ul class="space-y-2.5 text-sm text-aur-muted">
				<?php if ( tpg_opt( 'tpg_phone' ) ) : ?><li><a class="hover:text-aur-blue" href="tel:<?php echo esc_attr( tpg_opt( 'tpg_phone' ) ); ?>"><?php echo esc_html( tpg_opt( 'tpg_phone' ) ); ?></a></li><?php endif; ?>
				<?php if ( tpg_wa_number() ) : ?><li><a class="hover:text-aur-blue" target="_blank" rel="noopener" href="<?php echo tpg_wa_link( __( 'Hi TechPlug GH!', 'techpluggh' ) ); ?>"><?php esc_html_e( 'WhatsApp us', 'techpluggh' ); ?></a></li><?php endif; ?>
				<?php if ( tpg_opt( 'tpg_email' ) ) : ?><li><a class="hover:text-aur-blue" href="mailto:<?php echo esc_attr( tpg_opt( 'tpg_email' ) ); ?>"><?php echo esc_html( tpg_opt( 'tpg_email' ) ); ?></a></li><?php endif; ?>
				<?php if ( tpg_opt( 'tpg_address' ) ) : ?><li><?php echo esc_html( tpg_opt( 'tpg_address' ) ); ?></li><?php endif; ?>
			</ul>
			<div class="flex flex-wrap gap-2 mt-5">
				<span class="chip">MoMo</span>
				<span class="chip">Bank Transfer</span>
				<span class="chip">Pay on Delivery</span>
			</div>
		</div>
	</div>

	<div class="border-t border-aur-line">
		<div class="wrap py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-aur-muted">
			<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Plug Into Quality.', 'techpluggh' ); ?></p>
			<p class="font-mono uppercase tracking-widest"><?php esc_html_e( 'Accra · Tema · Nationwide courier', 'techpluggh' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
