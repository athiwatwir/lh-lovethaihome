document.addEventListener('alpine:init', () => {
    Alpine.data('propertySearchAddress', (config = {}) => ({
        submitting: false,
        provinces: [],
        districts: [],
        subDistricts: [],
        provinceId: '',
        districtId: '',
        subDistrictId: '',
        loadingProvinces: false,
        loadingDistricts: false,
        loadingSubDistricts: false,

        async init() {
            await this.loadProvinces();
            await this.restoreInitialAddress();
        },

        get provinceName() {
            return this.findName(this.provinces, this.provinceId);
        },

        get amphurName() {
            return this.findName(this.districts, this.districtId);
        },

        get districtName() {
            return this.findName(this.subDistricts, this.subDistrictId);
        },

        findName(items, id) {
            if (! id) {
                return '';
            }

            return items.find((item) => String(item.id) === String(id))?.name ?? '';
        },

        async loadProvinces() {
            this.loadingProvinces = true;

            try {
                const response = await fetch(config.provincesUrl);
                this.provinces = response.ok ? await response.json() : [];
            } catch {
                this.provinces = [];
            } finally {
                this.loadingProvinces = false;
            }
        },

        async onProvinceChange() {
            this.districtId = '';
            this.subDistrictId = '';
            this.districts = [];
            this.subDistricts = [];

            if (! this.provinceId) {
                return;
            }

            this.loadingDistricts = true;

            try {
                const url = new URL(config.districtsUrl, window.location.origin);
                url.searchParams.set('province_id', this.provinceId);
                const response = await fetch(url);
                this.districts = response.ok ? await response.json() : [];
            } catch {
                this.districts = [];
            } finally {
                this.loadingDistricts = false;
            }
        },

        async onDistrictChange() {
            this.subDistrictId = '';
            this.subDistricts = [];

            if (! this.districtId) {
                return;
            }

            this.loadingSubDistricts = true;

            try {
                const url = new URL(config.subDistrictsUrl, window.location.origin);
                url.searchParams.set('district_id', this.districtId);
                const response = await fetch(url);
                this.subDistricts = response.ok ? await response.json() : [];
            } catch {
                this.subDistricts = [];
            } finally {
                this.loadingSubDistricts = false;
            }
        },

        async restoreInitialAddress() {
            if (! config.initialProvince) {
                return;
            }

            const province = this.provinces.find((item) => item.name === config.initialProvince);

            if (! province) {
                return;
            }

            this.provinceId = province.id;
            await this.onProvinceChange();

            if (! config.initialAmphur) {
                return;
            }

            const amphur = this.districts.find((item) => item.name === config.initialAmphur);

            if (! amphur) {
                return;
            }

            this.districtId = amphur.id;
            await this.onDistrictChange();

            if (! config.initialDistrict) {
                return;
            }

            const district = this.subDistricts.find((item) => item.name === config.initialDistrict);

            if (district) {
                this.subDistrictId = district.id;
            }
        },
    }));

    Alpine.data('propertySearchPrice', (initial = {}) => ({
        priceMin: initial.min ?? '',
        priceMax: initial.max ?? '',

        presets: [
            { label: 'ทั้งหมด', min: '', max: '' },
            { label: 'ไม่เกิน 1 ล้าน', min: '', max: '1000000' },
            { label: '1–3 ล้าน', min: '1000000', max: '3000000' },
            { label: '3–5 ล้าน', min: '3000000', max: '5000000' },
            { label: '5–10 ล้าน', min: '5000000', max: '10000000' },
            { label: '10 ล้านขึ้นไป', min: '10000000', max: 'unlimited' },
        ],

        applyPreset(preset) {
            this.priceMin = preset.min;
            this.priceMax = preset.max;
        },

        isPresetActive(preset) {
            return this.priceMin === preset.min && this.priceMax === preset.max;
        },

        onManualChange() {
            // Custom selection clears preset highlight automatically via isPresetActive.
        },

        get priceSummary() {
            if (! this.priceMin && ! this.priceMax) {
                return 'ทุกช่วงราคา';
            }

            const minLabel = this.formatPrice(this.priceMin);
            const maxLabel = this.formatPrice(this.priceMax);

            if (this.priceMin && this.priceMax) {
                return `${minLabel} – ${maxLabel}`;
            }

            if (this.priceMin) {
                return `ตั้งแต่ ${minLabel}`;
            }

            return `ไม่เกิน ${maxLabel}`;
        },

        formatPrice(value) {
            if (! value) {
                return '';
            }

            if (value === 'unlimited') {
                return 'ไม่จำกัด';
            }

            const amount = Number(value);

            if (Number.isNaN(amount)) {
                return value;
            }

            if (amount >= 1_000_000) {
                const millions = amount / 1_000_000;

                return Number.isInteger(millions) ? `${millions} ล้าน` : `${millions.toFixed(1)} ล้าน`;
            }

            return new Intl.NumberFormat('th-TH').format(amount);
        },
    }));
});
