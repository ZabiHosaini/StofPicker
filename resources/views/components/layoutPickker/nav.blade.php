<nav class="bg-gray-800 text-white px-4 py-3 flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <a href="#" class="text-white hover:text-gray-400">
            <img class="rounded" width="50" height="30" src="{{ asset('storage/fotos/fabric.jpg') }}" alt="">
        </a>
        <div class="relative">
            <input type="text" class="rounded bg-gray-700  placeholder-white w-72 px-3 py-1" placeholder="Zoeken naar Stof....">

            <div class="absolute top-0 right-0 flex items-center h-full">
                <div class="border border-gray-600 rounded text-xs txet-gray-400 px-2 mr-2 items-center">/</div>
            </div>

        </div>

        <ul class="flex items-center font-semibold space-x-4">
            <li><a href="/stoffen" class="hover:text-gray-400" wire:current="text-green-400 font-bold">Stoffen</a></li>
            <li><a href="/fabrikant" class="hover:text-gray-400" wire:current="text-green-400 font-bold">Leveranciers</a></li>
            <li><a href="/contact" class="hover:text-gray-400 " wire:current="text-green-400 font-bold">contact</a></li>
        </ul>
  

        {{-- left --}}
    </div>

    <div>
       {{--  right --}}
    </div>  
</nav>


  