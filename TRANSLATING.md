# Translating Potts Help Centre

Potts Help Centre separates interface translation from article-content translation. English is the bundled fallback language.

## Article translations in webtrees

1. Open **Control panel → Modules → All modules → Potts Help Centre**.
2. Export the English JSON language pack.
3. Change the pack-level `language` and every article `language` to the target BCP 47 code, such as `de`, `fr`, `nl` or `en-AU`.
4. Translate `title`, `summary` and `body`. Translate resource-link labels while retaining verified addresses.
5. Keep `translation_key` unchanged so the translated article is paired with its English version.
6. Give each translated article a unique `slug`, usually by adding the language code.
7. Import the JSON into the required tree and test it using the corresponding webtrees display language.

The selection order is:

1. exact webtrees language, such as `de-DE`
2. base language, such as `de`
3. English (`en`)
4. another available variant only when no English version exists

A notice appears when English fallback content is displayed.

## Interface translations

Custom interface strings are loaded from PHP arrays in `resources/lang/`. Add files such as `de.php` or `fr.php`, returning an array whose keys are the original English strings and whose values are reviewed translations.

Interface translations are best contributed through a GitHub pull request so they can be reviewed and distributed with future releases. Do not use unreviewed machine translation for publication.

## Translation-pack safety

- Import updates an article only when both its language and translation group match.
- New variants are added without deleting other languages.
- Existing feedback totals are retained when a matching article is updated.
- Imported HTML is sanitised by webtrees.
- Only secure HTTPS resource links are accepted.

## Community contributions

When sharing a language pack, state the language, translator, webtrees version and Potts Help Centre version used for review. Remove tree-specific private information before publishing the JSON file.
