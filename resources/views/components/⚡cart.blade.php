<?php

use Livewire\Component;

new class extends Component
{
    public $kleding;
    public $prijs;
    public $aantalen;
    public $product;


    public function updateAantal($key, $aantal)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['aantalen'] = $aantal;
        }

        session()->put('cart', $cart);
    }

    public function removeFromCart($key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
        }

        session()->put('cart', $cart);

        $this->dispatch('$refresh');
    }
    
};
?>

<div>
    @if (session('cart', []))
        
        

    <div class="w-full overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-sm text-left text-gray-700">
        
            <!-- Header -->
            <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                <tr>
                
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Product</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Prijs</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline" width="100px">Antallen</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">SubTotal</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline"></th>

                </tr>
            </thead>
        
            <!-- Body -->
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach (session('cart',[]) as $key => $value )
                @php
                   $total = $total + ($value['aantalen'] * $value['prijs']);
                @endphp
              <tr class="border-b odd:bg-white even:bg-gray-100 hover:bg-gray-50">
                        <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                                <img class="rounded" src="{{asset('storage/wielrennen/visma.jpg') }}" width="100" alt="">
                                <span class="font-medium">
                                    {{ $value['name'] }}
                                </span>
                          </div>
                    </td>
                
{{--                     <td class="px-6 py-4"><img class="rounded-full" src="{{asset('storage/wielrennen/visma.jpg') }}" width="80" alt="">{{ $value['name']}}</td>
--}}                   {{--  <td class="px-6 py-4"><a class="text-blue-600 hover:underline" href="/show/">{{ $value['name']}}</a>  </td> --}}
                    <td class="px-6 py-4">${{ $value['prijs']}}</td>
                    <td class="px-6 py-4"><input 
                        type="number"
                        min="1"
                        value="{{ $value['aantalen'] }}"
                        wire:change="updateAantal('{{ $key }}', $event.target.value)"
                        class="border rounded px-2 py-1 w-20"> 
                    </td>
                    <td class="px-6 py-4">${{ $value['aantalen'] * $value['prijs'] }} </td>
                    

                    <td class="flex px-6 py-4">
                        {{-- <a href="/edit/"  Wire:key="" class="text-blue-600 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                        </svg>
                        </a> --}}
                        <a wire:click="removeFromCart({{ $key }})"  Wire:key="" href="#" class="text-red-600 hover:underline ml-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                        </svg>
                        </a>
                    </td>
                </tr>
                @endforeach   
                <tr class="bg-gray-200">
                    <td colspan="5" class="px-6 py-4 text-right text-2xl font-extrabold text-green-600">
                        Totaal: ${{ $total }}
                    </td>
                </tr>
            </tbody>
            </table>
            <div class="text-end mt-5">
                
                <form action="{{ route('order.post')}}" method="post">
                    @csrf
                    <a href="{{ url('wielrennen')}}" class="inline-block rounded bg-yellow-500 px-4 py-2 text-white font-semibold hover:bg-yellow-600 transition">
                        Continue Shoping
                    </a>
                    <a href="{{ route('order.post')}}" class="inline-block rounded bg-green-600 px-4 py-2 text-white font-semibold hover:bg-green-800 transition">
                        Betelen
                    </a>
                </form>
            </div>
            <div class="text-end mt-5">
                
            </div>
        </div>


    
@endif
  
</div>