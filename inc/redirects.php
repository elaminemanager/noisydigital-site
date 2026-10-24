<?php
/**
 * Redirections de migration (ancien site Uncode vers le nouveau thème).
 * Appliquées très tôt, avant la résolution WordPress, pour couvrir aussi les URL supprimées.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function () {
    if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) { return; }
    if ( ! isset( $_SERVER['REQUEST_URI'] ) ) { return; }
    $uri   = $_SERVER['REQUEST_URI'];
    $path  = parse_url( $uri, PHP_URL_PATH ) ?: '/';
    $query = parse_url( $uri, PHP_URL_QUERY );
    if ( strpos( $path, '/wp-' ) === 0 || strpos( $path, '/wp-json' ) === 0 ) { return; }
    $path = rawurldecode( $path );

    // 1. Préfixes de langue de l'ancien site : /fr_fr/ disparaît, /en/ rejoint la version française (site monolingue).
    $new = preg_replace( '#^/(fr_fr|en)(/|$)#', '/', $path, 1, $n );
    $stripped = (bool) $n;
    if ( $stripped ) { $path = $new; }

    $p = rtrim( $path, '/' ) . '/';
    if ( $p === '//' ) { $p = '/'; }

    // 2. Correspondances directes (anciennes pages vers la nouvelle arborescence).
    $map = [
        '/marketingdigital/' => '/services/relations-publiques-digitales/',
        '/digital-marketing/' => '/services/relations-publiques-digitales/',
        '/studiocreatif/' => '/services/production-de-contenus/',
        '/audiovisuelle/' => '/services/production-de-contenus/',
        '/webdesign/' => '/services/',
        '/web-design/' => '/services/',
        '/digital-marketing-agency-in-senegal/' => '/',
        '/classic-firm/' => '/',
        '/home/' => '/',
        '/projets/' => '/realisations/',
        '/projet-test/' => '/realisations/',
        '/contact/' => '/contactez-nous/',
        '/prise-de-contact/' => '/contactez-nous/',
        '/blogdudof/' => '/les-echos-du-digital/',
        '/gdpr/' => '/politique-de-confidentialite/',
        '/portfolio/vivo-energy/' => '/realisations/vivo-energy/',
        '/portfolio/english-connects/' => '/realisations/english-connects/',
        '/portfolio/bureau-de-mise-a-niveau/' => '/realisations/',
        '/portfolio/tamoona-travel/' => '/realisations/',
        '/portfolio/tamoona-travel-web/' => '/realisations/',
        '/portfolio/' => '/realisations/',
    ];
    if ( isset( $map[ $p ] ) ) { noisy_go( $map[ $p ], $query, 301 ); }

    // 3. Démos du thème, boutique factice, pages orphelines : contenu retiré (410).
    if ( preg_match( '#^/(homepages|features|shops|works|blog|pages|product|product-category|product-tag|page_category|shop|cart|checkout|my-account)(/|$)#', $p )
        || preg_match( '#^/(services-minimal|services-creative|blog-classic|home-3|page-d-exemple|page-404-custom|promo-arbre-de-noel)/$#', $p ) ) {
        status_header( 410 );
        nocache_headers();
        get_template_part( '410' );
        exit;
    }

    // 4. Préfixe retiré sans autre correspondance : une seule redirection vers l'URL propre.
    if ( $stripped ) { noisy_go( $p === '/' ? '/' : $path, $query, 301 ); }
}, 1 );

function noisy_go( $to, $query = null, $code = 301 ) {
    $to = home_url( $to );
    if ( $query ) { $to .= '?' . $query; }
    wp_redirect( $to, $code, 'Noisy migration' );
    exit;
}

/* Archives sans valeur pour le référencement : étiquettes, auteurs, dates. */
add_filter( 'wp_robots', function ( $robots ) {
    if ( is_tag() || is_author() || is_date() || is_search() || is_attachment() ) {
        $robots['noindex'] = true; $robots['follow'] = true;
        unset( $robots['max-image-preview'] );
    }
    return $robots;
} );
