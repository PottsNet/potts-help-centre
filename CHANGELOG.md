# Changelog

## 1.0.0-rc.2 — 2026-07-29

### Fixed

- Fixed Help Centre searches redirecting to the tree home page on installations that do not use pretty URLs.
- Added a dedicated POST search action that preserves module, tree, audience and category routing.
- Re-ran the bundled screenshot migration non-destructively for installations where earlier screenshot assignment was incomplete.

### Added

- Added language codes and translation-group keys to articles.
- Added exact-language, base-language and English fallback selection.
- Added visible fallback notices when English content is shown for another selected language.
- Added JSON language-pack export and import tools for administrators.
- Added article-specific resource links and automatic official webtrees documentation links.
- Added a working **Contact the site administrator** action using the tree’s configured webtrees contact form.
- Added language filtering and language counts to administration.
- Added `TRANSLATING.md` for community translation contributors.

### Changed

- Replaced the prominent contextual-help panel with a compact **Help with this page** link.
- Improved the starter articles about places and interpreting names, dates and places with practical examples and cautions.
- Reduced repetitive contact wording and pre-filled useful diagnostic questions in the contact form.
- Clarified how Potts Help Centre differs from and can coexist with LinkEnhancer.
- Updated official forum and documentation references.

### Upgrade safety

- Existing custom article text, language variants, screenshots, settings and feedback are preserved.
- The two improved starter articles are updated automatically only when their saved text still exactly matches the earlier bundled version.
- New starter resource links are added only when an article has no existing resource links.

## 1.0.0-rc.1 — 2026-07-28

### Added

- Added a GitHub Actions quality workflow for PHP and JavaScript syntax checks.
- Added a README screenshot gallery using bundled fictional-data illustrations.
- Added `NOTICE.md` with attribution and modification details for official webtrees images.
- Added release-candidate notes and a GitHub publication checklist.

### Changed

- Promoted the module from alpha development to the first 1.0.0 release candidate.
- Updated repository, issue, release and latest-version links to `PottsNet/potts-help-centre`.
- Clarified that the GitHub repository name may change while the internal `potts_member_help` identity must remain stable.
- Added `noopener noreferrer` to links that open a new tab.
- Added a no-referrer policy and asynchronous decoding to article and editor screenshot images.
- Expanded installation, privacy, attribution and final regression-test documentation.

### Compatibility

- Retained the `potts_member_help` installation folder, namespace and storage identity.
- No database migration is required when upgrading from an earlier release.

## 0.6.0-alpha.2 — 2026-07-28

### Added

- Added eight annotated screen guides for quick search, individual-page tabs, sign-in, adding a partner, adding a child, correcting a name, adding media and adding a source citation.
- Used fictional names and records throughout the new guides so no private family information is distributed.
- Added the new guides to the bundled-image selector in the article editor.
- Added screenshot metadata to the matching visitor and member starter articles.

### Changed

- Increased the illustrated starter-article coverage from four to twelve articles.
- Added a new non-destructive screenshot upgrade pass so installations already running 0.6.0-alpha.1 receive the additional guides without replacing article text or existing images.
- Clearly identify original screen guides as illustrations whose controls may vary by theme, permissions, language and enabled modules.

## 0.6.0-alpha.1 — 2026-07-28

### Added

- Added optional article screenshots with accessible alternative text, captions and source attribution.
- Added four compressed official webtrees illustrations covering the interactive tree, Facts and events place details, event maps and geographic-data editing.
- Added a standard notice explaining that screens may vary by theme, access level and enabled modules.
- Added screenshot controls to the article editor, including bundled-image suggestions and secure HTTPS image addresses.
- Added illustrated-guide totals and screenshot badges to administration.
- Added a non-destructive upgrade that applies bundled screenshot metadata to matching starter articles without replacing their edited instructions.

### Changed

- Bundled screenshots are stored as compressed WebP files to keep the module package small.
- Screenshot images open at full size in a new tab and remain suitable for printing.

## 0.5.0-alpha.2 — 2026-07-28

### Changed

- Corrected the public branding to **Potts Help Centre**, consistently using the established mixed-case Potts name.
- Updated all user-facing documentation, administration labels and breadcrumbs to use **Potts** rather than the all-capital form.
- Retained all internal module identifiers and the `potts_member_help` folder name for upgrade compatibility.

