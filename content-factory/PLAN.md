# TechPlug GH - Organic Content Factory & Intelligence Platform

Sprint plan and system design. Status: DRAFT FOR LOCK-DOWN. Nothing built or published yet.
Owner: Stephen (aidooonline). Site: techpluggh.com (WordPress + WooCommerce, Aurora v2 theme).
Supply this plan is built around: 90 HP business laptops (mr_boadi supply).

---

## 0. The reality that shapes every decision

Cost GHS 2,000/unit. Sell GHS 2,500 to 3,500. Margin is only GHS 500 to 1,500 per unit.
This is a VELOCITY play, not a premium play. The whole engine exists to move 90 units fast at
the lowest cost per sale. Content and ads both lead with model + price to pull ready buyers,
not browsers.

### The supply, as content sees it

| Hero bucket | Units | Typical spec | Role in the plan |
|---|---|---|---|
| HP EliteBook 830 G6 | 33 | i5 8th gen, 8GB, 256GB SSD | Primary hero. Most stock. Push hardest. |
| HP EliteBook 840 G6 | 29 | i5, mostly 8GB (a few 16/32GB), 256GB | Second hero. |
| HP EliteBook 840 G5 | 20 | i5, mix of 8GB and 16GB, 256GB | Third hero. |
| HP ProBook 445 (Ryzen 5) | 4 | Ryzen 5, 8GB | Value / AMD angle. |
| HP ZBook 15 G5 | 1 | i7, 16GB, 512GB | Premium workstation halo piece. |
| 745 G6 / 830 G5 / 250 G7 | 3 | mixed | Long-tail, one-off listings. |

82 of 90 units are "HP EliteBook 830/840, Core i5, 256GB SSD." That single phrase is the
commercial spine of the entire content and ads program.

---

## 1. Operating model

1. **All work lives in the theme repo** (`aidooonline/techplugghv2` - CONFIRM) inside a new
   top-level folder: `content-factory/`. This is the source of truth. It holds every article
   spec, the locked writing standard, the publishing engine, the content index, and this plan.
2. **Publishing is direct to WordPress** over the REST API using an Application Password you
   provide. Articles are created as real posts with categories, tags, featured image, schema,
   and SEO meta set programmatically. No copy-paste.
3. **Dating:** batch 1 is back-dated, batch 2 is future-scheduled, both at strict 3-day
   intervals (see section 3).
4. **Organic first.** We lock, research, write, and publish the articles. Google Ads and the
   data executor come after, but are designed for here so nothing has to be rebuilt.

### Repo folder layout (proposed)

```
content-factory/
  PLAN.md                     # this document
  writing-standard.md         # the locked article standard (GEO/SEO/AI-Overview/CVR)
  content-index.md            # every article: slug, title, keyword, status, publish date, WP id
  research/
    <slug>.research.md        # per-article competitive + keyword + SERP research
  specs/
    <slug>.spec.md            # per-article brief the writer/engine builds from
  articles/
    <slug>.html               # final WordPress post body (HTML), ready to publish
  engine/
    publish.py                # WP REST publisher: create, back-date, schedule, idempotent
    dedup_check.py            # grep index + live WP REST search before writing (locked rule)
    reindex.py                # rebuild content-index.md from live WP
  config/
    wp.env.example            # WP base URL + app-password var names (never commit the secret)
    schedule.json             # the computed date for every article
```

---

## 2. Content architecture (pillar and cluster)

Five clusters. Each has one pillar that owns the head term and children that capture the
long tail and feed links up to the pillar and out to the WooCommerce product/category pages.

- **A. Model money pages** - 830 G6, 840 G6, 840 G5, ProBook Ryzen, ZBook. Bottom funnel.
- **B. Category and trust** - "UK used laptops in Ghana," "refurbished business laptops Accra,"
  "Core i5 laptops price in Ghana." Converts and builds entity authority.
- **C. Comparisons (GEO/AI-Overview magnets)** - G5 vs G6, EliteBook vs ProBook, EliteBook vs
  Dell vs Lenovo, 8GB vs 16GB, new vs UK-used. These win AI Overview and "vs" SERPs.
