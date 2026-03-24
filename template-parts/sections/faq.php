<?php
/**
 * FAQ Accordion section
 * Uses native <details>/<summary> — no JS required.
 *
 * @package SolidGuard
 */

$faqs = array(
    array(
        'q' => 'How fast can you arrive?',
        'a' => 'For emergency calls we target same-day arrival across the GTA. In most cases a technician is on-site within 1–3 hours of your call. We operate including weekends and holidays, so you\'re never left waiting when it matters most.',
    ),
    array(
        'q' => 'Is the on-site assessment really free?',
        'a' => 'Yes — always. A technician comes to you, measures the damage, and gives you a firm quote on the spot. There\'s no call-out fee and no obligation. Work only begins once you approve the price in writing.',
    ),
    array(
        'q' => 'Are your technicians background-checked?',
        'a' => 'Every Solid Guard technician passes a full background check before they\'re cleared to enter a client\'s home or business. You\'ll also receive the technician\'s name and photo before they arrive so you know exactly who to expect.',
    ),
    array(
        'q' => 'Can cracked glass be repaired, or does it need full replacement?',
        'a' => 'It depends on the size, location, and type of crack. Minor chips in single-pane glass can sometimes be polished or stabilised. Broken seals on double/triple-pane units, shattered glass, or anything that compromises security requires full replacement. We\'ll always recommend the most cost-effective safe option — never upsell an unnecessary replacement.',
    ),
    array(
        'q' => 'Do you handle insurance claims?',
        'a' => 'Yes. We have experience working with all major Canadian insurers. We can provide a detailed damage report and quote in the format your insurer requires, and our team is happy to communicate directly with your adjuster to keep things moving quickly.',
    ),
    array(
        'q' => 'What glass types do you stock?',
        'a' => 'We carry single-pane, double-pane (IGU), triple-pane, tempered, laminated, Low-E coated, argon-filled, privacy, and custom-cut glass. For standard residential sizes we often have stock on the van — meaning same-visit replacement. Specialty or oversized commercial glass is typically ordered and installed within 2–5 business days.',
    ),
    array(
        'q' => 'Do you work on storefronts and commercial properties?',
        'a' => 'Absolutely. Commercial glass repair is a core part of our business. We handle storefront emergencies, office partition glass, security doors, lobby entrances, and more. Emergency board-up is available within the hour for break-ins or vandalism.',
    ),
    array(
        'q' => 'What warranty do you offer on your work?',
        'a' => 'All labour is backed by our 3-month Solid Guarantee. Manufacturer warranties on glass units vary by product — we\'ll walk you through exactly what\'s covered before we start. If anything fails due to our workmanship within the warranty period, we return and fix it at no charge.',
    ),
    array(
        'q' => 'How do I prepare for a technician visit?',
        'a' => 'Just ensure safe access to the affected window or door. If there\'s broken glass on the floor, leave it — our technicians handle debris cleanup as part of the job. You don\'t need to purchase any materials or have anything ready in advance.',
    ),
);
?>

<section class="faq" id="faq" aria-label="Frequently asked questions">
    <div class="container">

    <h2 class="section-heading">Common Questions</h2>

    <dl class="faq__list">
        <?php foreach ( $faqs as $i => $item ) : ?>
            <div class="faq__item">
                <details <?php echo $i === 0 ? 'open' : ''; ?>>
                    <summary class="faq__question" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                        <span class="faq__question-text"><?php echo esc_html( $item['q'] ); ?></span>
                        <span class="material-symbols-outlined faq__icon" aria-hidden="true">add</span>
                    </summary>
                    <div class="faq__answer">
                        <p><?php echo esc_html( $item['a'] ); ?></p>
                    </div>
                </details>
            </div>
        <?php endforeach; ?>
    </dl>

    </div>
</section>
