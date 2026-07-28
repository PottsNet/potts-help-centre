# Release-candidate test checklist — 1.0.0-rc.2

Record the webtrees version, PHP version, theme, browser and device used for each test round.

## Upgrade and identity

- [ ] Back up the current module folder and database before testing.
- [ ] Replace an earlier `potts_member_help` folder without deleting database content.
- [ ] The control panel shows **Potts Help Centre** and version `1.0.0-rc.2`.
- [ ] Existing articles, settings, ordering and feedback totals remain available.
- [ ] Matching starter articles with no existing image receive bundled screenshots without replacing written instructions or custom images.
- [ ] The public menu label is **Help**.
- [ ] The installation folder remains exactly `modules_v4/potts_member_help/`.

## Clean-install check

- [ ] A clean webtrees 2.2.x installation enables the module without an exception.
- [ ] Opening settings creates the starter article set once only.
- [ ] No SQL script or manual database operation is required.
- [ ] Disabling and re-enabling the module does not duplicate articles.

## Visitor experience

- [ ] Signed out, the page title is **Visitor Help Centre**.
- [ ] Quick help shows common visitor tasks.
- [ ] Topic cards show article counts.
- [ ] The landing page does not initially display every article.
- [ ] **View all help articles** opens the full visitor list.
- [ ] Visitor-only and shared articles are visible; member-only articles are hidden.

## Member experience

- [ ] Signed in as a tree member, the page title is **Member Help Centre**.
- [ ] Quick help shows common editing tasks.
- [ ] Member-only and shared articles are visible; visitor-only articles are hidden.
- [ ] Member contextual help appears on supported pages and forms.

## Permissions and privacy

- [ ] Users without editing permission do not receive misleading editing actions from the module.
- [ ] Living-person information is not exposed through starter content or screenshots.
- [ ] Administrator visitor/member preview does not bypass webtrees record privacy.
- [ ] External screenshots use HTTPS and send no referrer header.
- [ ] External links opening a new tab include `noopener noreferrer`.

## Search

- [ ] A multi-word search finds articles when the words are separated within article text.
- [ ] Exact title matches rank above body-only matches.
- [ ] Search within a category retains that category scope.
- [ ] Search works when webtrees pretty URLs are disabled and does not redirect to the tree home page.
- [ ] Search preserves an administrator visitor/member preview.
- [ ] Result counts use correct singular and plural wording.
- [ ] An empty result shows a clear recovery action.

## Article page

- [ ] Reading time appears beside the topic.
- [ ] Articles with two or more headings receive an **On this page** table of contents.
- [ ] Table-of-contents links scroll to the correct section.
- [ ] **Copy link** copies the current article URL.
- [ ] **Print guide** produces a clean article-only print layout.
- [ ] Previous and next article links work.
- [ ] Related instructions remain available.
- [ ] Official webtrees resources appear without duplicate links.
- [ ] The contact button opens the configured webtrees contact form with article and troubleshooting details pre-filled.
- [ ] All 12 illustrated starter articles show the correct screenshot, caption, alternative text and source.
- [ ] Annotated guides contain only fictional example data and remain clearly labelled as illustrations.
- [ ] Clicking a screenshot opens the full-size image.
- [ ] The screen-difference notice appears only when an article has a screenshot.
- [ ] Screenshot images remain legible on phone, tablet and desktop widths.

## Feedback

- [ ] A **Yes** or **Not quite** response records once per browser session and article.
- [ ] Returning to the article in the same session shows **Feedback already recorded**.
- [ ] Administrator preview does not permit feedback.
- [ ] Aggregate totals remain visible in administration.

## Administration

- [ ] Dashboard totals match the article list.
- [ ] Helpful percentage is correct when responses exist and shows a dash when none exist.
- [ ] Article text, audience, language, publication and Quick help filters work without reloading.
- [ ] Selecting **Show in Quick help** adds the article to the correct audience landing page.
- [ ] The **Articles to review** panel appears only when sufficient feedback exists.
- [ ] Visitor and member preview buttons open the correct view.
- [ ] The illustrated-guide total matches the number of articles with screenshots.
- [ ] The editor accepts a bundled `module://` image and a secure HTTPS image address.
- [ ] Invalid or non-HTTPS image addresses are not displayed.
- [ ] Clearing the screenshot field removes the image without affecting the article body.
- [ ] Exporting a language downloads valid JSON containing that language only.
- [ ] Importing a translated JSON pack adds new variants and updates matching language/translation groups without deleting feedback.
- [ ] Selecting another webtrees language displays its matching article variant.
- [ ] Missing translations fall back to English and show a clear fallback notice.

## Contextual help and themes

- [ ] Individual-page tab guidance updates when tabs change.
- [ ] Contextual help appears as a compact link rather than a full-width callout.
- [ ] Family-page guidance appears when enabled.
- [ ] Editing dialogs receive the correct task-specific guide.
- [ ] New-tab behaviour protects partially completed forms.
- [ ] Potts Modern colour presets remain readable.
- [ ] Clouds and at least one other standard webtrees theme remain readable.
- [ ] Desktop, tablet and phone layouts do not overflow.
- [ ] The Help menu does not overlap sign-in or other navigation items.

## Optional-module regression

- [ ] Core help remains usable with every optional Potts module disabled.
- [ ] Module-specific articles hide when their required module is disabled.
- [ ] Re-enabling a required module restores its applicable articles.

## Release decision

- [ ] No PHP errors, browser-console errors or failed network requests attributable to the module.
- [ ] GitHub Actions quality checks pass on the release commit.
- [ ] Any release-blocking issue is fixed and retested.
- [ ] The candidate is approved for version `1.0.0`.
