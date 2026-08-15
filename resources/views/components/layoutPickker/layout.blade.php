<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'App' }}</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100">

    <div class="drawer lg:drawer-open">

        {{-- Drawer toggle --}}
        <input
            id="drawer"
            type="checkbox"
            class="drawer-toggle"
        />

        {{-- =========================
             CONTENT
        ========================== --}}
        <div class="drawer-content flex flex-col min-h-screen">

            {{-- TOP NAVBAR --}}
            <livewire:nav />

            {{-- PAGE CONTENT --}}
            <main class="flex-1 p-4 lg:p-6">

                {{ $slot }}

            </main>

        </div>

        {{-- =========================
             SIDEBAR
        ========================== --}}
        <livewire:side />

    </div>

    @livewireScripts

</body>
</html>