import './bootstrap';
import '../css/app.css';
import 'vue-select/dist/vue-select.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

/* import vuex */
import { createPinia } from 'pinia';
import { useMainStore } from "@/stores/main.js";
import { useStyleStore } from "@/stores/style.js";
import { darkModeKey, styleKey } from "@/config.js";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

/* Init Pinia */
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(pinia)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

/* Init Pinia stores */
const mainStore = useMainStore(pinia);
const styleStore = useStyleStore(pinia);

/* Fetch sample data */
// mainStore.fetch("clients");
// mainStore.fetch("history");

/* App style */
styleStore.setStyle(localStorage[styleKey] ?? "white");

/* Dark mode */
if (
  (!localStorage[darkModeKey] &&
    window.matchMedia("(prefers-color-scheme: dark)").matches) ||
  localStorage[darkModeKey] === "1"
) {
  styleStore.setDarkMode(true);
}

/* Default title tag */
// const defaultDocumentTitle = "Admin One Vue 3 Tailwind";

/* Set document title from route meta */
// router.afterEach((to) => {
//   document.title = to.meta?.title
//     ? `${to.meta.title} — ${defaultDocumentTitle}`
//     : defaultDocumentTitle;
// });
