<?php
$client = get_post_meta( get_the_ID(), 'client', true );
$annee  = get_post_meta( get_the_ID(), 'annee', true );
$label  = get_post_meta( get_the_ID(), 'label', true );
$accroche = get_post_meta( get_the_ID(), 'accroche', true );
$kicker = $label ?: trim( implode( ' · ', array_filter( [ $client, $annee ] ) ) );
?>
<a class="case" href="<?php the_permalink(); ?>">
  <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'noisy-card', [ 'alt' => '', 'loading' => 'lazy' ] ); } else { noisy_img( 'tama-drum.jpg', '' ); } ?>
  <div class="txt">
    <?php if ( $kicker ) : ?><small><?php echo esc_html( $kicker ); ?></small><?php endif; ?>
    <h3><?php the_title(); ?></h3>
    <?php if ( $accroche ) : ?><p><?php echo esc_html( $accroche ); ?></p><?php elseif ( has_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
  </div>
</a>