- **D. Buyer guides / use-case (top and mid funnel)** - best laptop under GHS 3,500, for
  students, for programming, for business owners, price guides. High volume, high GEO value.
- **E. Local + EEAT** - where to buy in Accra, how to check a used laptop, warranty/grading,
  buying online safely, the evergreen deals hub.

---

## 3. The publishing schedule (computed, exact)

20 articles, 3-day interval, landing #20 on today. Span = 57 days.

| # | Publish date | Days ago |
|---|---|---|
| 1 | 2026-05-19 | 57 |
| 2 | 2026-05-22 | 54 |
| 3 | 2026-05-25 | 51 |
| 4 | 2026-05-28 | 48 |
| 5 | 2026-05-31 | 45 |
| 6 | 2026-06-03 | 42 |
| 7 | 2026-06-06 | 39 |
| 8 | 2026-06-09 | 36 |
| 9 | 2026-06-12 | 33 |
| 10 | 2026-06-15 | 30 |
| 11 | 2026-06-18 | 27 |
| 12 | 2026-06-21 | 24 |
| 13 | 2026-06-24 | 21 |
| 14 | 2026-06-27 | 18 |
| 15 | 2026-06-30 | 15 |
| 16 | 2026-07-03 | 12 |
| 17 | 2026-07-06 | 9 |
| 18 | 2026-07-09 | 6 |
| 19 | 2026-07-12 | 3 |
| 20 | 2026-07-15 | 0 (today) |

**Future batch:** 30 slots, 3-day interval, from 2026-07-18 to 2026-10-13. That is the next
90 days. Total planned library = 50 articles.

Note on realism: back-dated posts are a legitimate way to seed a content library with a
publish history, but Google indexes them from when it first crawls them, not from the stamped
date. The value is a coherent archive and internal-link depth on day one, not retroactive
ranking. Worth knowing so expectations are set.

---

## 4. The first 20 (back-dated batch) - proposed slate for lock-down

Ordered so the earliest dates carry foundational trust/category pieces and the most recent
dates carry the sharpest commercial pieces (freshest = highest intent).

| # | Working title | Cluster | Primary keyword | Intent |
|---|---|---|---|---|
| 1 | UK Used Laptops in Ghana: What It Means and Why People Buy Them | B | uk used laptops ghana | Trust |
| 2 | Is a Refurbished Laptop Worth It? An Honest Guide for Ghana | C | is refurbished laptop worth it | GEO |
| 3 | New vs UK-Used Laptop in Ghana: The Real Cost Breakdown | C | new vs used laptop ghana | GEO |
| 4 | Refurbished Business Laptops in Accra: A Buyer's Guide | B | refurbished laptops accra | Commercial |
| 5 | How Much Does a Good Laptop Cost in Ghana? (2026 Price Guide) | D | laptop price in ghana | GEO |
| 6 | Core i5 Business Laptops Price in Ghana | B | core i5 laptop price ghana | Commercial |
| 7 | Best Business Laptop in Ghana Under GHS 3,500 | D | best laptop under 3500 ghana | GEO |
| 8 | HP EliteBook vs ProBook: Which Should You Buy? | C | elitebook vs probook | GEO |
| 9 | 8GB vs 16GB RAM: How Much Do You Actually Need? | C | 8gb vs 16gb ram laptop | GEO |
| 10 | Best Laptop for University Students in Ghana | D | best laptop for students ghana | Use-case |
| 11 | Best Laptop for Programming and Coding in Ghana | D | best laptop for programming ghana | Use-case |
| 12 | Best Laptop for Business Owners and Accountants in Ghana | D | business laptop ghana | Use-case |
| 13 | HP EliteBook 840 G5 vs 840 G6: Differences That Matter | C | elitebook 840 g5 vs g6 | Comparison |
| 14 | How to Check a Used Laptop Before You Buy (Ghana Guide) | E | how to check used laptop | Trust |
| 15 | Where to Buy Original HP Laptops in Accra | E | buy hp laptops accra | Local |
| 16 | HP EliteBook 830 G6 Full Review and Specs | A | hp elitebook 830 g6 review | EEAT/hero |
| 17 | HP EliteBook 830 G6 Price in Ghana | A | elitebook 830 g6 price ghana | Money |
| 18 | HP EliteBook 840 G5 Price in Ghana | A | elitebook 840 g5 price ghana | Money |
| 19 | HP EliteBook 840 G6 Price in Ghana | A | elitebook 840 g6 price ghana | Money |
| 20 | Laptop Deals in Accra This Month (Evergreen Hub) | E | laptop deals accra | Money/hub |

