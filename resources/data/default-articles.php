<?php

declare(strict_types=1);

return array (
  0 => 
  array (
    'block_order' => 10,
    'title' => 'Welcome to this webtrees family tree',
    'slug' => 'welcome-to-the-family-tree',
    'category' => 'visitor-start',
    'summary' => 'Learn what webtrees is, what this family-history website contains and how to begin exploring.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>This website is powered by <strong>webtrees</strong>, a family-history system that connects people through parents, partners, children, facts, events, places, sources, photographs and documents.</p>
<h2>Begin with someone you know</h2>
<ol>
<li>Use the search box to find a relative.</li>
<li>Open the person’s page and check the dates, places and close family to make sure you have the correct person.</li>
<li>Use the tabs and family links to move to parents, partners, children and other relatives.</li>
<li>Try an ancestor, descendant or interactive-tree chart when you want a wider view.</li>
</ol>
<h2>Why some information is missing</h2>
<p>webtrees applies privacy and access rules to every record. Living people and recent family details may be hidden, partly shown or available only to approved registered members. Optional modules and the selected language can also change what appears.</p>
<p>The help topics shown in this centre match the features currently enabled on this website.</p>',
    'language' => 'en',
    'translation_key' => 'welcome-to-the-family-tree',
  ),
  1 => 
  array (
    'block_order' => 20,
    'title' => 'How webtrees organises family information',
    'slug' => 'how-webtrees-organises-family-information',
    'category' => 'visitor-start',
    'summary' => 'Understand the difference between a person, a family relationship, a fact or event, media and a source.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>webtrees stores several connected types of information.</p>
<ul>
<li><strong>Individual:</strong> one person, with names, sex, facts, events, notes, sources and media.</li>
<li><strong>Family:</strong> the connection between partners and their children. A person can belong to more than one family.</li>
<li><strong>Fact or event:</strong> information such as birth, residence, occupation, marriage, immigration or death.</li>
<li><strong>Media:</strong> a photograph, certificate, newspaper item, recording or other document.</li>
<li><strong>Source and citation:</strong> where a particular piece of information came from.</li>
</ul>
<p>This distinction explains why different tasks are performed in different places. Personal events are viewed in <strong>Facts and events</strong>, while partners, parents and children are managed through <strong>Families</strong>. A Biography tab may summarise the same records as a story, but it does not hold a separate copy of the data.</p>',
    'language' => 'en',
    'translation_key' => 'how-webtrees-organises-family-information',
  ),
  2 => 
  array (
    'block_order' => 30,
    'title' => 'Find a person with quick search',
    'slug' => 'visitor-find-a-person',
    'category' => 'searching-viewing',
    'summary' => 'Search by name and use relatives, dates and places to identify the correct person.',
    'published' => true,
    'audience' => 'visitors',
    'featured' => true,
    'requires_modules' => '',
    'screenshot' => 'module://quick-search-guide.webp',
    'screenshot_alt' => 'Annotated example of the webtrees quick search field and suggested person and family results.',
    'screenshot_caption' => 'Begin with a name, then compare dates, places and relatives before opening a result.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<ol>
<li>Open the main search box and begin typing a surname or full name.</li>
<li>Select a suggested result, or open the full search page when no suitable result appears.</li>
<li>Try maiden surnames, nicknames, initials and alternative spellings.</li>
<li>Compare birth and death years, places, parents, partners and children before deciding it is the correct person.</li>
</ol>
<p>webtrees may display a person under the spelling used in an original record. A known-as name or nickname may also appear beside the formal name.</p>
<p>When a name is common, begin with a better-known relative and follow the family links rather than relying on the name alone.</p>',
    'language' => 'en',
    'translation_key' => 'visitor-find-a-person',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'Official webtrees user documentation',
        'url' => 'https://webtrees.net/user/',
      ),
    ),
  ),
  3 => 
  array (
    'block_order' => 40,
    'title' => 'Use general and advanced search',
    'slug' => 'use-general-and-advanced-search',
    'category' => 'searching-viewing',
    'summary' => 'Use broader search tools when quick search does not find the person, family, place or record you need.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>The full search pages can search more than names. Depending on your access and the modules enabled, you may be able to search individuals, families, places, notes, sources and media.</p>
<h2>Useful approaches</h2>
<ul>
<li>Search for a surname without a given name when spelling is uncertain.</li>
<li>Use a place, occupation or other known fact to narrow a large group of results.</li>
<li>Try a married surname and a maiden surname.</li>
<li>Use date ranges rather than an exact date when family information is approximate.</li>
<li>Remove one search condition at a time when no results are returned.</li>
</ul>
<p>Search results only include records you are permitted to view. A private person may not appear even when they exist in the tree.</p>',
    'language' => 'en',
    'translation_key' => 'use-general-and-advanced-search',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'Official webtrees user documentation',
        'url' => 'https://webtrees.net/user/',
      ),
    ),
  ),
  4 => 
  array (
    'block_order' => 50,
    'title' => 'Understand the tabs on a person’s page',
    'slug' => 'understand-individual-page-tabs',
    'category' => 'individual-pages',
    'summary' => 'Learn what Biography, Facts and events, Families, Album and other individual-page tabs are for.',
    'published' => true,
    'audience' => 'visitors',
    'featured' => true,
    'requires_modules' => '',
    'screenshot' => 'module://individual-tabs-guide.webp',
    'screenshot_alt' => 'Annotated example of an individual page showing Biography, Facts and events, Families, Sources, Media and Interactive tree tabs.',
    'screenshot_caption' => 'The available tabs and their position can vary with the theme, permissions and installed modules.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<p>A person’s page can contain several tabs. The exact tabs depend on the site settings and installed modules.</p>
<ul>
<li><strong>Biography:</strong> a readable story assembled from the person’s visible records.</li>
<li><strong>Facts and events:</strong> the detailed timeline of personal, family, relative and historical events.</li>
<li><strong>Families:</strong> parents, partners, children and family relationships.</li>
<li><strong>Album or Media:</strong> photographs, certificates and other linked files.</li>
<li><strong>Sources, notes or specialist tabs:</strong> additional research material or module features.</li>
</ul>
<p>The tabs are different views of connected records. Moving from one tab to another does not create a different person. Privacy rules can also mean that one visitor sees fewer tabs or less content than another.</p>',
    'language' => 'en',
    'translation_key' => 'understand-individual-page-tabs',
  ),
  5 => 
  array (
    'block_order' => 60,
    'title' => 'What the Biography tab shows',
    'slug' => 'what-the-biography-tab-shows',
    'category' => 'individual-pages',
    'summary' => 'Understand how Potts Biography turns visible webtrees records into a readable illustrated life story.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<p>The Biography tab is a reading view. It uses the facts, family relationships, notes, sources and media that webtrees allows you to see and turns them into a chronological story.</p>
<p>Depending on the available records, it may include:</p>
<ul>
<li>birth, parents, siblings and childhood</li>
<li>education, occupations and residences</li>
<li>partners, marriages and children</li>
<li>migration and important turning points</li>
<li>historical context during the person’s lifetime</li>
<li>research notes, photographs, documents and keepsakes</li>
<li>death, burial and a summary of the person’s recorded life</li>
</ul>
<p>The Biography never reveals information that webtrees has hidden. A short biography usually means that fewer facts are recorded or visible, not that the module has ignored them.</p>',
    'language' => 'en',
    'translation_key' => 'what-the-biography-tab-shows',
  ),
  6 => 
  array (
    'block_order' => 10,
    'title' => 'Why the Biography tab cannot be edited directly',
    'slug' => 'why-biography-cannot-be-edited-directly',
    'category' => 'individual-pages',
    'summary' => 'The Biography is generated from webtrees records; make corrections in Facts and events, Families, names, notes or media.',
    'published' => true,
    'audience' => 'everyone',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<p>Potts Biography is deliberately read-only. It does not maintain a second version of the family tree.</p>
<h2>Where to make a change</h2>
<ul>
<li>Use <strong>Facts and events</strong> for dates, places, occupations, residences, immigration and other life events.</li>
<li>Use <strong>Families</strong> for parents, partners, marriages and children.</li>
<li>Edit the person’s name record for formal names, maiden names, nicknames and known-as names.</li>
<li>Edit or link media for photographs and documents.</li>
<li>Add notes and sources to the relevant person, family or event.</li>
</ul>
<p>After an approved change is saved, the Biography is rebuilt from the updated records. There is normally no separate biography text to edit.</p>',
    'language' => 'en',
    'translation_key' => 'why-biography-cannot-be-edited-directly',
  ),
  7 => 
  array (
    'block_order' => 70,
    'title' => 'Use the Facts and events tab',
    'slug' => 'use-facts-and-events-tab',
    'category' => 'individual-pages',
    'summary' => 'Read the detailed timeline and choose whether to show family, close-relative, associate or historical events.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p><strong>Facts and events</strong> is the detailed record behind much of the individual page. It can include the person’s own events as well as selected family and contextual events.</p>
<h2>What you may see</h2>
<ul>
<li>birth, baptism, education, occupation, residence and death</li>
<li>family events such as marriage or divorce</li>
<li>events involving parents, partners, children or other close relatives</li>
<li>associate events where the person was a witness or participant</li>
<li>historical facts during the person’s lifetime</li>
<li>notes, sources, media and age-at-event labels</li>
</ul>
<p>Use the tab’s display or options control to tick or untick available categories. The choices change the presentation only; they do not delete any genealogy records.</p>',
    'screenshot' => 'module://facts-and-events-place.webp',
    'screenshot_alt' => 'Birth, baptism and burial facts displayed in webtrees with place information and map links.',
    'screenshot_caption' => 'Facts and events can display dates, places, map links and other details recorded for the person.',
    'screenshot_source' => 'Official webtrees location guide',
    'screenshot_source_url' => 'https://webtrees.net/faq/locations/',
    'language' => 'en',
    'translation_key' => 'use-facts-and-events-tab',
  ),
  8 => 
  array (
    'block_order' => 80,
    'title' => 'Use the Families tab',
    'slug' => 'use-families-tab',
    'category' => 'individual-pages',
    'summary' => 'See parents, partners, children and the separate family groups to which a person belongs.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>The Families tab explains how the person is connected to immediate relatives.</p>
<ul>
<li>A <strong>family as a child</strong> normally contains the person’s parents and siblings.</li>
<li>A <strong>family as a partner</strong> contains a spouse or partner and their children.</li>
<li>A person with more than one partner will usually have more than one partner-family section.</li>
<li>Adoptive, foster, step and other relationship types may be recorded separately.</li>
</ul>
<p>Members with editing permission also use this tab to add or correct parents, partners and children. Relationship changes should not be made by merely typing a relative’s name into a note.</p>',
    'language' => 'en',
    'translation_key' => 'use-families-tab',
  ),
  9 => 
  array (
    'block_order' => 90,
    'title' => 'Explore ancestors, descendants and the interactive tree',
    'slug' => 'explore-charts-and-interactive-tree',
    'category' => 'charts-tools',
    'summary' => 'Use webtrees charts to move beyond one person and see a wider part of the family.',
    'published' => true,
    'audience' => 'visitors',
    'featured' => true,
    'requires_modules' => '',
    'body' => '<p>Charts are generated from the relationships recorded in webtrees.</p>
<ul>
<li><strong>Ancestors:</strong> follows parents, grandparents and earlier generations.</li>
<li><strong>Descendants:</strong> follows children, grandchildren and later generations.</li>
<li><strong>Interactive tree:</strong> lets you expand branches and move around visually.</li>
<li><strong>Family book or hourglass charts:</strong> combine ancestors, partners and descendants in different layouts.</li>
<li><strong>Relationship chart:</strong> shows a path connecting two people where one can be found.</li>
</ul>
<p>Large trees may take longer to draw. Privacy rules still apply, so private people may appear as limited placeholders or may be omitted.</p>',
    'screenshot' => 'module://interactive-tree.webp',
    'screenshot_alt' => 'A webtrees interactive pedigree chart showing connected family members across several generations.',
    'screenshot_caption' => 'An interactive tree gives a visual overview of ancestors and family connections. Names, colours and controls vary by theme.',
    'screenshot_source' => 'Official webtrees website',
    'screenshot_source_url' => 'https://webtrees.net/',
    'language' => 'en',
    'translation_key' => 'explore-charts-and-interactive-tree',
  ),
  10 => 
  array (
    'block_order' => 100,
    'title' => 'Follow family links without getting lost',
    'slug' => 'follow-family-links',
    'category' => 'charts-tools',
    'summary' => 'Use page headings, breadcrumbs, tabs and open-in-new-tab techniques when exploring a large family.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<ul>
<li>Check the person’s name, lifespan and parents before following a link.</li>
<li>Use the browser’s Back button to return to the previous person.</li>
<li>Open an unfamiliar relative in a new browser tab so you do not lose your starting point.</li>
<li>Use an ancestor or descendant chart when repeatedly moving one generation at a time becomes confusing.</li>
<li>Return to a known person through quick search when you lose your place.</li>
</ul>
<p>People with similar names may belong to different branches. Dates, places and family members are usually more reliable identifiers than the name alone.</p>',
    'language' => 'en',
    'translation_key' => 'follow-family-links',
  ),
  11 => 
  array (
    'block_order' => 110,
    'title' => 'Understand the relationship summary',
    'slug' => 'understand-relationship-summary',
    'category' => 'optional-features',
    'summary' => 'Learn how Potts Relationship Context explains how the person relates to you or to the site’s reference person.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '_potts_relationship_context_',
    'body' => '<p>A relationship message near the individual page may say that the person is your aunt, cousin, ancestor or another relationship.</p>
<p>For a signed-in member, the reference person may be:</p>
<ol>
<li>the individual linked to the member’s account</li>
<li>a favourite individual selected by the member</li>
<li>the site’s public reference person</li>
<li>the tree’s root individual</li>
</ol>
<p>The administrator decides which fallbacks are allowed. Select the relationship link to open the normal webtrees relationship-path chart when one is available.</p>
<p>No relationship message does not prove that the families are unrelated. The connecting records may be private, incomplete or beyond the configured search depth.</p>',
    'language' => 'en',
    'translation_key' => 'understand-relationship-summary',
  ),
  12 => 
  array (
    'block_order' => 20,
    'title' => 'Turn relationship labels on or off',
    'slug' => 'turn-relationship-labels-on-or-off',
    'category' => 'optional-features',
    'summary' => 'Use the Relationship display option in Facts and events to show or hide added relationship labels.',
    'published' => true,
    'audience' => 'everyone',
    'requires_modules' => '_potts_relationship_context_',
    'body' => '<p>Potts Relationship Context can add labels to close-relative and associate events so that names are easier to understand.</p>
<ol>
<li>Open the person’s <strong>Facts and events</strong> tab.</li>
<li>Open the tab’s display or options control.</li>
<li>Tick <strong>Relationship</strong> to show the added labels, or untick it to hide them.</li>
</ol>
<p>This controls relationship labels within the Facts and events presentation. It may not remove the main relationship summary near the person’s heading because the administrator can configure that summary separately.</p>
<p>Your choice affects only what you see. It does not change the family tree or another visitor’s settings.</p>',
    'language' => 'en',
    'translation_key' => 'turn-relationship-labels-on-or-off',
  ),
  13 => 
  array (
    'block_order' => 120,
    'title' => 'What are events of close relatives?',
    'slug' => 'what-are-events-of-close-relatives',
    'category' => 'optional-features',
    'summary' => 'Understand why a parent’s death, child’s birth or partner’s event may appear in another person’s timeline.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>webtrees can place selected events from close relatives into the current person’s Facts and events timeline. This helps show what was happening within the family during the person’s life.</p>
<p>Examples include:</p>
<ul>
<li>the birth or death of a parent, partner or child</li>
<li>a partner’s marriage or death</li>
<li>important events involving siblings or other close family</li>
</ul>
<p>The event still belongs to the relative whose record contains it. It is displayed here as context. Correcting the event requires editing the relative’s own record, not the person whose timeline happens to show it.</p>',
    'language' => 'en',
    'translation_key' => 'what-are-events-of-close-relatives',
  ),
  14 => 
  array (
    'block_order' => 30,
    'title' => 'Show or hide events of close relatives',
    'slug' => 'show-hide-close-relative-events',
    'category' => 'optional-features',
    'summary' => 'Use the Facts and events options without deleting or changing any recorded event.',
    'published' => true,
    'audience' => 'everyone',
    'requires_modules' => '',
    'body' => '<ol>
<li>Open the person’s <strong>Facts and events</strong> tab.</li>
<li>Find the display or options control near the timeline.</li>
<li>Tick <strong>Events of close relatives</strong> to include them.</li>
<li>Untick the option when you want a simpler timeline containing mainly the person’s own events.</li>
</ol>
<p>The exact wording and position can vary slightly with the active theme and installed modules. The setting changes the view only. It does not remove events from relatives’ records.</p>
<p>When the timeline feels crowded, turn off close relatives, associates or historical facts one category at a time.</p>',
    'language' => 'en',
    'translation_key' => 'show-hide-close-relative-events',
  ),
  15 => 
  array (
    'block_order' => 130,
    'title' => 'Choose the historical collections you want to see',
    'slug' => 'choose-historical-collections',
    'category' => 'optional-features',
    'summary' => 'Use the History selector to choose regional or broader historical events relevant to the people you view.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '_potts_historical_facts_',
    'body' => '<p>Potts Historical Facts can offer several historical collections, such as Australia, England, Scotland, Ireland, Europe or world events.</p>
<ol>
<li>Open the <strong>History</strong> selector in the site header when it is available.</li>
<li>Select one or more collections.</li>
<li>Return to an individual page or refresh it.</li>
<li>Select <strong>Site default</strong> to return to the administrator’s normal choice.</li>
</ol>
<p>Your selection is remembered in your browser. It is independent of the language used to display webtrees.</p>
<p>Only events that overlap the person’s lifetime are shown. Broad collections can overlap with country collections, so selecting many collections may produce similar or repeated themes.</p>',
    'language' => 'en',
    'translation_key' => 'choose-historical-collections',
  ),
  16 => 
  array (
    'block_order' => 140,
    'title' => 'Understand historical facts in Facts and events',
    'slug' => 'historical-facts-in-facts-events',
    'category' => 'optional-features',
    'summary' => 'Historical events provide context and are not personal events recorded as having happened to the individual.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '_potts_historical_facts_',
    'body' => '<p>Historical facts are drawn from sourced regional collections and filtered to the person’s lifetime. They may appear among the person’s Facts and events to show the world in which they lived.</p>
<ul>
<li>Select the source link to learn more about a historical event.</li>
<li>Use the History selector to change the regional collections.</li>
<li>Use the Facts and events display options to show or hide historical facts where that option is provided.</li>
<li>Remember that a historical event is context; it does not claim that the person participated in it.</li>
</ul>
<p>If an event is incorrect or belongs to the wrong collection, report it to the site administrator rather than editing the individual’s genealogy record.</p>',
    'language' => 'en',
    'translation_key' => 'historical-facts-in-facts-events',
  ),
  17 => 
  array (
    'block_order' => 150,
    'title' => 'Understand historical context in Biography',
    'slug' => 'historical-context-in-biography',
    'category' => 'optional-features',
    'summary' => 'See how the Biography follows the selected historical collections and can change country after migration.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '_potts_life_story_engine_,_potts_historical_facts_',
    'body' => '<p>When Potts Biography and Potts Historical Facts are both active, the Biography can include a historical-context section based on the collections selected for the site or by the visitor.</p>
<p>The Biography:</p>
<ul>
<li>filters events to the person’s lifetime</li>
<li>uses the historical collections currently selected</li>
<li>can change regional context after a recorded migration</li>
<li>keeps historical context separate from the person’s own facts</li>
<li>shows source links supplied with the historical collection</li>
</ul>
<p>Change the History selection and reload the Biography when you want to compare another region. A missing historical section may mean no matching events were found, the module is disabled or the person’s dates and migration details are incomplete.</p>',
    'language' => 'en',
    'translation_key' => 'historical-context-in-biography',
  ),
  18 => 
  array (
    'block_order' => 160,
    'title' => 'Understand ages shown beside events',
    'slug' => 'understand-fact-ages',
    'category' => 'optional-features',
    'summary' => 'Potts Fact Ages calculates a person’s age from the first recorded birth date and dated events.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '_potts_fact_ages_',
    'body' => '<p>Age labels can appear in a separate Potts Fact Ages tab, on Facts and events cards or in both places.</p>
<p>Age calculations can be shown as:</p>
<ul>
<li>a simple age such as <strong>35 years</strong></li>
<li>a detailed age such as <strong>35 years, 2 months, 4 days</strong></li>
<li>both styles together</li>
</ul>
<p>An age may be absent when the birth date or event date is incomplete, unsupported, private or uncertain. Approximate dates and ranges can only produce the precision supported by the recorded information.</p>
<p>The administrator controls which categories and event types receive labels. Seeing an age does not make the underlying date more certain.</p>',
    'language' => 'en',
    'translation_key' => 'understand-fact-ages',
  ),
  19 => 
  array (
    'block_order' => 170,
    'title' => 'Understand names, dates and places',
    'slug' => 'understand-names-dates-and-places',
    'category' => 'searching-viewing',
    'summary' => 'Recognise maiden names, known-as names, approximate dates, date ranges and historical place names.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Family-history records are often incomplete, contradictory or written according to the customs of another period. webtrees can preserve that uncertainty rather than forcing every detail into a modern, exact form.</p>
<h2>Names</h2>
<ul>
<li>A person may have formal names, a maiden surname, married names, nicknames and alternative spellings.</li>
<li>A starred given name may identify the part of a formal name by which the person was known. The asterisk itself is not normally displayed in the Biography.</li>
<li>Check the person’s relatives, dates and places before assuming that a different spelling belongs to a different person.</li>
</ul>
<h2>Dates</h2>
<ul>
<li><strong>About</strong>, <strong>before</strong> and <strong>after</strong> record uncertainty.</li>
<li><strong>Between</strong> and <strong>from/to</strong> record ranges rather than exact days.</li>
<li>Do not turn an estimate into an exact date simply to make a chart look complete.</li>
</ul>
<h2>Places</h2>
<p>Places may use a historically accurate name, a consistent modern hierarchy or both through a note. Follow the conventions used by this tree and select existing place suggestions where appropriate.</p>
<p>Conflicting records can be retained with explanatory notes and citations when the evidence is genuinely uncertain. A difference is not always a mistake.</p>',
    'screenshot' => 'module://event-map.webp',
    'screenshot_alt' => 'A webtrees map showing separate markers for a birth and burial near Milton Keynes.',
    'screenshot_caption' => 'Place names and recorded coordinates can be used to display events on a map.',
    'screenshot_source' => 'Official webtrees location guide',
    'screenshot_source_url' => 'https://webtrees.net/faq/locations/',
    'language' => 'en',
    'translation_key' => 'understand-names-dates-and-places',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'Official webtrees guidance about locations',
        'url' => 'https://webtrees.net/faq/locations/',
      ),
    ),
  ),
  20 => 
  array (
    'block_order' => 180,
    'title' => 'Why different visitors see different information',
    'slug' => 'why-visitors-see-different-information',
    'category' => 'privacy-accounts',
    'summary' => 'Privacy, account access, language, personal display choices and optional modules can all change a page.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Two people can open the same individual and see different content.</p>
<p>Common reasons include:</p>
<ul>
<li>one visitor is signed in and the other is not</li>
<li>their accounts have different access levels</li>
<li>the person or a relative is living or otherwise private</li>
<li>they selected different historical collections</li>
<li>they turned close-relative, relationship or historical displays on or off</li>
<li>they are using different languages</li>
<li>an administrator has changed a module or tab setting</li>
</ul>
<p>Privacy filtering also affects generated biographies, charts and relationship paths. A missing paragraph or connection may therefore be an access decision rather than an error.</p>',
    'language' => 'en',
    'translation_key' => 'why-visitors-see-different-information',
  ),
  21 => 
  array (
    'block_order' => 190,
    'title' => 'Why living people are private',
    'slug' => 'why-living-people-are-private',
    'category' => 'privacy-accounts',
    'summary' => 'Understand why names, dates, photographs and family details may be hidden or limited.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>webtrees applies privacy rules to protect living people and recent family information. You may see a private placeholder, limited details or no record at all.</p>
<ul>
<li>Signing in does not automatically provide unrestricted access to every person.</li>
<li>Access can depend on your account, relationship to the family and the site’s privacy policy.</li>
<li>Private relatives can also affect charts, biographies and calculated relationships.</li>
<li>Information visible to a registered member should not be copied or shared without permission.</li>
</ul>
<p>Contact the administrator when you have a genuine family-history reason for requesting access. Include enough information to establish your connection to the family.</p>',
    'language' => 'en',
    'translation_key' => 'why-living-people-are-private',
  ),
  22 => 
  array (
    'block_order' => 200,
    'title' => 'Request a registered account',
    'slug' => 'request-a-registered-account',
    'category' => 'privacy-accounts',
    'summary' => 'Explain who you are, how you connect to the family and why you would like access.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Use the registration option when it is available, or contact the administrator when registrations are handled manually.</p>
<p>Include:</p>
<ul>
<li>your full name</li>
<li>the branch of the family to which you belong</li>
<li>the name of a close relative already recorded in the tree</li>
<li>the reason you would like access</li>
<li>any information, photographs or research you would like to contribute</li>
</ul>
<p>An account may need email verification and administrator approval. Approval protects living relatives and helps prevent fraudulent registrations.</p>',
    'language' => 'en',
    'translation_key' => 'request-a-registered-account',
  ),
  23 => 
  array (
    'block_order' => 210,
    'title' => 'Sign in or reset your password',
    'slug' => 'sign-in-or-reset-your-password',
    'category' => 'privacy-accounts',
    'summary' => 'Use your registered account and recover access when you have forgotten your username or password.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'screenshot' => 'module://sign-in-guide.webp',
    'screenshot_alt' => 'Annotated example of a webtrees sign-in form with password reset and account request links.',
    'screenshot_caption' => 'Use the password-reset link rather than creating a second account when access has been lost.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<ol>
<li>Open the sign-in page and enter the username or email address associated with your account.</li>
<li>Enter the password carefully, including capital letters and symbols.</li>
<li>Use the password-reset option when you cannot remember it.</li>
<li>Check spam or junk mail when the reset message does not appear.</li>
</ol>
<p>Reset links can expire and should not be shared. Contact the administrator if you no longer have access to the registered email address, cannot remember the username or the account remains locked.</p>',
    'language' => 'en',
    'translation_key' => 'sign-in-or-reset-your-password',
  ),
  24 => 
  array (
    'block_order' => 220,
    'title' => 'Report a correction',
    'slug' => 'report-a-correction',
    'category' => 'corrections-contact',
    'summary' => 'Identify the exact person, explain the proposed change and provide evidence that can be reviewed.',
    'published' => true,
    'audience' => 'visitors',
    'featured' => true,
    'requires_modules' => '',
    'body' => '<p>When reporting an error, include:</p>
<ul>
<li>the person’s name and a link to their page where possible</li>
<li>the information currently displayed</li>
<li>the corrected information you propose</li>
<li>the source, such as a certificate, notice, record image or family document</li>
<li>your relationship to the person where relevant</li>
</ul>
<p>An online family tree by itself is not strong evidence because trees often copy one another. Original records or clearly identified contemporary sources are especially helpful.</p>
<p>Explain uncertainty rather than forcing a precise answer when records conflict.</p>',
    'language' => 'en',
    'translation_key' => 'report-a-correction',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'webtrees community forum',
        'url' => 'https://webtrees.net/forum/',
      ),
    ),
  ),
  25 => 
  array (
    'block_order' => 230,
    'title' => 'Share family information, stories or photographs',
    'slug' => 'share-family-information',
    'category' => 'corrections-contact',
    'summary' => 'Contribute material that can improve the family tree and explain its ownership and context.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Family knowledge and private collections can add detail unavailable in public records.</p>
<p>When contributing material, provide:</p>
<ul>
<li>the people or event it relates to</li>
<li>names, approximate dates and places</li>
<li>how the information was obtained</li>
<li>whether any people shown are living</li>
<li>who owns the original item</li>
<li>whether permission is given for website display</li>
</ul>
<p>High-resolution scans are preferred. Keep an unedited master copy and do not crop away handwritten notes, photographer details or the reverse side of a photograph before making a preservation copy.</p>',
    'language' => 'en',
    'translation_key' => 'share-family-information',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'webtrees community forum',
        'url' => 'https://webtrees.net/forum/',
      ),
    ),
  ),
  26 => 
  array (
    'block_order' => 240,
    'title' => 'Use photographs and written information responsibly',
    'slug' => 'using-photographs-and-information',
    'category' => 'privacy-accounts',
    'summary' => 'Respect privacy, copyright and the work of family members and researchers who contributed material.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Being able to view an item does not automatically give permission to republish it.</p>
<ul>
<li>Ask before reposting photographs of living people or recent family events.</li>
<li>Keep photographer, owner, source and contributor credits.</li>
<li>Do not use information about living people for unsolicited contact, marketing or identity checks.</li>
<li>Contact the administrator before reproducing substantial biographies, research notes or image collections elsewhere.</li>
</ul>
<p>Public historical facts may be freely known, but photographs, scans, transcriptions and original writing can still be protected by copyright or family usage conditions.</p>',
    'language' => 'en',
    'translation_key' => 'using-photographs-and-information',
  ),
  27 => 
  array (
    'block_order' => 250,
    'title' => 'Change the webtrees display language',
    'slug' => 'change-display-language',
    'category' => 'visitor-start',
    'summary' => 'Select another language for menus and labels without changing the genealogy data itself.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Use the language selector provided by the site to change webtrees menus, headings, fact labels and other translated text.</p>
<p>Changing the language does not translate names, notes, documents or user-written research automatically. Historical Facts may use a language-matched collection when one is available, while the selected region remains your choice.</p>
<p>Some custom-module wording may remain in the site’s main language when a translation has not yet been supplied. Report unclear or untranslated labels to the administrator with a screenshot and the language selected.</p>',
    'language' => 'en',
    'translation_key' => 'change-display-language',
  ),
  28 => 
  array (
    'block_order' => 260,
    'title' => 'Contact the site administrator',
    'slug' => 'contact-the-site-administrator',
    'category' => 'corrections-contact',
    'summary' => 'Send enough information for questions about access, corrections, missing people or site features to be investigated.',
    'published' => true,
    'audience' => 'visitors',
    'requires_modules' => '',
    'body' => '<p>Contact the administrator when you:</p>
<ul>
<li>cannot find a person you expected to see</li>
<li>need help with registration or sign-in</li>
<li>want to report a correction</li>
<li>have photographs, documents or family knowledge to contribute</li>
<li>believe private information is being displayed incorrectly</li>
<li>cannot find a tab or display option described in this help centre</li>
</ul>
<p>Include the person’s name, a page link, what you expected, what actually happened and a screenshot where useful. Do not send passwords or highly sensitive personal documents through an insecure contact form.</p>',
    'language' => 'en',
    'translation_key' => 'contact-the-site-administrator',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'webtrees community forum',
        'url' => 'https://webtrees.net/forum/',
      ),
    ),
  ),
  29 => 
  array (
    'block_order' => 10,
    'title' => 'Before you make a change',
    'slug' => 'before-you-make-a-change',
    'category' => 'getting-started',
    'summary' => 'Check the person, the evidence and the correct editing location before changing the family tree.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Confirm that you are viewing the correct person by checking dates, places and close relatives.</li>
<li>Search for the person or family before creating anything new.</li>
<li>Decide whether the change belongs to the individual, a family relationship, an event, a media item or a source.</li>
<li>Keep the source or family explanation ready before saving.</li>
<li>Protect living people and avoid entering sensitive information that does not serve a genuine family-history purpose.</li>
</ol>
<p>Use <strong>Facts and events</strong> for life details and <strong>Families</strong> for parents, partners and children. The Biography is a generated reading view and should not be treated as the editing form.</p>',
    'language' => 'en',
    'translation_key' => 'before-you-make-a-change',
  ),
  30 => 
  array (
    'block_order' => 20,
    'title' => 'Choose the correct tab for your change',
    'slug' => 'choose-correct-tab-for-change',
    'category' => 'getting-started',
    'summary' => 'Use Biography for reading, Facts and events for life details and Families for relationships.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<table>
<thead><tr><th>What you need to change</th><th>Where to go</th></tr></thead>
<tbody>
<tr><td>Birth, death, residence, occupation, immigration or another event</td><td>Facts and events</td></tr>
<tr><td>Parents, partner, marriage family or child</td><td>Families</td></tr>
<tr><td>Formal name, maiden surname, nickname or known-as name</td><td>Edit the individual’s name</td></tr>
<tr><td>Photograph, certificate or document</td><td>Media/Album or the relevant fact’s media section</td></tr>
<tr><td>Where information came from</td><td>Source citation on the relevant fact or record</td></tr>
<tr><td>Biography wording</td><td>Correct the underlying records; Biography rebuilds automatically</td></tr>
</tbody>
</table>
<p>Exact button placement can vary with the theme, your permissions and the type of record.</p>',
    'language' => 'en',
    'translation_key' => 'choose-correct-tab-for-change',
  ),
  31 => 
  array (
    'block_order' => 30,
    'title' => 'Find a person before creating them',
    'slug' => 'find-before-creating',
    'category' => 'getting-started',
    'summary' => 'Avoid duplicate people by checking names, relatives, dates, places and alternative spellings.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Duplicate individuals create conflicting relationships, repeated events and misleading charts.</p>
<ol>
<li>Search the full name and surname separately.</li>
<li>Try maiden surnames, nicknames, initials and spelling variants.</li>
<li>Search for parents, partners or children and inspect their Families tab.</li>
<li>Compare dates and places before deciding the person is absent.</li>
<li>Ask the administrator when two records may represent the same person.</li>
</ol>
<p>Do not create a second person merely because a private record is hidden from you. Limited access can make an existing person difficult to recognise.</p>',
    'language' => 'en',
    'translation_key' => 'find-before-creating',
  ),
  32 => 
  array (
    'block_order' => 40,
    'title' => 'Create a new person',
    'slug' => 'create-a-new-person',
    'category' => 'people-families',
    'summary' => 'Create a person from the family relationship where they belong whenever possible.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>The safest way to create a person is usually from an existing relative’s <strong>Families</strong> tab.</p>
<ol>
<li>Open a known parent, partner or child.</li>
<li>Open <strong>Families</strong>.</li>
<li>Select the appropriate action, such as adding a child, partner or parent.</li>
<li>Search for an existing individual before choosing to create a new one.</li>
<li>Enter the name carefully, including surname slashes or name fields as presented by webtrees.</li>
<li>Add known birth or death details and a source where available.</li>
<li>Save and check the resulting family connections.</li>
</ol>
<p>Creating from the family context reduces the chance of leaving the new person unconnected or attaching them to the wrong family.</p>',
    'language' => 'en',
    'translation_key' => 'create-a-new-person',
  ),
  33 => 
  array (
    'block_order' => 50,
    'title' => 'Add a partner',
    'slug' => 'add-a-partner',
    'category' => 'people-families',
    'summary' => 'Create or connect a spouse or partner through the Families tab rather than the Biography or a personal note.',
    'published' => true,
    'audience' => 'members',
    'featured' => true,
    'requires_modules' => '',
    'screenshot' => 'module://add-partner-guide.webp',
    'screenshot_alt' => 'Annotated example of the Families tab and the action to add another spouse or partner.',
    'screenshot_caption' => 'Add a partner through the Families tab and search for an existing person before creating a new record.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<ol>
<li>Open the person who already exists.</li>
<li>Select the <strong>Families</strong> tab.</li>
<li>Choose the action to add a husband, wife, spouse or partner.</li>
<li>Search for the partner before creating a new individual.</li>
<li>Add the marriage or partnership details to the new family record where known.</li>
<li>Save and confirm that both partners appear in the same family section.</li>
</ol>
<p>A partner is a family relationship, not merely a marriage fact on one person. Linking the family correctly allows children, charts and biographies to use the relationship consistently.</p>',
    'language' => 'en',
    'translation_key' => 'add-a-partner',
  ),
  34 => 
  array (
    'block_order' => 60,
    'title' => 'Add another partner or marriage',
    'slug' => 'add-another-partner',
    'category' => 'people-families',
    'summary' => 'Create a separate partner family when a person had more than one relationship.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Each partnership normally has its own family record.</p>
<ol>
<li>Open the person’s <strong>Families</strong> tab.</li>
<li>Select the option to add another partner.</li>
<li>Search for and link the existing partner, or create the person if necessary.</li>
<li>Add marriage, separation, divorce or partnership events to that family.</li>
<li>Add children to the correct partner family.</li>
</ol>
<p>Do not place children from different relationships into one family for convenience. Correct family grouping is essential for descendant charts and for Biography wording about partners and children.</p>',
    'language' => 'en',
    'translation_key' => 'add-another-partner',
  ),
  35 => 
  array (
    'block_order' => 70,
    'title' => 'Add a child',
    'slug' => 'add-a-child',
    'category' => 'people-families',
    'summary' => 'Add a child to the correct parents or partner family and search before creating a duplicate.',
    'published' => true,
    'audience' => 'members',
    'featured' => true,
    'requires_modules' => '',
    'screenshot' => 'module://add-child-guide.webp',
    'screenshot_alt' => 'Annotated example showing the Add a child action for a selected family and a new-child form.',
    'screenshot_caption' => 'Make sure the correct family is selected and search for the child before creating a new individual.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<ol>
<li>Open either parent and select <strong>Families</strong>.</li>
<li>Find the correct partner-family section.</li>
<li>Select <strong>Add a child</strong> or the equivalent action.</li>
<li>Search for the child before creating a new individual.</li>
<li>Enter the child’s name and known birth details.</li>
<li>Check the relationship type when adoption, foster care or another non-biological relationship applies.</li>
<li>Save and verify that the child appears with the correct parents.</li>
</ol>
<p>When only one parent is known, webtrees can still record a family with one identified parent. Do not invent an unknown parent to make the layout look complete.</p>',
    'language' => 'en',
    'translation_key' => 'add-a-child',
  ),
  36 => 
  array (
    'block_order' => 80,
    'title' => 'Add or correct parents',
    'slug' => 'add-or-correct-parents',
    'category' => 'people-families',
    'summary' => 'Connect a person to existing or new parents and use the appropriate relationship type.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Open the child’s <strong>Families</strong> tab.</li>
<li>Find the family-as-a-child section.</li>
<li>Add a father, mother or parent using the available family action.</li>
<li>Search carefully before creating a new parent.</li>
<li>Choose biological, adoptive, foster, step or another relationship type when the option is provided.</li>
<li>Save and check siblings and charts for unexpected connections.</li>
</ol>
<p>When the existing parents are wrong, do not simply add another pair. Ask an administrator to help unlink the incorrect family when you are unsure, because deleting a person is not the same as removing a relationship.</p>',
    'language' => 'en',
    'translation_key' => 'add-or-correct-parents',
  ),
  37 => 
  array (
    'block_order' => 90,
    'title' => 'Correct an incorrect family relationship',
    'slug' => 'correct-family-relationship',
    'category' => 'people-families',
    'summary' => 'Unlink the wrong relationship without accidentally deleting a person or their other family connections.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>A person and a family link are separate records. Correcting the link should not normally require deleting the person.</p>
<ol>
<li>Confirm which family relationship is wrong.</li>
<li>Open the relevant Families tab and use the edit action for that family.</li>
<li>Remove or change the child, partner or parent link as appropriate.</li>
<li>Reconnect the person to the correct family.</li>
<li>Check charts and sibling lists afterwards.</li>
</ol>
<p>Relationship changes can affect many pages. Contact an administrator when the action is unavailable or when the person belongs to several families and the consequences are unclear.</p>',
    'language' => 'en',
    'translation_key' => 'correct-family-relationship',
  ),
  38 => 
  array (
    'block_order' => 100,
    'title' => 'Correct a person’s name',
    'slug' => 'correct-a-name',
    'category' => 'names',
    'summary' => 'Edit the name record while preserving maiden surnames, prefixes, suffixes and alternative names correctly.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'screenshot' => 'module://edit-name-guide.webp',
    'screenshot_alt' => 'Annotated example of the edit menu and name fields including given names, surname, nickname and name type.',
    'screenshot_caption' => 'Edit a documented error but use an additional name when both historical forms are supported.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<ol>
<li>Open the person and use the edit action for their name or personal details.</li>
<li>Enter given names and surname in the fields or GEDCOM name format presented by webtrees.</li>
<li>Keep maiden surnames as the principal birth surname where that is the site’s convention.</li>
<li>Use prefix, suffix, title, nickname and alternative-name fields rather than squeezing everything into given names.</li>
<li>Add a source citation when the correction comes from a record.</li>
<li>Save and check the page heading, search results and Biography.</li>
</ol>
<p>Do not silently replace a documented historical spelling with a modern spelling. Add an alternative name when both forms are supported by evidence.</p>',
    'language' => 'en',
    'translation_key' => 'correct-a-name',
  ),
  39 => 
  array (
    'block_order' => 110,
    'title' => 'Record a maiden surname and married names',
    'slug' => 'record-maiden-and-married-names',
    'category' => 'names',
    'summary' => 'Keep the person identifiable across birth, marriage and later records without creating duplicate individuals.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Record the person’s birth or maiden surname as the principal genealogical surname unless your site uses another documented convention.</p>
<ul>
<li>Add married names as additional or type-labelled names where useful.</li>
<li>Do not create a new individual for each surname.</li>
<li>Use source citations to explain when a surname changed or was adopted.</li>
<li>Retain spelling variants that appear in significant records when they help searching and identification.</li>
</ul>
<p>Search in webtrees generally becomes more useful when both the birth surname and important later names are recorded properly.</p>',
    'language' => 'en',
    'translation_key' => 'record-maiden-and-married-names',
  ),
  40 => 
  array (
    'block_order' => 120,
    'title' => 'Add a nickname or known-as name',
    'slug' => 'add-a-nickname-known-as',
    'category' => 'names',
    'summary' => 'Record the name used in everyday life without replacing the person’s formal full name.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<p>Use the <strong>Nickname</strong> field when the person was commonly known by a separate nickname.</p>
<p>On this site, a given name ending in an asterisk can indicate the part of a formal name by which the person was known. For example, <code>Charles Henry Lyle* /Potts/</code> means he was known as Lyle.</p>
<ul>
<li>Keep the formal name complete.</li>
<li>Use only one clear preferred-name method unless evidence requires more.</li>
<li>Do not display the asterisk as part of the public name; Potts Biography removes it.</li>
<li>Add an explanatory note or source when the preferred name may not be obvious.</li>
</ul>
<p>Potts Biography prefers a starred known-as given name, then GEDCOM nickname, then the first given name.</p>',
    'language' => 'en',
    'translation_key' => 'add-a-nickname-known-as',
  ),
  41 => 
  array (
    'block_order' => 130,
    'title' => 'Add a fact or event',
    'slug' => 'add-a-fact-or-event',
    'category' => 'facts-events',
    'summary' => 'Use Facts and events to record a dated or descriptive part of a person’s life.',
    'published' => true,
    'audience' => 'members',
    'featured' => true,
    'requires_modules' => '',
    'body' => '<ol>
<li>Open the person’s <strong>Facts and events</strong> tab.</li>
<li>Select the action to add a fact or event.</li>
<li>Choose the most specific available type, such as residence, occupation, education, immigration or burial.</li>
<li>Enter the date and place using webtrees formats.</li>
<li>Add value, description, note, media and source citation where they belong.</li>
<li>Save and check the timeline.</li>
</ol>
<p>A fact should describe the person, not a general historical event. Use the Historical Facts module or contact the administrator for regional history that did not happen directly to the individual.</p>',
    'language' => 'en',
    'translation_key' => 'add-a-fact-or-event',
  ),
  42 => 
  array (
    'block_order' => 140,
    'title' => 'Edit or remove an event',
    'slug' => 'edit-or-remove-event',
    'category' => 'facts-events',
    'summary' => 'Correct the existing record instead of adding a second version of the same event.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Open <strong>Facts and events</strong>.</li>
<li>Find the event and select its edit action.</li>
<li>Correct the date, place, value, note, source or media.</li>
<li>Save and check whether duplicate versions remain.</li>
</ol>
<p>Delete an event only when it is genuinely wrong or duplicated. When the evidence conflicts, it may be better to keep the event, qualify the date and explain the uncertainty in a note.</p>
<p>Some displayed events belong to a partner or close relative. In that case, follow the person’s link and edit the event on the record that owns it.</p>',
    'language' => 'en',
    'translation_key' => 'edit-or-remove-event',
  ),
  43 => 
  array (
    'block_order' => 150,
    'title' => 'Record dates and date ranges',
    'slug' => 'record-dates-and-date-ranges',
    'category' => 'facts-events',
    'summary' => 'Use GEDCOM-style dates to show exact, approximate and ranged evidence accurately.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Use the most precise date supported by the evidence.</p>
<ul>
<li><code>14 FEB 1966</code> — exact day</li>
<li><code>FEB 1966</code> — month known</li>
<li><code>1966</code> — year known</li>
<li><code>ABT 1966</code> — approximately</li>
<li><code>BEF 1966</code> or <code>AFT 1966</code> — before or after</li>
<li><code>BET 2004 AND 2025</code> — event occurred at an unknown time within the range</li>
<li><code>FROM 2004 TO 2025</code> — a state such as residence continued across the period</li>
</ul>
<p>For a residence lasting from 2004 until 2025, <strong>FROM 2004 TO 2025</strong> is generally clearer than <strong>BET 2004 AND 2025</strong>, because the latter means the event happened at some unknown point between those years.</p>',
    'language' => 'en',
    'translation_key' => 'record-dates-and-date-ranges',
  ),
  44 => 
  array (
    'block_order' => 160,
    'title' => 'Record a residence over a period',
    'slug' => 'record-residence-period',
    'category' => 'facts-events',
    'summary' => 'Use a continuing date range and enough address detail to distinguish different homes.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Add a <strong>Residence</strong> fact.</li>
<li>Use <code>FROM year TO year</code> when the person lived there throughout a known period.</li>
<li>Use an exact date or <code>BET ... AND ...</code> only when recording a single occurrence whose timing is uncertain.</li>
<li>Enter the place in the site’s normal hierarchy.</li>
<li>Add the street address in the address fields or note where appropriate.</li>
<li>Cite electoral rolls, directories, certificates, correspondence or family evidence.</li>
</ol>
<p>Create separate residence facts when the person moved away and later returned, or when the evidence relates to distinct addresses.</p>',
    'language' => 'en',
    'translation_key' => 'record-residence-period',
  ),
  45 => 
  array (
    'block_order' => 170,
    'title' => 'Enter places consistently',
    'slug' => 'enter-places-consistently',
    'category' => 'facts-events',
    'summary' => 'Enter the same place in the same way so suggestions, maps, place lists and reports group records correctly.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>webtrees treats the text in a place field as a hierarchy. Use the place order adopted by this tree, usually from the most specific area to the broadest:</p>
<p><code>locality, municipality or county, state or region, country</code></p>
<h2>Choose an existing place where possible</h2>
<ol>
<li>Begin typing the place and check the suggestions.</li>
<li>Select an existing suggestion when it represents the same location.</li>
<li>Before creating a new version, check spelling, punctuation and whether an abbreviation has already been expanded.</li>
</ol>
<p>For example, use one agreed form such as <code>Newborough, Victoria, Australia</code>. Avoid creating separate entries such as <code>Newborough VIC Australia</code>, <code>Newborough, Vic.</code> and <code>Newborough, Australia</code> for the same place.</p>
<h2>Historical and modern place names</h2>
<p>Use the place name that best describes where the event occurred. When boundaries or names changed, record the historical place in the event and explain the modern location in a note where that helps readers. Do not silently replace a historically accurate name merely because a modern name is more familiar.</p>
<h2>Addresses and coordinates</h2>
<ul>
<li>Keep a street address in the address fields when webtrees provides them, rather than making it part of every level of the place hierarchy.</li>
<li>Add coordinates only when they are reasonably verified.</li>
<li>Do not copy town-centre coordinates into a specific event unless they genuinely identify the event location.</li>
</ul>
<p>After saving, check the place link or map and correct any accidental duplicate. Consistent places improve searching, mapping and country-aware historical context.</p>',
    'screenshot' => 'module://edit-location.webp',
    'screenshot_alt' => 'The webtrees geographic location editor showing a map, place field, latitude and longitude.',
    'screenshot_caption' => 'The geographic-data screen is separate from the place text recorded in an individual event.',
    'screenshot_source' => 'Official webtrees location guide',
    'screenshot_source_url' => 'https://webtrees.net/faq/locations/',
    'language' => 'en',
    'translation_key' => 'enter-places-consistently',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'Official webtrees guidance about locations',
        'url' => 'https://webtrees.net/faq/locations/',
      ),
    ),
  ),
  46 => 
  array (
    'block_order' => 180,
    'title' => 'Record occupations, education and other life details',
    'slug' => 'record-occupations-education-life-details',
    'category' => 'facts-events',
    'summary' => 'Use separate dated facts when a person’s work, study or role changed over time.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Add the most specific fact available rather than placing an entire life summary in one note.</p>
<ul>
<li><strong>Occupation:</strong> job, trade, profession or role, with employer in a note when useful.</li>
<li><strong>Education:</strong> school, qualification or training period.</li>
<li><strong>Military service:</strong> use the available military facts and supporting notes or media.</li>
<li><strong>Religion, title or elected role:</strong> record only when relevant and supported.</li>
</ul>
<p>Add dates and places when known. Multiple occupation facts allow webtrees and Biography to present change over time instead of implying that one occupation lasted for the person’s entire life.</p>',
    'language' => 'en',
    'translation_key' => 'record-occupations-education-life-details',
  ),
  47 => 
  array (
    'block_order' => 190,
    'title' => 'Add or correct marriage and divorce details',
    'slug' => 'add-correct-marriage-divorce',
    'category' => 'facts-events',
    'summary' => 'Edit family events on the partner family so they apply consistently to both people.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Open either partner’s <strong>Families</strong> tab.</li>
<li>Open the correct partner-family section.</li>
<li>Add or edit the marriage, partnership, separation or divorce event on the family.</li>
<li>Enter date, place, type, notes, sources and media as supported.</li>
<li>Save and check both partners’ timelines and biographies.</li>
</ol>
<p>Do not add separate conflicting marriage facts to each partner when one family event can represent the relationship. Use a family note when the legal and personal circumstances require explanation.</p>',
    'language' => 'en',
    'translation_key' => 'add-correct-marriage-divorce',
  ),
  48 => 
  array (
    'block_order' => 200,
    'title' => 'Correct an event shown as a close-relative event',
    'slug' => 'correct-close-relative-event',
    'category' => 'facts-events',
    'summary' => 'Open the relative who owns the event rather than editing the person whose timeline merely displays it.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Events of close relatives are borrowed into the current timeline for context.</p>
<ol>
<li>Read the event label to identify the parent, partner, child or other relative.</li>
<li>Select that relative’s name.</li>
<li>Open their Facts and events tab.</li>
<li>Edit the event on their own record.</li>
<li>Return to the original person and reload the tab.</li>
</ol>
<p>When the event is a marriage or divorce, edit the appropriate family record through Families. Do not create a duplicate event on the current person just to alter the contextual display.</p>',
    'language' => 'en',
    'translation_key' => 'correct-close-relative-event',
  ),
  49 => 
  array (
    'block_order' => 210,
    'title' => 'Control close-relative, associate and historical displays',
    'slug' => 'control-facts-events-displays',
    'category' => 'facts-events',
    'summary' => 'Simplify the timeline by changing display options without altering any genealogy data.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Open <strong>Facts and events</strong>.</li>
<li>Open the display or options control.</li>
<li>Tick or untick available categories such as family events, events of close relatives, associates, relationship labels or historical facts.</li>
<li>Reload the tab if a dynamically loaded option does not update immediately.</li>
</ol>
<p>These are personal viewing choices. They do not delete events and may be remembered by the browser. The exact options depend on the active webtrees modules.</p>',
    'language' => 'en',
    'translation_key' => 'control-facts-events-displays',
  ),
  50 => 
  array (
    'block_order' => 220,
    'title' => 'Add a photograph or document',
    'slug' => 'add-a-photograph-or-document',
    'category' => 'photos-documents',
    'summary' => 'Upload a media file, describe it clearly and link it to the correct person, family or event.',
    'published' => true,
    'audience' => 'members',
    'featured' => true,
    'requires_modules' => '',
    'screenshot' => 'module://media-upload-guide.webp',
    'screenshot_alt' => 'Annotated example of a webtrees media upload form with file, title, type, date, privacy and description fields.',
    'screenshot_caption' => 'Describe the item clearly and check privacy and permission before publishing it.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<ol>
<li>Open the person, family or event that the item illustrates.</li>
<li>Select the media or add-media action.</li>
<li>Search for an existing media record before uploading another copy.</li>
<li>Upload the best available file.</li>
<li>Add a clear title, date, place, type and note.</li>
<li>Record the owner, photographer, source or copyright information where known.</li>
<li>Save and check privacy before publishing material involving living people.</li>
</ol>
<p>One media record can be linked to several people and events. Reuse it instead of uploading the same image repeatedly.</p>',
    'language' => 'en',
    'translation_key' => 'add-a-photograph-or-document',
  ),
  51 => 
  array (
    'block_order' => 230,
    'title' => 'Link an existing media item',
    'slug' => 'link-existing-media-item',
    'category' => 'photos-documents',
    'summary' => 'Reuse a photograph or document that is already stored instead of uploading a duplicate file.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ol>
<li>Open the person, family or event that should also show the item.</li>
<li>Select the option to add or link media.</li>
<li>Search by media title, filename or related person.</li>
<li>Select the existing record and save the link.</li>
<li>Check that the title and privacy settings make sense in every linked context.</li>
</ol>
<p>Linking preserves one description and one master file. Editing the media record can affect every person or event linked to it.</p>',
    'language' => 'en',
    'translation_key' => 'link-existing-media-item',
  ),
  52 => 
  array (
    'block_order' => 240,
    'title' => 'Choose a main photograph',
    'slug' => 'choose-main-photograph',
    'category' => 'photos-documents',
    'summary' => 'Set the preferred portrait while keeping other photographs available in the media collection.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>webtrees and the active theme can choose a highlighted or primary image from media linked to the person.</p>
<ol>
<li>Open the person’s media or Album area.</li>
<li>Edit the media link or ordering controls.</li>
<li>Mark or position the preferred portrait according to the available interface.</li>
<li>Use a recognisable image that primarily depicts the person.</li>
<li>Check the individual header, charts and Biography after saving.</li>
</ol>
<p>Do not delete useful group photographs merely because they are unsuitable as the main portrait.</p>',
    'language' => 'en',
    'translation_key' => 'choose-main-photograph',
  ),
  53 => 
  array (
    'block_order' => 250,
    'title' => 'Attach media to the event it illustrates',
    'slug' => 'attach-media-to-biography-event',
    'category' => 'biography-content',
    'summary' => 'Improve Biography placement by linking a photograph or document to the relevant fact or family event.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<p>Potts Biography can place media more intelligently when webtrees records explain what the item belongs to.</p>
<ol>
<li>Open the relevant fact or event, such as marriage, immigration, military service or occupation.</li>
<li>Edit the event and add or link the media item there.</li>
<li>Add a genuine media date when known.</li>
<li>Use a clear media title and description.</li>
<li>Save and reload the Biography.</li>
</ol>
<p>Media linked only to the person remains available, but an undated unattached item may appear in <strong>Photographs and keepsakes</strong> rather than beside a specific chapter. Do not invent a date merely to force placement.</p>',
    'language' => 'en',
    'translation_key' => 'attach-media-to-biography-event',
  ),
  54 => 
  array (
    'block_order' => 260,
    'title' => 'Improve photograph captions and placement in Biography',
    'slug' => 'improve-biography-media',
    'category' => 'biography-content',
    'summary' => 'Use accurate titles, dates, links and notes so the illustrated life story can explain the item properly.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<ul>
<li>Give the media record a human-readable title, not only a camera filename.</li>
<li>Add a date or approximate date only when supported.</li>
<li>Identify the people shown in a note or link the media to each person.</li>
<li>Link certificates and newspaper items to the event they document.</li>
<li>Keep photographs, documents and keepsakes classified clearly.</li>
<li>Record source, ownership and usage permission.</li>
</ul>
<p>Biography inherits dates and ages from reliable event links where appropriate. Undated media is not assigned an invented year or age.</p>',
    'language' => 'en',
    'translation_key' => 'improve-biography-media',
  ),
  55 => 
  array (
    'block_order' => 270,
    'title' => 'Add a source and citation',
    'slug' => 'add-source-and-citation',
    'category' => 'sources-research',
    'summary' => 'Record where a particular name, date, place, relationship or event came from.',
    'published' => true,
    'audience' => 'members',
    'featured' => true,
    'requires_modules' => '',
    'screenshot' => 'module://source-citation-guide.webp',
    'screenshot_alt' => 'Annotated example of adding a source citation to a birth fact, with source, reference and evidence fields.',
    'screenshot_caption' => 'Attach the citation to the particular fact or relationship it supports.',
    'screenshot_source' => 'Potts Help Centre illustrated guide based on webtrees 2.2',
    'screenshot_source_url' => 'https://dev.webtrees.net/',
    'body' => '<p>A <strong>source</strong> identifies the broader work or collection. A <strong>citation</strong> identifies the specific page, entry, certificate or item supporting the fact.</p>
<ol>
<li>Edit the fact, event, name or family record supported by the evidence.</li>
<li>Add a source citation.</li>
<li>Select an existing source where one already represents the collection.</li>
<li>Add page, reference number, date accessed, transcription, quality and media as appropriate.</li>
<li>Save and confirm the citation appears with the correct fact.</li>
</ol>
<p>A source attached only to the person is less precise than a citation attached directly to the claim it supports.</p>',
    'language' => 'en',
    'translation_key' => 'add-source-and-citation',
    'resource_links' => 
    array (
      0 => 
      array (
        'label' => 'Official webtrees frequently asked questions',
        'url' => 'https://webtrees.net/faq/',
      ),
    ),
  ),
  56 => 
  array (
    'block_order' => 280,
    'title' => 'Add a research note',
    'slug' => 'add-research-note',
    'category' => 'sources-research',
    'summary' => 'Explain uncertainty, conflicting evidence, reasoning or work still required without presenting it as a proven fact.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Use a research note when you need to record:</p>
<ul>
<li>why two records are believed to concern the same person</li>
<li>conflicting dates or places</li>
<li>an unproven parent or relationship theory</li>
<li>repositories or records already searched</li>
<li>the next research task</li>
</ul>
<p>Attach the note to the relevant person, family or event. Keep conclusions separate from speculation and cite the evidence discussed.</p>
<p>Do not use a note as a substitute for entering a supported event in the proper field.</p>',
    'language' => 'en',
    'translation_key' => 'add-research-note',
  ),
  57 => 
  array (
    'block_order' => 290,
    'title' => 'Make a research note appear meaningfully in Biography',
    'slug' => 'research-notes-in-biography',
    'category' => 'biography-content',
    'summary' => 'Attach the note to the event or part of the life story it explains and include supporting evidence.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<p>Potts Biography can present research notes with the events they support.</p>
<ol>
<li>Add or edit the relevant event in Facts and events.</li>
<li>Attach the research note to that event where possible.</li>
<li>State the research question, evidence, uncertainty and conclusion clearly.</li>
<li>Add source citations or links to the records discussed.</li>
<li>Save and reload the Biography.</li>
</ol>
<p>A general note attached only to the individual may appear separately or may not have enough context for intelligent placement. Avoid raw GEDCOM references or unexplained shorthand intended only for the researcher.</p>',
    'language' => 'en',
    'translation_key' => 'research-notes-in-biography',
  ),
  58 => 
  array (
    'block_order' => 300,
    'title' => 'Personal events and historical context are different',
    'slug' => 'personal-events-vs-historical-context',
    'category' => 'historical-context',
    'summary' => 'Do not add wars, elections or regional events as personal facts unless the individual actually participated.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_historical_facts_',
    'body' => '<p>A personal fact states something about the individual. A historical event describes the wider world.</p>
<p><strong>Personal example:</strong> “Enlisted in the Australian Imperial Force in 1916.”</p>
<p><strong>Historical context:</strong> “The First World War was taking place during this period.”</p>
<p>Add the personal event to the individual’s Facts and events with evidence. Historical context belongs in Potts Historical Facts so it can be sourced once and shown appropriately for many people.</p>
<p>When a historical event had a direct effect on the family, record the effect as a personal event or note and retain the wider event as historical context.</p>',
    'language' => 'en',
    'translation_key' => 'personal-events-vs-historical-context',
  ),
  59 => 
  array (
    'block_order' => 310,
    'title' => 'How new historical information is added',
    'slug' => 'add-historical-information',
    'category' => 'historical-context',
    'summary' => 'Historical collections are maintained by the administrator rather than being entered as ordinary personal events.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_historical_facts_',
    'body' => '<p>Potts Historical Facts uses sourced CSV collections maintained by the site administrator.</p>
<p>To suggest a new historical event, provide:</p>
<ul>
<li>an exact or approximate start date</li>
<li>an end date when the event continued over a period</li>
<li>a concise neutral description</li>
<li>a reliable public source link</li>
<li>the appropriate country, region or broader collection</li>
<li>a category such as political, social, military, disaster or technology where used</li>
</ul>
<p>Administrators can add a persistent custom CSV file under the webtrees data folder. The module then filters the event to people whose lifetimes overlap it. Do not edit bundled files in the module folder because upgrades can replace them.</p>',
    'language' => 'en',
    'translation_key' => 'add-historical-information',
  ),
  60 => 
  array (
    'block_order' => 320,
    'title' => 'Make historical context follow migration',
    'slug' => 'historical-context-and-migration',
    'category' => 'historical-context',
    'summary' => 'Record migration and residence details accurately so Biography can change regional context at the right time.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_life_story_engine_,_potts_historical_facts_',
    'body' => '<p>Potts Biography can pivot historical context after a person moves between countries.</p>
<ol>
<li>Record immigration or emigration as a dated event.</li>
<li>Enter the origin and destination clearly in places, notes or event details.</li>
<li>Add residence facts before and after the move when supported.</li>
<li>Cite passenger lists, certificates, naturalisation files or family records.</li>
<li>Reload the Biography and check that the historical context changes at a sensible point.</li>
</ol>
<p>Without a reliable migration date, the Biography cannot know when to stop using one country’s history and begin another’s. Do not create a false exact date solely for presentation.</p>',
    'language' => 'en',
    'translation_key' => 'historical-context-and-migration',
  ),
  61 => 
  array (
    'block_order' => 330,
    'title' => 'Set the person used for relationship calculations',
    'slug' => 'relationship-reference-person',
    'category' => 'display-options',
    'summary' => 'A linked account or favourite individual can let Relationship Context calculate from the signed-in member.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_relationship_context_',
    'body' => '<p>The best relationship experience is usually provided when your webtrees account is linked to your own individual record.</p>
<ul>
<li>Ask the administrator to link your account to your person if this has not been done.</li>
<li>If the module settings allow it, choose your own person as a favourite individual.</li>
<li>The module may otherwise use the public reference person or the tree root.</li>
</ul>
<p>The administrator controls the permitted reference sources and maximum search depth. A favourite will not override a linked individual when the linked-account option has priority.</p>',
    'language' => 'en',
    'translation_key' => 'relationship-reference-person',
  ),
  62 => 
  array (
    'block_order' => 340,
    'title' => 'Show or hide relationship labels in Facts and events',
    'slug' => 'member-relationship-display',
    'category' => 'display-options',
    'summary' => 'Use the Relationship checkbox to simplify or enrich close-relative and associate event labels.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_relationship_context_',
    'body' => '<ol>
<li>Open <strong>Facts and events</strong>.</li>
<li>Open the display or options control.</li>
<li>Tick <strong>Relationship</strong> to show labels explaining how event participants relate to the reference person.</li>
<li>Untick it to hide those labels.</li>
</ol>
<p>The main relationship summary near the person’s heading may remain because its display position is configured by the administrator. Your checkbox changes the event-level presentation rather than the recorded relationships.</p>',
    'language' => 'en',
    'translation_key' => 'member-relationship-display',
  ),
  63 => 
  array (
    'block_order' => 350,
    'title' => 'Understand Potts Fact Ages display options',
    'slug' => 'fact-ages-display-options',
    'category' => 'display-options',
    'summary' => 'Know which age settings are personal viewing choices and which are controlled by the administrator.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_fact_ages_',
    'body' => '<p>Potts Fact Ages can be configured to show:</p>
<ul>
<li>a separate Potts Fact Ages tab</li>
<li>age labels on existing Facts and events title tiles</li>
<li>both</li>
</ul>
<p>The administrator also chooses personal, family, close-relative, associate and historical categories, the included GEDCOM tags, the layout and whether ages are simple or detailed.</p>
<p>Members can choose which tab to read and can use the ordinary Facts and events category options, but they usually cannot change the site-wide age style. Contact the administrator when duplicate age labels appear or a useful event type is excluded.</p>',
    'language' => 'en',
    'translation_key' => 'fact-ages-display-options',
  ),
  64 => 
  array (
    'block_order' => 360,
    'title' => 'How your edits update the Biography',
    'slug' => 'how-edits-update-biography',
    'category' => 'biography-content',
    'summary' => 'Biography regenerates from approved visible records, so corrections should appear without rewriting the story manually.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '_potts_life_story_engine_',
    'body' => '<p>After saving an approved change:</p>
<ol>
<li>Reload the individual page.</li>
<li>Open the Biography tab again.</li>
<li>Check the chapter related to the changed record.</li>
<li>Clear the browser cache only when an old page appears to be retained.</li>
</ol>
<p>Biography wording depends on the combination of facts, dates, relationships, media and privacy. One correction can alter several sentences.</p>
<p>A change may not appear immediately when it is awaiting approval, hidden by privacy, recorded on the wrong person or family, outside the module’s supported narrative facts or overridden by stronger records.</p>',
    'language' => 'en',
    'translation_key' => 'how-edits-update-biography',
  ),
  65 => 
  array (
    'block_order' => 370,
    'title' => 'Pending changes and approvals',
    'slug' => 'pending-changes-and-approvals',
    'category' => 'getting-started',
    'summary' => 'Understand why an edit may be marked pending and not yet appear to every visitor.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>Some accounts can propose changes but cannot publish them immediately.</p>
<ul>
<li>Pending changes are visible to authorised reviewers and sometimes to the contributor.</li>
<li>Public visitors normally continue to see the last approved data.</li>
<li>Generated Biography text, charts and relationship calculations may not use the proposal until approval.</li>
<li>An administrator may approve, reject or discuss the change.</li>
</ul>
<p>Provide a source and a concise explanation so the reviewer can assess the change. Avoid submitting the same edit repeatedly because it has not yet appeared publicly.</p>',
    'language' => 'en',
    'translation_key' => 'pending-changes-and-approvals',
  ),
  66 => 
  array (
    'block_order' => 380,
    'title' => 'Protect living people',
    'slug' => 'protect-living-people',
    'category' => 'privacy-good-practice',
    'summary' => 'Record useful genealogy while avoiding unnecessary sensitive details and inappropriate media.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ul>
<li>Check that living status and death information are accurate.</li>
<li>Do not publish private addresses, phone numbers, email addresses, health details or legal matters without a clear reason and permission.</li>
<li>Use privacy settings for photographs and documents involving living people.</li>
<li>Do not copy information from social media merely because it is visible there.</li>
<li>Ask before adding detailed stories about another living person.</li>
</ul>
<p>When in doubt, save the information privately, provide it to the administrator or leave a research note explaining why it has not been published.</p>',
    'language' => 'en',
    'translation_key' => 'protect-living-people',
  ),
  67 => 
  array (
    'block_order' => 390,
    'title' => 'Good contribution habits',
    'slug' => 'good-contribution-habits',
    'category' => 'privacy-good-practice',
    'summary' => 'Make changes that are reliable, understandable and useful to future family researchers.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<ul>
<li>Search before creating people, sources or media.</li>
<li>Use the correct fact, family or relationship type.</li>
<li>Record uncertainty honestly.</li>
<li>Add sources to the specific claims they support.</li>
<li>Write notes in clear language and explain abbreviations.</li>
<li>Use consistent places and dates.</li>
<li>Preserve original scans and ownership information.</li>
<li>Review the resulting individual page, family and charts after significant changes.</li>
</ul>
<p>A smaller amount of well-supported information is more valuable than a large amount copied without evidence.</p>',
    'language' => 'en',
    'translation_key' => 'good-contribution-habits',
  ),
  68 => 
  array (
    'block_order' => 400,
    'title' => 'Resolve possible duplicate people',
    'slug' => 'resolve-duplicate-people',
    'category' => 'privacy-good-practice',
    'summary' => 'Do not delete one record until relationships, facts, notes, sources and media have been compared.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p>When two individuals may be the same person:</p>
<ol>
<li>Compare names, dates, places, parents, partners and children.</li>
<li>Check notes, sources, media and private information.</li>
<li>Identify which relationships and facts must be preserved.</li>
<li>Contact an administrator to merge the records using an appropriate webtrees process.</li>
<li>Review charts and families after the merge.</li>
</ol>
<p>Simply deleting the shorter record can also delete unique evidence or leave family links pointing incorrectly.</p>',
    'language' => 'en',
    'translation_key' => 'resolve-duplicate-people',
  ),
  69 => 
  array (
    'block_order' => 410,
    'title' => 'Delete a person or unlink a relationship?',
    'slug' => 'delete-person-or-unlink-relationship',
    'category' => 'privacy-good-practice',
    'summary' => 'Choose the safer action when a person is attached to the wrong parent, partner or child family.',
    'published' => true,
    'audience' => 'members',
    'requires_modules' => '',
    'body' => '<p><strong>Unlink a relationship</strong> when the individual is real but connected to the wrong family.</p>
<p><strong>Delete the individual</strong> only when the entire person record is an accidental duplicate or invalid and all useful information has been preserved elsewhere.</p>
<p>Before deleting, check:</p>
<ul>
<li>every family in which the person appears</li>
<li>facts, notes, sources and media</li>
<li>links from children, partners and parents</li>
<li>whether another member has pending changes</li>
</ul>
<p>Ask an administrator when you are uncertain. Deleting and unlinking have very different consequences.</p>',
    'language' => 'en',
    'translation_key' => 'delete-person-or-unlink-relationship',
  ),
  70 => 
  array (
    'block_order' => 420,
    'title' => 'Why you cannot see an edit button',
    'slug' => 'why-no-edit-button',
    'category' => 'getting-started',
    'summary' => 'Editing access can depend on your account, the record’s privacy, the active tab and the selected theme.',
    'published' => true,
    'audience' => 'members',
    'featured' => true,
    'requires_modules' => '',
    'body' => '<p>An edit button may be absent because:</p>
<ul>
<li>your account has viewing access but not editing access</li>
<li>the person or fact is outside the branch you are allowed to edit</li>
<li>you are on the read-only Biography tab rather than Facts and events or Families</li>
<li>the action is inside an event or family menu rather than a page-wide button</li>
<li>a theme places actions differently on phone or desktop</li>
<li>the record is private or locked</li>
</ul>
<p>First try the Facts and events or Families tab. Contact the administrator with the person’s name, the task and a screenshot when the expected action is still unavailable.</p>',
    'language' => 'en',
    'translation_key' => 'why-no-edit-button',
  ),
);
