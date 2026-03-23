<?php
/**
 * Reviews section — Elfsight Google Reviews widget
 *
 * @package SolidGuard
 */
?>

<section class="section section--bg" id="reviews" aria-label="Customer reviews">
    <div class="container">

        <!-- Heading -->
        <div class="text-center" style="margin-bottom: var(--space-10);">
            <div class="star-row" style="justify-content: center; margin-bottom: var(--space-2);" aria-label="5 out of 5 stars">
                <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24; color: #F9AB00;" aria-hidden="true">star</span>
                <?php endfor; ?>
            </div>
            <p class="h3 text-navy">5/5 Google Reviews</p>
        </div>

        <!-- Elfsight Google Reviews widget -->
        <script src="https://elfsightcdn.com/platform.js" async></script>
        <div class="elfsight-app-8c78541f-b588-48f7-9d7b-6b245249187f" data-elfsight-app-lazy></div>

    </div>
</section>
