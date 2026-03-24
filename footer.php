<footer id="colophon" class="site-footer">

    <!-- Animated stripe -->
    <div class="footer-stripe" aria-hidden="true">
        <div class="footer-stripe__line"></div>
    </div>

    <div class="container">

        <div class="site-footer__grid">

            <!-- Brand column -->
            <div class="site-footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Solid Guard — Home" class="site-footer__logo">
                    <img
                        src="<?php echo esc_url( get_template_directory_uri() . '/images/logos/logo.png' ); ?>"
                        alt="Solid Guard"
                        width="140"
                        height="80"
                    >
                </a>
                <p class="site-footer__tagline">
                    Toronto's premier emergency glass response team. Licensed, insured, and ready when you need us.
                </p>
                <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="site-footer__phone">
                    <span class="material-symbols-outlined" aria-hidden="true">call</span>
                    <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
            </div>

            <!-- Services -->
            <div class="site-footer__col">
                <h5 class="site-footer__nav-heading">Services</h5>
                <nav class="site-footer__nav" aria-label="Footer service links">
                    <button type="button" data-modal-trigger="modal-emergency">Emergency Glass Repair</button>
                    <button type="button" data-modal-trigger="modal-estimate">Insulated Glass Units</button>
                    <button type="button" data-modal-trigger="modal-estimate">Tempered Glass</button>
                    <button type="button" data-modal-trigger="modal-estimate">Board-up Services</button>
                    <button type="button" data-modal-trigger="modal-commercial">Commercial Glass Repair</button>
                    <button type="button" data-modal-trigger="modal-residential">Residential Glass Repair</button>
                    <button type="button" data-modal-trigger="modal-storefront">Storefront Glass</button>
                </nav>
            </div>

            <!-- Explore -->
            <div class="site-footer__col">
                <h5 class="site-footer__nav-heading">Explore</h5>
                <nav class="site-footer__nav" aria-label="Footer page sections">
                    <a href="#services">Our Services</a>
                    <a href="#reviews">Google Reviews</a>
                    <a href="#offers">Special Offers</a>
                    <a href="#guarantee">Warranty</a>
                    <a href="#service-areas">Service Areas</a>
                </nav>
            </div>

            <!-- Contact -->
            <div class="site-footer__col">
                <h5 class="site-footer__nav-heading">Contact Us</h5>
                <nav class="site-footer__nav" aria-label="Footer contact links">
                    <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>">
                        <span class="material-symbols-outlined" aria-hidden="true">call</span>
                        <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                    </a>
                </nav>
                <button class="btn btn--orange btn--full" type="button" data-modal-trigger="modal-estimate" style="margin-top: var(--space-5);">
                    Get Quick Estimate
                </button>
            </div>

        </div>

        <!-- Legal bar -->
        <div class="site-footer__legal">
            <span>&copy; <?php echo date( 'Y' ); ?> Solid Guard Glass &amp; Windows. All rights reserved.</span>
            <span>Created and designed by <a href="http://jcsoftware.ca/" target="_blank" rel="noopener" style="color: var(--color-orange); transition: color var(--transition);">JC Software</a></span>
        </div>

    </div>
</footer>


<!-- Elfsight Google Reviews | Floating Review -->
<script src="https://elfsightcdn.com/platform.js" async></script>
<div class="elfsight-app-09abe886-6277-4f6f-bb44-46ee50d4f64f" data-elfsight-app-lazy></div>

<?php wp_footer(); ?>
</body>
</html>
