const LAZY_IMAGE_PLACEHOLDER =
    "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 3'%3E%3Crect fill='%23f3f4f6' width='4' height='3'/%3E%3C/svg%3E";

function loadLazyImage(img) {
    const src = img.dataset.lazySrc;

    if (! src || img.dataset.lazyLoaded === '1') {
        return;
    }

    img.dataset.lazyLoaded = '1';
    img.src = src;
    img.removeAttribute('data-lazy-src');
}

function observeLazyImages(root = document) {
    const images = root.querySelectorAll('img[data-lazy-src]:not([data-lazy-watched])');

    if (images.length === 0) {
        return;
    }

    if (! ('IntersectionObserver' in window)) {
        images.forEach((img) => loadLazyImage(img));

        return;
    }

    if (! window.__lazyImageObserver) {
        window.__lazyImageObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (! entry.isIntersecting) {
                        return;
                    }

                    loadLazyImage(entry.target);
                    window.__lazyImageObserver.unobserve(entry.target);
                });
            },
            { rootMargin: '300px 0px', threshold: 0.01 },
        );
    }

    images.forEach((img) => {
        img.dataset.lazyWatched = '1';
        window.__lazyImageObserver.observe(img);
    });
}

window.lazyLoadImages = observeLazyImages;

document.addEventListener('DOMContentLoaded', () => {
    observeLazyImages();

    new MutationObserver(() => observeLazyImages()).observe(document.body, {
        childList: true,
        subtree: true,
    });
});

export { LAZY_IMAGE_PLACEHOLDER, observeLazyImages };
