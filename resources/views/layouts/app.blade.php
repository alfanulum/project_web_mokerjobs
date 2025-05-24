<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MokerJobs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white text-black font-sans">
    <main>
        @yield('content')
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        const counters = {};

        function incrementOpening(index) {
            if (!counters[index]) counters[index] = 0;
            counters[index]++;
            document.getElementById(`opening-${index}`).innerText =
                counters[index].toString().padStart(3, '0') + ' Opening';
        }

        AOS.init({
            duration: 1000, // durasi animasi (ms)
            once: true // animasi hanya terjadi sekali saat scroll
        });
    </script>

</body>

</html>
