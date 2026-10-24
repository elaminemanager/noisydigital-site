<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#content"><?php esc_html_e( 'Aller au contenu', 'noisy' ); ?></a>
<header class="site-head dark">
  <div class="wrap nav">
    <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="NOISY DIGITAL, accueil">
      <?php noisy_img( 'logo-white.png', 'NOISY DIGITAL', 'width="572" height="156"' ); ?>
    </a>
    <button class="burger" type="button" aria-expanded="false" aria-controls="menu-principal"><span></span><span></span><span></span><span class="sr"><?php esc_html_e( 'Menu', 'noisy' ); ?></span></button>
    <nav id="menu-principal" class="menu" aria-label="<?php esc_attr_e( 'Navigation principale', 'noisy' ); ?>">
      <?php
      wp_nav_menu( [ 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu-list', 'fallback_cb' => 'noisy_menu_fallback', 'depth' => 1 ] );
      ?>
      <a class="btn red small" href="<?php echo esc_url( home_url( '/contactez-nous/' ) ); ?>"><?php esc_html_e( 'Parlons-en', 'noisy' ); ?></a>
    </nav>
  </div>
</header>
<main id="content">
