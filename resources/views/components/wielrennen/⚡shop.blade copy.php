<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Kleding;

new class extends Component
{
    public array $filters = [
        'geslacht' => null,
        'sizes' => [],
    ];

    public array $selectedSize = [];

    public function updated($property)
    {
        // hier kun je later debounce/logica toevoegen
    }

   
   #[Computed]
    public function kledings()
    {
        return Kleding::query()
            ->with([
                'fotos',
                'sizes' => function ($query) {
                    if (!empty($this->filters['sizes'])) {
                        $query->whereIn('sizes.id', $this->filters['sizes']);
                    }
                }
            ])
            ->when($this->filters['geslacht'], function ($query, $geslacht) {
                $query->where('geslacht', $geslacht);
            })
            ->when(!empty($this->filters['sizes']), function ($query) {
                $query->whereHas('sizes', function ($q) {
                    $q->whereIn('sizes.id', $this->filters['sizes']);
                });
            })
            ->get();
    }

  
    public function addToCart($kledingId, $sizeId)
    {  
        $kleding = Kleding::findOrFail($kledingId);

        $size = $kleding->sizes()
            ->where('sizes.id', $sizeId)
            ->first();

        if (!$size || $size->pivot->stock <= 0) return;

        $cartKey = $kledingId.'-'.$sizeId;

        $cart = session('cart', []);
        
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['aantalen']++;
        } else {
            $cart[$cartKey] = [
                'kleding_id' => $kledingId,
                'size_id' => $sizeId,
                'name' => $kleding->name,
                'size' => $size->name,
                'aantalen' => 1,
                'prijs' => $kleding->prijs,
            ];
        }

        $kleding->sizes()->updateExistingPivot($sizeId, [
            'stock' => $size->pivot->stock - 1
        ]);

        session()->put('cart', $cart);

        $this->dispatch('cart-updated');

    // session()->forget('cart');
    }
};
?>

<div class="flex items-start gap-6 w-full min-h-screen mt-8">
    @session("success")
     
    <div x-data="{show:true}"  wire:key="flash-message"
          x-init="setTimeout(() =>  show = false, 2500)" x-show = "show"                 
          class="fixed top-5 right-5 z-50
          bg-teal-100 border-t-4 border-teal-500 rounded-b
          text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
          <p class="font-bold">{{ $value }}</p>
            <p class="text-sm">{{ $value }}</p>
          </div>
        </div>
     </div>
   
   @endsession
    <!-- SIDEBAR -->
    <aside class="w-1/4 shrink-0 self-start sticky top-4 bg-slate-100 p-4 rounded-xl border border-slate-200">

        <h2 class="font-bold text-slate-700 mb-4">Filter</h2>

        <!-- GENDER -->
        <div class="flex flex-col gap-2 mb-6">
            <label class="flex items-center">
                <input type="radio" wire:model.live="filters.geslacht" value="">
                <span class="ms-2">All</span>
            </label>

            <label class="flex items-center">
                <input type="radio" wire:model.live="filters.geslacht" value="Heren">
                <span class="ms-2">Heren</span>
            </label>

            <label class="flex items-center">
                <input type="radio" wire:model.live="filters.geslacht" value="Dames">
                <span class="ms-2">Dames</span>
            </label>

            <label class="flex items-center">
                <input type="radio" wire:model.live="filters.geslacht" value="Kids">
                <span class="ms-2">Kids</span>
            </label>

        </div>

        <!-- SIZES -->
        <div class="mt-6 mb-2">
            <h3 class="text-lg font-semibold">Beschikbare maten</h3>
        </div>

        <div class="flex flex-col gap-2">

            <label class="flex items-center">
                <input type="checkbox" wire:model.live="filters.sizes" value="1">
                <span class="ms-2">XS</span>
            </label>

            <label class="flex items-center">
                <input type="checkbox" wire:model.live="filters.sizes" value="2">
                <span class="ms-2">S</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" wire:model.live="filters.sizes" value="3">
                <span class="ms-2">M</span>
            </label>

            <label class="flex items-center">
                <input type="checkbox" wire:model.live="filters.sizes" value="4">
                <span class="ms-2">L</span>
            </label>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 min-w-0">
        
        <!-- GRID WRAPPER (BELANGRIJK) -->
        <div class="min-h-[500px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($this->kledings as $kleding)
                <div wire:key="kleding-{{ $kleding->id }}" class="card bg-base-100 shadow-xl">
{{--                     <img class="h-48 w-full object-cover rounded" src="{{ asset('storage/wielrennen/visma.jpg') }}"> 
 --}}                    
                   {{--  <div class="card card-sm bg-base-200 max-w-60 shadow"> --}}
                    <a href="{{ route('wielrennen.show', $kleding->id)}}">
                        <figure class="hover-gallery w-full aspect-[5/4] rounded-t-xl overflow-hidden">

                            @forelse($kleding->fotos as $foto)
                        
                                <img
                                    src="{{ asset('storage/' . $foto->foto) }}"
                                    alt="{{ $kleding->name }}"
                                />
                        
                            @empty
                        
                                <div class="flex items-center justify-center w-full h-full bg-base-200">
                                    <span class="text-base-content/50">
                                        Geen foto
                                    </span>
                                </div>
                        
                            @endforelse
                        
                        </figure>
                    </a>
                     {{--  </div> --}}

                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-lg">
                                {{ $kleding->name }}
                            </span>
                        
                            <span class="text-sm text-blue-600 font-medium uppercase">
                                {{ $kleding->geslacht }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 line-clamp-2">
                            {{ $kleding->omschrijving }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        
                        <div class="px-6 pt-2 pb-2"> 

                            <div class="flex gap-2 justify-end flex-wrap">
                        
                                @foreach($kleding->sizes as $size)
                                    <button
                                    wire:click="addToCart({{ $kleding->id }}, {{ $size->id }})"
                                    @if($size->pivot->stock == 0)
                                        disabled
                                    @endif
                                    class="btn btn-sm btn-outline 
                                    {{ $size->pivot->stock == 0 ? 'bg-red-200 text-red-700 cursor-not-allowed' : 'bg-white hover:bg-gray-100' }}"
                                >
                                    {{ $size->size }} ({{ $size->pivot->stock }})
                                </button>
                                @endforeach
                        
                            </div>
                        
                        </div>
                    </div>
                </div>
                
            @empty

                <div class="col-span-3 flex items-center justify-center min-h-[300px] text-gray-500">
                    Geen producten gevonden
                </div>

            @endforelse
            
        </div>

    </main>
    
</div>