<?php

use Livewire\Component;
use App\Models\Stof;
use App\Models\Fabrikant;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

new class extends Component
{
    use WithFileUploads;


    public $name; 
    public $categorie;
    public $prijs;
    public $kleur;
    public $status;
    public $vooraad;
    public $omschrijving;
    public $foto;

    public $currentPhoto;
    public $productId;

    
    public $fabrikant_id;

   
    public $fabrikanten = [];

  
   
    public function loadFabrikanten()
    {   //dd("komt");
        $this->fabrikanten = Fabrikant::orderBy('name')->get();
    } 
   
    

 public function save() 
 {   //dd($this->fabrikant_id);
     sleep(2);
    $validated = $this->validate([
            'name' => 'required|min:3',
            'fabrikant_id' => 'required|exists:fabrikants,id',
            'categorie' => 'required|min:3',
            'prijs' => 'required|integer|min:1',
            'kleur' => 'required|min:3',
            'status' => 'required|min:3',
            'vooraad' => 'required|integer|min:1',
            'foto' => 'required|image|max:2048',
            'omschrijving' => 'required|min:3',
        ]);

        $path = $this->foto->store('fotos', 'public');
        $validated['foto'] = $path;

        Stof::create($validated);
        $this->reset();

        session()->flash('success', "Deze stof in toegevord in database!");
        
       // unset($this->stoffen); 

        return redirect('/stoffen');


    } 
}
?>
 
<div>
    
    <section class="min-h-screen pb-[600px]">
        <div class="max-w-xl mx-auto">
           <div class="mb-12">
              <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl dark:text-slate-50">
                  Stoffen Toevoegen
              </h2>
              <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">
                 Have a question, need support, or want to discuss your next project? We’re here to help.
              </p>
           </div>
     
           <form wire:submit.prevent="save" class="space-y-4 justify-center pace-y-4 justify-center overflow-visible">
            <label for="Fabrikant" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">StofName</label>
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
            <label class="mb-2 text-sm font-medium">Fabrikant</label>
            <div class="overflow-visible">
                <select wire:model="fabrikant_id" wire:focus="loadFabrikanten" class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700">
                    <option value="">Selecteer fabrikant</option>
                
                    @foreach($fabrikanten as $fabrikant)
                        <option value="{{ $fabrikant->id }}">
                            {{ $fabrikant->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('fabrikant_id')
                <p class="text-red-500 text-xs">Deze field is verplicht!</p>
            @enderror
            
                <label for="categorie"class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Categorie</label>
            <div class="flex items-center gap-1">
                <input wire:model="categorie" type="text" id="categorie" name="categorie" placeholder="categorie" class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                @if($categorie && !$errors->has('categorie'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                 @endif
            </div>
            @error('categorie')
                <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
            @enderror
             
                <label for="prijs" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Prijs</label>
            <div class="flex items-center gap-1">
                <input wire:model="prijs" type="number" id="prijs" name="prijs" placeholder="prijs"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                @if($prijs && !$errors->has('prijs'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                @endif
            </div>
             @error('prijs')
             <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
             @enderror
             
                <label for="kleur" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Kleur</label>
            <div class="flex items-center gap-1">
                <input wire:model="kleur" type="text" id="kleur" name="kleur" placeholder="kleur"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                @if($kleur && !$errors->has('kleur'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                @endif
            </div>
             @error('kleur')
             <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
             @enderror
             
                <label for="status"class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Status</label>
                <div class="flex items-center gap-1">
                    @foreach(App\Enums\Status::cases() as $status)
    
                    <label>
                        <input type="radio"
                               wire:model="status"
                               name="size"
                               value="{{ $status->value }}">
                    
                        {{ $status->value }}
                    </label>
                    
                    @endforeach               
                     @if($status && !$errors->has('status'))
                        <div class="text-green-500 text-xs">
                            ok✔
                        </div>
                     @endif
                </div>
             @error('status')
             <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
             @enderror
                <label for="vooraad" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Voorraad</label>
            <div class="flex items-center gap-1"> 
                <input wire:model="vooraad" type="number" id="vooraad" name="vooraad" placeholder="voorraad" class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                @if($vooraad && !$errors->has('vooraad'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                @endif
            </div>
             @error('vooraad')
             <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
             @enderror
                         
           <!-- File Upload -->
            
            <div class="flex flex-wrap items-center gap-3 sm:gap-5">
                <div class="group" data-hs-file-upload-previews data-hs-file-upload-pseudo-trigger>
                    @if ($foto)
                        <img src="{{ $foto->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover border"/>
                    @else  
                        <img src="https://via.placeholder.com/80" class="w-20 h-20 rounded-full object-cover border"/>
                    @endif
   
                </div>
            
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                    <input type="file" wire:model="foto" id="fileInput" class="hidden">
                    <label for="fileInput"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg bg-blue-600 text-white cursor-pointer hover:bg-blue-700">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>

                        Upload photo
                        </label>
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg bg-layer border border-layer-line text-red-500 shadow-2xs hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none" data-hs-file-upload-clear>Delete</button>
                    <div wire:loading wire:target="foto">
                        <span class="text-xs text-green-400 whitespace-nowrap">
                            Uploaden foto ..
                        </span>
                    </div>
                    </div>
                </div>
            </div>
           <!-- End File Upload -->
     
              <div>
                 <label for="omschrijving"
                    class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Omschrijving</label>
                 <textarea wire:model="omschrijving" placeholder="Write message" rows="6" type="text" id="omschrijving" name="omschrijving" class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700"></textarea>
              </div>
     
              <button type="submit" 
                 class="py-2.5 px-4 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Opslaan
              </button>
              <div wire:loading wire:target="save"  class="flex items-center gap-2">
                <span class="text-xs text-green-400 whitespace-nowrap">
                    aan het laden..
                </span>
        {{-- wire:target="save" --}}
                <img
                    src="https://media.tenor.com/eFde1mp-8fYAAAAM/carregando.gif"
                    class="w-5 h-5"
                    alt="">
            </div>
              
           </form>
        </div>
     </section>
</div>