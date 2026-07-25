# POTTS Member Help Centre

POTTS Member Help Centre is a standalone custom module for webtrees 2.2.x. It provides a searchable, tree-specific guide for visitors and registered members, with detailed instructions written specifically for webtrees and optional Potts modules.

## Version 0.4.0-alpha.4

This is an alpha pre-release for public testing. It is feature-complete enough for GitHub publication but should remain marked as a pre-release until it has been checked on a clean webtrees installation and at least one standard theme.

This build gives contextual help a quieter, theme-aware presentation. It follows every Potts Modern colour preset through the theme’s design variables and retains Bootstrap and fixed fallbacks for standard webtrees themes.

### Added or fixed in this build

- quieter contextual help that follows all Potts Modern colour presets automatically
- softened background, border, icon, shadow and action-button treatments
- high-contrast contextual guide-link hover and keyboard-focus styling
- theme-resistant background, border and text colours scoped only to contextual help actions
- contextual help beneath the active tab on individual pages
- separate guidance for Biography, Facts and events, Families, Media and other individual-page tabs
- contextual guidance on family pages
- task-specific links inside webtrees editing dialogs and full-page forms
- recognised tasks including creating people, adding partners, children or parents, editing names, adding facts and events, adding media and adding sources or citations
- module-aware links for close-relative events, relationship options and historical context
- per-tree administration settings for visitors, members, individual pages, family pages and editing forms
- guides open in a new tab by default so partially completed editing forms remain intact

### Included

- 71 editable starter articles
- 26 visitor articles, 42 member articles and 3 articles available to everyone
- 17 visitor and member categories
- webtrees-specific guidance for searching, individual pages, charts, privacy and accounts
- clear explanations of the Biography, Facts and events and Families tabs
- step-by-step member instructions for people, relationships, facts, events, media, sources and research notes
- module-aware help for:
  - Potts Biography
  - Potts Relationship Context
  - Potts Historical Facts
  - Potts Fact Ages
  - Potts Modern Theme, available as an article requirement for custom content
- automatic hiding of module-specific articles when the required module is not active
- an optional-module selector in the article editor
- module status indicators in administration
- a safe action to add only missing starter articles
- a separate action to replace the bundled starter set with the latest guide while preserving custom articles with other link names

## Visitor and member experiences

The menu label changes automatically:

- signed-out users see **Visitor Help**
- registered tree members see **Member Help**

Each article can be assigned to:

- **Visitors only**
- **Registered members only**
- **Everyone**

The menu module must be configured at the **Visitor** access level so both audiences can reach it. The module then filters the articles according to the current user's membership of the selected tree.

## Module-aware articles

An article can require one or more supported optional modules. It is displayed only while every selected module is active. Core webtrees articles have no module requirement and are always eligible to appear.

This prevents visitors from seeing instructions for Biography, Relationship Context, Historical Facts or Fact Ages when those features are unavailable on the site.

## Installation

1. Extract the release ZIP.
2. Copy the `potts_member_help` folder to `webtrees/modules_v4/`, replacing the earlier module folder when upgrading.
3. Open **Control panel → Modules → All modules** and enable **POTTS Member Help Centre**.
4. Open **Control panel → Modules → Menus**.
5. Enable the module for the required tree and set its access level to **Visitor**.
6. Open the module configuration page.

## Upgrading from 0.2.x

The existing database content is retained automatically.

Open the module configuration page and choose one of these actions:

- **Add missing starter articles** adds only new link names and does not alter existing articles.
- **Replace starter articles with latest guide** updates all bundled articles with matching link names and adds missing bundled articles. Custom articles with other link names are preserved.

The replacement action overwrites edits made directly to bundled starter articles. Copy or rename any heavily customised starter article before using it.

## Administration

Open **Control panel → Modules → All modules → POTTS Member Help Centre**.

Administrators can:

- add, edit, publish, unpublish, order and delete articles
- choose the visitor/member audience
- assign a visitor or member category
- make an article dependent on an optional module
- preview the visitor and member experiences
- view which supported Potts modules are active
- refresh bundled starter content
- enable or disable contextual help by audience and page type

Article bodies use webtrees’ built-in visual CKEditor when that module is active. A plain HTML field remains available as a fallback, and all saved content is sanitised by webtrees.

## Compatibility

- webtrees 2.2.x
- designed against webtrees 2.2.6
- Potts modules are optional
- Potts Modern Theme is optional
- standard webtrees themes should also work

## Planned enhancements

- screenshots and image placement within instructions
- editable categories and landing-page introductions
- import and export of help content
- translated article sets
- more detailed contextual matching for additional webtrees and third-party module forms

## Project links

- Repository: https://github.com/PottsNet/potts-member-help
- Issues and support: https://github.com/PottsNet/potts-member-help/issues
- Releases: https://github.com/PottsNet/potts-member-help/releases

## Licence

GPL-3.0-or-later. See `LICENSE`.
