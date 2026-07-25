# Testing checklist

## Installation and upgrade

- [ ] Module loads without a PHP or SQL error.
- [ ] Existing 0.2.x articles remain after replacing the module folder.
- [ ] **Add missing starter articles** adds new link names without altering existing articles.
- [ ] **Replace starter articles with latest guide** updates bundled articles and preserves custom link names.
- [ ] Settings page reports version 0.4.0-alpha.4.
- [ ] While signed out on desktop, Theme, Language, History and Sign in appear on one vertically centred row.
- [ ] Sign in uses a compact inline icon/label treatment and does not adopt the tall genealogy-menu layout.
- [ ] The cream genealogy menu remains consistently aligned.
- [ ] Tablet and mobile navigation are unchanged.

## Audience behaviour

- [ ] Signed-out users see **Visitor Help**.
- [ ] Registered tree members see **Member Help**.
- [ ] Visitor-only articles are not visible to members in normal view.
- [ ] Member-only articles are not visible to visitors.
- [ ] Everyone articles appear in both experiences.
- [ ] Administrator preview links work without signing out.

## Module awareness

Test with each supported module active and inactive:

- [ ] Potts Biography articles appear only when Potts Biography is active.
- [ ] Relationship Context articles appear only when Potts Relationship Context is active.
- [ ] Historical Facts articles appear only when Potts Historical Facts is active.
- [ ] Articles requiring both Biography and Historical Facts disappear if either module is inactive.
- [ ] Fact Ages articles appear only when Potts Fact Ages is active.
- [ ] Core webtrees articles remain visible regardless of optional-module status.
- [ ] Module status badges in administration are accurate.
- [ ] Custom article module requirements save and reload correctly.

## Content and navigation

- [ ] All 71 starter articles are present after a full refresh.
- [ ] Search finds terms such as Biography, Families, close relatives, relationship and historical.
- [ ] Category filters show only categories with visible articles.
- [ ] Direct links to unavailable module-specific articles return not found.
- [ ] Related instructions never link to an unavailable article.
- [ ] Feature badges appear on module-specific article cards and pages.

## Editing

- [ ] New article can be created.
- [ ] Existing article can be edited.
- [ ] Visitor/member audience selection saves correctly.
- [ ] One or more required modules can be selected.
- [ ] Article can be published and unpublished.
- [ ] Article order changes correctly.
- [ ] Article can be deleted.
- [ ] HTML is sanitised when saved.

## Themes and devices

- [ ] Potts Modern Theme desktop layout.
- [ ] Contextual help remains subtle and readable in each Potts Modern colour preset.
- [ ] Contextual help accent, icon and action link change with the selected Potts Modern preset.
- [ ] Potts Modern Theme phone and tablet layout.
- [ ] Clouds or another standard webtrees theme.
- [ ] Administration table remains usable on smaller screens.
## Typography regression

- [ ] Article titles are visible in Potts Modern Theme.
- [ ] Article titles are visible in Clouds or another standard webtrees theme.
- [ ] Landing-page, section, card and sidebar headings remain readable.
- [ ] Light and dark appearances retain adequate heading contrast.
- [ ] The article header does not leave an excessive blank area above the summary.
- [ ] Mobile article headings wrap cleanly without clipping.


## Menu regression

- [ ] Signed-out users see a distinct help/FAQ icon rather than an account-style grid icon.
- [ ] Visitor Help does not appear to overlap or sit behind the sign-in control.
- [ ] Visitor Help icon and label align with Family tree, Charts, Lists, Calendar, Reports, Search and Books.
- [ ] Signed-in Member Help alignment is unchanged.
- [ ] Menu alignment remains correct in Potts Modern and a standard webtrees theme.
- [ ] Narrow desktop and tablet widths wrap or collapse the menu without overlap.

## Rich-text editor

- [ ] With CKEditor active, the Instructions field displays a visual toolbar.
- [ ] Headings, bold text, numbered lists, bullet lists, links and tables save correctly.
- [ ] Source mode can inspect and edit the underlying HTML.
- [ ] Saved content is still sanitised.
- [ ] The **View saved article** button opens the published article in a new tab.
- [ ] With CKEditor disabled, a warning appears and the plain HTML textarea remains usable.


## Feedback testing

1. Open a published visitor article while signed out.
2. Select **Yes** and confirm that the in-page thank-you message appears.
3. Reload the first article, vote again and confirm its count does not increase twice in the same browser session.
4. Open another article and select **Not quite**.
5. Sign in as administrator and confirm the aggregate and per-article counts increased.
6. Preview the visitor or member experience from administration and confirm voting is disabled in preview mode.
7. Confirm no feedback option is shown outside article pages.

## Potts Modern menu alignment

1. Check the desktop menu while signed out and signed in.
2. Confirm the icons and labels begin on the same horizontal rows.
3. Confirm drop-down carets sit consistently below labels.
4. Check the menu at tablet and phone widths to confirm mobile navigation is unchanged.
## Contextual help links

- [ ] Contextual guide links remain readable in their normal, hover and keyboard-focus states.
- [ ] Hovering a contextual guide link shows dark text on a softly tinted background rather than white text on a transparent background.
- [ ] Contextual help settings save separately for each family tree.
- [ ] Disabling contextual help removes all contextual links without hiding the Help Centre menu.
- [ ] Visitor and member audience switches work independently.
- [ ] The individual-page switch controls only the tab-level guide.
- [ ] The family-page switch controls only the family-page guide.
- [ ] The editing-forms switch controls modal and full-page editing help.
- [ ] Biography displays a Biography-specific guide.
- [ ] Facts and events displays the correct visitor or member article.
- [ ] Families displays family-relationship guidance.
- [ ] Media displays photograph/document guidance.
- [ ] Changing tabs updates the contextual guide without reloading the page.
- [ ] Family pages display a family-specific guide above the family content.
- [ ] Add partner, add child and add parent dialogs display the matching guide.
- [ ] Create person, edit name, add fact/event, edit fact/event, add media and add citation forms display matching guides when their headings are recognised.
- [ ] Contextual links never appear inside the Help Centre itself.
- [ ] New-tab mode preserves any information already entered in an editing form.
- [ ] Turning off new-tab mode opens the guide in the current tab.
- [ ] Contextual links are readable in Potts Modern and at least one standard webtrees theme.
- [ ] Contextual links wrap cleanly on phone-sized screens.

