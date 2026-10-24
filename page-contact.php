<?php /* Template Name: Contact */ get_header(); the_post(); ?>
<div class="light">
  <div class="wrap page-head" style="border-color:var(--line-on-light)">
    <p class="eyebrow"><?php esc_html_e( 'Contact', 'noisy' ); ?></p>
    <h1><?php echo esc_html( noisy_opt( 'contact_title' ) ); ?></h1>
    <p class="lead" style="color:var(--muted-on-light)"><?php echo esc_html( noisy_opt( 'contact_text' ) ); ?></p>
  </div>
  <div class="wrap section two-col">
    <div class="prose"><?php the_content(); ?></div>
    <aside>
      <dl class="facts">
        <dt><?php esc_html_e( 'Adresse', 'noisy' ); ?></dt><dd><?php echo esc_html( noisy_opt( 'address' ) ); ?></dd>
        <dt><?php esc_html_e( 'Téléphone', 'noisy' ); ?></dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', noisy_opt( 'phone1' ) ) ); ?>"><?php echo esc_html( noisy_opt( 'phone1' ) ); ?></a><br><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', noisy_opt( 'phone2' ) ) ); ?>"><?php echo esc_html( noisy_opt( 'phone2' ) ); ?></a></dd>
        <dt>Email</dt><dd><a href="mailto:<?php echo esc_attr( noisy_opt( 'email' ) ); ?>"><?php echo esc_html( noisy_opt( 'email' ) ); ?></a></dd>
        <?php if ( noisy_whatsapp_url() ) : ?><dt>WhatsApp</dt><dd><a href="<?php echo esc_url( noisy_whatsapp_url() ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Écrire sur WhatsApp', 'noisy' ); ?></a></dd><?php endif; ?>
      </dl>
    </aside>
  </div>
</div>
<?php get_footer();
