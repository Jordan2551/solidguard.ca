/* =============================================================================
   Solid Guard — main.js
   Hamburger nav + services accordion
   ============================================================================= */

( function () {
    'use strict';

    const toggle   = document.getElementById( 'nav-toggle' );
    const overlay  = document.getElementById( 'site-nav' );
    const backdrop = document.getElementById( 'nav-backdrop' );
    const closeBtn = document.getElementById( 'nav-close' );

    if ( ! toggle || ! overlay ) return;

    // -------------------------------------------------------------------------
    // Open / close helpers
    // -------------------------------------------------------------------------

    function openNav() {
        overlay.classList.add( 'is-open' );
        overlay.setAttribute( 'aria-hidden', 'false' );
        toggle.classList.add( 'is-open' );
        toggle.setAttribute( 'aria-expanded', 'true' );
        toggle.setAttribute( 'aria-label', 'Close navigation menu' );
        document.body.style.overflow = 'hidden';

        // Move focus into drawer
        const firstFocusable = overlay.querySelector( 'button, a[href]' );
        if ( firstFocusable ) firstFocusable.focus();
    }

    function closeNav() {
        overlay.classList.remove( 'is-open' );
        overlay.setAttribute( 'aria-hidden', 'true' );
        toggle.classList.remove( 'is-open' );
        toggle.setAttribute( 'aria-expanded', 'false' );
        toggle.setAttribute( 'aria-label', 'Open navigation menu' );
        document.body.style.overflow = '';
        toggle.focus();
    }

    // -------------------------------------------------------------------------
    // Toggle on hamburger click
    // -------------------------------------------------------------------------
    toggle.addEventListener( 'click', function () {
        overlay.classList.contains( 'is-open' ) ? closeNav() : openNav();
    } );

    // Close on backdrop click
    if ( backdrop ) {
        backdrop.addEventListener( 'click', closeNav );
    }

    // Close on × button
    if ( closeBtn ) {
        closeBtn.addEventListener( 'click', closeNav );
    }

    // Close on Escape key
    document.addEventListener( 'keydown', function ( e ) {
        if ( e.key === 'Escape' && overlay.classList.contains( 'is-open' ) ) {
            closeNav();
        }
    } );

    // Close when any anchor link inside the nav is clicked
    overlay.querySelectorAll( 'a' ).forEach( function ( link ) {
        link.addEventListener( 'click', closeNav );
    } );

    // -------------------------------------------------------------------------
    // Services accordion
    // -------------------------------------------------------------------------
    const servicesTrigger = document.getElementById( 'nav-services-btn' );
    const servicesSub     = document.getElementById( 'nav-services' );

    if ( servicesTrigger && servicesSub ) {
        servicesTrigger.addEventListener( 'click', function () {
            const isOpen = this.getAttribute( 'aria-expanded' ) === 'true';

            this.setAttribute( 'aria-expanded', isOpen ? 'false' : 'true' );
            servicesSub.classList.toggle( 'is-open', ! isOpen );
        } );
    }

    // -------------------------------------------------------------------------
    // Trap focus within drawer when open
    // -------------------------------------------------------------------------
    overlay.addEventListener( 'keydown', function ( e ) {
        if ( e.key !== 'Tab' ) return;
        if ( ! overlay.classList.contains( 'is-open' ) ) return;

        const focusable = Array.from(
            overlay.querySelectorAll( 'button:not([disabled]), a[href], [tabindex]:not([tabindex="-1"])' )
        ).filter( el => el.offsetParent !== null ); // only visible elements

        if ( focusable.length === 0 ) return;

        const first = focusable[ 0 ];
        const last  = focusable[ focusable.length - 1 ];

        if ( e.shiftKey ) {
            if ( document.activeElement === first ) {
                e.preventDefault();
                last.focus();
            }
        } else {
            if ( document.activeElement === last ) {
                e.preventDefault();
                first.focus();
            }
        }
    } );

} )();


/* =============================================================================
   Offer expiry — set to 7 days from today
   ============================================================================= */

