window.LivewireModalTwitter = () => {
    return {
        loading: false,
        show: false,
        showActiveComponent: false,
        showSidebar: true,
        showSidebarMobile: false,
        activeImage: 1,
        getComponentModalAttribute(key) {
            return this.$wire.get('component')['modalAttributes'][key];
        },
        closeModalViaEscape() {
            this.show = false;
        },
        showModalComponent() {
            this.show = true;

            if (this.showActiveComponent === false) {
                this.dispatch();
                this.showActiveComponent = true;
            } else {
                this.showActiveComponent = false;

                setTimeout(() => {
                    this.dispatch();
                    this.showActiveComponent = true;
                }, 300);
            }
        },
        dispatch() {
            if (this.$wire.get('component') && this.getComponentModalAttribute('hasLoading') === true) {
                let child = Object.keys(this.$wire.__instance.serverMemo.children)[0];

                this.loading = true;
                this.showSidebar = false;

                Livewire.find(this.$wire.__instance.serverMemo.children[child].id).call('dispatch').then(() => {
                    this.setSidebar();
                    this.loading = false;
                });
            } else {
                this.loading = false;
            }
        },
        toggleSidebar() {
            this.showSidebar = !this.showSidebar;

            localStorage.setItem('modalTwitter', this.showSidebar);
        },
        setSidebar() {
            if (localStorage.getItem('modalTwitter') !== null) {
                this.showSidebar = localStorage.getItem('modalTwitter') === 'true';
            }
        },
        responsive() {
            if (window.innerWidth < 768) {
                this.showSidebarMobile = true;
                this.showSidebar = false
            } else {
                this.showSidebarMobile = false;
            }
        },
        init() {
            this.setSidebar();

            this.$watch('show', value => {
                if (value) {
                    document.body.classList.add('overflow-y-hidden');
                } else {
                    document.body.classList.remove('overflow-y-hidden');

                    setTimeout(() => {
                        this.showActiveComponent = false;
                        this.images = [];
                        this.activeImage = 1;
                        this.$wire.resetState();
                    }, 300);
                }
            });

            Livewire.on('closeModalTwitter', () => {
                this.show = false;
            });

            Livewire.on('activeModalTwitterComponentChanged', () => {
                this.showModalComponent();
            });
        }
    };
}
