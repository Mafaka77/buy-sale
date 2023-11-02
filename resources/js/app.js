import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import  {Dialog, Loading, Notify,Quasar} from "quasar";
import quasarIconSet from 'quasar/icon-set/material-icons-outlined'
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/material-icons-outlined/material-icons-outlined.css'
import 'quasar/src/css/index.sass'
import GuestLayout from "@/Layouts/GuestLayout.vue";
import HomeLayout from "@/Layouts/HomeLayout.vue";
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>{
        const page=resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
        page.then((module)=>{
            module.default.layout=name.startsWith('Auth/')?GuestLayout:HomeLayout
        })
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(Quasar,{
                plugins:{
                    Notify,Dialog,Loading
                },
                config:{
                    notify:{
                        closeBtn:true,
                    },
                    iconSet:quasarIconSet
                }
            })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
