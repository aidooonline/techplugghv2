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
				<?php if ( tpg_wa_number() ) : ?><li><button type="button" data-open-chat class="hover:text-aur-blue"><?php esc_html_e( 'WhatsApp us', 'techpluggh' ); ?></button></li><?php endif; ?>
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

<?php if ( tpg_wa_number() && ! is_front_page() ) : ?>
<!-- WhatsApp chat box: an on-page chat panel, clearly branded as WhatsApp. Hidden on the homepage. -->
<div id="tpg-chat" class="fixed bottom-5 right-5 z-40">
	<!-- Panel -->
	<div id="tpg-chat-panel" class="hidden absolute bottom-20 right-0 w-[320px] max-w-[88vw] rounded-2xl overflow-hidden border border-aur-line shadow-card bg-aur-surface">
		<div class="flex items-center gap-3 px-4 py-3 bg-[#075E54]">
			<span class="w-9 h-9 rounded-full bg-[#25D366] grid place-items-center shrink-0">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="#fff"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.82 11.82 0 018.413 3.488 11.82 11.82 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24z"/></svg>
			</span>
			<div class="min-w-0">
				<p class="text-white text-sm font-semibold leading-tight"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
				<p class="text-white/70 text-[11px] leading-tight"><?php esc_html_e( 'WhatsApp chat · typically replies fast', 'techpluggh' ); ?></p>
			</div>
			<button type="button" data-close-chat class="ml-auto text-white/80 hover:text-white p-1" aria-label="<?php esc_attr_e( 'Close chat', 'techpluggh' ); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/></svg>
			</button>
		</div>
		<div class="p-4 bg-aur-base min-h-[120px]">
			<div class="max-w-[85%] rounded-2xl rounded-tl-sm bg-aur-elevated px-3.5 py-2.5 text-sm text-aur-paper leading-relaxed">
				<?php esc_html_e( 'Hi! Welcome to TechPlug GH. How can we help you today? Ask about any laptop, price or delivery.', 'techpluggh' ); ?>
			</div>
		</div>
		<form id="tpg-chat-form" class="flex items-center gap-2 p-3 border-t border-aur-line bg-aur-surface">
			<input id="tpg-chat-input" type="text" class="input !py-2.5 !text-sm" placeholder="<?php esc_attr_e( 'Type your message...', 'techpluggh' ); ?>" autocomplete="off">
			<button type="submit" class="shrink-0 w-10 h-10 rounded-full bg-[#25D366] grid place-items-center text-white hover:brightness-110 transition" aria-label="<?php esc_attr_e( 'Send on WhatsApp', 'techpluggh' ); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
			</button>
		</form>
		<p class="px-4 pb-3 text-[10px] text-aur-muted bg-aur-surface"><?php esc_html_e( 'Sending opens WhatsApp with your message.', 'techpluggh' ); ?></p>
	</div>
	<!-- Launcher -->
	<button id="tpg-chat-toggle" type="button" class="w-14 h-14 rounded-full bg-[#25D366] shadow-lg grid place-items-center text-white hover:brightness-110 transition" aria-label="<?php esc_attr_e( 'Open WhatsApp chat', 'techpluggh' ); ?>" data-wa="<?php echo esc_attr( tpg_wa_number() ); ?>">
		<svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.82 11.82 0 018.413 3.488 11.82 11.82 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.978-1.045z"/></svg>
	</button>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
