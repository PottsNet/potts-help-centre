# GitHub publication checklist

## Repository name

Use `PottsNet/potts-help-centre`. Do not delete the repository history merely to change the public name.

If the repository still displays the old name:

1. Open the repository on GitHub.
2. Select **Settings**.
3. Change **Repository name** to `potts-help-centre`.
4. Select **Rename**.
5. Do not create a new repository later using the old `potts-member-help` name because that can break GitHub redirects.

The installation folder must remain `potts_member_help`.

## Replace repository files

Upload the contents of the GitHub source package to the repository root. The repository root should contain `module.php`, `PottsMemberHelp.php`, `README.md`, `resources/`, `src/` and the other project files—not an extra outer `potts_member_help` directory.

Suggested commit message:

```text
Prepare Potts Help Centre 1.0.0-rc.1
```

## Confirm automated checks

Open **Actions** and confirm the **Quality checks** workflow passes.

## Create the release

1. Open **Releases → Draft a new release**.
2. Create tag `v1.0.0-rc.1`.
3. Set the release title to `Potts Help Centre 1.0.0-rc.1`.
4. Paste the contents of `RELEASE_NOTES.md` into the description.
5. Attach `potts_help_centre_v1.0.0-rc.1.zip`.
6. Select **Set as a pre-release**.
7. Publish the release.

Do not attach the GitHub source package as the user installation asset.

## Final 1.0.0 release

After `TESTING.md` is complete:

1. Change the version in `PottsMemberHelp.php`, `latest-version.txt`, README, changelog and release notes to `1.0.0`.
2. Run all quality checks again.
3. Create tag `v1.0.0`.
4. Attach `potts_help_centre_v1.0.0.zip`.
5. Publish it as the latest full release, not a pre-release.
