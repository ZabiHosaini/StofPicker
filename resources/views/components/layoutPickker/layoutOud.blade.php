<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/combine/npm/daisyui@5/base/svg.css,npm/daisyui@5/base/rootscrollgutter.css,npm/daisyui@5/base/properties.css,npm/daisyui@5/base/scrollbar.css,npm/daisyui@5/base/rootscrolllock.css,npm/daisyui@5/base/reset.css,npm/daisyui@5/base/rootcolor.css,npm/daisyui@5/components/toggle.css,npm/daisyui@5/components/menu.css,npm/daisyui@5/components/button.css,npm/daisyui@5/components/checkbox.css,npm/daisyui@5/components/input.css,npm/daisyui@5/components/select.css,npm/daisyui@5/theme/light.css" rel="stylesheet" type="text/css" />



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
       
    @livewireStyles

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="overflow-auto">    
    @props(['indexPage' => false])
    
    <livewire:nav />    
    
    <div class="flex min-h-screen ">

        <livewire:side /> 
        
        @if ($indexPage)
        
            {{ $slot }}
        
        @else
        <div class="w-full p-2 overflow-visible">
            {{ $slot }}
        </div>
        @endif


        
        
    </div>
   
    
    

</body>
@livewireScripts   
</html>