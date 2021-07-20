window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

window.EchoService = { // initialise echo instance/pusher connection only when and where called not on app launch and every page
    init: () => 
    new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/pusher/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
    }
})
};

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,1
//     forceTLS: true,
//     authEndpoint: '/pusher/auth',
//     auth: {
//         headers: {
//             'X-CSRF-TOKEN': '{{ csrf_token() }}',
//         }
//     }
// });


// Vue.config.devtools = true;
