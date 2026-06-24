document.addEventListener('click', function (event) {
    const link = event.target.closest('[data-track-enquiry]');

    if (!link) {
        return;
    }

    const product = link.getAttribute('data-product') || 'General enquiry';

    if (typeof window.gtag === 'function') {
        window.gtag('event', 'whatsapp_enquiry', {
            event_category: 'lead',
            event_label: product,
            value: 1
        });
    }

    if (typeof window.fbq === 'function') {
        window.fbq('track', 'Lead', {
            content_name: product
        });
    }
});

document.querySelectorAll('[data-filter-group]').forEach(function (group) {
    const section = group.closest('.section');
    const cards = Array.from(section.querySelectorAll('[data-product-card]'));
    const count = section.querySelector('[data-visible-count]');

    group.addEventListener('click', function (event) {
        const button = event.target.closest('[data-filter]');

        if (!button) {
            return;
        }

        const value = button.getAttribute('data-filter');
        let visible = 0;

        group.querySelectorAll('[data-filter]').forEach(function (item) {
            item.classList.toggle('is-active', item === button);
        });

        cards.forEach(function (card) {
            const show = value === 'all' || card.getAttribute('data-category') === value;
            card.hidden = !show;
            if (show) {
                visible += 1;
            }
        });

        if (count) {
            count.textContent = visible;
        }
    });
});

document.querySelectorAll('[data-link-tools]').forEach(function (tools) {
    const form = tools.closest('form');
    const editor = form ? form.querySelector('[data-link-editor]') : null;
    const textInput = tools.querySelector('[data-link-text]');
    const urlInput = tools.querySelector('[data-link-url]');
    const preset = tools.querySelector('[data-link-url-preset]');
    const button = tools.querySelector('[data-insert-link]');

    if (!editor || !textInput || !urlInput || !button) {
        return;
    }

    if (preset) {
        preset.addEventListener('change', function () {
            if (preset.value) {
                urlInput.value = preset.value;
            }
        });
    }

    button.addEventListener('click', function () {
        const selected = editor.value.slice(editor.selectionStart, editor.selectionEnd).trim();
        const label = (textInput.value || selected || 'link text').trim();
        const url = (urlInput.value || (preset ? preset.value : '')).trim();

        if (!url) {
            urlInput.focus();
            return;
        }

        const markdown = '[' + label.replace(/\]/g, '') + '](' + url.replace(/\)/g, '') + ')';
        const start = editor.selectionStart;
        const end = editor.selectionEnd;
        const before = editor.value.slice(0, start);
        const after = editor.value.slice(end);

        editor.value = before + markdown + after;
        editor.focus();
        editor.selectionStart = start;
        editor.selectionEnd = start + markdown.length;

        textInput.value = '';
    });
});
