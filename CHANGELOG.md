# Changelog

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

- Control-panel name changed to **POTTS Member Help Centre**.
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
