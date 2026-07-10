document.addEventListener('alpine:init', () => {
    window.Alpine.data('propertyGallery', (images) => ({
        images,
        activeIndex: 0,
        lightboxOpen: false,
        touchStartX: 0,

        get activeImage() {
            return this.images[this.activeIndex] ?? '';
        },

        get hasMultiple() {
            return this.images.length > 1;
        },

        init() {
            this.$watch('lightboxOpen', (open) => {
                document.body.classList.toggle('overflow-hidden', open);
            });
        },

        selectImage(index) {
            if (index >= 0 && index < this.images.length) {
                this.activeIndex = index;
                this.preloadAdjacent();
            }
        },

        openLightbox(index = this.activeIndex) {
            this.selectImage(index);
            this.lightboxOpen = true;
            this.preloadAdjacent();
        },

        closeLightbox() {
            this.lightboxOpen = false;
        },

        next() {
            if (! this.hasMultiple) {
                return;
            }

            this.activeIndex = (this.activeIndex + 1) % this.images.length;
            this.preloadAdjacent();
        },

        prev() {
            if (! this.hasMultiple) {
                return;
            }

            this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
            this.preloadAdjacent();
        },

        preloadImage(url) {
            if (! url) {
                return;
            }

            const loader = new Image();
            loader.decoding = 'async';
            loader.src = url;
        },

        preloadAdjacent() {
            const nextIndex = (this.activeIndex + 1) % this.images.length;
            const prevIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;

            this.preloadImage(this.images[nextIndex]);
            this.preloadImage(this.images[prevIndex]);
        },

        onTouchStart(event) {
            this.touchStartX = event.touches[0]?.clientX ?? 0;
        },

        onTouchEnd(event) {
            if (! this.lightboxOpen || ! this.hasMultiple) {
                return;
            }

            const touchEndX = event.changedTouches[0]?.clientX ?? 0;
            const diff = touchEndX - this.touchStartX;

            if (Math.abs(diff) < 48) {
                return;
            }

            if (diff < 0) {
                this.next();
            } else {
                this.prev();
            }
        },

        onKeydown(event) {
            if (event.key === 'ArrowRight' && this.hasMultiple) {
                event.preventDefault();
                this.next();

                return;
            }

            if (event.key === 'ArrowLeft' && this.hasMultiple) {
                event.preventDefault();
                this.prev();

                return;
            }

            if (! this.lightboxOpen) {
                return;
            }

            if (event.key === 'Escape') {
                this.closeLightbox();
            }
        },
    }));
});
