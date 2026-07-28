(function () {
    'use strict';

    const config = window.PottsMemberHelpContext;
    if (!config || !config.contexts || !document.body) {
        return;
    }

    const body = document.body;
    const pageIsHelpCentre = Boolean(document.querySelector('.pmh-hero, .pmh-article-layout'));
    if (pageIsHelpCentre) {
        return;
    }

    const normalise = (value) => String(value || '')
        .toLowerCase()
        .replace(/\s+/g, ' ')
        .trim();

    const contextForTab = (tab) => {
        if (!tab) {
            return 'individual-page';
        }

        const text = normalise(tab.textContent);
        const href = normalise(tab.getAttribute('href'));
        const key = text + ' ' + href;

        if (key.includes('biograph') || key.includes('life story')) {
            return 'individual-biography';
        }
        if (key.includes('fact') || key.includes('event') || key.includes('personal_facts')) {
            return 'individual-facts';
        }
        if (key.includes('famil')) {
            return 'individual-families';
        }
        if (key.includes('media') || key.includes('photo') || key.includes('document')) {
            return 'individual-media';
        }

        return 'individual-page';
    };

    const createBox = (contextKey, compact) => {
        const details = config.contexts[contextKey];
        if (!details) {
            return null;
        }

        const link = document.createElement('a');
        link.className = 'pmh-contextual-help' + (compact ? ' pmh-contextual-help--compact' : '');
        link.dataset.pmhContext = contextKey;
        link.href = details.url;
        link.setAttribute('aria-label', details.message || config.helpIconLabel || 'Help');
        link.title = details.message || '';
        if (config.newTab) {
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
        }

        const icon = document.createElement('span');
        icon.className = 'pmh-contextual-help__icon';
        icon.setAttribute('aria-hidden', 'true');
        icon.textContent = '?';

        const label = document.createElement('span');
        label.className = 'pmh-contextual-help__label';
        label.textContent = config.openGuideLabel || details.label || 'Help with this page';

        link.append(icon, label);
        return link;
    };

    const replaceContextBox = (container, contextKey, compact) => {
        if (!container || !config.contexts[contextKey]) {
            return;
        }

        const existing = container.querySelector(':scope > .pmh-contextual-help');
        if (existing && existing.dataset.pmhContext === contextKey) {
            return;
        }

        if (existing) {
            existing.remove();
        }

        const box = createBox(contextKey, compact);
        if (box) {
            container.prepend(box);
        }
    };

    const updateIndividualHelp = () => {
        if (!config.areas.individual || !body.classList.contains('wt-route-IndividualPage')) {
            return;
        }

        const tabs = document.querySelector('#individual-tabs');
        const tabList = tabs ? tabs.querySelector(':scope > .nav-tabs') : null;
        if (!tabs || !tabList) {
            return;
        }

        const activeTab = tabList.querySelector('.nav-link.active, .nav-link[aria-selected="true"]')
            || tabList.querySelector('.nav-link[href="' + window.location.hash.replace('tab-', '') + '"]')
            || tabList.querySelector('.nav-link');
        const contextKey = contextForTab(activeTab);
        const existing = tabs.querySelector(':scope > .pmh-contextual-help');

        if (!config.contexts[contextKey]) {
            if (existing) {
                existing.remove();
            }
            return;
        }

        if (existing && existing.dataset.pmhContext === contextKey) {
            return;
        }

        if (existing) {
            existing.remove();
        }

        const box = createBox(contextKey, false);
        if (box) {
            tabList.insertAdjacentElement('afterend', box);
        }
    };

    const updateFamilyHelp = () => {
        if (!config.areas.family || !body.classList.contains('wt-route-FamilyPage') || !config.contexts['family-page']) {
            return;
        }

        const pageContent = document.querySelector('#content .wt-page-content');
        if (!pageContent) {
            return;
        }

        replaceContextBox(pageContent, 'family-page', false);
    };

    const formContextFromText = (value) => {
        const text = normalise(value);
        if (!text) {
            return '';
        }

        if (/add (a |another )?(husband|wife|spouse|partner)|new (husband|wife|spouse|partner)/.test(text)) {
            return 'add-partner';
        }
        if (/add (a |another )?child|new child|add son|add daughter/.test(text)) {
            return 'add-child';
        }
        if (/add (a )?(father|mother|parent)|new parent|change parents|edit parents/.test(text)) {
            return 'add-parent';
        }
        if (/add (a |new )?(person|individual)|create (a |new )?(person|individual)|new individual/.test(text)) {
            return 'create-person';
        }
        if (/edit name|change name|add name|new name|nickname|known.as name/.test(text)) {
            return 'edit-name';
        }
        if (/add (a |new )?(fact|event)|new (fact|event)|create (a )?(fact|event)/.test(text)) {
            return 'add-fact';
        }
        if (/edit (a )?(fact|event)|delete (a )?(fact|event)|remove (a )?(fact|event)/.test(text)) {
            return 'edit-fact';
        }
        if (/add (a |new )?(media|photograph|photo|document)|upload (a )?(media|photograph|photo|document)|create media/.test(text)) {
            return 'add-media';
        }
        if (/add (a |new )?(source|citation)|edit (a )?(source|citation)|source citation/.test(text)) {
            return 'source-citation';
        }
        if (/close relative|events of close relatives/.test(text)) {
            return 'close-relative-events';
        }
        if (/relationship (option|setting|reference|label)|reference person/.test(text)) {
            return 'relationship-options';
        }
        if (/historical (fact|context|event|collection)|history collection/.test(text)) {
            return 'historical-context';
        }

        return '';
    };

    const updateModalHelp = () => {
        if (!config.areas.forms) {
            return;
        }

        document.querySelectorAll('.modal.show, .modal[aria-modal="true"]').forEach((modal) => {
            const title = modal.querySelector('.modal-title, .modal-header h1, .modal-header h2, .modal-header h3');
            const form = modal.querySelector('form');
            const contextKey = formContextFromText((title ? title.textContent : '') + ' ' + (form ? form.getAttribute('action') : ''));
            const bodyElement = modal.querySelector('.modal-body');

            if (!contextKey || !bodyElement || !config.contexts[contextKey]) {
                return;
            }

            replaceContextBox(bodyElement, contextKey, true);
        });
    };

    const updatePageFormHelp = () => {
        if (!config.areas.forms || body.classList.contains('wt-route-IndividualPage') || body.classList.contains('wt-route-FamilyPage')) {
            return;
        }

        const main = document.querySelector('#content');
        const title = main ? main.querySelector('h1, h2.wt-page-title, .wt-page-title') : null;
        const form = main ? main.querySelector('form') : null;
        if (!main || !form) {
            return;
        }

        const contextKey = formContextFromText((title ? title.textContent : '') + ' ' + (form.getAttribute('action') || ''));
        if (!contextKey || !config.contexts[contextKey]) {
            return;
        }

        const insertionPoint = title && title.parentElement ? title.parentElement : main;
        const existing = main.querySelector('.pmh-contextual-help[data-pmh-location="page-form"]');
        if (existing && existing.dataset.pmhContext === contextKey) {
            return;
        }
        if (existing) {
            existing.remove();
        }

        const box = createBox(contextKey, true);
        if (box) {
            box.dataset.pmhLocation = 'page-form';
            insertionPoint.insertAdjacentElement('afterend', box);
        }
    };

    let scheduled = false;
    const refresh = () => {
        if (scheduled) {
            return;
        }
        scheduled = true;
        window.requestAnimationFrame(() => {
            scheduled = false;
            updateIndividualHelp();
            updateFamilyHelp();
            updateModalHelp();
            updatePageFormHelp();
        });
    };

    document.addEventListener('shown.bs.tab', refresh);
    document.addEventListener('shown.bs.modal', refresh);
    document.addEventListener('click', (event) => {
        if (event.target && event.target.closest('#individual-tabs .nav-link, [data-bs-toggle="modal"]')) {
            window.setTimeout(refresh, 0);
        }
    });
    window.addEventListener('hashchange', refresh);

    const observer = new MutationObserver(refresh);
    observer.observe(document.body, {childList: true, subtree: true, attributes: true, attributeFilter: ['class', 'aria-selected']});

    refresh();
}());
