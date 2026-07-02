import { observeLazyImages } from './lazy-images';

document.addEventListener('alpine:init', () => {
    Alpine.data('propertyProgressiveReveal', (config = {}) => ({
        batchSize: config.batchSize ?? 4,
        delayMs: config.delayMs ?? 350,
        visibleCount: 0,
        total: 0,
        loading: false,
        _timer: null,

        init() {
            this.total = this.$refs.grid?.querySelectorAll('[data-property-card]').length ?? 0;

            if (this.total === 0) {
                return;
            }

            this.revealNextBatch();
        },

        isVisible(index) {
            return index < this.visibleCount;
        },

        revealNextBatch() {
            if (this.visibleCount >= this.total) {
                this.loading = false;

                return;
            }

            this.loading = true;

            const delay = this.visibleCount === 0 ? 0 : this.delayMs;

            this._timer = window.setTimeout(() => {
                this.visibleCount = Math.min(this.visibleCount + this.batchSize, this.total);

                this.$nextTick(() => {
                    observeLazyImages(this.$refs.grid);

                    if (this.visibleCount < this.total) {
                        this.revealNextBatch();
                    } else {
                        this.loading = false;
                    }
                });
            }, delay);
        },

        destroy() {
            if (this._timer) {
                window.clearTimeout(this._timer);
            }
        },
    }));
});
