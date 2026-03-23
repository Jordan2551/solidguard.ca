<?php
/**
 * Modals — service detail modals + estimate modal
 *
 * @package SolidGuard
 */

$img = get_template_directory_uri() . '/images/pictures/';

$service_modals = array(
    array(
        'id'         => 'modal-residential',
        'image'      => $img . 'work/resedential-glass-services/foggy_before_after_combined(1)-1_70reduced.webp',
        'image_alt'  => 'Residential glass repair before and after',
        'label'      => 'Residential Glass Services',
        'subtitle'   => 'Broken, Foggy, or Drafty Glass?',
        'tagline'    => 'Fast, professional repair for windows, patio doors, and sealed glass units.',
        'intro'      => 'Glass problems do not fix themselves. A cracked pane can spread, a failed seal can keep costing you in energy loss, and broken glass can leave your home exposed.',
        'help_title' => 'What We Help With',
        'help_items' => array(
            'Cracked or shattered window glass',
            'Foggy double-pane glass',
            'Drafty or poorly sealed windows',
            'Patio and sliding door glass',
            'Emergency board-up after break-ins or accidents',
        ),
        'why_title'  => 'Why Homeowners Choose SolidGuard',
        'why_intro'  => 'Most companies jump straight to full window replacement. We don\'t. If the frame is still good, we replace just the glass and restore performance — saving you hundreds to thousands.',
        'why_items'  => array(
            'Faster turnaround',
            'Lower cost',
            'Same-day or next-day solutions available',
            'Clean, professional installation',
            'Fast response across the GTA',
            'Honest recommendations without the runaround',
        ),
        'form_title' => 'Get a Quote',
        'form_sub'   => 'Fast response. Clear pricing. No pressure.',
    ),
    array(
        'id'         => 'modal-commercial',
        'image'      => $img . 'work/commercial-glass-services/before_after_combined(1)_70reduced.webp',
        'image_alt'  => 'Commercial glass repair before and after',
        'label'      => 'Commercial Glass Services',
        'subtitle'   => 'Broken or Damaged Glass Disrupting Your Business?',
        'tagline'    => 'Fast, professional repair for storefronts, doors, and commercial glass systems.',
        'intro'      => 'Glass issues don\'t just look bad — they affect security, safety, and customer trust.',
        'help_title' => 'What We Handle',
        'help_items' => array(
            'Storefront glass repair and replacement',
            'Cracked or shattered commercial doors',
            'Office, dealership, and vestibule glass systems',
            'Frameless sliding door glass and hardware mechanisms',
            'Foggy or failed sealed units',
            'Emergency board-up after break-ins or damage',
            'Door closer, hinge, and alignment issues',
        ),
        'why_title'  => 'Why Businesses Choose SolidGuard',
        'why_intro'  => 'Most companies push full replacements. We focus on restoring what you have first. If the structure is still solid, we replace only the glass or repair the issue — minimizing downtime and saving you thousands.',
        'why_items'  => array(
            'Fast turnaround',
            'Cost-effective repair-first approach',
            'Same-day emergency service',
            'Clean, professional work',
            'Reliable scheduling',
        ),
        'form_title' => 'Get a Quote',
        'form_sub'   => 'Fast response. Clear pricing. No downtime guesswork.',
    ),
    array(
        'id'         => 'modal-emergency',
        'image'      => $img . 'work/emergency-glass-services/backyard_before_after_polished(1)_70reduced.webp',
        'image_alt'  => 'Emergency glass repair',
        'label'      => 'Emergency Glass Services',
        'subtitle'   => 'Broken Glass Right Now?',
        'tagline'    => 'We secure your property fast and restore your glass without delay.',
        'intro'      => 'A broken window or door is a security risk and needs immediate attention.',
        'help_title' => 'What We Handle',
        'help_items' => array(
            'Emergency board-up',
            'Shattered glass',
            'Break-in damage',
            'Unsafe doors and windows',
        ),
        'why_title'  => 'Why Call SolidGuard',
        'why_intro'  => 'We secure first, repair fast.',
        'why_items'  => array(
            'Rapid response',
            'Same-day service',
            'Safety-first approach',
        ),
        'form_title' => 'Get Help Now',
        'form_sub'   => 'Fast response. Priority service.',
    ),
    array(
        'id'         => 'modal-storefront',
        'image'      => $img . 'work/storefront-glass-services/dogstore_before_after_combined(1)_70reduced.webp',
        'image_alt'  => 'Storefront glass installation',
        'label'      => 'Storefront Glass Services',
        'subtitle'   => 'Cracked or Damaged Storefront?',
        'tagline'    => 'Protect your image, security, and daily revenue.',
        'intro'      => 'Your storefront is your first impression. Damaged glass sends the wrong message and creates real security risks.',
        'help_title' => 'What We Handle',
        'help_items' => array(
            'Storefront glass repair and replacement',
            'Large tempered glass panels',
            'Aluminum frame and door glass',
            'Cracked or shattered glass',
        ),
        'why_title'  => 'Why Choose SolidGuard',
        'why_intro'  => 'Repair-first approach to reduce downtime and cost.',
        'why_items'  => array(
            'Fast turnaround',
            'Clean installation',
            'Priority service',
        ),
        'form_title' => 'Get a Quote',
        'form_sub'   => 'Fast response. Back to business.',
    ),
);
?>

