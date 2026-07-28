# Installation and upgrade

## Release package

Use the named GitHub release asset `potts_help_centre_v1.0.0-rc.1.zip`. Do not install GitHub’s automatic **Source code.zip** archive because it may not preserve the required enclosing module folder.

## New installation

1. Extract `potts_help_centre_v1.0.0-rc.1.zip`.
2. Upload the enclosed `potts_member_help` folder to `modules_v4/`.
3. Confirm the final path is `modules_v4/potts_member_help/module.php`.
4. Open **Control panel → Modules → All modules**.
5. Enable **Potts Help Centre**.
6. Open **Control panel → Modules → Menus**.
7. Enable **Help** for the required family tree and set its minimum access level to **Visitor**.
8. Open the module settings page once to create the editable starter articles.

## Upgrade from an earlier release

1. Back up the existing `modules_v4/potts_member_help` folder and database.
2. Replace the existing folder with the `potts_member_help` folder from this release ZIP.
3. Do not rename the installation folder and do not delete database records.
4. Open **Potts Help Centre** in the control panel.
5. Confirm the displayed version is `1.0.0-rc.1`.
6. Review the dashboard and visitor/member previews.
7. Clear the webtrees cache and hard-refresh the browser if older wording or styling remains visible.

The display name and GitHub repository name do not change the internal module identity. Existing articles, settings, publication choices and feedback totals are retained.

## Starter article choices

On first use after upgrading, the module non-destructively marks bundled common-task articles for Quick help and assigns missing bundled screenshots. This does not replace article wording, existing custom screenshots or feedback.

- **Add missing articles** adds only new link names and is non-destructive.
- **Refresh starter guide** updates bundled articles with matching link names and adds any missing bundled articles.

Refreshing overwrites edits made directly to bundled starter articles. Custom articles with other link names are preserved.

## Menu access

Set the menu access level to **Visitor**. Registered members also meet this minimum access level. The public menu label is **Help** and the page content changes automatically after sign-in.

## Rich-text editor

Keep the core **CKEditor™** module active to use the visual article toolbar. When it is disabled, the module safely falls back to a plain HTML editor.

## Database

The module uses webtrees’ existing block and block-setting tables. No SQL script or manual database migration is required.

## Screenshot files and privacy

Keep `resources/screenshots/` when copying or updating the module. Bundled images are served from the module and are the preferred option.

Administrators may also enter a secure HTTPS image address. External images contact the remote server when displayed. Potts Help Centre applies `referrerpolicy="no-referrer"`, but administrators should still use a trusted host and avoid images containing private information.
