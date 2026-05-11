<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Size;
use App\Models\Kleding;

new class extends Component
{
   public $name;
   public $geslacht;
   public $prijs;
   public $omschrijving;

   public $sizes = [];

public $selectedSizes = [];

public $stocks = [];

public function mount()
{
    $this->sizes = Size::all();
}
public function save()
{ 
    $validated = $this->validate([
        'name' => 'required|min:3',
        'geslacht' => 'required|in:Heren,Dames,Kids',
        'prijs' => 'required|numeric|min:0',
        'omschrijving' => 'required|min:3',

    ]);
    $kleding = Kleding::create($validated);
    $data = [];

    foreach ($this->selectedSizes as $sizeId) {

        $data[$sizeId] = [
            'stock' => $this->stocks[$sizeId] ?? 0
        ];
    }
    if (!empty($this->selectedSizes)) 
        {
        $kleding->sizes()->sync($data);
        }



    $this->reset();

        session()->flash('success', "Deze Kleding in toegevord in database!");
        
       // unset($this->stoffen); 

        return redirect('/wielrennen');
}
  
};
?>

<div class="w-full min-h-screen flex mt-10">

    <!-- CONTENT -->
    <section class="px-4 md:px-8 w-full">
        <div class="max-w-xl mx-auto">
           <div class="mb-12">
              <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl dark:text-slate-50">
                  Kleding Toevoegen
              </h2>
              <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">
                 Have a question, need support, or want to discuss your next project? We’re here to help.
              </p>
           </div>
     
           <form wire:submit.prevent="save" class="space-y-4 justify-center">
            <label for="Fabrikant" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Name</label>
            <div class="flex items-center gap-1">
                <input wire:model="name" type="text" id="name" name="name" placeholder="John doe" class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
            
                @if($name && !$errors->has('name'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                @endif
            </div>
            @error('name')
                <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
            @enderror
            
                <label for="geslacht" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Geslachten</label>
            <div class="flex items-center gap-1">
                @foreach(App\Enums\Geslacht::cases() as $geslacht)

                <label>
                    <input type="radio"
                           wire:model="geslacht"
                           name="size"
                           value="{{ $geslacht->value }}">
                
                    {{ $geslacht->value }}
                </label>
                
                @endforeach               
                 @if($geslacht && !$errors->has('geslacht'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                 @endif
            </div>
            @error('geslacht')
                <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
            @enderror
            @foreach($sizes as $size)

            <div class="flex items-center gap-4 mb-2">
            
                <label>
                    <input type="checkbox"
                           wire:model.live="selectedSizes"
                           value="{{ $size->id }}">
            
                    {{ $size->name }}
                </label>
            
                @if(in_array($size->id, $selectedSizes))
            
                    <input type="number"
                           min="0"
                           wire:model="stocks.{{ $size->id }}"
                           placeholder="Aantal"
                           class="border rounded px-2 py-1 w-24">
            
                @endif
            
            </div>
            
            @endforeach
            
                <label for="prijs"class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Prijs</label>
            <div class="flex items-center gap-1">
                <input wire:model="prijs" type="text" id="prijs" name="prijs" placeholder="prijs"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                @if($prijs && !$errors->has('prijs'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                 @endif
            </div>
            @error('prijs')
                <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
            @enderror
            <label for="omschrijving" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Omschrijving</label>
            <div class="flex items-center gap-1">
                <textarea wire:model="omschrijving" placeholder="Write message" rows="6" type="text" id="omschrijving" name="omschrijving" class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700"></textarea>
                @if($omschrijving && !$errors->has('omschrijving'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                @endif
            </div>
             @error('omschrijving')
             <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
             @enderror 
             
           {{--     <!-- File Upload -->
            
            <div class="flex flex-wrap items-center gap-3 sm:gap-5">
                <div class="group" data-hs-file-upload-previews data-hs-file-upload-pseudo-trigger>
                    @if ($logo)
                        <img src="{{ $logo->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover border"/>
                    @else  
                        <img src="https://via.placeholder.com/80" class="w-20 h-20 rounded-full object-cover border"/>
                    @endif
   
                </div>
            
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                    <input type="file" wire:model="logo" id="logo" class="hidden">
                    <label for="logo"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg bg-blue-600 text-white cursor-pointer hover:bg-blue-700">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>

                        Upload Logo
                        </label>
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg bg-layer border border-layer-line text-red-500 shadow-2xs hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none" data-hs-file-upload-clear>Delete</button>
                    </div>
                </div>
            </div>
           <!-- End File Upload --> --}}
            
           
           <div class="flex flex-row items-center gap-3">

                <button
                    type="submit"
                    wire:click.prevent="save"
                    wire:loading.attr="disabled"
                    class="py-2.5 px-4 text-sm rounded-md font-semibold text-white bg-blue-600 hover:bg-blue-700">
                    Opslaan
                </button>
            
                <div wire:loading  class="flex items-center gap-2">
                    <span class="text-xs text-green-400 whitespace-nowrap">
                        aan het laden..
                    </span>
            {{-- wire:target="save" --}}
                    <img
                        src="https://media.tenor.com/eFde1mp-8fYAAAAM/carregando.gif"
                        class="w-5 h-5"
                        alt="">
                </div>
        
            </div>
         
             
           </form>
        </div>
     </section>

</div>