### Future 30 (backlog for the scheduled batch)

Model reviews (840 G5 review, 840 G6 review, ProBook 445 Ryzen review, ZBook 15 G5 for
design/engineering), more comparisons (EliteBook vs Dell Latitude vs Lenovo ThinkPad, Intel
vs Ryzen for business, SSD vs HDD), more use-cases (working from home, NSS personnel,
freelancers and traders, content creators, students by program), local long-tail (laptop
shops by Accra area, delivery in Kumasi/Takoradi), seasonal (back-to-school, Black Friday /
year-end), and trust/support (what UK-used grading means, warranty explained, buying online
safely, trade-in, laptop care in Ghana's heat and power conditions). Final 30 locked once the
first 20 are approved.

---

## 5. The locked writing standard (draft - becomes writing-standard.md)

Every article must hit all of these or it does not publish:

- **Length:** 1,200 to 2,000 words for guides/comparisons; 900 to 1,400 for model money pages.
- **AI Overview / GEO structure:** a direct, extractable answer in the first 60 words; a clear
  H2 question structure matching People Also Ask; a comparison or spec table where relevant;
  a short "bottom line" summary block. This is what gets cited by AI answer engines.
- **Schema:** Article + FAQPage on every post; Product/Offer schema on model money pages;
  BreadcrumbList sitewide.
- **EEAT:** named author entity (TechPlug GH), real specs, honest grading language, at least
  two named external references where a claim needs backing (no invented sources).
- **Conversion:** every article ends with a CTA block linking to the exact WooCommerce
  product or category page for the models discussed, plus the tracked WhatsApp-cart path. CTAs
  carry UTM so organic-to-order is measurable.
- **Internal linking:** every article links up to its pillar, sideways to one comparison, and
  down to at least one product page. The deals hub (#20) links to all money pages.
- **Local signals:** prices in GHS, Accra/Ghana context, delivery and pickup mentions.
- **Hard rules:** no em dash (U+2014) anywhere. "Accra International Airport" never "Kotoka."
  Never claim a spec the supply does not have. No company name attributed to Stephen.

---

## 6. The research protocol (per article, before writing)

This is what makes them "severely researched" rather than generic. For each article:

1. **Dedup gate (locked):** grep `content-index.md` by title text AND run a live WP REST
   search on the topic keywords. If it exists, update in place, never duplicate. (This rule
   already cost a real duplication incident on another site; it is non-negotiable.)
2. **SERP capture:** pull the current top 10 for the primary keyword. Note who ranks, format
   (guide vs listing vs forum), and word count to beat.
3. **PAA + AI Overview:** capture People Also Ask questions and whether an AI Overview shows,
   and what it currently cites. Those questions become H2s; that citation is what we displace.
4. **Keyword set:** primary + secondary + local variants, with rough volume/difficulty.
5. **Angle decision:** the one reason our article is the best answer (price transparency,
   honest grading, local delivery, real specs from live stock).
6. Write the spec, then the article, then publish.

---

## 7. Sprints

**Sprint 0 - Foundations (setup, no content yet)**
- Create `content-factory/` in the repo. Add PLAN.md, writing-standard.md, empty index.
- Build `engine/publish.py` (WP REST, app-password auth, back-date, schedule, idempotent,
  sets category/tags/featured image/schema/meta). Test on ONE throwaway draft first.
- Build `dedup_check.py` and `reindex.py`. Seed `content-index.md` from live WP.
- Confirm SEO plugin in use (Yoast / The SEO Framework / Rank Math) so meta is set correctly.
- Decide categories/tags taxonomy for the blog.

**Sprint 1 - First 5 articles, back-dated**
- Research + write + publish articles 1 to 5 (dates 19 May to 31 May). Verify each is live,
  indexed-eligible, schema valid, links resolve, CTA points at a real product page.

**Sprint 2 - Articles 6 to 12**

**Sprint 3 - Articles 13 to 20** (completes the back-dated batch, lands #20 today)

**Sprint 4 - Lock the future 30, then schedule-publish in waves** (3-day interval, +90 days)

**Sprint 5 - Measurement wired** (GSC, indexation check, AI Overview citation tracking)

**Sprint 6 - Google Ads intelligence layer** (separate lock-down, after organic is running)

Definition of done per article: live URL returns 200, schema validates, primary keyword in
title/H1/first paragraph/slug, at least 3 internal links, CTA links to a real SKU, entry
added to content-index.md with WP post id and publish date. Never "done" on write alone.

---

## 8. What I recommend we add to make this a serious factory + intelligence platform

You asked for the full vision. Here is what turns 50 articles into a system.

### Article publishing factory
- **Manifest-driven, like DataHouse.** Each article is a spec file, not ad-hoc work. The engine
  reads specs and publishes. Adding an article = adding a spec, not new code.
- **Featured-image generation.** Reuse your fal.ai article-cover generator pattern for laptop
  covers (model shots / branded templates) so no post ships imageless.
- **Idempotent publisher.** Re-running never double-posts; it updates by slug. This is what
  makes back-dating and scheduling safe to re-run.
- **Auto internal-linking graph.** A small map of pillar/cluster/product so the engine can
  inject the right up/side/down links automatically and keep the deals hub current.
- **Live content-index as source of truth**, rebuilt from WP so it never goes stale (the stale
  index is exactly what caused the past duplication incident).

### Google Ads intelligence platform (built for now, run later)
- **Keyword → SKU → margin map.** Every target keyword tied to the model it sells and that
  model's margin, which sets a hard CPA ceiling (with GHS 500 to 1,500 margin, CPA has to stay
  low; this map enforces it).
- **Ad-hygiene defaults as a checklist** (carried from the Regalia overhaul): AI Max off, text
  customization off, final URL expansion off, presence-only targeting, manual CPC to start,
  clean UTMs. These prevent the exact leaks that wasted spend on Regalia.
- **Tiered conversion actions:** Lead / Add-to-cart / Order / Sale, with Sale = Primary so
  bidding chases revenue, not form fills.
- **Attribution through WhatsApp checkout.** Unlike Regalia (where WhatsApp was banned because
  it bypassed tracking), TechPlug uses a WhatsApp-cart checkout, so that path MUST forward
  utm_term and gclid into the order, or ad spend is flying blind. This is a build item.
- **Search-term mining + negative automation** feeding back weekly.
- **Budget-vs-inventory pacing:** the platform knows units remaining per SKU and paces spend so
  we do not keep advertising a model that has sold out.

### Data intelligence executor
- **One joined view** of: inventory (units left per SKU) + organic performance (GSC clicks,
  impressions, position) + ads performance + WooCommerce orders + attribution
  (keyword → order → margin). This is the decision layer: which SKU to push, which keyword
  actually converts, when a model is nearly sold out, when to reorder.
- Start lean (a scheduled script writing to a sheet or a small Filament dashboard in your
  usual Laravel pattern). Grows into the real executor over time.

---

## 9. CONFIRM BEFORE BUILD (open items - do not want to assume)

1. **Repo name/branch** - is it `aidooonline/techplugghv2`, and which branch do I work on?
2. **Application password** - you provide the WP username + app password for techpluggh.com.
3. **Are the WooCommerce products already listed?** Conversion articles must link to real
   product/category URLs. If the 90 units are not yet listed as products, that is a dependency
   we sequence first (or I write to category pages until they exist).
4. **SEO plugin in use** on techpluggh.com (Yoast / TSF / Rank Math) so meta/schema is set the
   right way.
5. **Blog author/byline** to display (never your name unless you say so).
6. **Sign-off on the 20-article slate** in section 4 before any research or writing begins.

---

## 10. Standing rules (apply to everything here)

- No em dash (U+2014) anywhere in code, content, or comments.
- Never claim done without verifying the live result.
- Dedup gate (grep index + live WP REST search) before writing any article.
- Scrub PATs from git remotes after every push.
- Never attribute a company name to Stephen; ask before using any byline.
- "Accra International Airport," never "Kotoka."
