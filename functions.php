<?php
/**
 * Thème Noisy, NOISY DIGITAL.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'NOISY_VERSION', '0.2.7' );
require_once get_template_directory() . '/inc/redirects.php';

/* ---------- Réglages de base ---------- */
add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'noisy', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'script', 'style', 'navigation-widgets' ] );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-logo', [ 'height' => 60, 'width' => 220, 'flex-width' => true ] );
    register_nav_menus( [
        'primary' => __( 'Menu principal', 'noisy' ),
        'footer'  => __( 'Pied de page', 'noisy' ),
    ] );
    add_image_size( 'noisy-card', 900, 1200, true );   // cartes réalisations 3:4
    add_image_size( 'noisy-wide', 1600, 900, true );   // bandeaux
    add_image_size( 'noisy-logo', 640, 320, false );   // mur de logos
} );

/* ---------- Styles et scripts ---------- */
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'noisy-fonts', 'https://fonts.googleapis.com/css2?family=Anton&family=Work+Sans:wght@400;500;600&display=swap', [], null );
    wp_enqueue_style( 'noisy', get_stylesheet_uri(), [ 'noisy-fonts' ], NOISY_VERSION );
    wp_enqueue_script( 'noisy', get_template_directory_uri() . '/assets/noisy.js', [], NOISY_VERSION, true );
} );
add_filter( 'style_loader_tag', function ( $html, $handle ) {
    if ( 'noisy-fonts' === $handle ) { $html = str_replace( "rel='stylesheet'", "rel='stylesheet' crossorigin='anonymous'", $html ); }
    return $html;
}, 10, 2 );
add_action( 'wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n" . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );

/* ---------- Types de contenu ---------- */
add_action( 'init', function () {
    register_post_type( 'service', [
        'labels' => [ 'name' => 'Services', 'singular_name' => 'Service', 'add_new_item' => 'Ajouter un service', 'edit_item' => 'Modifier le service' ],
        'public' => true, 'has_archive' => true, 'rewrite' => [ 'slug' => 'services', 'with_front' => false ],
        'menu_icon' => 'dashicons-megaphone', 'menu_position' => 5, 'show_in_rest' => true,
        'supports' => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields' ],
    ] );
    register_post_type( 'realisation', [
        'labels' => [ 'name' => 'Réalisations', 'singular_name' => 'Réalisation', 'add_new_item' => 'Ajouter une réalisation', 'edit_item' => 'Modifier la réalisation' ],
        'public' => true, 'has_archive' => true, 'rewrite' => [ 'slug' => 'realisations', 'with_front' => false ],
        'menu_icon' => 'dashicons-format-video', 'menu_position' => 6, 'show_in_rest' => true,
        'supports' => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields' ],
    ] );
    register_post_type( 'client', [
        'labels' => [ 'name' => 'Clients (logos)', 'singular_name' => 'Client', 'add_new_item' => 'Ajouter un client' ],
        'public' => false, 'show_ui' => true, 'show_in_rest' => true, 'menu_icon' => 'dashicons-groups', 'menu_position' => 7,
        'supports' => [ 'title', 'thumbnail', 'page-attributes' ],
    ] );
    // Champs exposés à l'API REST (saisie dans l'écran "Champs personnalisés")
    foreach ( [ 'client', 'annee', 'accroche', 'chiffre', 'video', 'label' ] as $key ) {
        register_post_meta( 'realisation', $key, [ 'type' => 'string', 'single' => true, 'show_in_rest' => true, 'sanitize_callback' => 'sanitize_text_field' ] );
    }
    register_post_meta( 'service', 'code', [ 'type' => 'string', 'single' => true, 'show_in_rest' => true, 'sanitize_callback' => 'sanitize_text_field' ] );
    register_post_meta( 'service', 'prestations', [ 'type' => 'string', 'single' => true, 'show_in_rest' => true, 'sanitize_callback' => 'sanitize_text_field' ] );
    register_post_meta( 'realisation', 'une', [ 'type' => 'string', 'single' => true, 'show_in_rest' => true, 'sanitize_callback' => 'sanitize_text_field' ] );
} );
add_action( 'after_switch_theme', function () { flush_rewrite_rules(); } );

/* ---------- Personnalisation (textes de l'accueil, coordonnées) ---------- */
add_action( 'customize_register', function ( $wp_customize ) {
    $wp_customize->add_section( 'noisy_home', [ 'title' => 'NOISY : page d\'accueil', 'priority' => 20 ] );
    $wp_customize->add_section( 'noisy_contact', [ 'title' => 'NOISY : coordonnées', 'priority' => 21 ] );
    $fields = [
        'noisy_home' => [
            'hero_eyebrow' => [ 'Surtitre', 'Dakar · depuis 2015' ],
            'hero_title'   => [ 'Titre (la partie entre * * passe en rouge)', 'Faites du bruit pour ce qui *compte.*' ],
            'hero_text'    => [ 'Texte', 'Agence de relations publiques digitales et de production de contenu. Nous transformons les enjeux de développement en récits que le grand public regarde, partage et retient.' ],
            'hero_caption' => [ 'Légende photo', 'Production · Studio NOISY' ],
            'ticker_1'     => [ 'Ligne défilante 1 (réalisations), séparer par ;', 'Communication pour le développement;Film institutionnel;Campagnes de sensibilisation' ],
            'ticker_2'     => [ 'Ligne défilante 2 (réalisations)', 'Un échantillon de nos projets réalisés' ],
            'ticker_3'     => [ 'Ligne défilante 3 (réalisations)', 'Marketing d\'influence;Podcast;Relations presse;Couverture d\'événement' ],
            'contact_title' => [ 'Titre du bloc contact', 'Make noise.' ],
            'contact_text'  => [ 'Texte du bloc contact', 'Un brief, un appel, un café à Yoff. Nous répondons sous 24 heures ouvrées.' ],
        ],
        'noisy_contact' => [
            'address'  => [ 'Adresse', 'N°70 Aéroport Yoff, Dakar 11320' ],
            'phone1'   => [ 'Téléphone 1', '+221 33 867 71 57' ],
            'phone2'   => [ 'Téléphone 2', '+221 77 267 27 02' ],
            'whatsapp' => [ 'WhatsApp (numéro international sans +)', '221772672702' ],
            'email'    => [ 'Email', 'contact@noisydigital.com' ],
            'facebook' => [ 'Facebook', 'https://www.facebook.com/noisydigital/' ],
            'linkedin' => [ 'LinkedIn', 'https://www.linkedin.com/company/noisydigital/' ],
            'instagram'=> [ 'Instagram', 'https://instagram.com/senegaldigital/' ],
            'x'        => [ 'X (Twitter)', 'https://twitter.com/NoisyDigital' ],
            'youtube'  => [ 'YouTube', '' ],
        ],
    ];
    foreach ( $fields as $section => $items ) {
        foreach ( $items as $id => $f ) {
            $wp_customize->add_setting( 'noisy_' . $id, [ 'default' => $f[1], 'sanitize_callback' => 'wp_kses_post' ] );
            $wp_customize->add_control( 'noisy_' . $id, [ 'label' => $f[0], 'section' => $section, 'type' => ( strlen( $f[1] ) > 80 ? 'textarea' : 'text' ) ] );
        }
    }
    $wp_customize->add_setting( 'noisy_hero_image', [ 'sanitize_callback' => 'absint' ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'noisy_hero_image', [ 'label' => 'Photo du hero (portrait 4:5)', 'section' => 'noisy_home', 'mime_type' => 'image' ] ) );
} );

function noisy_opt( $key, $default = '' ) {
    $defaults = [
        'hero_eyebrow' => 'Dakar · depuis 2015', 'hero_title' => 'Faites du bruit pour ce qui *compte.*',
        'hero_text' => 'Agence de relations publiques digitales et de production de contenu. Nous transformons les enjeux de développement en récits que le grand public regarde, partage et retient.',
        'hero_caption' => 'Production · Studio NOISY',
        'ticker_1' => 'Communication pour le développement;Film institutionnel;Campagnes de sensibilisation',
        'ticker_2' => 'Un échantillon de nos projets réalisés',
        'ticker_3' => 'Marketing d\'influence;Podcast;Relations presse;Couverture d\'événement',
        'contact_title' => 'Make noise.', 'contact_text' => 'Un brief, un appel, un café à Yoff. Nous répondons sous 24 heures ouvrées.',
        'address' => 'N°70 Aéroport Yoff, Dakar 11320', 'phone1' => '+221 33 867 71 57', 'phone2' => '+221 77 267 27 02', 'whatsapp' => '221772672702',
        'email' => 'contact@noisydigital.com', 'facebook' => 'https://www.facebook.com/noisydigital/', 'linkedin' => 'https://www.linkedin.com/company/noisydigital/',
        'instagram' => 'https://instagram.com/senegaldigital/', 'x' => 'https://twitter.com/NoisyDigital', 'youtube' => '',
    ];
    $d = $default !== '' ? $default : ( $defaults[ $key ] ?? '' );
    return get_theme_mod( 'noisy_' . $key, $d );
}

/* ---------- Aides d'affichage ---------- */
function noisy_ticker( $text, $class = 'lg red', $reverse = false, $min = 8 ) {
    $items = array_filter( array_map( 'trim', explode( ';', $text ) ) );
    if ( ! $items ) { return; }
    $out = [];
    while ( count( $out ) < $min ) { foreach ( $items as $i ) { $out[] = $i; } }
    echo '<div class="ticker ' . esc_attr( $class ) . ( $reverse ? ' reverse' : '' ) . '" aria-hidden="true"><div class="track">';
    foreach ( $out as $i ) { echo '<span>' . esc_html( $i ) . '</span>'; }
    echo '</div></div>';
}
function noisy_title_accent( $text ) {
    return preg_replace( '/\*(.+?)\*/', '<em>$1</em>', esc_html( $text ) );
}
function noisy_img( $file, $alt = '', $attrs = '' ) {
    echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/' . $file ) . '" alt="' . esc_attr( $alt ) . '" ' . $attrs . '>';
}
function noisy_whatsapp_url() {
    $n = preg_replace( '/\D/', '', noisy_opt( 'whatsapp' ) );
    return $n ? 'https://wa.me/' . $n : '';
}

/* ---------- Extraits et lecture ---------- */
add_filter( 'excerpt_length', fn() => 24 );
add_filter( 'excerpt_more', fn() => '…' );

/* ---------- SEO : nettoyage léger ---------- */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

/* ---------- Données structurées Organization ---------- */
add_action( 'wp_head', function () {
    if ( ! is_front_page() ) { return; }
    $same = array_values( array_filter( [ noisy_opt( 'facebook' ), noisy_opt( 'linkedin' ), noisy_opt( 'instagram' ), noisy_opt( 'x' ), noisy_opt( 'youtube' ) ] ) );
    $data = [
        '@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'NOISY DIGITAL', 'url' => home_url( '/' ),
        'logo' => get_template_directory_uri() . '/assets/img/logo-red.png', 'foundingDate' => '2015',
        'address' => [ '@type' => 'PostalAddress', 'streetAddress' => noisy_opt( 'address' ), 'addressLocality' => 'Dakar', 'addressCountry' => 'SN' ],
        'telephone' => noisy_opt( 'phone1' ), 'email' => noisy_opt( 'email' ), 'sameAs' => $same,
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}, 20 );

/* ---------- Menu de secours tant qu'aucun menu n'est assigné ---------- */
function noisy_menu_fallback() {
    $items = [ 'Agence' => '/agence/', 'Services' => '/services/', 'Réalisations' => '/realisations/', 'Les échos du digital' => '/les-echos-du-digital/', 'Contact' => '/contactez-nous/' ];
    echo '<ul class="menu-list">';
    foreach ( $items as $l => $u ) { echo '<li><a href="' . esc_url( home_url( $u ) ) . '">' . esc_html( $l ) . '</a></li>'; }
    echo '</ul>';
}
