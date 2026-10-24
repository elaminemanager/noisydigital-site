<?php
/**
 * Page d'accueil.
 */
get_header();
$hero_id = (int) noisy_opt( 'hero_image', 0 );
?>
<section class="hero-band dark">
  <div class="wrap hero">
    <div>
      <p class="eyebrow"><?php echo esc_html( noisy_opt( 'hero_eyebrow' ) ); ?></p>
      <h1><?php echo noisy_title_accent( noisy_opt( 'hero_title' ) ); ?></h1>
      <p class="lead"><?php echo esc_html( noisy_opt( 'hero_text' ) ); ?></p>
      <div class="cta">
        <a class="btn red" href="<?php echo esc_url( home_url( '/contactez-nous/' ) ); ?>"><?php esc_html_e( 'Parlons de votre projet', 'noisy' ); ?></a>
        <a class="btn" href="#realisations"><?php esc_html_e( 'Voir nos réalisations', 'noisy' ); ?></a>
      </div>
    </div>
    <figure>
      <?php if ( $hero_id ) { echo wp_get_attachment_image( $hero_id, 'noisy-card', false, [ 'alt' => '' ] ); } else { noisy_img( 'djembe-hands.jpg', '', 'width="986" height="1400"' ); } ?>
      <figcaption><?php echo esc_html( noisy_opt( 'hero_caption' ) ); ?></figcaption>
    </figure>
  </div>
</section>

<section class="light" id="services">
  <?php noisy_ticker( 'Services', 'xl red', false, 12 ); ?>
  <div class="wrap section tight">
    <h2 class="sr"><?php esc_html_e( 'Services', 'noisy' ); ?></h2>
    <div class="services">
      <?php
      $services = new WP_Query( [ 'post_type' => 'service', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC', 'no_found_rows' => true ] );
      if ( $services->have_posts() ) : while ( $services->have_posts() ) : $services->the_post();
          $code = get_post_meta( get_the_ID(), 'code', true );
          $prest = array_filter( array_map( 'trim', explode( ';', (string) get_post_meta( get_the_ID(), 'prestations', true ) ) ) );
      ?>
      <article class="svc">
        <?php if ( $code ) : ?><span class="n"><?php echo esc_html( $code ); ?></span><?php endif; ?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php if ( $prest ) : ?><ul><?php foreach ( $prest as $p ) : ?><li><?php echo esc_html( $p ); ?></li><?php endforeach; ?></ul><?php endif; ?>
      </article>
      <?php endwhile; wp_reset_postdata(); else : ?>
      <p class="muted"><?php esc_html_e( 'Les services seront publiés ici.', 'noisy' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="dark" id="realisations">
  <?php noisy_ticker( noisy_opt( 'ticker_1' ), 'lg red' ); ?>
  <?php noisy_ticker( noisy_opt( 'ticker_2' ), 'lg white', true, 6 ); ?>
  <?php noisy_ticker( noisy_opt( 'ticker_3' ), 'lg red' ); ?>
  <div class="wrap section tight">
    <h2 class="sr"><?php esc_html_e( 'Réalisations', 'noisy' ); ?></h2>
    <div class="cases">
      <?php
      $cases = new WP_Query( [ 'post_type' => 'realisation', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC', 'no_found_rows' => true, 'meta_query' => [ 'relation' => 'OR', [ 'key' => 'une', 'value' => '1' ], [ 'key' => 'une', 'compare' => 'NOT EXISTS' ] ] ] );
      if ( $cases->have_posts() ) : while ( $cases->have_posts() ) : $cases->the_post(); get_template_part( 'template-parts/card', 'realisation' ); endwhile; wp_reset_postdata(); endif;
      ?>
    </div>
    <div class="more"><a class="btn" href="<?php echo esc_url( get_post_type_archive_link( 'realisation' ) ); ?>"><?php esc_html_e( 'Toutes les réalisations', 'noisy' ); ?></a></div>
  </div>
</section>

<section class="light" id="clients">
  <?php noisy_ticker( 'Clients', 'xl black', false, 12 ); ?>
  <div class="wrap logos">
    <h2 class="sr"><?php esc_html_e( 'Clients et partenaires', 'noisy' ); ?></h2>
    <?php
    $clients = new WP_Query( [ 'post_type' => 'client', 'posts_per_page' => 30, 'orderby' => 'menu_order', 'order' => 'ASC', 'no_found_rows' => true ] );
    if ( $clients->have_posts() ) : ?>
    <ul class="logowall">
      <?php while ( $clients->have_posts() ) : $clients->the_post(); if ( has_post_thumbnail() ) : ?>
        <li><?php the_post_thumbnail( 'noisy-logo', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?></li>
      <?php endif; endwhile; wp_reset_postdata(); ?>
    </ul>
    <?php endif; ?>
  </div>
  <?php noisy_ticker( 'Les échos du digital', 'lg red', false, 8 ); ?>
  <div class="wrap section tight" id="blog">
    <h2 class="sr"><?php esc_html_e( 'Les échos du digital', 'noisy' ); ?></h2>
    <div class="blog-grid">
      <?php
      $posts = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 3, 'no_found_rows' => true, 'ignore_sticky_posts' => true ] );
      if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post(); ?>
      <a class="post-card" href="<?php the_permalink(); ?>">
        <small><?php echo esc_html( get_the_date( 'F Y' ) ); ?></small>
        <h3><?php the_title(); ?></h3>
        <span class="read"><?php esc_html_e( 'Lire', 'noisy' ); ?></span>
      </a>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
    <div class="more"><a class="btn ink" href="<?php echo esc_url( home_url( '/les-echos-du-digital/' ) ); ?>"><?php esc_html_e( 'Tous les articles', 'noisy' ); ?></a></div>
  </div>
</section>
<?php get_footer();
