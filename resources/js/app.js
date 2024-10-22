import '../css/app.css';
import { createInertiaApp } from '@inertiajs/vue3';
//sweetalert
import Swal from 'sweetalert2';
window.Swal =Swal
const toast=Swal.mixin({
    toast:true,
    position:'bottom-end',
    showConfirmButton:false,
    timer:3000,
    timerProgressBar:true,

})
window.toast=toast
//
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import '@fortawesome/fontawesome-free/css/all.min.css';
import DefaultLayout from './Layouts/layout.vue';  // Import your default layout
import {Link} from "@inertiajs/vue3";

const appName = 'Poll';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ).then((module) => {
            // Set the default layout if the page doesn't have one
            module.default.layout = module.default.layout || DefaultLayout;
            return module;
        }),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Link', Link)
            .mount(el);
    },
    progress:false,
});
