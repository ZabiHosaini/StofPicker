<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'App' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100">

    <div class="drawer lg:drawer-open">

        <input id="drawer" type="checkbox" class="drawer-toggle" />
    
        <div class="drawer-content flex flex-col min-h-screen">
    
            <!-- NAV -->
            <livewire:nav />
    
            <!-- PAGE CONTENT -->
            <main class="flex-1 p-4 mr-20">
                {{ $slot }}
            </main>
    
        </div>
    
        <livewire:side />
    
    </div>

@livewireScripts
</body>
</html>