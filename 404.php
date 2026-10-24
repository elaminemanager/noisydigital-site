<?php get_header(); ?>
<div class="light"><div class="wrap section" style="min-height:50vh">
  <p class="eyebrow">404</p>
  <h1 style="font-size:clamp(40px,6vw,80px);text-transform:uppercase"><?php esc_html_e( 'Cette page n\'existe plus.', 'noisy' ); ?></h1>
  <p class="prose"><?php esc_html_e( 'Le site a été refondu. Ce que vous cherchez se trouve sûrement dans nos services ou nos réalisations.', 'noisy' ); ?></p>
  <p class="cta"><a class="btn red" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'noisy' ); ?></a> <a class="btn dark" href="<?php echo esc_url( home_url( '/realisations/' ) ); ?>"><?php esc_html_e( 'Réalisations', 'noisy' ); ?></a></p>
</div></div>
<?php get_footer();
