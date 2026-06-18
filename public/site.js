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
