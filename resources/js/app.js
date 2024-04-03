import './bootstrap';
import '../css/app.css';
import 'bulma/css/bulma.min.css';
import '@fortawesome/fontawesome-free/css/all.css'
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress'; // Import InertiaProgress
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { Link } from '@inertiajs/inertia-vue3';



const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),

    //doc : https://inertiajs.com/client-side-setup. warning : script and style tags are ignored
    // resolve: name => {
    //     const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    //     return pages[`./Pages/${name}.vue`]
    //   },

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            // .use(Link)
            .use(ZiggyVue)
            .component('Link', Link)
            .mount(el)

    },
    progress: {
        color: '#4B5563',
    },
});

InertiaProgress.init({ color: '#4B5563' }); // Initialize InertiaProgress
