<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Solacards
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <!-- fafa-icon -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- Font family Montserrat-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
  <!-- jQuery select2  -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


  <?php wp_head(); ?>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" media='all' />
</head>
<?php

$cart_count = WC()->cart->get_cart_contents_count();

?>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'solacards'); ?></a>

    <?php
    /*
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$solacards_description = get_bloginfo( 'description', 'display' );
			if ( $solacards_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $solacards_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'solacards' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	*/
    ?>

    <header class="card-header-fix">
      <div class="card-header">
        <div class="card-header__top-bar brand-bg-color">
          <div class="card-item__container">
            <?php if (is_user_logged_in()) { ?>
              <div class="card-header__top-bar-item font-family__monserrat">
                <a href="<?php echo site_url(); ?>/my-account/" class="card-header__top-bar-list">My Account</a>
                <a href="<?php echo wp_logout_url(site_url('/my-account/')); ?>" class="card-header__top-bar-list">Logout</a>
              </div>
            <?php } else { ?>
              <div class="card-header__top-bar-item font-family__monserrat">
                <a href="<?php echo site_url(); ?>/my-account/" class="card-header__top-bar-list">Login</a>
                <a href="<?php echo site_url(); ?>/my-account/" class="card-header__top-bar-list">Register</a>
              </div>

            <?php } ?>

          </div>
        </div>
        <div class="card-header__main">
          <div class="card-item__container">
            <div class="card-header__wrapper">
              <div class="card-header__wrapper-box nav-menu">
                <div class="toggle-menu"></div>

                <div class="card-header__logo">
                  <a href="<?php echo site_url(); ?>"> <img class="card-header__logo--img" src="<?php echo get_template_directory_uri(); ?>/assets/img/Solacards-logo.png" alt="site-logo" /></a>
                </div>
                <nav class="card-header__nav-menu font-family__monserrat">
                  <!-- <ul class="card-header__menu-list">
                    <li>
                      <a href="<?php echo site_url(); ?>/product-category/gift-cards/">GIFT CARDS</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url(); ?>/product-category/other-card/">OTHER CARDS</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url(); ?>/product-category/card-holder/">CARD HOLDERS</a>
                    </li>
                   
                  </ul> -->
                  <?php
                  wp_nav_menu(array(
                    'menu'  => '19',
                    'menu_class'      => 'card-header__menu-list',
                    'container'       => false, // Removes the default `div` container
                    'walker'         => new Custom_Nav_Walker(), // Custom walker for submenus
                  ));
                  ?>
                </nav>
              </div>
              <div class="card-header__wrapper-box">
                <div class="card-header__search-box">
                  <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="card-header__search-bar">
                      <input class="card-header__search-bar-input" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search..." />
                      <input type="hidden" name="post_type" value="product" /> <!-- Ensures it searches only products -->
                    </div>
                  </form>

                </div>
                <div class="card-header__cart-button">
                  <a href="<?php echo site_url(); ?>/cart/" class="my-cart-link">
                    <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 192 192" fill="none">
                      <path d="M154.42 111.7H58.94L44.79 48.23H167.59L154.42 111.7Z" stroke="black" stroke-width="9" stroke-miterlimit="10" />
                      <path d="M44.7901 48.23L37.7201 23H20.1101" stroke="black" stroke-width="10" stroke-miterlimit="10" />
                      <path d="M58.98 129.12V111.75" stroke="black" stroke-width="9" stroke-miterlimit="10" />
                      <path d="M124.4 154.03H83.89" stroke="black" stroke-width="9" stroke-miterlimit="10" />
                      <path d="M59.04 170.66C68.23 170.66 75.68 163.21 75.68 154.02C75.68 144.83 68.23 137.38 59.04 137.38C49.85 137.38 42.4 144.83 42.4 154.02C42.4 163.21 49.85 170.66 59.04 170.66Z" fill="black" />
                      <path d="M149.34 170.63C158.53 170.63 165.98 163.18 165.98 153.99C165.98 144.8 158.53 137.35 149.34 137.35C140.15 137.35 132.7 144.8 132.7 153.99C132.7 163.18 140.15 170.63 149.34 170.63Z" fill="black" />
                      <path d="M51.89 79.96H161" stroke="black" stroke-width="9" stroke-miterlimit="10" />
                    </svg>
                  </a>

                  <!-- <i class="fas fa-shopping-cart cart--icon"></i> -->
                  <?php if ($cart_count > 0) { ?>
                    <div class="card-header__cart-action"><?php echo $cart_count; ?></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>