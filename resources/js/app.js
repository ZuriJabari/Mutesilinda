import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('contact', {
    isOpen: false,
    open() {
        this.isOpen = true;
    },
    close() {
        this.isOpen = false;
    },
});

Alpine.start();
