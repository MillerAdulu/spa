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

        <!-- Adds PWA Install feature. -->
        {{-- <script
        type="module"
        src="https://cdn.jsdelivr.net/npm/@pwabuilder/pwainstall"
        ></script> --}}

        <!--This is the "Offline copy of pages" service worker

        Add this below content to your HTML page inside a script tag, or add the js file to your page at the very top to register service worker
        If you get an error about not being able to import, double check that you have type="module" on your script tag

        This code uses the pwa-update web component https://github.com/pwa-builder/pwa-update to register your service worker,
        tell the user when there is an update available and let the user know when your PWA is ready to use offline.
        -->
        {{-- <script type="module">
        import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

        const el = document.createElement('pwa-update');
        document.body.appendChild(el);
        </script> --}}

        {{-- <script type="module">
        import "https://js.pusher.com/beams/service-worker.js";
        const beamsClient = new PusherPushNotifications.Client({
            instanceId: '70c36fac-c3a8-4d54-ab25-dbe58acb0d55',
        });
        
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
