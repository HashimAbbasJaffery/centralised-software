<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Used Link</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind.output.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('/assets/js/init-alpine.js') }}"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <div id="app" class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
        <div class="w-full max-w-xl bg-white p-10 rounded-lg shadow-md text-center">
            <h1 class="text-2xl font-bold mb-4 mt-2 text-black">This link has already been used.</h1>
            <p class="mb-4 text-black">
                This priority link is <span class="font-semibold">no longer valid</span>.
            </p>
            <p class="mb-6 text-black">
                Used links cannot be reused.
            </p>
        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {}
            },
            methods: {}
        });
        app.mount('#app');
    </script>
</body>

</html>