/* =============================================================================
   GA4 — Track all clickable element interactions + Ninja Forms submissions
   ============================================================================= */

( function () {
    'use strict';

    var GA_ID = 'G-M4S0Y3B78Y';

    function sendGtag( eventName, params ) {
        if ( typeof gtag !== 'function' ) return;
        params.send_to = GA_ID;
        gtag( 'event', eventName, params );
    }

    // -----------------------------------------------------------------
    // All element clicks — buttons, links, cards, CTAs
    // -----------------------------------------------------------------
    document.addEventListener( 'click', function ( e ) {
        var el = e.target.closest( 'a, button, [role="button"], input[type="submit"]' );
        if ( ! el ) return;

        var text = ( el.textContent || '' ).trim().substring( 0, 100 );
        var tag  = el.tagName.toLowerCase();

        // For submit inputs, use the value
        if ( tag === 'input' && el.type === 'submit' ) {
            text = el.value || text;
        }

        sendGtag( 'all_element_clicks', {
            button_text:      text,
            button_id:        el.id || '',
            button_classes:   el.className || '',
            button_tag:       tag,
            button_href:      el.href || el.getAttribute( 'data-modal-trigger' ) || '',
            button_page_url:  window.location.href,
            button_page_path: window.location.pathname,
            button_section:   ( function () {
                var section = el.closest( 'section, footer, header, .nav-overlay' );
                return section ? ( section.id || section.className.split( ' ' )[ 0 ] || '' ) : '';
            } )()
        } );
    } );

    // -----------------------------------------------------------------
    // Phone link clicks — dedicated event
    // -----------------------------------------------------------------
    document.addEventListener( 'click', function ( e ) {
        var link = e.target.closest( 'a[href^="tel:"]' );
        if ( ! link ) return;

        sendGtag( 'phone_click', {
            phone_number:   link.href.replace( 'tel:', '' ),
            click_location: link.id || '',
            page_url:       window.location.href
        } );
    } );

    // -----------------------------------------------------------------
    // Modal opens — track which service/CTA triggered it
    // -----------------------------------------------------------------
    document.addEventListener( 'click', function ( e ) {
        var trigger = e.target.closest( '[data-modal-trigger]' );
        if ( ! trigger ) return;

        sendGtag( 'modal_open', {
            modal_id:       trigger.getAttribute( 'data-modal-trigger' ),
            trigger_id:     trigger.id || '',
            trigger_text:   ( trigger.textContent || '' ).trim().substring( 0, 100 ),
            page_url:       window.location.href
        } );
    } );

    // -----------------------------------------------------------------
    // Ninja Forms — track successful submissions
    // -----------------------------------------------------------------
    if ( typeof jQuery !== 'undefined' ) {
        jQuery( document ).on( 'nfFormSubmitResponse', function ( e, response ) {
            var formId    = response && response.id ? response.id : '';
            var formTitle = '';
            var fields    = {};

            // Extract field values (skip sensitive data)
            if ( response && response.fields ) {
                var skipTypes = [ 'password', 'creditcard' ];
                Object.keys( response.fields ).forEach( function ( key ) {
                    var field = response.fields[ key ];
                    if ( skipTypes.indexOf( field.type ) === -1 ) {
                        fields[ field.label || key ] = ( field.value || '' ).toString().substring( 0, 50 );
                    }
                } );
            }

            sendGtag( 'form_submission', {
                form_id:        formId.toString(),
                form_title:     formTitle,
                form_location:  window.location.pathname,
                page_url:       window.location.href
            } );

            // Also fire Google Ads conversion for form submit
            if ( typeof gtag === 'function' ) {
                gtag( 'event', 'conversion', {
                    send_to: 'AW-17670100208/form_submit'
                } );
            }
        } );
    }

    // -----------------------------------------------------------------
    // Scroll depth — fire at 25%, 50%, 75%, 100%
    // -----------------------------------------------------------------
    var firedDepths = {};
    var depthThresholds = [ 25, 50, 75, 100 ];

    window.addEventListener( 'scroll', function () {
        var scrollTop    = window.pageYOffset || document.documentElement.scrollTop;
        var docHeight    = document.documentElement.scrollHeight - window.innerHeight;
        if ( docHeight <= 0 ) return;
        var scrollPercent = Math.round( ( scrollTop / docHeight ) * 100 );

        depthThresholds.forEach( function ( threshold ) {
            if ( scrollPercent >= threshold && ! firedDepths[ threshold ] ) {
                firedDepths[ threshold ] = true;
                sendGtag( 'scroll_depth', {
                    depth_threshold: threshold,
                    page_url:        window.location.href
                } );
            }
        } );
    }, { passive: true } );

} )();


