require('./bootstrap');
window.Vue = require('vue');

// Import modules...
import { createApp, h } from 'vue'
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import * as PusherPushNotifications from "@pusher/push-notifications-web"

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => import(`./Pages/${name}`).then(module => module.default),
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin, PusherPushNotifications)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });

// window.navigator.serviceWorker.ready.then(serviceWorkerRegistration =>
//     const beamsClient = new PusherPushNotifications.Client({
//       instanceId: process.env.PUSHER_BEAMS_INSTANCE_ID,
//       serviceWorkerRegistration: serviceWorkerRegistration,
//     })
//     );
//     beamsClient.start()
//       .then(() => beamsClient.addDeviceInterest('hello'))
//       .then(() => console.log('Successfully registered and subscribed!'))
//       .catch(console.error);