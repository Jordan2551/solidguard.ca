<footer id="colophon" class="site-footer">

    <!-- Brand column -->
    <div class="stack stack--gap-4">
        <div class="site-footer__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Solid Guard — Home">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/logos/logo.png' ); ?>"
                    alt="Solid Guard"
                    width="140"
                    height="40"
                >
            </a>
        </div>
        <p class="site-footer__tagline">
            Toronto's premier emergency glass response team. Licensed, insured, and ready when you need us.
        </p>
    </div>

    <!-- Nav columns -->
    <div class="stack stack--gap-8">

        <div class="stack stack--gap-3">
            <h5 class="site-footer__nav-heading">Services</h5>
            <nav class="site-footer__nav stack stack--gap-2" aria-label="Footer service links">
                <a href="<?php echo esc_url( home_url( '/emergency-glass-repair' ) ); ?>">Emergency Glass Repair</a>
                <a href="<?php echo esc_url( home_url( '/insulated-glass-units' ) ); ?>">Insulated Glass Units</a>
                <a href="<?php echo esc_url( home_url( '/tempered-glass' ) ); ?>">Tempered Glass</a>
                <a href="<?php echo esc_url( home_url( '/board-up-services' ) ); ?>">Board-up Services</a>
                <a href="<?php echo esc_url( home_url( '/commercial-glass-repair' ) ); ?>">Commercial Glass Repair</a>
                <a href="<?php echo esc_url( home_url( '/residential-glass-repair' ) ); ?>">Residential Glass Repair</a>
            </nav>
        </div>

        <div class="stack stack--gap-3">
            <h5 class="site-footer__nav-heading">Explore</h5>
            <nav class="site-footer__nav stack stack--gap-2" aria-label="Footer page sections">
                <a href="#reviews">Google Reviews</a>
                <a href="#services">Our Services</a>
                <a href="#offers">Special Offers</a>
                <a href="#service-areas">Service Areas</a>
                <a href="#faq">FAQ</a>
            </nav>
        </div>

        <div class="stack stack--gap-3">
            <h5 class="site-footer__nav-heading">Contact Us</h5>
            <p style="color: var(--neutral-400); font-size: var(--text-sm);">
                Main Office:
                <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" style="color: inherit;">
                    <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
            </p>
            <p style="color: var(--neutral-400); font-size: var(--text-sm);">
                Dispatch:
                <a href="mailto:<?php echo esc_attr( SG_EMAIL_DISPATCH ); ?>" style="color: inherit;">
                    <?php echo esc_html( SG_EMAIL_DISPATCH ); ?>
                </a>
            </p>
        </div>

    </div>

</footer>


<!-- Elfsight Google Reviews | Floating Review -->
<script src="https://elfsightcdn.com/platform.js" async></script>
<div class="elfsight-app-09abe886-6277-4f6f-bb44-46ee50d4f64f" data-elfsight-app-lazy></div>

<?php wp_footer(); ?>
</body>
</html>
