# Installation and upgrade

## New installation

1. Extract `potts_member_help-0.4.0-alpha.4.zip`.
2. Upload the enclosed `potts_member_help` folder to `modules_v4/`.
3. Confirm the final path is `modules_v4/potts_member_help/module.php`.
4. Open **Control panel → Modules → All modules**.
5. Enable **POTTS Member Help Centre**.
6. Open **Control panel → Modules → Menus**.
7. Enable it for the required family tree and set the minimum access level to **Visitor**.
8. Open the module settings page once to create the editable starter articles.

## Upgrade from 0.2.x

1. Keep a backup of the existing `modules_v4/potts_member_help` folder.
2. Replace that folder with the one from this ZIP.
3. Do not delete database records or existing articles.
4. Open **POTTS Member Help Centre** in the control panel.
5. Review the optional-module status panel.
6. Choose:
   - **Add missing starter articles** for a non-destructive addition, or
   - **Replace starter articles with latest guide** to install the complete revised wording.

The replacement action updates articles whose link names match bundled starter articles. It preserves custom articles with other link names but overwrites edits made to matching starter articles.

## Menu access

Set the menu access to **Visitor**. Registered members also meet that minimum access level, and the module changes its menu label and content automatically after sign-in.

## No database migration

The module uses webtrees' existing block and block-setting storage. No SQL script or manual database change is required.

## Rich-text editor

Keep the core **CKEditor™** module active under **Control panel → Modules → All modules** to use the visual article toolbar. If it is disabled, POTTS Member Help Centre safely falls back to a plain HTML editor.

Upgrading to 0.4.0-alpha.4 does not require adding or replacing starter articles. Existing help content and feedback totals are retained. Contextual help is enabled by default and can be adjusted for each tree on the module settings page.


## Upgrade from 0.4.0-alpha.3

1. Keep a backup of the existing `modules_v4/potts_member_help` folder.
2. Replace it with the `potts_member_help` folder from this release.
3. No database migration or starter-article refresh is required.
4. Clear the webtrees cache and hard-refresh the browser so the revised theme-aware contextual styling is loaded.

This release retains existing articles, publication settings and feedback totals.

## Upgrade from 0.4.0-alpha.2

1. Keep a backup of the existing `modules_v4/potts_member_help` folder.
2. Replace it with the `potts_member_help` folder from this release.
3. No database migration or starter-article refresh is required.
4. Clear the browser cache if contextual help styling appears unchanged.

This release retains existing articles, publication settings and feedback totals.