( function () {
    var expiry = new Date();
    expiry.setDate( expiry.getDate() + 7 );
    var formatted = ( expiry.getMonth() + 1 ) + '/' + expiry.getDate() + '/' + expiry.getFullYear();

    document.querySelectorAll( '.js-offer-expiry' ).forEach( function ( el ) {
        el.textContent = formatted;
    } );
} )();


/* =============================================================================
   Desktop nav — Services dropdown
   ============================================================================= */

( function () {
    'use strict';

    var trigger = document.querySelector( '.desktop-nav__link--trigger' );
    if ( ! trigger ) return;

    var dropdown = trigger.closest( '.desktop-nav__dropdown' );

    trigger.addEventListener( 'click', function () {
        var isOpen = dropdown.classList.contains( 'is-open' );
        dropdown.classList.toggle( 'is-open', ! isOpen );
        trigger.setAttribute( 'aria-expanded', ! isOpen );
    } );

    // Close when clicking outside
    document.addEventListener( 'click', function ( e ) {
        if ( ! dropdown.contains( e.target ) ) {
            dropdown.classList.remove( 'is-open' );
            trigger.setAttribute( 'aria-expanded', 'false' );
        }
    } );

} )();


/* =============================================================================
   Modal system
   ============================================================================= */

( function () {
    'use strict';

    var activeModal = null;

    function openModal( id ) {
        var modal = document.getElementById( id );
        if ( ! modal ) return;

        // Close any currently open modal first
        if ( activeModal ) closeModal();

        activeModal = modal;
        modal.classList.add( 'is-open' );
        modal.setAttribute( 'aria-hidden', 'false' );
        document.body.style.overflow = 'hidden';

        // Focus first focusable element
        var firstFocusable = modal.querySelector( 'button, input, select, textarea, a[href]' );
        if ( firstFocusable ) {
            setTimeout( function () { firstFocusable.focus(); }, 50 );
        }
    }

    function closeModal() {
        if ( ! activeModal ) return;
        activeModal.classList.remove( 'is-open' );
        activeModal.setAttribute( 'aria-hidden', 'true' );
        activeModal = null;
        document.body.style.overflow = '';
    }

    // Open on [data-modal-trigger] click
    document.addEventListener( 'click', function ( e ) {
        var trigger = e.target.closest( '[data-modal-trigger]' );
        if ( trigger ) {
            e.preventDefault();
            openModal( trigger.getAttribute( 'data-modal-trigger' ) );
        }
    } );

    // Close on [data-modal-close] click (overlay or close button)
    document.addEventListener( 'click', function ( e ) {
        if ( e.target.closest( '[data-modal-close]' ) ) {
            closeModal();
        }
    } );

    // Close on Escape; open on Enter/Space for keyboard-navigable card triggers
    document.addEventListener( 'keydown', function ( e ) {
        if ( e.key === 'Escape' && activeModal ) {
            closeModal();
            return;
        }
        if ( e.key === 'Enter' || e.key === ' ' ) {
            var trigger = document.activeElement && document.activeElement.closest( '[data-modal-trigger]' );
            if ( trigger && trigger.getAttribute( 'role' ) === 'button' ) {
                e.preventDefault();
                openModal( trigger.getAttribute( 'data-modal-trigger' ) );
            }
        }
    } );

} )();
