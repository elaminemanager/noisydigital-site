<?php get_header(); the_post(); ?>
<div class="light">
  <div class="wrap page-head" style="border-color:var(--line-on-light)">
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?><p class="lead" style="color:var(--muted-on-light)"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
  </div>
  <div class="wrap section"><div class="prose"><?php the_content(); ?></div></div>
</div>
<?php get_footer();
