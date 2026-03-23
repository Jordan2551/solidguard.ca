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
