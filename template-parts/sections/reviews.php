<?php
/**
 * Reviews section - Elfsight Google Reviews widget
 *
 * @package SolidGuard
 */
?>

<section class="section section--bg" id="reviews" aria-label="Customer reviews">
    <div class="container">

        <!-- Heading -->
        <div class="text-center reviews-header">
            <div class="star-row" aria-label="5 out of 5 stars">
                <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                    <span class="material-symbols-outlined" aria-hidden="true">star</span>
                <?php endfor; ?>
            </div>
            <p class="h3 text-navy">5/5 Google Reviews</p>
        </div>

        <!-- Elfsight Google Reviews widget -->
        <script src="https://elfsightcdn.com/platform.js" async></script>
        <div class="elfsight-app-8c78541f-b588-48f7-9d7b-6b245249187f" data-elfsight-app-lazy></div>

    </div>
</section>