## 0.5.0-alpha.1 — 2026-07-28

### Changed

- Renamed the displayed module from **Potts Member Help Centre** to **Potts Help Centre** because it supports visitors as well as registered members.
- Shortened the public menu label to **Help** while keeping audience-specific Visitor Help Centre and Member Help Centre page titles.
- Retained the `potts_member_help` folder and storage identity so existing installations upgrade without losing content or settings.
- Reworked the landing page to prioritise Quick help and topic browsing instead of displaying every article immediately.
- Improved multi-word search with relevance ranking across titles, summaries, category names and article content.

### Added

- Added administrator-selectable Quick help articles with a one-time, non-destructive upgrade for existing installations.
- Added category and search result counts.
- Added article reading time, automatic table of contents, print guide, copy link and previous/next navigation.
- Added browser-session awareness for feedback already submitted.
- Added an administration dashboard with publication, audience, featured and feedback summaries.
- Added instant administration filters for article text, audience, status and Quick help.
- Added an Articles to review panel based on aggregate “Not quite” ratings.

## 0.4.0-alpha.4 — 2026-07-25

### Changed

- Restyled contextual help as a quieter page aid rather than a prominent blue alert.
- Contextual help now prioritises Potts Modern variables for accent, text, border and card colours, allowing it to follow all seven colour presets automatically.
- Reduced the background tint, border strength, shadow, icon emphasis and button height while retaining clear visibility and keyboard focus.
- Preserved Bootstrap and fixed colour fallbacks for Clouds and other standard webtrees themes.

## 0.4.0-alpha.3 — 2026-07-25

### Fixed

- Added self-contained colour variables and fallback colours for contextual help boxes outside the Help Centre page.
- Ensured contextual help borders, backgrounds, icons and action links remain readable in standard webtrees themes as well as Potts Modern Theme.
- Corrected installation documentation that still referred to an earlier alpha package.
- Replaced the abbreviated licence notice with the full GNU General Public License version 3 text.

### Changed

- Marked the build clearly as an alpha pre-release suitable for GitHub publication and broader compatibility testing.

## 0.4.0-alpha.2 — 2026-07-24

### Fixed

- Fixed contextual help action text becoming white and difficult to read when hovering in Potts Modern Theme.
- Added a strongly scoped hover and keyboard-focus treatment that resists global theme link styles.
- Kept the contextual action text dark on a softly tinted background for reliable contrast.
- Added a visible focus ring without changing links elsewhere in webtrees.

## 0.4.0-alpha.1 — 2026-07-24

### Added

- Added contextual help links to webtrees individual pages, family pages and editing interfaces.
- Added active-tab detection for Biography, Facts and events, Families and Media.
- Added task recognition for creating people, adding partners, children and parents, editing names, adding or editing events, adding media and adding sources or citations.
- Added contextual links for close-relative events, relationship options and historical context when the related articles and modules are available.
- Added per-tree controls for enabling contextual help, visitor/member audiences, individual pages, family pages and editing forms.
- Added an option to open guides in a new tab, enabled by default to protect partially completed forms.
- Contextual links automatically use the correct visitor or member article and do not appear inside the Help Centre itself.

## 0.3.0-alpha.5 — 2026-07-24

### Fixed

- Corrected the dark masthead utility menu rather than applying another adjustment to the lower genealogy menu.
- Scoped the tall icon-over-label rules to the cream genealogy navigation only.
- Restored Theme, Language, History and Sign in to one compact, vertically centred desktop row.
- Normalised utility-link box sizing so text links and icon links share the same 42-pixel visual height.
- Removed the Historical Facts selector's three-pixel vertical offset while the help module is active.
- Prevented the desktop utility menu from wrapping when sufficient horizontal space is available.
- Left mobile navigation behaviour unchanged.

## 0.3.0-alpha.4 — 2026-07-24

### Added

- Added a **Was this helpful?** prompt to every published help article.
- Added simple **Yes** and **Not quite** responses with an in-page thank-you message.
- Limited each browser session to one recorded response per article to reduce accidental duplicate voting.
- Added aggregate helpful and not-helpful totals to the administration page.
- Added per-article feedback counts to the administration table.
- Feedback uses existing webtrees block settings and stores no names, email addresses or written comments.

### Fixed

