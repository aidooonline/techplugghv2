# TechPlug GH — Google Ads Sprint Plan

Status: DRAFT FOR LOCK-DOWN. Nothing built or imported yet.
Site: techpluggh.com (WordPress + WooCommerce). Account: NEW, to be created by Stephen.
Template basis: the Regalia overhaul (Search, manual CPC, strict hygiene, tiered conversions,
clean UTMs). Same discipline, different niche, market, and structure.
Proposed repo home: `google-ads/` folder in the same theme repo as the content factory.

---

## 0. The economics set the CPA ceiling

Cost GHS 2,000, sell GHS 2,500 to 3,500, so margin is GHS 500 to 1,500 (call it ~1,000
average). Ads are only profitable if cost per sale stays well under that margin.

- Target CPA to start: **under GHS 300 per sale** (leaves real profit at ~1,000 margin).
- Rough feasibility: laptop CPCs in Ghana are low (~GHS 2 to 4). At a 2 to 4% click-to-order
  rate, cost per sale lands around GHS 100 to 200. So unlike Regalia, this vertical can
  actually be profitable on paid search. The job is to protect that with tight structure.
- Budget you set: GHS 3,000 to 6,000/mo = roughly GHS 100 to 200/day.

This is a velocity play: 90 units, thin margin, so the account is built to convert ready
buyers cheaply, not to chase awareness.

---

## 1. How this differs from Regalia (deliberately)

| Dimension | Regalia | TechPlug GH |
|---|---|---|
| Market | Tiny high-intent pool, GHS ceiling ~$30-50/day | High, steady commercial-intent volume |
| Ticket | ~$95,000, one product | GHS 2,500-3,500, many SKUs |
| Goal | A handful of qualified leads | Volume of orders, clear 90 units fast |
| WhatsApp | Banned (bypassed tracking) | A real checkout path — MUST forward gclid |
| Conversion | Lead tiers, manual value | WooCommerce order value (real revenue) |
| Bidding | Manual CPC, low volume | Manual CPC to start, then value-based once data accrues |
| Targeting | Presence-only, avoid tourists | Presence, Ghana (Accra + major cities) |

The Regalia hygiene lessons carry over unchanged (section 4). The structure below is rebuilt
for a multi-SKU, volume, commercial-intent niche.

---

## 2. Account structure (proposed)

New account. Campaign-level prefix `[TPG]` so it stays clean if other brands ever share it
(the same isolation pattern used across your accounts). Search only to start, mirroring the
Regalia template. Shopping/PMax is a deliberate phase-2 decision, not launched blind.

**Campaign 1 — [TPG] Models (highest intent, best CPA)**
Ad groups, one per hero SKU, tightly themed:
- HP EliteBook 830 G6   (33 units — push hardest)
- HP EliteBook 840 G6   (29 units)
- HP EliteBook 840 G5   (20 units)
- HP ProBook 445 Ryzen  (4 units)
- HP ZBook 15 G5         (1 unit — workstation halo)

**Campaign 2 — [TPG] Category (commercial intent)**
Ad groups:
- Business laptops Ghana
- Refurbished / UK-used laptops
- Core i5 laptops
- Affordable laptops Accra

**Campaign 3 — [TPG] Use-case (mid intent, broader)**
Ad groups:
- Student laptops
- Laptops for programming
- Office / business-owner laptops

**Campaign 4 — [TPG] Brand (cheap defense)**
Your own brand terms so you own the SERP for people who already know you.

**Conquest (competitor terms) is deferred.** On Regalia, conquest via AI Max quietly ate 70%
of spend. With a thin margin and GHS 100-200/day, we do not open conquest until the core
campaigns prove CPA. Noted as a phase-2 option, off by default.

Budget split to start (of, say, GHS 150/day): Models 50%, Category 30%, Use-case 15%,
Brand 5%. Move budget toward whatever ad group returns the lowest cost per order.

---

## 3. Keyword architecture (seed set, per campaign)

Exact and phrase to start (broad only later, guarded by negatives). Illustrative, finalized at
build.

- **Models:** "hp elitebook 830 g6 price", "elitebook 840 g5 ghana", "hp elitebook 840 g6 price
  in ghana", "hp probook ryzen 5 ghana", "hp zbook 15 price ghana", plus each model + "buy",
  "for sale", "accra".
- **Category:** "business laptop ghana", "uk used laptops ghana", "refurbished laptops accra",
  "core i5 laptop price ghana", "cheap laptops in accra", "hp laptops for sale ghana".
- **Use-case:** "laptop for students ghana", "laptop for programming ghana", "office laptop
  ghana", "best laptop under 3500 ghana".
- **Brand:** "techplug gh", "techplug ghana", "techpluggh".

Each ad group's keywords route to the matching landing page (its model page, category page, or
the buyer-guide article that sells that use-case).

---

## 4. Locked hygiene defaults (carried from the Regalia overhaul)

These are non-negotiable at build. They are the exact settings whose absence wasted spend on
Regalia:

- **AI Max: OFF.**
- **Text customization: OFF.**
- **Final URL expansion: OFF.**
- **Targeting: presence** ("Location of presence"), not "presence or interest."
- **Locations:** Ghana, weighted to Accra and major cities (Kumasi, Takoradi) if delivery
  supports it. Confirm delivery coverage before widening.
- **Bidding:** Manual CPC to start so we control cost while learning; graduate to Maximize
  Conversion Value / tROAS only after ~15-30 orders of conversion data.
