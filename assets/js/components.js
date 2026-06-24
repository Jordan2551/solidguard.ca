/* Solid Guard — reusable block behaviours
   (before/after slider self-initialises via the img-comparison-slider element;
    the floating van animates via CSS only — no JS) */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var money = function (n) { return '$' + Math.round(n).toLocaleString('en-CA'); };
  var range = function (a) { return money(a[0]) + '–' + money(a[1]); };
  var mid = function (a) { return (a[0] + a[1]) / 2; };

  /* ---- Savings teaser (supports multiple instances per page) ---- */
  Array.prototype.forEach.call(document.querySelectorAll('[data-sg-cmp]'), function (cmp) {
    var data;
    try { data = JSON.parse(cmp.getAttribute('data-sg-pricing')); } catch (e) { return; }
    var q = function (sel) { return cmp.querySelector(sel); };
    var elDesc = q('[data-sg-desc]'),
        barR = q('[data-sg-bar-replace]'), barF = q('[data-sg-bar-repair]'),
        pR = q('[data-sg-price-replace]'), pF = q('[data-sg-price-repair]'),
        sAmt = q('[data-sg-save]'), sPct = q('[data-sg-pct]');
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
      var d = data[job];
      if (!d) return;
      var rMid = mid(d.repair), pMid = mid(d.replace), save = pMid - rMid;
      if (elDesc) elDesc.textContent = d.desc;
      if (barR) barR.style.width = '100%';
      if (barF) barF.style.width = ((rMid / pMid) * 100).toFixed(1) + '%';
      if (pR) pR.textContent = range(d.replace);
      if (pF) pF.textContent = range(d.repair);
      if (sPct) sPct.textContent = 'less — ~' + Math.round((save / pMid) * 100) + '% off replacing';
      if (sAmt) countUp(sAmt, save);
    }

    Array.prototype.forEach.call(cmp.querySelectorAll('.sg-cmp__tab'), function (tab) {
      tab.addEventListener('click', function () {
        Array.prototype.forEach.call(cmp.querySelectorAll('.sg-cmp__tab'), function (t) {
          t.classList.remove('is-active'); t.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('is-active'); tab.setAttribute('aria-selected', 'true');
        render(tab.dataset.job);
      });
    });
    // default state already rendered server-side — no initial render needed.
  });
})();
