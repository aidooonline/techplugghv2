#!/usr/bin/env python3
"""
Dedup gate (locked rule). Before writing any article, run BOTH:
  (a) a grep of content-index.md by title text, and
  (b) a live WP REST search on the topic keywords.
If a match exists, update in place, never create a duplicate.

Usage:
    python dedup_check.py "hp elitebook 830 g6 price" "elitebook 830 g6"
Exits 0 if clear to write, 1 if a likely duplicate is found.
"""
import base64, json, os, sys, urllib.request, urllib.parse, urllib.error

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.dirname(HERE)
INDEX = os.path.join(ROOT, "content-index.md")


def load_env():
    path = os.path.join(ROOT, "config", "wp.env")
    env = {}
    if os.path.exists(path):
        for line in open(path):
            if "=" in line and not line.strip().startswith("#"):
                k, v = line.strip().split("=", 1)
                env[k.strip()] = v.strip()
    return env


def wp_search(env, term):
    if not env.get("WP_BASE_URL"):
        return None
    url = env["WP_BASE_URL"].rstrip("/") + "/wp-json/wp/v2/posts?" + urllib.parse.urlencode(
        {"search": term, "per_page": 20, "status": "publish,future,draft"})
    req = urllib.request.Request(url)
    if env.get("WP_USER") and env.get("WP_APP_PASSWORD"):
        raw = f'{env["WP_USER"]}:{env["WP_APP_PASSWORD"]}'.encode()
        req.add_header("Authorization", "Basic " + base64.b64encode(raw).decode())
    try:
        with urllib.request.urlopen(req, timeout=45) as r:
            return json.loads(r.read().decode() or "[]")
    except (urllib.error.URLError, urllib.error.HTTPError) as e:
        print(f"[warn] live WP search unavailable ({e}). Index-only check performed.")
        return None


def main():
    terms = sys.argv[1:]
    if not terms:
        sys.exit("Pass one or more topic phrases to check.")
    hit = False

    # (a) index grep
    if os.path.exists(INDEX):
        idx = open(INDEX, encoding="utf-8").read().lower()
        for t in terms:
            if t.lower() in idx:
                print(f"[index] possible match for: {t!r}")
                hit = True
    else:
        print("[index] content-index.md not found yet (first run).")

    # (b) live WP search
    env = load_env()
    for t in terms:
        posts = wp_search(env, t)
        if posts:
            for p in posts:
                title = p.get("title", {}).get("rendered", "")
                print(f"[wp] {p.get('status')} #{p.get('id')} {title!r} -> {p.get('link')}")
                hit = True

    if hit:
        print("\nRESULT: possible duplicate. Update in place, do not create new.")
        sys.exit(1)
    print("\nRESULT: clear to write.")
    sys.exit(0)


if __name__ == "__main__":
    main()
