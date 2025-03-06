import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js';

import Alpine from 'alpinejs';

if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
