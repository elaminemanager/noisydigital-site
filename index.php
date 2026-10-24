<?php
/* Liste des articles (Les échos du digital) et archives. */
get_header(); ?>
<div class="light">
  <div class="wrap page-head" style="border-color:var(--line-on-light)">
    <p class="eyebrow"><?php esc_html_e( 'Blog', 'noisy' ); ?></p>
    <h1><?php if ( is_home() ) { echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ?: 'Les échos du digital' ); } elseif ( is_archive() ) { the_archive_title(); } elseif ( is_search() ) { printf( esc_html__( 'Recherche : %s', 'noisy' ), esc_html( get_search_query() ) ); } ?></h1>
  </div>
  <div class="wrap section">
    <?php if ( have_posts() ) : ?>
    <div class="post-list">
      <?php while ( have_posts() ) : the_post(); ?>
      <a class="post-card" href="<?php the_permalink(); ?>">
        <small><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></small>
        <h3><?php the_title(); ?></h3>
        <p class="muted" style="font-size:14px"><?php echo esc_html( get_the_excerpt() ); ?></p>
        <span class="read"><?php esc_html_e( 'Lire', 'noisy' ); ?></span>
      </a>
      <?php endwhile; ?>
    </div>
    <div class="pagination"><?php echo paginate_links(); ?></div>
    <?php else : ?><p><?php esc_html_e( 'Aucun article pour le moment.', 'noisy' ); ?></p><?php endif; ?>
  </div>
</div>
<?php get_footer();