- Reworked the Potts Modern desktop menu alignment so icons, labels and drop-down carets use a consistent top-aligned layout.
- Removed the native `menu-faq` class from this custom menu item to avoid overlapping native and Potts Modern icon-spacing rules while retaining the FAQ icon through the module’s unique `pmh-faq` class.

## 0.3.0-alpha.3 — 2026-07-24

### Added

- Added a visual rich-text article editor using webtrees’ built-in CKEditor module.
- Added toolbar support for headings, bold and italic text, numbered and bullet lists, links, tables, images and HTML source editing.
- Added an editor-status badge and a plain-HTML fallback message when CKEditor is not active.
- Added a **View saved article** button when editing an existing published article.

### Fixed

- Changed the help menu to use webtrees’ native `menu-faq` icon class, preventing it from resembling the sign-in/account icon in Potts Modern Theme.
- Removed custom menu-link flex styling so the active theme controls icon size, label spacing and vertical alignment consistently with the other main menu items.

## 0.3.0-alpha.2 — 2026-07-23

### Fixed

- Corrected article titles that could become invisible when Potts Modern Theme or another theme applied a light heading colour.
- Added scoped, high-specificity heading colours that follow the active theme body colour and override conflicting heading opacity or text-shadow rules.
- Applied the contrast fix to landing-page, section, category, article-card, article-body and sidebar headings.
- Tightened article header spacing and normalised heading margins and line heights.
- Added dedicated CSS classes for the help-centre page title and article title.

## 0.3.0-alpha.1 — 2026-07-23

### Added

- Expanded the bundled guide from 30 to 71 editable articles.
- Detailed webtrees visitor guidance covering navigation, searches, individual-page tabs, charts, privacy, accounts and corrections.
- Clear guidance that Biography is a generated reading view and changes are made through Families, Facts and events, names, notes, media and sources.
- Detailed member instructions for creating and linking people, recording names, facts, events, places, media, citations and research notes.
- Help for events of close relatives and display controls.
- Help for Potts Biography, Potts Relationship Context, Potts Historical Facts and Potts Fact Ages.
- Optional-module requirements on each article.
- Automatic hiding of articles whose required modules are not active.
- Optional-module selection and live status badges in the article editor.
- Module status panel and feature column in administration.
- Feature badges on public article cards and article pages.
- **Replace starter articles with latest guide** action for upgrading bundled content while preserving custom link names.
- Confirmation warning before replacing edited starter articles.
- Success messages after starter-content actions.
- Additional visitor and member categories for a manual-style information structure.

### Changed

- Landing-page introductions and search examples are now webtrees-specific.
- Administration explains the difference between adding missing articles and replacing bundled articles.
- Module description now identifies the guide as audience-aware and module-aware.

## 0.2.0-alpha.2 — 2026-07-23

### Fixed

- Corrected a settings-page database error caused by reading the webtrees module name before webtrees had assigned it.
- The help repository is now created lazily, after module registration, so new articles are stored with the valid module name.
- No manual database repair is required after the failed alpha.1 insert because webtrees rolled the request back.

## 0.2.0-alpha.1 — 2026-07-23

### Added

- Combined visitor and registered-member help in the same module.
- Audience selection for every article: Visitors, Registered members or Everyone.
- Eleven editable visitor starter articles across four visitor categories.
- Dynamic public menu label: Visitor Help when signed out and Member Help when signed in.
- Dynamic landing-page wording, search prompts and assistance text for each audience.
- Administrator preview links for both audience experiences.
- Missing-default detection and a safe action to add new starter articles without overwriting existing content.
- Audience column in article administration.
- Visitor and member category groupings in the article editor.

### Changed

- Control-panel name changed to **Potts Member Help Centre**.
- Menu access should now be configured at Visitor level so the same module is available to both audiences.
- Public routes filter content by tree membership rather than redirecting every guest to sign-in.

## 0.1.0-alpha.1 — 2026-07-23

### Added

- Standalone members-only help centre for webtrees 2.2.x.
- Seven contribution-guide categories.
- Nineteen editable starter articles.
- Search, category filtering, article pages and related links.
- Tree-specific administration with add, edit, draft, publish, order and delete functions.
- Native webtrees HTML sanitisation and CSRF-protected administration forms.
- Member access enforcement and sign-in redirection for direct links.
- Responsive styling independent of Potts Modern Theme.
