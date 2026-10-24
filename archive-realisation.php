<?php get_header(); ?>
<div class="dark">
  <?php noisy_ticker( noisy_opt( 'ticker_1' ), 'lg red' ); noisy_ticker( noisy_opt( 'ticker_2' ), 'lg white', true, 6 ); ?>
  <div class="wrap page-head" style="padding-top:12px">
    <h1><?php esc_html_e( 'Réalisations', 'noisy' ); ?></h1>
    <p class="lead"><?php esc_html_e( 'Des campagnes qui ont changé des comportements, des films qui ont fait parler, des récits que le grand public a partagés.', 'noisy' ); ?></p>
  </div>
  <div class="wrap section tight"><div class="cases">
    <?php $q = new WP_Query( [ 'post_type' => 'realisation', 'posts_per_page' => 30, 'orderby' => 'menu_order', 'order' => 'ASC' ] ); while ( $q->have_posts() ) : $q->the_post(); get_template_part( 'template-parts/card', 'realisation' ); endwhile; wp_reset_postdata(); ?>
  </div></div>
</div>
<?php get_footer();
