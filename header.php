<?php
/**
 * Header (v2).
 * @package TechPlugGH
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop' );
// Brand quick-links for the secondary nav bar.
$brand_terms = function_exists( 'tpg_brand_terms' ) ? tpg_brand_terms( 6 ) : array();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:bg-aur-blue focus:text-white focus:px-3 focus:py-2 focus:rounded" href="#main"><?php esc_html_e( 'Skip to content', 'techpluggh' ); ?></a>

<?php if ( tpg_opt( 'tpg_promo_on', true ) && tpg_opt( 'tpg_promo_text' ) ) : ?>
<div class="bg-aurora bg-[length:200%_auto] animate-shimmer text-white text-center text-[12px] sm:text-xs font-medium tracking-wide py-2 px-4">
	<?php echo esc_html( tpg_opt( 'tpg_promo_text' ) ); ?>
</div>
<?php endif; ?>

<header id="site-header" class="sticky top-0 z-40 border-b border-aur-line bg-aur-ink/85 backdrop-blur-md">
	<div class="wrap flex items-center justify-between gap-4 h-16">
		<div class="flex items-center gap-3">
			<button id="tpg-menu-toggle" class="lg:hidden text-aur-paper p-2 -ml-2" aria-label="<?php esc_attr_e( 'Open menu', 'techpluggh' ); ?>" aria-expanded="false">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round"/></svg>
			</button>
			<?php tpg_logo(); ?>
		</div>

		<!-- Center search (prominent for new customers) -->
		<form role="search" method="get" class="hidden md:flex flex-1 max-w-md items-center gap-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="relative w-full">
				<svg class="absolute left-3 top-1/2 -translate-y-1/2 text-aur-muted" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
				<input type="search" name="s" class="input !pl-10" placeholder="<?php esc_attr_e( 'Search laptops, brands, specs...', 'techpluggh' ); ?>" value="<?php echo get_search_query(); ?>">
				<input type="hidden" name="post_type" value="product">
			</div>
		</form>

		<div class="flex items-center gap-2 sm:gap-3">
			<button id="tpg-search-toggle" class="md:hidden text-aur-paper/80 hover:text-aur-blue p-2" aria-label="<?php esc_attr_e( 'Search', 'techpluggh' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
			</button>
			<?php if ( function_exists( 'WC' ) ) :
				$cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
			<button id="tpg-cart-toggle" type="button" class="relative text-aur-paper/80 hover:text-aur-blue p-2" aria-label="<?php esc_attr_e( 'Open cart', 'techpluggh' ); ?>">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6h15l-1.5 9h-12z" stroke-linejoin="round"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M6 6L5 3H2" stroke-linecap="round"/></svg>
				<span class="tpg-cart-bubble absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] px-1 rounded-full bg-aurora text-white text-[10px] font-bold grid place-items-center<?php echo $cart_count ? '' : ' opacity-0'; ?>"><span class="tpg-cart-count" data-count="<?php echo esc_attr( $cart_count ); ?>"><?php echo esc_html( $cart_count ); ?></span></span>
			</button>
			<?php endif; ?>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="hidden sm:inline-flex btn-primary text-xs px-5 py-2.5"><?php esc_html_e( 'Shop all', 'techpluggh' ); ?></a>
		</div>
	</div>

	<!-- Primary + brand nav -->
	<div class="border-t border-aur-line/60 hidden lg:block">
		<div class="wrap flex items-center justify-between h-11">
			<nav aria-label="<?php esc_attr_e( 'Primary', 'techpluggh' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex items-center gap-7',
					'fallback_cb'    => 'tpg_default_menu',
					'depth'          => 2,
					'walker'         => new TPG_Nav_Walker(),
				) );
				?>
			</nav>
			<?php if ( $brand_terms ) : ?>
			<div class="flex items-center gap-2">
				<span class="font-mono text-[10px] uppercase tracking-widest text-aur-muted mr-1"><?php esc_html_e( 'Brands:', 'techpluggh' ); ?></span>
				<?php foreach ( $brand_terms as $bt ) : ?>
					<a href="<?php echo esc_url( get_term_link( $bt ) ); ?>" class="chip hover:border-aur-blue hover:text-aur-blue"><?php echo esc_html( str_replace( ' Laptops', '', $bt->name ) ); ?></a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Mobile search drawer -->
	<div id="tpg-search-drawer" class="hidden border-t border-aur-line bg-aur-base md:hidden">
		<div class="wrap py-4">
			<?php if ( function_exists( 'get_product_search_form' ) ) { get_product_search_form(); } else { get_search_form(); } ?>
		</div>
	</div>
</header>

<!-- Mobile menu -->
<div id="tpg-mobile-menu" class="fixed inset-0 z-50 hidden">
	<div class="absolute inset-0 bg-black/70" data-close></div>
	<div class="absolute left-0 top-0 h-full w-[84%] max-w-xs bg-aur-base border-r border-aur-line p-6 overflow-y-auto translate-x-[-100%] transition-transform duration-300" id="tpg-mobile-panel">
		<div class="flex items-center justify-between mb-8">
			<?php tpg_logo(); ?>
			<button data-close class="text-aur-paper p-2" aria-label="<?php esc_attr_e( 'Close', 'techpluggh' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/></svg>
			</button>
		</div>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'flex flex-col gap-1 text-base',
			'fallback_cb'    => 'tpg_default_menu',
			'depth'          => 2,
		) );
		?>
		<?php if ( $brand_terms ) : ?>
		<p class="font-mono text-[10px] uppercase tracking-widest text-aur-muted mt-8 mb-3"><?php esc_html_e( 'Shop by brand', 'techpluggh' ); ?></p>
		<div class="flex flex-wrap gap-2">
			<?php foreach ( $brand_terms as $bt ) : ?>
				<a href="<?php echo esc_url( get_term_link( $bt ) ); ?>" class="chip"><?php echo esc_html( str_replace( ' Laptops', '', $bt->name ) ); ?></a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<a href="<?php echo esc_url( $shop_url ); ?>" class="btn-primary w-full mt-8"><?php esc_html_e( 'Shop all laptops', 'techpluggh' ); ?></a>
	</div>
</div>

<main id="main" class="min-h-[60vh]">
