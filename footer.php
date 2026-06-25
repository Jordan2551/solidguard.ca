<?php
/**
 * Default site footer — SEO / content pages.
 *
 * Internal-linking workhorse: category roots + top spokes + Tier A/B cities get a
 * sitewide link. Driven by sg_glass_nav() / sg_service_area_regions().
 * The ad landing page uses footer-lp.php instead (get_footer('lp')).
 *
 * @package SolidGuard
 */

$glass_nav = sg_glass_nav();
$logo      = get_template_directory_uri() . '/images/logos/logo.webp';

// Footer shows curated top spokes per category (navigation.md), not the full set.
$footer_caps = array(
    'residential' => 5,
    'commercial'  => 6,
    'emergency'   => 3,
);

// Tier A + B cities only (skip Tier C in the footer).
$footer_cities = array();
foreach ( sg_service_area_regions() as $cities ) {
    foreach ( $cities as $city ) {
        if ( 'C' !== $city['tier'] ) {
            $footer_cities[] = $city['name'];
        }
    }
}
?>

<footer id="colophon" class="site-footer">

    <div class="footer-stripe" aria-hidden="true">
        <div class="footer-stripe__line"></div>
    </div>

    <div class="container">

        <div class="site-footer__grid site-footer__grid--seo">

            <!-- Brand column -->
            <div class="site-footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="SolidGuard Home" class="site-footer__logo">
                    <img src="<?php echo esc_url( $logo ); ?>" alt="SolidGuard" width="140" height="80">
                </a>
                <p class="site-footer__tagline">
                    Repair-first glass for homes and businesses across Toronto and the GTA. We fix it right, or we come back free.
                </p>
                <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="site-footer__phone" id="phone-footer-brand">
                    <?php echo sg_icon( 'call' ); ?>
                    <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
                <p class="site-footer__rating">
                    <?php echo sg_icon( 'star', 'site-footer__rating-star' ); ?>
                    5.0 on Google &middot; 3-month workmanship warranty
                </p>
            </div>

            <!-- Glass service columns -->
            <?php foreach ( $glass_nav as $cat ) :
                $cap    = isset( $footer_caps[ $cat['root'] ] ) ? $footer_caps[ $cat['root'] ] : count( $cat['spokes'] );
                $spokes = array_slice( $cat['spokes'], 0, $cap );
                ?>
                <div class="site-footer__col">
                    <h2 class="site-footer__nav-heading<?php echo $cat['accent'] ? ' is-accent' : ''; ?>">
                        <?php echo esc_html( ucfirst( $cat['root'] ) ); ?> Glass
                    </h2>
                    <nav class="site-footer__nav" aria-label="<?php echo esc_attr( $cat['root'] ); ?> glass links">
                        <?php foreach ( $spokes as $spoke ) : ?>
                            <a href="<?php echo esc_url( sg_glass_url( $cat['root'], $spoke['slug'] ) ); ?>">
                                <?php echo esc_html( $spoke['label'] ); ?>
                            </a>
                        <?php endforeach; ?>
                        <a href="<?php echo esc_url( sg_glass_url( $cat['root'] ) ); ?>" class="site-footer__nav-all">
                            All <?php echo esc_html( strtolower( $cat['root'] ) ); ?> glass
                        </a>
                    </nav>
                </div>
            <?php endforeach; ?>

            <!-- Service areas -->
            <div class="site-footer__col">
                <h2 class="site-footer__nav-heading">Service Areas</h2>
                <nav class="site-footer__nav site-footer__nav--areas" aria-label="Service area links">
                    <?php foreach ( $footer_cities as $city ) : ?>
                        <a href="<?php echo esc_url( sg_location_url( $city ) ); ?>"><?php echo esc_html( $city ); ?></a>
                    <?php endforeach; ?>
                    <a href="<?php echo esc_url( home_url( '/glass/locations/' ) ); ?>" class="site-footer__nav-all">
                        All service areas
                    </a>
                </nav>
            </div>

        </div>

        <!-- Bottom bar: company + legal -->
        <div class="site-footer__bottom">
            <nav class="site-footer__bottom-nav" aria-label="Company links">
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
                <a href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>">Reviews</a>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
                <a href="<?php echo esc_url( home_url( '/offers/' ) ); ?>">Offers</a>
                <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy</a>
                <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms</a>
            </nav>
            <div class="site-footer__credit">
                <span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> SolidGuard Glass &amp; Windows. All rights reserved.</span>
                <span>Created &amp; Designed by <a href="https://jcsoftware.ca/" target="_blank" rel="noopener">JC Software</a></span>
            </div>
        </div>

    </div>
</footer>

<!-- Elfsight Google Reviews | Floating Review -->
<script src="https://elfsightcdn.com/platform.js" async></script>
<div class="elfsight-app-09abe886-6277-4f6f-bb44-46ee50d4f64f" data-elfsight-app-lazy></div>

<?php wp_footer(); ?>

<!-- CallRail Dynamic Number Insertion -->
<script type="text/javascript" src="//cdn.callrail.com/companies/825390083/7d705884a4f0568f7615/12/swap.js"></script>
</body>
</html>
