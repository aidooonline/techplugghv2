# TechPlug GH v2 - Aurora theme

Vivid, media-rich WooCommerce theme for techpluggh.com. Built from client feedback on v1:

1. Easier navigation: prominent header search, primary nav bar plus a brand quick-links row, brand chips in the mobile menu.
2. On-page WhatsApp chat box (clearly WhatsApp-branded panel with a message input); sending opens WhatsApp with the typed message. No silent redirects.
3. Categories are brands (HP, Dell, Lenovo, MacBooks, Accessories), not purposes.
4. New "Aurora" palette: midnight navy base, electric blue > violet > cyan gradient signature, amber for deals. Gradient buttons, glow hovers, shimmer promo bar.
5. Hero is a banner containing a live grid of available products with specs and prices (no static picture).

## Setup (same workflow as v1)
1. Activate theme, ensure WooCommerce active, currency GHS.
2. Tools > TechPlug GH Setup > Run Full Setup (brand categories + tiles, pages, menu, 31 products with aurora product cards, deals banner).
3. Update Product Details (researched specs + SEO content), Fetch web images (optional), Refresh Category Images if tiles need overwriting.
4. WooCommerce > Settings > Payments > Order via WhatsApp: set the number (or Customize > Contact & Social). This powers the chat box, Buy Now buttons and gateway.

## Build
npm install && npm run build (Tailwind -> assets/css/main.css)
