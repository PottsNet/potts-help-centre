(function () {
    'use strict';

    const ready = (callback) => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, {once: true});
        } else {
            callback();
        }
    };

    const slugify = (value) => String(value || '')
        .toLowerCase()
        .normalize('NFKD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '') || 'section';

    const buildTableOfContents = () => {
        const article = document.querySelector('[data-pmh-article]');
        const richText = article ? article.querySelector('[data-pmh-rich-text]') : null;
        const tocCard = document.querySelector('[data-pmh-toc-card]');
        const toc = tocCard ? tocCard.querySelector('[data-pmh-toc]') : null;
        if (!richText || !tocCard || !toc) {
            return;
        }

        const headings = Array.from(richText.querySelectorAll('h2, h3'));
        if (headings.length < 2) {
            return;
        }

        const usedIds = new Set(Array.from(document.querySelectorAll('[id]')).map((element) => element.id));
        const list = document.createElement('ul');
        list.className = 'pmh-toc';

        headings.forEach((heading) => {
            if (!heading.id) {
                const base = slugify(heading.textContent);
                let id = base;
                let suffix = 2;
                while (usedIds.has(id)) {
                    id = base + '-' + suffix;
                    suffix += 1;
                }
                heading.id = id;
                usedIds.add(id);
            }

            const item = document.createElement('li');
            item.className = heading.tagName === 'H3' ? 'pmh-toc__subitem' : 'pmh-toc__item';
            const link = document.createElement('a');
            link.href = '#' + heading.id;
            link.textContent = heading.textContent || '';
            item.append(link);
            list.append(item);
        });

        toc.append(list);
        tocCard.hidden = false;
    };

    const installArticleTools = () => {
        const printButton = document.querySelector('[data-pmh-print]');
        if (printButton) {
            printButton.addEventListener('click', () => window.print());
        }

        const copyButton = document.querySelector('[data-pmh-copy-link]');
        if (!copyButton) {
            return;
        }

        const originalLabel = copyButton.dataset.copyLabel || copyButton.textContent || 'Copy link';
        const copiedLabel = copyButton.dataset.copiedLabel || 'Link copied';
        copyButton.addEventListener('click', async () => {
            let copied = false;
            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(window.location.href);
                    copied = true;
                }
            } catch (error) {
                copied = false;
            }

            if (!copied) {
                const field = document.createElement('textarea');
                field.value = window.location.href;
                field.setAttribute('readonly', '');
                field.style.position = 'fixed';
                field.style.opacity = '0';
                document.body.append(field);
                field.select();
                try {
                    copied = document.execCommand('copy');
                } catch (error) {
                    copied = false;
                }
                field.remove();
            }

            if (copied) {
                copyButton.textContent = copiedLabel;
                window.setTimeout(() => {
                    copyButton.textContent = originalLabel;
                }, 1800);
            }
        });
    };

    const installAdminFilters = () => {
        const table = document.querySelector('[data-pmh-admin-table]');
        const search = document.querySelector('[data-pmh-admin-search]');
        const audience = document.querySelector('[data-pmh-admin-audience]');
        const status = document.querySelector('[data-pmh-admin-status]');
        const count = document.querySelector('[data-pmh-admin-count]');
        if (!table || !search || !audience || !status) {
            return;
        }

        const rows = Array.from(table.querySelectorAll('[data-pmh-admin-row]'));
        const normalise = (value) => String(value || '').toLowerCase().replace(/\s+/g, ' ').trim();

        const filter = () => {
            const query = normalise(search.value);
            const selectedAudience = audience.value;
            const selectedStatus = status.value;
            let visible = 0;

            rows.forEach((row) => {
                const matchesSearch = query === '' || normalise(row.dataset.search).includes(query);
                const matchesAudience = selectedAudience === '' || row.dataset.audience === selectedAudience;
                let matchesStatus = selectedStatus === '' || row.dataset.status === selectedStatus;
                if (selectedStatus === 'featured') {
                    matchesStatus = row.dataset.featured === '1';
                } else if (selectedStatus === 'illustrated') {
                    matchesStatus = row.dataset.screenshot === '1';
                } else if (selectedStatus === 'no-screenshot') {
                    matchesStatus = row.dataset.screenshot !== '1';
                }

                const show = matchesSearch && matchesAudience && matchesStatus;
                row.hidden = !show;
                if (show) {
                    visible += 1;
                }
            });

            if (count) {
                count.textContent = visible + (visible === 1 ? ' article shown' : ' articles shown');
            }
        };

        search.addEventListener('input', filter);
        audience.addEventListener('change', filter);
        status.addEventListener('change', filter);
        filter();
    };

    ready(() => {
        buildTableOfContents();
        installArticleTools();
        installAdminFilters();
    });
}());
