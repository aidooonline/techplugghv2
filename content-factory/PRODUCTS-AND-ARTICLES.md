# Products and Articles map

Answers two questions: where does every file live, and what is every article. Pairs the
prepared products (products/mr-boadi-products.json) with the money-page articles that drive
search traffic to them.

## Finding: the 90 units are NOT in the current catalog
The theme's inc/setup-data/products.json holds 31 products, all newer generation: EliteBook
G7/G8 (10th to 13th gen), Dell Latitude, Lenovo ThinkPad. The mr_boadi supply is older-gen
8th-gen HP (G5/G6) plus ProBook Ryzen and one ZBook. Same brand family, different generation,
so these are new SKUs. Prepared fresh in products/mr-boadi-products.json (not merged into the
theme setup file, so the existing catalog is untouched until you decide).

## Where files live
```
content-factory/
  products/mr-boadi-products.json      # 12 prepared products (this batch), WooCommerce schema
  engine/build_products.py             # regenerates the JSON from researched specs
  research/<article-slug>.research.md   # per-article SERP + keyword + AI-Overview research
  specs/<article-slug>.spec.md          # per-article brief
  articles/<article-slug>.html          # final WordPress post body
```
Products get created on techpluggh.com (WooCommerce) from the JSON once the domain is
allowlisted. Articles get published as blog posts by engine/publish.py. Each article links
down to its matching product page.

## The 12 prepared products (proposed prices, CONFIRM before listing)

| Product | SKU | Stock | Proposed GHS | Notes |
|---|---|---|---|---|
| EliteBook 830 G6 i5 8GB 256GB | TPG-HP-830G6-I5-8-256 | 33 | 2,600 | 9 units storage to confirm |
| EliteBook 840 G6 i5 8GB 256GB | TPG-HP-840G6-I5-8-256 | 26 | 2,600 | 1 unit storage to confirm |
| EliteBook 840 G6 i5 16GB 256GB | TPG-HP-840G6-I5-16-256 | 2 | 2,850 | |
| EliteBook 840 G6 i5 32GB 256GB | TPG-HP-840G6-I5-32-256 | 1 | 3,100 | rare high-RAM config |
| EliteBook 840 G5 i5 8GB 256GB | TPG-HP-840G5-I5-8-256 | 11 | 2,500 | 1 unit storage to confirm |
| EliteBook 840 G5 i5 16GB 256GB | TPG-HP-840G5-I5-16-256 | 9 | 2,750 | |
| ProBook 445r G6 Ryzen 5 8GB | TPG-HP-445RG6-R5-8-256 | 3 | 2,500 | 1 unit storage to confirm |
| ProBook 445 G7 Ryzen 5 8GB | TPG-HP-445G7-R5-8-256 | 1 | 2,600 | |
| EliteBook 745 G6 Ryzen 5 Pro 16GB | TPG-HP-745G6-R5P-16-256 | 1 | 2,750 | |
| EliteBook 830 G5 i5 16GB 256GB | TPG-HP-830G5-I5-16-256 | 1 | 2,600 | |
| HP 250 G7 i5 8GB 256GB | TPG-HP-250G7-I5-8-256 | 1 | 2,500 | 15.6 inch |
| ZBook 15 G5 i7 16GB 512GB Quadro | TPG-HP-ZB15G5-I7-16-512 | 1 | 3,500 | premium workstation |

Prices are proposed inside your GHS 2,500 to 3,500 band, positioned below the existing G7/G8
catalog (they are older generation). Edit before listing. 12 units logged as 0GB storage need
their SSD confirmed so we never advertise a spec the unit does not have.

## Money-page articles (one per model line, drive traffic to the products)

These map onto the back-dated 20 slate. The volume lines get dedicated money pages; the
single-unit oddities are covered inside the category page and the deals hub rather than their
own articles (low return on one unit).

| Article slug | Target keyword | Links to product(s) | Priority |
|---|---|---|---|
| hp-elitebook-830-g6-price-in-ghana | hp elitebook 830 g6 price ghana | 830 G6 (33) | Highest (most stock) |
| hp-elitebook-840-g6-price-in-ghana | hp elitebook 840 g6 price ghana | 840 G6 8/16/32GB (29) | High |
| hp-elitebook-840-g5-price-in-ghana | hp elitebook 840 g5 price ghana | 840 G5 8/16GB (20) | High |
| hp-probook-445-ryzen-5-price-in-ghana | hp probook ryzen 5 ghana | 445r G6, 445 G7 (4) | Medium |
| hp-zbook-15-g5-workstation-ghana | hp zbook 15 g5 price ghana | ZBook 15 G5 (1) | Halo / high-value |
| hp-elitebook-830-g6-review | hp elitebook 830 g6 review | 830 G6 | EEAT support |

The remaining slots in the 20-article back-dated batch stay as defined in PLAN.md section 4
(category, comparison, buyer-guide, trust, and the deals hub). The single-unit models
(745 G6, 830 G5, 250 G7, 840 G6 32GB) each still get a product page for direct and long-tail
search, linked from the category page and deals hub.

## Article standard
All money-page articles follow content-factory/writing-standard.md: direct answer first,
spec + price table, FAQ + Article + Product schema, honest UK-used grading, CTA to the exact
product page with UTM, internal links up to the EliteBook pillar and across to comparisons.
"More data-backed" than the existing product copy means: real 8th-gen part numbers, honest
brightness/battery figures, and a price-in-Ghana table with the live stock configs above.

## Open confirmations before build
1. Allowlist techpluggh.com (still blocking all publishing and product creation).
2. Confirm or edit the 12 proposed prices.
3. Confirm SSD on the 12 units logged as 0GB storage.
4. Decide: create these 12 as new products alongside the existing 31, or replace? (Default:
   add alongside; the existing 31 may be aspirational/out of stock, which only you can confirm
   once the site is reachable.)
