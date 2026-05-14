<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 


    @vite(['resources/css/app.css', 'resources/js/app.js'])
       
    @livewireStyles

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @props(['indexPage' => false])
    
    <x-layoutPickker.nav>

    </x-layoutPickker.nav>

    <div class="flex min-h-screen">

        <x-layoutPickker.side>

        </x-layoutPickker.side>
        
        @if ($indexPage)
        
            {{ $slot }}
        
        @else
        <div class="w-full p-2">
            {{ $slot }}
        </div>
        @endif


        
        
    </div>
   
    
    

</body>
@livewireScripts   
</html>