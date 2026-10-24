<?php get_header(); the_post(); $code = get_post_meta( get_the_ID(), 'code', true ); $prest = array_filter( array_map( 'trim', explode( ';', (string) get_post_meta( get_the_ID(), 'prestations', true ) ) ) ); ?>
<div class="light">
  <div class="wrap page-head" style="border-color:var(--line-on-light)">
    <p class="eyebrow"><?php esc_html_e( 'Service', 'noisy' ); ?><?php if ( $code ) echo ' · ' . esc_html( $code ); ?></p>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?><p class="lead" style="color:var(--muted-on-light)"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
  </div>
  <div class="wrap section two-col">
    <div class="prose"><?php the_content(); ?></div>
    <aside>
      <?php if ( $prest ) : ?>
      <dl class="facts"><dt><?php esc_html_e( 'Prestations', 'noisy' ); ?></dt><?php foreach ( $prest as $p ) : ?><dd><?php echo esc_html( $p ); ?></dd><?php endforeach; ?></dl>
      <?php endif; ?>
      <p style="margin-top:22px"><a class="btn red" href="<?php echo esc_url( home_url( '/contactez-nous/' ) ); ?>"><?php esc_html_e( 'Demander un devis', 'noisy' ); ?></a></p>
    </aside>
  </div>
</div>
<div class="dark">
  <?php noisy_ticker( 'Réalisations liées', 'lg red', false, 8 ); ?>
  <div class="wrap section tight"><div class="cases">
    <?php $q = new WP_Query( [ 'post_type' => 'realisation', 'posts_per_page' => 3, 'orderby' => 'menu_order', 'order' => 'ASC' ] ); while ( $q->have_posts() ) : $q->the_post(); get_template_part( 'template-parts/card', 'realisation' ); endwhile; wp_reset_postdata(); ?>
  </div></div>
</div>
<?php get_footer();
