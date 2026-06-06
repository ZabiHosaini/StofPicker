
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
       <el-dropdown class="inline-block">
        <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring-1 inset-ring-white/5 hover:bg-white/20">
            <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="w-5 h-5 flex-none">
            <path stroke-linecap="round"
               stroke-linejoin="round"
               d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
            </svg>
              
            Mijn card  <strong>({{count (session('cart',[]))}})</strong> 
          <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-mr-1 size-5 text-gray-400">
            <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
          </svg>
        </button>
      
        <el-menu anchor="bottom end" popover class="w-56 origin-top-right divide-y divide-white/10 rounded-md bg-gray-800 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
          
          @if (session('cart', []))
              @foreach (session('cart',[]) as $key => $value )
              <div class="flex items-center gap-3 px-4 py-6">
    
                <img 
                    class="h-16 w-16 object-cover rounded"
                    src="{{ asset('storage/wielrennen/visma.jpg') }}"
                    alt=""
                >
            
                <div class="flex flex-col">
                    <span class="text-sm text-white font-semibold">
                        {{ $value['name'] }}
                    </span>
                    <span class="text-sm text-gray-300">
                        Aantalen: {{ $value['aantalen'] }}
                     </span>
                    <span class="text-sm text-gray-300">
                       Prijs: €{{ $value['prijs'] }}
                    </span>
                </div>
            
            </div>
              @endforeach
              <div class="text-center">
              <a href="{{ route('cart')}}" class="inline-block rounded bg-cyan-500 px-4 py-2 text-white font-semibold hover:bg-cyan-600 transition">
                    View All
                </a>
              </div>
          @endif
            
          
         
        
        </el-menu>
      </el-dropdown>
    </div>  
</nav>


  