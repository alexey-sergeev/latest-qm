<?php
/**
 * The theme header.
 *
 * @package Latest
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
	<header id="masthead" class="site-header">

		<?php if(is_active_sidebar( 'latest-top-bar' )): ?>
		<div id="top-bar">
			<div class="container">
				<?php 
					dynamic_sidebar( 'latest-top-bar' );
				?>
			</div>
		</div>
		<?php endif; ?>

		<div class="container clearfix">

			<div id="site-branding">
				<?php if ( get_theme_mod( 'custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
					<?php if ( is_front_page() ) { ?>
						<h1 class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } else { ?>
						<p class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php } 
					} ?>
				
			</div><!-- #site-branding -->

			<div class="site-description"><?php bloginfo( 'description' ); ?></div>

		</div>


			<div id="site-navigation" role="navigation">
				<div class="container clearfix">
					<a class="toggle-nav" href="javascript:void(0);"><span></span></a>

					<div class="site-main-menu">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'fallback_cb'    => 'latest_primary_menu_fallback',
						)
					); ?>
					</div>


				</div>
			</div>

	</header><!-- #masthead -->
	                        
	<div id="content" class="site-content clearfix">
	                                         
	<?php latest_header_title(); ?>           
	<p><br />
	<!-- <div class="container clearfix"> -->