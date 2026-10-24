<?php get_header(); ?>
<div class="light"><div class="wrap section" style="min-height:50vh">
  <p class="eyebrow">410</p>
  <h1 style="font-size:clamp(40px,6vw,80px);text-transform:uppercase"><?php esc_html_e( 'Cette page a été retirée.', 'noisy' ); ?></h1>
  <p class="prose"><?php esc_html_e( 'Elle faisait partie de l\'ancienne version du site. Nos services et nos réalisations sont par ici.', 'noisy' ); ?></p>
  <p class="cta"><a class="btn red" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'noisy' ); ?></a> <a class="btn ink" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'noisy' ); ?></a></p>
</div></div>
<?php get_footer();