<?php foreach ( $service_modals as $modal ) : ?>
<div
    class="sg-modal"
    id="<?php echo esc_attr( $modal['id'] ); ?>"
    aria-hidden="true"
    role="dialog"
    aria-modal="true"
    aria-label="<?php echo esc_attr( $modal['label'] ); ?>"
>
    <div class="sg-modal__overlay" data-modal-close></div>

    <div class="sg-modal__panel">

        <button class="sg-modal__close" data-modal-close aria-label="Close modal">
            <span class="material-symbols-outlined" aria-hidden="true">close</span>
            Close
        </button>

        <div class="sg-modal__scroll">

            <!-- Image -->
            <div class="sg-modal__image">
                <img
                    src="<?php echo esc_url( $modal['image'] ); ?>"
                    alt="<?php echo esc_attr( $modal['image_alt'] ); ?>"
                    loading="lazy"
                >
            </div>

            <div class="sg-modal__body">

                <!-- Header -->
                <span class="sg-modal__label"><?php echo esc_html( $modal['label'] ); ?></span>
                <h2 class="sg-modal__title"><?php echo esc_html( $modal['subtitle'] ); ?></h2>
                <p class="sg-modal__tagline"><?php echo esc_html( $modal['tagline'] ); ?></p>

                <!-- Intro -->
                <p class="sg-modal__text"><?php echo esc_html( $modal['intro'] ); ?></p>

                <!-- What We Help With -->
                <div class="sg-modal__section">
                    <h3 class="sg-modal__section-heading"><?php echo esc_html( $modal['help_title'] ); ?></h3>
                    <ul class="sg-modal__bullets" role="list">
                        <?php foreach ( $modal['help_items'] as $item ) : ?>
                            <li>
                                <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
                                <?php echo esc_html( $item ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Why SolidGuard -->
                <div class="sg-modal__section">
                    <h3 class="sg-modal__section-heading"><?php echo esc_html( $modal['why_title'] ); ?></h3>
                    <p class="sg-modal__text"><?php echo esc_html( $modal['why_intro'] ); ?></p>
                    <ul class="sg-modal__bullets" role="list">
                        <?php foreach ( $modal['why_items'] as $item ) : ?>
                            <li>
                                <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
                                <?php echo esc_html( $item ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Form -->
                <hr class="sg-modal__divider">
                <h3 class="sg-modal__form-title"><?php echo esc_html( $modal['form_title'] ); ?></h3>
                <p class="sg-modal__form-sub"><?php echo esc_html( $modal['form_sub'] ); ?></p>

                <form class="form-stack sg-modal__form" action="#" method="post" novalidate>
                    <input type="hidden" name="service_context" value="<?php echo esc_attr( $modal['label'] ); ?>">

                    <div class="form-group">
                        <label class="form-label" for="<?php echo esc_attr( $modal['id'] ); ?>-name">Name</label>
                        <input class="form-input" id="<?php echo esc_attr( $modal['id'] ); ?>-name" type="text" name="name" placeholder="Full Name" autocomplete="name" required>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label" for="<?php echo esc_attr( $modal['id'] ); ?>-phone">Phone</label>
                            <input class="form-input" id="<?php echo esc_attr( $modal['id'] ); ?>-phone" type="tel" name="phone" placeholder="(416) 000-0000" autocomplete="tel" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="<?php echo esc_attr( $modal['id'] ); ?>-email">Email</label>
                            <input class="form-input" id="<?php echo esc_attr( $modal['id'] ); ?>-email" type="email" name="email" placeholder="email@address.com" autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="<?php echo esc_attr( $modal['id'] ); ?>-message">Message</label>
                        <textarea class="form-input form-textarea" id="<?php echo esc_attr( $modal['id'] ); ?>-message" name="message" placeholder="Tell us how we can help..." rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn--primary btn--full btn--lg">
                        Get Quick Estimate
                    </button>
                </form>

            </div><!-- .sg-modal__body -->
        </div><!-- .sg-modal__scroll -->
    </div><!-- .sg-modal__panel -->
</div><!-- .sg-modal -->
<?php endforeach; ?>


<!-- =====================================================================
     Estimate Modal — contact form only
     ===================================================================== -->
<div
    class="sg-modal sg-modal--estimate"
    id="modal-estimate"
    aria-hidden="true"
    role="dialog"
    aria-modal="true"
    aria-label="Request a quick estimate"
>
    <div class="sg-modal__overlay" data-modal-close></div>

    <div class="sg-modal__panel sg-modal__panel--compact">

        <button class="sg-modal__close" data-modal-close aria-label="Close modal">
            <span class="material-symbols-outlined" aria-hidden="true">close</span>
            Close
        </button>

        <!-- Van image header -->
        <div class="sg-modal__estimate-hero">
            <img
                src="<?php echo esc_url( get_template_directory_uri() . '/images/pictures/no-bg-van-reverse.webp' ); ?>"
                alt="Solid Guard service van"
                aria-hidden="true"
            >
        </div>

        <div class="sg-modal__body sg-modal__body--padded">

            <span class="sg-modal__label">Quick Estimate</span>
            <h2 class="sg-modal__title">Get Quick Estimate</h2>
            <p class="sg-modal__tagline">Fast response. Clear pricing. No pressure.</p>

            <form class="form-stack sg-modal__form" action="#" method="post" novalidate>

                <div class="form-group">
                    <label class="form-label" for="est-name">Name</label>
                    <input class="form-input" id="est-name" type="text" name="name" placeholder="Full Name" autocomplete="name" required>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="est-phone">Phone</label>
                        <input class="form-input" id="est-phone" type="tel" name="phone" placeholder="(416) 000-0000" autocomplete="tel" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="est-email">Email</label>
                        <input class="form-input" id="est-email" type="email" name="email" placeholder="email@address.com" autocomplete="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="est-service">Service</label>
                    <div class="form-select-wrap">
                        <select class="form-select" id="est-service" name="service">
                            <option value="">Select a service...</option>
                            <option value="residential">Residential Glass Repair</option>
                            <option value="commercial">Commercial Glass Repair</option>
                            <option value="emergency">Emergency Glass Repair</option>
                            <option value="storefront">Storefront Glass</option>
                            <option value="icu">Insulated Glass Units</option>
                            <option value="boardup">Board-up Services</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="est-message">Message</label>
                    <textarea class="form-input form-textarea" id="est-message" name="message" placeholder="Tell us how we can help..." rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn--primary btn--full btn--lg">
                    Get Quick Estimate
                </button>

            </form>
        </div>
    </div>
</div>
