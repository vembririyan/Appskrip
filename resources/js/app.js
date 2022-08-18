import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';



// Fontawesome
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from "@fortawesome/fontawesome-svg-core";
import {fab} from "@fortawesome/free-brands-svg-icons";
import {fas} from "@fortawesome/free-solid-svg-icons";

library.add(fab)
library.add(fas)

// Datatable
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

// Modal
import swal from 'sweetalert/dist/sweetalert.min.js';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue')),
        setup({ el, app, props, plugin }) {            
            return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
                .component('swal', swal)
                .component('v-select', vSelect)
                .component('fontawesome', FontAwesomeIcon)
                .component('EasyDataTable', Vue3EasyDataTable)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });