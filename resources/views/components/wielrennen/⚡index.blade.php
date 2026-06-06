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

    public function updated($property)
    {
        // hier kun je later debounce/logica toevoegen
    }

    #[Computed]
    public function kledings()
    {
        return Kleding::query()
            ->with('sizes')
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

    Public function addToCart($id)
    {  
        //session()->forget('cart');
       $kleding = Kleding::find($id);

       $cart = session('cart',[]);

       $cart[$id] = [
            "name" => $kleding->name,
            "quantity" => 1,
            "prijs" => $kleding->prijs,
            "omschrijving" => $kleding->omschrijving,
        ];

       //dd($cart[$id]);
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

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 min-w-0">
        <!-- GRID WRAPPER (BELANGRIJK) -->
        <div class="min-h-[500px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($this->kledings as $kleding)
                <div wire:key="kleding-{{ $kleding->id }}" class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="h-48 w-full object-cover rounded" src="{{ asset('storage/wielrennen/visma.jpg') }}">                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $kleding->name }}</div>
                    <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                    </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <div class="font-bold text-l flex gap-4 mb-2">voorraad
                            @forelse($kleding->sizes as $size)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                    
                                {{ $size->name }} ({{ $size->pivot->stock }})
                    
                            </span>
                            @empty
                                <span class="text-gray-400 text-sm">
                                    Geen maten beschikbaar
                                </span>
                            @endforelse
                        </div> 
                        
                        <div class="px-6 pt-2 pb-2 text-right">

                            
                        <a href="#{{-- {{ route('add.to.cart',$kleding->id )}} --}}" wire:click.prevent="addToCart({{ $kleding->id }})"   class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Add to Card</a>
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