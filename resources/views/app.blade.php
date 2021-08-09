<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<!-- Imports the manifest to represent the web application. A web app must have a manifest to be a PWA. -->
<link rel="manifest" href="manifest.json" />

{{-- <script>
window.navigator.serviceWorker.ready.then(serviceWorkerRegistration =>
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: process.env.PUSHER_BEAMS_INSTANCE_ID,
        serviceWorkerRegistration: serviceWorkerRegistration,
    })
);
beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);
</script> --}}
<!-- Scripts -->
@routes
<script src="{{ mix('js/manifest.js') }}" defer></script>
<script src="{{ mix('js/vendor.js') }}" defer></script>
<script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>
