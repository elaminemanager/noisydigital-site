<?php get_header(); the_post();
$m = fn( $k ) => get_post_meta( get_the_ID(), $k, true );
$video = $m( 'video' ); $yt = '';
if ( $video && preg_match( '~(?:youtu\.be/|youtube\.com/(?:watch\?v=|live/|embed/))([A-Za-z0-9_-]{6,})~', $video, $mm ) ) { $yt = $mm[1]; }
?>
<div class="dark">
  <div class="wrap page-head">
    <p class="eyebrow"><?php echo esc_html( trim( implode( ' · ', array_filter( [ $m( 'client' ), $m( 'annee' ) ] ) ) ) ?: 'Réalisation' ); ?></p>
    <h1><?php the_title(); ?></h1>
    <?php if ( $m( 'accroche' ) ) : ?><p class="lead"><?php echo esc_html( $m( 'accroche' ) ); ?></p><?php endif; ?>
  </div>
</div>
<div class="light">
  <div class="wrap section two-col">
    <div>
      <?php if ( $yt ) : ?><div class="video"><iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $yt ); ?>" title="<?php the_title_attribute(); ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe></div>
      <?php elseif ( has_post_thumbnail() ) : ?><div style="margin-bottom:28px;max-width:720px"><?php the_post_thumbnail( 'large', [ 'alt' => '' ] ); ?></div><?php endif; ?>
      <div class="prose"><?php the_content(); ?></div>
    </div>
    <aside>
      <dl class="facts">
        <?php foreach ( [ 'client' => 'Client', 'annee' => 'Année', 'chiffre' => 'Chiffre clé' ] as $k => $l ) : if ( $m( $k ) ) : ?><dt><?php echo esc_html( $l ); ?></dt><dd><?php echo esc_html( $m( $k ) ); ?></dd><?php endif; endforeach; ?>
        <?php if ( $video ) : ?><dt><?php esc_html_e( 'Voir', 'noisy' ); ?></dt><dd><a href="<?php echo esc_url( $video ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Ouvrir la vidéo', 'noisy' ); ?></a></dd><?php endif; ?>
      </dl>
      <p style="margin-top:22px"><a class="btn red" href="<?php echo esc_url( home_url( '/contactez-nous/' ) ); ?>"><?php esc_html_e( 'Un projet similaire ?', 'noisy' ); ?></a></p>
    </aside>
  </div>
</div>
<div class="dark">
  <?php noisy_ticker( 'Autres réalisations', 'lg red', false, 8 ); ?>
  <div class="wrap section tight"><div class="cases">
    <?php $q = new WP_Query( [ 'post_type' => 'realisation', 'posts_per_page' => 3, 'post__not_in' => [ get_the_ID() ], 'orderby' => 'menu_order', 'order' => 'ASC' ] ); while ( $q->have_posts() ) : $q->the_post(); get_template_part( 'template-parts/card', 'realisation' ); endwhile; wp_reset_postdata(); ?>
  </div></div>
</div>
<?php get_footer();
