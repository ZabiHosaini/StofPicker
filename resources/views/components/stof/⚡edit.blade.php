<?php

use Livewire\Component;
use App\Models\Stof;
use Livewire\WithFileUploads;



new class extends Component
{
    use WithFileUploads;

    public $stof;
    public $id;
    public $name; 
    public $fabrikant; 
    public $categorie;
    public $prijs;
    public $kleur;
    public $status;
    public $vooraad;
    public $omschrijving;
    public $foto;

    public $currentfoto;
    public $productId;

public function mount($id)
{
    $stof = Stof::find($id);

    $this->id = $stof->id;
    $this->name = $stof->name;
    $this->fabrikant = $stof->fabrikant;
    $this->categorie = $stof->categorie;
    $this->prijs = $stof->prijs;
    $this->kleur = $stof->kleur;
    $this->status = $stof->status;
    $this->vooraad = $stof->vooraad;
    $this->omschrijving = $stof->omschrijving;

   // $this->foto = $stof->foto;
    $this->currentfoto = $stof->foto;
   //dd($this->currentfoto);

}

public function update()
{   
    sleep(2);
    $stof = Stof::findOrFail($this->id);
    $stof->name = $this->name;
    $stof->fabrikant = $this->fabrikant;
    $stof->categorie = $this->categorie;
    $stof->prijs = $this->prijs;
    $stof->kleur = $this->kleur;
    $stof->status = $this->status;
    $stof->vooraad = $this->vooraad;
    $stof->omschrijving = $this->omschrijving;
 
        if($this->foto)
        {
            $filepath = $this->foto->store("fotos","public");
            //'photo' => $filepath;
            $stof->foto = $filepath;   
        }

        $stof->save();

        session()->flash('success',"Deze product is geupdated!");

        return redirect('/stoffen');
  
}


 

};
?>

<div>
    
    <section class="px-4 md:px-8 w-full mt-8">
        <div class="max-w-xl mx-auto">
           <div class="mb-12">
              <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl dark:text-slate-50">
                  Stoffen Toevoegen
              </h2>
              <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">
                 Have a question, need support, or want to discuss your next project? We’re here to help.
              </p>
           </div>
     
           <form wire:submit.prevent="update" class="space-y-4 justify-center">
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
            
                <label for="Fabrikant" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Fabrikant</label>
            <div class="flex items-center gap-1">
                <input wire:model="fabrikant" type="text" id="Fabrikant" name="Fabrikant" placeholder="fabrikant"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                @if($fabrikant && !$errors->has('Fabrikant'))
                    <div class="text-green-500 text-xs">
                        ok✔
                    </div>
                 @endif
            </div>
            @error('fabrikant')
                <p class="text-red-500 text-xs mt-0">Deze field is verplicht!</p>
            @enderror
            
                <label for="categorie"class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Categorie</label>
            <div class="flex items-center gap-1">
                <input wire:model="categorie" type="text" id="categorie" name="categorie" placeholder="categorie"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
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
                <input wire:model="status" type="text" id="status" name="status" placeholder="status"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
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
                    @elseif($currentfoto) 
                        <img src="{{ asset('storage/' . $currentfoto) }}" class="w-20 h-20 rounded-full object-cover border"/>
                    @endif

                    <div wire:loading wire:target="foto">
                        <span class="text-xs text-green-400 whitespace-nowrap">
                            Uploaden foto ..
                        </span>
                    </div>

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
                    </div>
                </div>
            </div>
           <!-- End File Upload -->
     
              <div x-data>
                 <label for="omschrijving"
                    class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Omschrijving</label>
                 <textarea wire:dirty.class="focus:outline-red-500"   wire:model="omschrijving" placeholder="Write message" rows="6" type="text" id="omschrijving" name="omschrijving"class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700"></textarea>
                 <div class="text-red-500 text-sm" wire:dirty>Unsaved changes...</div> <small>Aantaal tekens <span class="text-green-500" x-text="$wire.omschrijving.length"></span></small>
              </div>
                
     
              <button type="submit" wire:click="update"
                 class="py-2.5 px-4 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Opslaan
              </button>
              <div wire:loading wire:target="update"  class="flex items-center gap-2">
                <span class="text-xs text-green-400 whitespace-nowrap">
                    aan het Opslaan..
                </span>
                 
                <img
                    src="https://media.tenor.com/eFde1mp-8fYAAAAM/carregando.gif"
                    class="w-5 h-5"
                    alt="">
            </div>
           </form>
        </div>
     </section>
</div>