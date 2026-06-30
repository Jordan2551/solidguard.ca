# SolidGuard page seeder

Programmatic, idempotent build of the `/glass/` page tree. **One seeder, many
manifests** — the seeder is fixed logic; each page is a JSON file in `manifest/`.
The manifests are the source of truth; the live pages are ordinary WordPress
pages whose content was loaded by the seeder (not rendered by it at request time).

## Files

- `seed.php` — importer. Reads every `manifest/*.json` and upserts the tree
  (hub → roots → spokes → locations), shallow-to-deep so parents exist first.
- `export.php` — reverse. Dumps the current DB pages back to `manifest/*.json`.
  Used once to bootstrap manifests from a hand-built page; handy for capturing
  dashboard tweaks back into version control.
- `manifest/*.json` — one file per page (data only).

## Workflow

```sh
# Edit content -> edit the JSON, never the dashboard (the seeder overwrites it).
wp eval-file seeder/seed.php

# Then gate each spoke on its keyword cluster (rendered HTML, not the RM editor score):
php <marketing>/seo/tools/coverage-check.php \
    https://solidguard.ca/glass/residential/window-glass-repair/ \
    seeder/manifest/window-glass-repair.json
```

`seed.php` is **idempotent**: it upserts by path, so re-running never duplicates
and always restores a page to its manifest. Add a page = add a JSON file + re-run.

## Manifest schema

```jsonc
{
  "path": "glass/residential/window-glass-repair", // full URI (drives URL + breadcrumb)
  "parent": "glass/residential",                    // parent URI ("" = hub)
  "template": "template-glass-spoke.php",            // "" = default
  "title": "Window Glass Repair",                    // post_title / breadcrumb label
  "menu_order": 0,
  "rank_math": { "title": "...", "description": "...", "focus_keyword": "..." },
  "cluster":   { "primary": "...", "secondary": [], "semantic": [], "guard_against": [] },
  "fields":    { "<acf_field_name>": value, ... }    // the cemented Glass Service group
}
```

Notes:
- `focus_keyword` should equal `cluster.primary`.
- Internal links in `fields` are stored **root-relative** (`/glass/...`) for portability.
- Image fields (`hero_asset`, `before_image`, `after_image`) hold attachment IDs;
  they are not exported as URLs and need real assets sideloaded before seeding.
- The posts-index homepage SEO is **not** a manifest (no post). It lives in the
  RankMath `rank-math-options-titles` option; seed it separately.
