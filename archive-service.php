<?php get_header(); ?>
<div class="light">
  <?php noisy_ticker( 'Services', 'xl red', false, 12 ); ?>
  <div class="wrap page-head" style="border-color:var(--line-on-light);padding-top:12px">
    <h1><?php esc_html_e( 'Quatre métiers, une seule exigence', 'noisy' ); ?></h1>
    <p class="lead" style="color:var(--muted-on-light)"><?php esc_html_e( 'De la conception stratégique à la réalisation technique, jusqu\'à la diffusion multi-plateforme. Une équipe stable, bilingue, habituée aux exigences des institutions et des bailleurs.', 'noisy' ); ?></p>
  </div>
  <div class="wrap section tight">
    <div class="services">
      <?php $q = new WP_Query( [ 'post_type' => 'service', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
      while ( $q->have_posts() ) : $q->the_post(); $code = get_post_meta( get_the_ID(), 'code', true ); $prest = array_filter( array_map( 'trim', explode( ';', (string) get_post_meta( get_the_ID(), 'prestations', true ) ) ) ); ?>
      <article class="svc">
        <?php if ( $code ) : ?><span class="n"><?php echo esc_html( $code ); ?></span><?php endif; ?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php if ( $prest ) : ?><ul><?php foreach ( $prest as $p ) : ?><li><?php echo esc_html( $p ); ?></li><?php endforeach; ?></ul><?php endif; ?>
        <p style="margin-top:16px"><a class="read" style="font:600 13px/1 var(--body);color:var(--red);text-decoration:none" href="<?php the_permalink(); ?>"><?php esc_html_e( 'En savoir plus', 'noisy' ); ?></a></p>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</div>
<?php get_footer();
