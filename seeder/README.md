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

## Hero image assignments

The manifest `hero` key picks a window graphic from `images/hero/<key>/`. A folder
with one file renders a static cutout; three files animate (cross-fade). Priority:
a client-uploaded `hero_asset` (ACF) > the `hero` key > the casement default.

Six graphics exist; these are the assignments (reasoned from what each image shows,
not a strict 1:1 — reuse where no dedicated art exists):

| Page | `hero` | Why |
|---|---|---|
| `window-glass-repair` | `casement-window` ✱ | flagship; clean modern double casement |
| `patio-sliding-door-glass` | `slider-window` | wide horizontal slider = sliding door (best literal match) |
| `window-crank-repair` | `awning-window` ✱ | awning windows are crank-operated; motion suits the page |
| `window-restoration` | `shaped-window` | arched/heritage = restoring character windows |
| `porch-enclosures` | `bow-window` | projecting 3D bay reads as an enclosure/sunroom |
| `window-glass-replacement` | `hung-window` | pristine classic double-hung = "new window" |
| `double-pane-window-repair` | `awning-window` ✱ | two clearly stacked panes reads "double pane" |
| `window-screens` | `slider-window` | screen panel is visible in the graphic |
| `custom-glass-mirrors` | `shaped-window` | decorative/custom (low priority) |
| commercial structural (curtain-wall, vestibules, partitions) | `bow-window` | most architectural of the set (stand-in until storefront art) |
| roots / hub / emergency / other commercial | *(omit)* | falls back to the casement default until dedicated art |

✱ = animated (3 frames). Swap any of these for a real per-page photo later by
uploading to the page's `hero_asset` ACF field, which overrides the key.
