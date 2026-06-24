/* Solid Guard — Interactive Blocks POC */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------------------------------------------------------------------------
     1 · BEFORE / AFTER SLIDER
     --------------------------------------------------------------------------- */
  (function () {
    var ba = document.getElementById('ba');
    var range = document.getElementById('ba-range');
    if (!ba || !range) return;
    function set(v) {
      v = Math.max(0, Math.min(100, v));
      ba.style.setProperty('--pos', v + '%');
      range.value = v;
    }
    range.addEventListener('input', function () { set(+range.value); });
    function fromPointer(e) {
      var r = ba.getBoundingClientRect();
      var x = (e.touches ? e.touches[0].clientX : e.clientX) - r.left;
      set((x / r.width) * 100);
    }
    var dragging = false;
    ba.addEventListener('pointerdown', function (e) { dragging = true; ba.setPointerCapture(e.pointerId); fromPointer(e); });
    ba.addEventListener('pointermove', function (e) { if (dragging) fromPointer(e); });
    ba.addEventListener('pointerup', function () { dragging = false; });
    ba.addEventListener('pointercancel', function () { dragging = false; });
    set(55);
  })();

  /* ---------------------------------------------------------------------------
     2 · SAVINGS COMPARATOR
     --------------------------------------------------------------------------- */
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
    var countTimer;

    function countUp(el, to) {
      if (reduce) { el.textContent = money(to); return; }
      clearInterval(countTimer);
      var from = 0, t0 = null, dur = 600;
      function step(ts) {
        if (!t0) t0 = ts;
        var p = Math.min((ts - t0) / dur, 1);
        el.textContent = money(Math.round(from + (to - from) * (1 - Math.pow(1 - p, 3))));
        if (p < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }

    function render(job) {
      var d = jobs[job];
      var save = d.replace - d.repair;
      var pct = Math.round((save / d.replace) * 100);
      // bars proportional to the replacement cost (the max)
      barR.style.width = '100%';
      barF.style.width = ((d.repair / d.replace) * 100).toFixed(1) + '%';
      pR.textContent = money(d.replace);
      pF.textContent = money(d.repair);
      sPct.textContent = '~' + pct + '% less than replacing';
      countUp(sAmt, save);
    }

    cmp.querySelectorAll('.cmp__tab').forEach(function (tab) {
      tab.addEventListener('click', function () {
        cmp.querySelectorAll('.cmp__tab').forEach(function (t) { t.classList.remove('is-active'); t.setAttribute('aria-selected', 'false'); });
        tab.classList.add('is-active'); tab.setAttribute('aria-selected', 'true');
        render(tab.dataset.job);
      });
    });
    render('standard');
  })();

  /* ---------------------------------------------------------------------------
     4 · GTA MAP
     --------------------------------------------------------------------------- */
  (function () {
    var nodes = document.getElementById('gta-nodes');
    var linesSvg = document.getElementById('gta-lines');
    var tip = document.getElementById('gta-tip');
    if (!nodes || !linesSvg || !tip) return;

    var cities = [
      { n: 'Toronto', x: 52, y: 66, a: 1 }, { n: 'Etobicoke', x: 43, y: 64 },
      { n: 'North York', x: 53, y: 55 }, { n: 'Scarborough', x: 63, y: 60, a: 1 },
      { n: 'Mississauga', x: 38, y: 71, a: 1 }, { n: 'Brampton', x: 34, y: 55, a: 1 },
      { n: 'Vaughan', x: 47, y: 49 }, { n: 'Markham', x: 59, y: 47 },
      { n: 'Richmond Hill', x: 53, y: 43 }, { n: 'Oakville', x: 31, y: 80 },
      { n: 'Burlington', x: 23, y: 84 }, { n: 'Milton', x: 25, y: 67 },
      { n: 'Ajax', x: 71, y: 62 }, { n: 'Pickering', x: 68, y: 60 },
      { n: 'Whitby', x: 77, y: 61 }, { n: 'Oshawa', x: 82, y: 59 },
      { n: 'Newmarket', x: 52, y: 30 }, { n: 'Aurora', x: 50, y: 35 },
      { n: 'Barrie', x: 45, y: 13 }
    ];
    var hub = cities[0];
    var SVGNS = 'http://www.w3.org/2000/svg';

    cities.forEach(function (c, i) {
      if (i > 0) {
        var ln = document.createElementNS(SVGNS, 'line');
        ln.setAttribute('x1', hub.x); ln.setAttribute('y1', hub.y);
        ln.setAttribute('x2', c.x); ln.setAttribute('y2', c.y);
        ln.dataset.idx = i;
        linesSvg.appendChild(ln);
      }
      var slug = c.n.toLowerCase().replace(/\s+/g, '-');
      var btn = document.createElement('a');
      btn.className = 'gta__city' + (c.a ? ' gta__city--a' : '');
      btn.href = '/glass/locations/' + slug + '/';
      btn.style.setProperty('--x', c.x + '%');
      btn.style.setProperty('--y', c.y + '%');
      btn.innerHTML = '<span>' + c.n + '</span>';
      btn.dataset.idx = i;
      function on() {
        tip.textContent = 'Glass Repair in ' + c.n + '  →';
        tip.style.setProperty('--x', c.x + '%');
        tip.style.setProperty('--y', c.y + '%');
        tip.classList.add('is-on');
        var l = linesSvg.querySelector('line[data-idx="' + i + '"]');
        if (l) l.classList.add('is-lit');
      }
      function off() {
        tip.classList.remove('is-on');
        var l = linesSvg.querySelector('line[data-idx="' + i + '"]');
        if (l) l.classList.remove('is-lit');
      }
      btn.addEventListener('mouseenter', on);
      btn.addEventListener('mouseleave', off);
      btn.addEventListener('focus', on);
      btn.addEventListener('blur', off);
      nodes.appendChild(btn);
    });
  })();

  /* ---------------------------------------------------------------------------
     5 · GLASS-HEAL
     --------------------------------------------------------------------------- */
  (function () {
    var heal = document.getElementById('heal');
    var replay = document.getElementById('heal-replay');
    if (!heal) return;
    var doneTimer;
    function play() {
      if (reduce) { heal.classList.add('is-done'); return; }
      heal.classList.remove('is-done');
      heal.classList.remove('is-playing');
      void heal.offsetWidth; // reflow to restart
      heal.classList.add('is-playing');
      clearTimeout(doneTimer);
      doneTimer = setTimeout(function () {
        heal.classList.remove('is-playing');
        heal.classList.add('is-done');
      }, 2400);
    }
    if (replay) replay.addEventListener('click', play);
    var played = false;
    if ('IntersectionObserver' in window && !reduce) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting && !played) { played = true; play(); }
        });
      }, { threshold: 0.5 });
      io.observe(heal);
    } else {
      heal.classList.add('is-done');
    }
  })();

  /* ---------------------------------------------------------------------------
     3 · VAN PARALLAX (subtle, on the stage so it doesn't fight the float)
     --------------------------------------------------------------------------- */
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
