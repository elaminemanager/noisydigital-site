<?php
/* Gabarit de secours du thème Noisy. Les gabarits définitifs arrivent avec la refonte. */
get_header(); ?>
<main id="content"><?php while ( have_posts() ) { the_post(); the_title( '<h1>', '</h1>' ); the_content(); } ?></main>
<?php get_footer();
