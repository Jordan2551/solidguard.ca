/* Solid Guard — Interactive Blocks POC (curated)
   Slider is handled by img-comparison-slider (loaded via CDN). */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- Savings teaser ---- */
  (function () {
    var cmp = document.getElementById('cmp');
    if (!cmp) return;
    var jobs = {
      standard:   { replace: 1200, repair: 350 },
      bay:        { replace: 2400, repair: 650 },
      patio:      { replace: 1800, repair: 500 },
      storefront: { replace: 3500, repair: 900 }
    };
    var barR = document.getElementById('bar-replace');
    var barF = document.getElementById('bar-repair');
    var pR = document.getElementById('price-replace');
    var pF = document.getElementById('price-repair');
    var sAmt = document.getElementById('save-amt');
    var sPct = document.getElementById('save-pct');
    var money = function (n) { return '$' + n.toLocaleString('en-CA'); };
    var raf;

    function countUp(el, to) {
      if (reduce) { el.textContent = money(to); return; }
      cancelAnimationFrame(raf);
      var t0 = null, dur = 600;
      function step(ts) {
        if (!t0) t0 = ts;
        var p = Math.min((ts - t0) / dur, 1);
        el.textContent = money(Math.round(to * (1 - Math.pow(1 - p, 3))));
        if (p < 1) raf = requestAnimationFrame(step);
      }
      raf = requestAnimationFrame(step);
    }

    function render(job) {
      var d = jobs[job];
      var save = d.replace - d.repair;
      barR.style.width = '100%';
      barF.style.width = ((d.repair / d.replace) * 100).toFixed(1) + '%';
      pR.textContent = money(d.replace);
      pF.textContent = money(d.repair);
      sPct.textContent = '~' + Math.round((save / d.replace) * 100) + '% less than replacing';
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
