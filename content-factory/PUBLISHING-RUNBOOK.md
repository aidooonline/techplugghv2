# PUBLISHING RUNBOOK — execute when techpluggh.com is allowlisted

For the next agent, in a fresh chat that HAS live access to techpluggh.com. This session
prepared everything but could not reach the site (the network allowlist only takes effect in a
new session). Follow these steps in order. Do not skip verification.

## Read first (in this order)
1. content-factory/PLAN.md
2. content-factory/PRODUCTS-AND-ARTICLES.md
3. content-factory/GEO-DATA-LAYER.md
4. content-factory/handover/SESSION-2026-07-15.md  (master resume, latest at bottom)
5. this file

## Preconditions
- techpluggh.com is allowlisted (bash can reach https://techpluggh.com/wp-json/).
- The SEO Framework plugin is installed and active (SEO_PLUGIN=tsf).
- WooCommerce active, currency GHS.
- Create content-factory/config/wp.env from wp.env.example and fill it:
  WP_BASE_URL=https://techpluggh.com
  WP_USER=xssee
  WP_APP_PASSWORD=<the application password Stephen provides>
  SEO_PLUGIN=tsf
  (wp.env is git-ignored. Never commit it. Never print the password.)

## Step 0 — confirm connectivity and seed the index
```
python engine/reindex.py           # pulls live posts into content-index.md (source of truth)
```
If reindex errors on auth, the app password or user is wrong. Fix before continuing.

## Step 1 — confirm prices and storage with Stephen (BLOCKING)
- Confirm or edit the 12 proposed prices in products/mr-boadi-products.json (regenerate with
  engine/build_products.py after editing the price fields in that script, or edit the JSON
  directly).
- Confirm the SSD on the 12 units logged as 0GB in the sheet. Do NOT list "256GB SSD" on any
  unit whose storage is not confirmed (standing rule: never claim a spec a unit lacks).

## Step 2 — create the products
```
python engine/create_products.py --dry-run    # sanity check
python engine/create_products.py               # creates/updates all 12, idempotent by SKU
```
This writes products/sku-permalinks.json (SKU -> live product URL). If WooCommerce rejects the
application-password auth, create WooCommerce API keys (WooCommerce > Settings > Advanced >
REST API, Read/Write) and add WC_KEY and WC_SECRET to wp.env, then re-run.

## Step 3 — wire article CTAs to the real product URLs
Each ready article currently links its CTA to /product-category/hp-laptops/. Update to the exact
product permalink from products/sku-permalinks.json:

| Article slug | Product SKU |
|---|---|
| hp-elitebook-830-g6-price-in-ghana | TPG-HP-830G6-I5-8-256 |
| hp-elitebook-840-g6-price-in-ghana | TPG-HP-840G6-I5-8-256 |
| hp-elitebook-840-g5-price-in-ghana | TPG-HP-840G5-I5-8-256 |
| hp-probook-445-ryzen-5-price-in-ghana | TPG-HP-445RG6-R5-8-256 |
| hp-zbook-15-g5-workstation-ghana | TPG-HP-ZB15G5-I7-16-512 |

Replace the href in each articles/<slug>.html, keeping the UTM query string
(?utm_source=organic&utm_medium=article&utm_campaign=model-money&utm_content=<code>).

## Step 4 — publish the ready articles (back-dated)
```
python engine/publish_batch.py --dry-run    # shows 5 ready, 15 to_write
python engine/publish_batch.py               # publishes the 5 ready money pages
```
publish.py back-dates each post to its slot date, sets category/tags, verifies the post is live
(returns 200, slug matches) and prints the link. It refuses any file containing an em dash.

## Step 5 — verify
```
python engine/reindex.py                     # rebuild content-index.md from live WP
```
Open 2 or 3 live URLs. Confirm: title/H1/price present, FAQ renders, JSON-LD is in the source,
CTA links to the real product page. Validate schema at Google Rich Results Test.

## Step 6 — write and publish the remaining 15 back-dated articles
The 15 to_write slots (1 to 15) are defined in config/schedule.json with slugs, titles, dates,
categories, tags. For each: run the dedup gate, research, write to articles/<slug>.html to
writing-standard.md (which now includes the citation-moat requirements), then:
```
python engine/publish_batch.py               # re-run; publishes any newly written articles
```
Milestone rule: after every 10 articles, commit the repo and append a dated handover, so a chat
switch never loses work.

## Step 7 — future batch (next 90 days)
After the back-dated 20 are live, schedule the backlog (model reviews, more comparisons,
use-cases, local long-tail, seasonal) at 3-day intervals from 2026-07-18 to 2026-10-13 using
status future in publish.py (WordPress auto-schedules a future date). Build the two new GEO
assets from GEO-DATA-LAYER.md: the Ghana Business Laptop Price Index page and /llms.txt
(engine/build_llms_txt.py, to be written; note it deploys at the site root, not the excluded
factory folder).

## Commit discipline (every milestone)
```
git add -A && git commit -m "..."           # never commit config/wp.env or any secret
# push with the PAT in the URL, then scrub:
git push "https://x-access-token:<PAT>@github.com/aidooonline/techplugghv2.git" main
git remote set-url origin "https://github.com/aidooonline/techplugghv2.git"
```
Sweep for secrets and em dashes before every commit:
```
grep -rn "wPcP\|DuMN\|github_pat" . | grep -v '^./.git' || echo CLEAN
grep -rlP "\x{2014}" content-factory || echo "no em dash"
```

## Safety and standing rules
- No em dash (U+2014) anywhere. publish.py enforces this.
- Never claim done without a live 200 and a matching slug. reindex proves it.
- Dedup gate (engine/dedup_check.py) before writing any new article.
- Scrub the PAT from the git remote after every push.
- Never attribute a company name to Stephen. Byline: confirm with Stephen (not his name).
- "Accra International Airport", never "Kotoka".
- I build and audit; Stephen owns the Google Ads account and pushes the CSV himself (later).
