// This is the "Offline copy of assets" service worker

const CACHE = "pwabuilder-offline";

importScripts("https://js.pusher.com/beams/service-worker.js");

importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

workbox.routing.registerRoute(
  new RegExp('/*'),
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: CACHE
  })
);


window.navigator.serviceWorker.ready.then(serviceWorkerRegistration =>
  const beamsClient = new PusherPushNotifications.Client({
  instanceId: '70c36fac-c3a8-4d54-ab25-dbe58acb0d55',
  serviceWorkerRegistration: serviceWorkerRegistration,
})
);