- **Ad rotation:** optimize for clicks early, then let Google optimize once conversions flow.
- **Networks:** Google Search only (Search Partners and Display off to start).
- **UTMs:** clean and consistent on every final URL:
  `?utm_source=google&utm_medium=cpc&utm_campaign=tpg-{campaign}&utm_term={keyword}`
  `&utm_content={creative}&matchtype={matchtype}&device={device}&campaignid={campaignid}`
  `&adgroupid={adgroupid}&gclid={gclid}` (or auto-tagging on, which is simpler and preferred).

---

## 5. Ad copy principle

Every RSA leads with model + price to self-qualify (the Regalia lesson: make the ad state the
offer so browsers filter themselves out). Examples of the direction (finalized at build):

- Headlines: "HP EliteBook Core i5", "From GHS 2,500", "UK-Used, Fully Tested", "256GB SSD,
  Fast i5", "Buy in Accra, Delivery Available", "1-Year-Grade Business Laptops".
- Descriptions: lead with price, spec, trust (tested, warranty), and a clear CTA to buy or
  message on WhatsApp.

Price in the ad is the single biggest efficiency lever here.

---

## 6. Conversion tracking + attribution (build item, must exist before scale)

- **Primary conversion = WooCommerce purchase** (order value passed as revenue), so bidding can
  eventually chase ROAS.
- **Secondary = Add to cart / Begin checkout**, as upper-funnel signals, set Secondary so they
  never become the bid target.
- **WhatsApp-cart path:** the theme already creates tracked pending WooCommerce orders from
  WhatsApp checkout. That path MUST carry the gclid into the order, or every WhatsApp sale is
  invisible to Google and bidding optimizes against half the truth. This is the single most
  important build item on the ads side. Options: capture gclid on the landing page, store it
  with the cart, write it onto the order; then offline-import WhatsApp orders as conversions.
- Mirror the Regalia conversion-actions discipline: **Sale/Order = Primary**, everything else
  Secondary.

---

## 7. Negative keywords (seed)

Cross-campaign shared list: "free", "jobs", "repair", "repairs", "screen replacement",
"charger", "battery", "parts", "drivers", "manual", "wallpaper", "rent", "hire", "for rent",
"cracked". Non-stocked brands as negatives in Category/Use-case (we only sell HP): "dell",
"lenovo", "thinkpad", "macbook", "apple", "asus", "acer", "hp pavilion" (consumer line we do
not stock). Out-of-market cities/countries as negatives.

---

## 8. The CSV push flow (how you import, like Regalia)

1. I generate a **Google Ads Editor-compatible CSV** (`TPG-FULL-IMPORT.csv`) with campaigns,
   ad groups, keywords, negatives, RSAs, sitelinks, settings, and final URLs — one file, the
   same format that imported cleanly for Regalia.
2. You create the new account, then in **Google Ads Editor: Account > Import > from file**,
   select the CSV, review, and **Post**.
3. A few settings Editor cannot set (Location "Presence", AI Max off) you confirm once in the
   **web UI** after posting. The CSV ships with a short checklist of those UI-only items.
4. You own the account and the push. I build and audit the file; I do not touch the live
   account. (Same boundary as Regalia.)

The CSV is built in Sprint 2, after final URLs and conversion setup are locked — not before,
because the final URLs and UTM/gclid handling change what goes in every row.

---

## 9. Sprints

**Sprint 0 — Pre-flight**
- Confirm final URLs exist (model pages / category pages / buyer-guide landing pages live and
  converting). If WooCommerce products are not listed yet, that is the blocking dependency.
- Confirm delivery coverage (which cities) so targeting is honest.
- Decide auto-tagging (recommended) vs manual UTMs.

**Sprint 1 — Conversion tracking**
- Wire WooCommerce purchase conversion + gclid capture, including the WhatsApp-cart path.
- Verify a test order fires a conversion before any spend. Never scale on unverified tracking.

**Sprint 2 — Build the CSV**
- Generate `TPG-FULL-IMPORT.csv` (4 campaigns, all ad groups, keywords, negatives, RSAs, clean
  final URLs). Audit it (the Regalia audit passes: no invalid columns, no self-blocking
  negatives, exact/phrase negative logic correct).
- Hand it to you with the UI-only checklist.

**Sprint 3 — Launch and learn**
- You post it. Manual CPC, low daily budget. Watch search terms, add negatives weekly, prune
  losers, shift budget toward the lowest cost-per-order ad groups.

**Sprint 4 — Scale what works**
- Once ~15-30 orders of data exist, graduate winners to value-based bidding; consider Shopping
  feed / PMax and conquest as deliberate additions, each with its own lock-down.

Definition of done: tracking verified with a real test order; CSV imports with zero errors;
every ad group points at a live, relevant, price-stating landing page.

---

## 10. CONFIRM BEFORE BUILD (open items — not assuming)

1. **Final URLs.** Are the 90 units listed as WooCommerce products? Ads must point at live
   product/category pages or dedicated landing pages. This is the same dependency as the
   content factory and it gates the CSV.
2. **Delivery coverage** — Accra only, or Kumasi/Takoradi too? Sets the geo targeting.
3. **Conversion setup** — do you already have the Google Ads tag / GTM on techpluggh.com, or do
   we install it in Sprint 1?
4. **Auto-tagging vs manual UTMs** — I recommend auto-tagging (gclid) plus one utm_campaign for
   reporting. Your call.
5. **Phone/WhatsApp number** for call and message assets.
6. **Sign-off on the campaign structure** in section 2 before I build the CSV.

---

## 11. Standing rules

- No em dash (U+2014) anywhere.
- I build and audit the CSV; you own and push the account. I do not edit the live account.
- Never scale on unverified conversion tracking; verify with a real test order first.
- "Accra International Airport", never "Kotoka".
- Never attribute a company name to Stephen.
- Never claim done without verifying the live result.
