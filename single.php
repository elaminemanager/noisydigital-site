<?php get_header(); the_post(); ?>
<div class="light">
  <div class="wrap page-head" style="border-color:var(--line-on-light)">
    <p class="eyebrow"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></p>
    <h1><?php the_title(); ?></h1>
  </div>
  <div class="wrap section">
    <?php if ( has_post_thumbnail() ) : ?><div style="max-width:900px;margin-bottom:28px"><?php the_post_thumbnail( 'noisy-wide', [ 'alt' => '' ] ); ?></div><?php endif; ?>
    <div class="prose"><?php the_content(); ?></div>
    <p style="margin-top:40px"><a class="btn ink" href="<?php echo esc_url( home_url( '/les-echos-du-digital/' ) ); ?>"><?php esc_html_e( 'Tous les articles', 'noisy' ); ?></a></p>
  </div>
</div>
<?php get_footer();
