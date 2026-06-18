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
