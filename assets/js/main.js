/* TechPlug GH v2 theme scripts */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    /* Mobile menu */
    var menu = document.getElementById('tpg-mobile-menu');
    var panel = document.getElementById('tpg-mobile-panel');
    var toggle = document.getElementById('tpg-menu-toggle');

    function openMenu() {
      if (!menu) return;
      menu.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      requestAnimationFrame(function () { if (panel) panel.style.transform = 'translateX(0)'; });
      if (toggle) toggle.setAttribute('aria-expanded', 'true');
    }
    function closeMenu() {
      if (!menu) return;
      if (panel) panel.style.transform = 'translateX(-100%)';
      document.body.style.overflow = '';
      setTimeout(function () { menu.classList.add('hidden'); }, 300);
      if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) toggle.addEventListener('click', openMenu);
    if (menu) menu.querySelectorAll('[data-close]').forEach(function (el) { el.addEventListener('click', closeMenu); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeMenu(); closeChat(); } });

    /* Mobile search drawer */
    var sToggle = document.getElementById('tpg-search-toggle');
    var sDrawer = document.getElementById('tpg-search-drawer');
    if (sToggle && sDrawer) {
      sToggle.addEventListener('click', function () {
        sDrawer.classList.toggle('hidden');
        var input = sDrawer.querySelector('input[type="search"]');
        if (input && !sDrawer.classList.contains('hidden')) input.focus();
      });
    }

    /* Header elevation */
    var header = document.getElementById('site-header');
    if (header) {
      var onScroll = function () {
        if (window.scrollY > 8) header.classList.add('shadow-card');
        else header.classList.remove('shadow-card');
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    }

    /* WhatsApp chat box: on-page panel, sending opens WhatsApp with the typed message */
    var chat = document.getElementById('tpg-chat');
    var chatPanel = document.getElementById('tpg-chat-panel');
    var chatToggle = document.getElementById('tpg-chat-toggle');
    var chatForm = document.getElementById('tpg-chat-form');
    var chatInput = document.getElementById('tpg-chat-input');

    function openChat() {
      if (!chatPanel) return;
      chatPanel.classList.remove('hidden');
      if (chatInput) chatInput.focus();
    }
    function closeChat() {
      if (chatPanel) chatPanel.classList.add('hidden');
    }
    if (chatToggle) {
      chatToggle.addEventListener('click', function () {
        if (chatPanel && chatPanel.classList.contains('hidden')) openChat();
        else closeChat();
      });
    }
    if (chat) chat.querySelectorAll('[data-close-chat]').forEach(function (el) { el.addEventListener('click', closeChat); });
    /* Any "Chat with us" button elsewhere on the page opens the same panel */
    document.querySelectorAll('[data-open-chat]').forEach(function (el) {
      el.addEventListener('click', function (e) { e.preventDefault(); openChat(); });
    });
    if (chatForm && chatToggle) {
      chatForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var num = chatToggle.getAttribute('data-wa') || '';
        var msg = (chatInput && chatInput.value.trim()) || 'Hi TechPlug GH, I have a question.';
        if (!num) return;
        window.open('https://wa.me/' + num + '?text=' + encodeURIComponent(msg), '_blank', 'noopener');
      });
    }
  });
})();

/* Mini-cart drawer + cart bubble sync + block-cart WhatsApp checkout */
(function () {
  'use strict';
  document.addEventListener('DOMContentLoaded', function () {
    var drawer = document.getElementById('tpg-cart-drawer');
    var panel = document.getElementById('tpg-cart-panel');
    var toggle = document.getElementById('tpg-cart-toggle');

    function openCart() {
      if (!drawer) return;
      drawer.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      requestAnimationFrame(function () { if (panel) panel.style.transform = 'translateX(0)'; });
    }
    function closeCart() {
      if (!drawer) return;
      if (panel) panel.style.transform = 'translateX(100%)';
      document.body.style.overflow = '';
      setTimeout(function () { drawer.classList.add('hidden'); }, 300);
    }
    if (toggle) toggle.addEventListener('click', openCart);
    if (drawer) drawer.querySelectorAll('[data-close-cart]').forEach(function (el) { el.addEventListener('click', closeCart); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeCart(); });

    /* Open the drawer when something is added, sync bubble visibility */
    function syncBubble() {
      document.querySelectorAll('.tpg-cart-bubble').forEach(function (b) {
        var inner = b.querySelector('.tpg-cart-count');
        var n = inner ? parseInt(inner.getAttribute('data-count') || inner.textContent || '0', 10) : 0;
        b.classList.toggle('opacity-0', !(n > 0));
      });
    }
    if (window.jQuery) {
      jQuery(document.body).on('added_to_cart', function () { syncBubble(); openCart(); });
      jQuery(document.body).on('wc_fragments_refreshed wc_fragments_loaded removed_from_cart', syncBubble);
    }
    syncBubble();

    /* Block-based cart page: point its checkout button at WhatsApp checkout */
    if (window.TPG && TPG.waCartUrl) {
      var fixBlockCheckout = function () {
        document.querySelectorAll('.wc-block-cart__submit-container a, a.wc-block-cart__submit-button').forEach(function (a) {
          a.setAttribute('href', TPG.waCartUrl);
          a.textContent = TPG.waCartLabel || 'Checkout on WhatsApp';
        });
      };
      fixBlockCheckout();
      new MutationObserver(fixBlockCheckout).observe(document.body, { childList: true, subtree: true });
    }
  });
})();
