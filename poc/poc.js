/* Solid Guard — Interactive Blocks POC (curated)
   Slider is handled by img-comparison-slider (loaded via CDN). */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- Savings teaser ---- */
  (function () {
    var cmp = document.getElementById('cmp');
    if (!cmp) return;
    // Market ranges (CAD, Toronto/GTA) — mirrors poc/pricing-data.json. [low, high]
    var types = {
      standard:   { desc: 'Double-pane sealed unit, up to ~3×4 ft',         repair: [350, 650],  replace: [600, 1200] },
      bay:        { desc: '3-panel — we replace the failed sealed unit(s)',  repair: [700, 1500], replace: [2800, 6000] },
      patio:      { desc: 'Sealed glass panel in the existing door',         repair: [500, 1000], replace: [1500, 5500] },
      storefront: { desc: 'Commercial tempered/plate glass, per panel',      repair: [600, 1500], replace: [1500, 3000] }
    };
    var elDesc = document.getElementById('cmp-desc');
    var barR = document.getElementById('bar-replace');
    var barF = document.getElementById('bar-repair');
    var pR = document.getElementById('price-replace');
    var pF = document.getElementById('price-repair');
    var sAmt = document.getElementById('save-amt');
    var sPct = document.getElementById('save-pct');
    var money = function (n) { return '$' + Math.round(n).toLocaleString('en-CA'); };
    var range = function (a) { return money(a[0]) + '–' + money(a[1]); };
    var mid = function (a) { return (a[0] + a[1]) / 2; };
    var raf;

    function countUp(el, to) {
      if (reduce) { el.textContent = money(to); return; }
      cancelAnimationFrame(raf);
      var t0 = null, dur = 600;
      function step(ts) {
        if (!t0) t0 = ts;
        var p = Math.min((ts - t0) / dur, 1);
        el.textContent = money(to * (1 - Math.pow(1 - p, 3)));
        if (p < 1) raf = requestAnimationFrame(step);
      }
      raf = requestAnimationFrame(step);
    }

    function render(job) {
      var d = types[job];
      var rMid = mid(d.repair), pMid = mid(d.replace);
      var save = pMid - rMid;
      if (elDesc) elDesc.textContent = d.desc;
      barR.style.width = '100%';
      barF.style.width = ((rMid / pMid) * 100).toFixed(1) + '%';
      pR.textContent = range(d.replace);
      pF.textContent = range(d.repair);
      sPct.textContent = 'less — ~' + Math.round((save / pMid) * 100) + '% off replacing';
      countUp(sAmt, save);
    }

    cmp.querySelectorAll('.cmp__tab').forEach(function (tab) {
      tab.addEventListener('click', function () {
        cmp.querySelectorAll('.cmp__tab').forEach(function (t) {
          t.classList.remove('is-active'); t.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('is-active'); tab.setAttribute('aria-selected', 'true');
        render(tab.dataset.job);
      });
    });
    render('standard');
  })();

  /* ---- Van parallax (subtle; float keyframes stay on the img) ---- */
  (function () {
    var stage = document.querySelector('.van-stage');
    if (!stage || reduce) return;
    var ticking = false;
    function update() {
      var r = stage.getBoundingClientRect();
      var center = r.top + r.height / 2 - window.innerHeight / 2;
      stage.style.transform = 'translate3d(' + (center * -0.04).toFixed(1) + 'px,' + (center * -0.03).toFixed(1) + 'px,0)';
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (!ticking) { ticking = true; requestAnimationFrame(update); }
    }, { passive: true });
    update();
  })();
})();
