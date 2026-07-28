# Potts Help Centre 1.0.0-rc.2

This second release candidate incorporates feedback from public testing before the stable 1.0.0 release.

## Main improvements

- fixes Help Centre search on sites without pretty URLs
- replaces the large contextual-help panel with a compact link
- provides a working, pre-filled webtrees contact action
- adds official and article-specific resource links
- improves generic place and record-reading guidance
- adds language-specific article variants with English fallback
- adds JSON language-pack export and import
- verifies and re-runs non-destructive screenshot assignment
- documents coexistence with LinkEnhancer

## Language status

English starter content is bundled. The module now selects article translations according to the current webtrees language and supports community language packs, but complete translations for every webtrees language are not yet included.

## Upgrade safety

The installation folder, namespace and storage identity remain `potts_member_help`. Existing articles, settings, screenshots and feedback remain in place. Selected starter-text improvements are applied only when the earlier bundled wording has not been customised.

## Installation asset

Use `potts_help_centre_v1.0.0-rc.2.zip` from the Assets section of the GitHub pre-release. Do not install GitHub’s automatically generated source archive.

## Before 1.0.0

Complete `TESTING.md`, with particular attention to non-pretty-URL search, contact routing, language fallback, translation import/export, upgrades, standard themes and mobile layouts.
