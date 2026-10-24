</main>
<?php if ( ! is_page_template( 'page-contact.php' ) ) : ?>
<section class="contact-band" id="contact">
  <div class="wrap">
    <div>
      <h2><?php echo esc_html( noisy_opt( 'contact_title' ) ); ?></h2>
      <p><?php echo esc_html( noisy_opt( 'contact_text' ) ); ?></p>
      <div class="cta"><a class="btn light" href="<?php echo esc_url( home_url( '/contactez-nous/' ) ); ?>"><?php esc_html_e( 'Écrire à l\'agence', 'noisy' ); ?></a>
      <?php if ( noisy_whatsapp_url() ) : ?><a class="btn light" href="<?php echo esc_url( noisy_whatsapp_url() ); ?>" target="_blank" rel="noopener">WhatsApp</a><?php endif; ?></div>
    </div>
    <address>
      <b>NOISY DIGITAL</b>
      <?php echo esc_html( noisy_opt( 'address' ) ); ?><br>
      <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', noisy_opt( 'phone1' ) ) ); ?>"><?php echo esc_html( noisy_opt( 'phone1' ) ); ?></a> ·
      <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', noisy_opt( 'phone2' ) ) ); ?>"><?php echo esc_html( noisy_opt( 'phone2' ) ); ?></a><br>
      <a href="mailto:<?php echo esc_attr( noisy_opt( 'email' ) ); ?>"><?php echo esc_html( noisy_opt( 'email' ) ); ?></a>
    </address>
  </div>
</section>
<?php endif; ?>
<footer class="site-foot dark">
  <div class="wrap">
    <div class="foot-grid">
      <div class="foot-brand">
        <?php noisy_img( 'logo-white.png', 'NOISY DIGITAL', 'width="572" height="156"' ); ?>
        <p><?php esc_html_e( 'Agence de relations publiques digitales et de production de contenu, Dakar, depuis 2015.', 'noisy' ); ?></p>
      </div>
      <nav class="foot-nav" aria-label="<?php esc_attr_e( 'Pied de page', 'noisy' ); ?>">
        <?php wp_nav_menu( [ 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'foot-list', 'fallback_cb' => 'noisy_menu_fallback', 'depth' => 1 ] ); ?>
      </nav>
      <ul class="social">
        <?php foreach ( [ 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'instagram' => 'Instagram', 'x' => 'X', 'youtube' => 'YouTube' ] as $k => $l ) : if ( noisy_opt( $k ) ) : ?>
          <li><a href="<?php echo esc_url( noisy_opt( $k ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $l ); ?></a></li>
        <?php endif; endforeach; ?>
      </ul>
    </div>
    <div class="foot-legal">
      <span>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> NOISY DIGITAL SARL</span>
      <span><a href="<?php echo esc_url( home_url( '/mentions-legales/' ) ); ?>"><?php esc_html_e( 'Mentions légales', 'noisy' ); ?></a> · <a href="<?php echo esc_url( home_url( '/politique-de-confidentialite/' ) ); ?>"><?php esc_html_e( 'Confidentialité', 'noisy' ); ?></a></span>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
