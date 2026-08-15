<?php

use Livewire\Component;
use App\Models\Fabrikant;
use App\Models\Stof;
use App\Events\StofCreate;

use Livewire\WithFileUploads;


new class extends Component
{
    use WithFileUploads;
    

    public $name; 
    public $categorie;
    public $prijs;
    public $kleur;
    public $status;
    public $breed;
    public $vooraad;
    public $omschrijving;
    public $foto;

    public $huidigeFoto;
    public $productId;

    

    
    public $fabrikant_id;

   
    public $fabrikanten = [];
    
    public ?Stof $stof = null;

    public function mount($id = null)
    {
        $this->fabrikanten = Fabrikant::all();

        if ($id) {
            $this->stof = Stof::find($id);

            if (!$this->stof) return;
            $stof = $this->stof;

            $this->name = $stof->name;
            $this->fabrikant_id = $stof->fabrikant_id;
            $this->categorie = $stof->categorie;
            $this->prijs = $stof->prijs;
            $this->kleur = $stof->kleur;
            $this->status =  $this->stof->status;
            $this->breed = $stof->breed;
            $this->vooraad = $stof->vooraad;
            $this->omschrijving = $stof->omschrijving;
            $this->huidigeFoto = $stof->foto;   

        }
        else {
            $this->status = App\Enums\Status::cases()[0]->value;
        }

         

        
    }

    public function loadFabrikanten()
    {   //dd("komt");
        $this->fabrikanten = Fabrikant::orderBy('name')->get();
    } 

    
public function save()

{
    $this->validate([
        'name' => 'required',
        'fabrikant_id' => 'required',
        'categorie' => 'required',
        'prijs' => 'required|numeric',
        'kleur' => 'required',
        'status' => 'required',
        'breed' => 'required|numeric',
        'vooraad' => 'required|integer',
        'omschrijving' => 'required',
        'foto' => $this->stof
            ? 'nullable|image|max:2048'
            : 'required|image|max:2048',
    ]);

    /*
    |--------------------------------------------------------------------------
    | BESTAANDE STOF BEWERKEN
    |--------------------------------------------------------------------------
    */

    if ($this->stof) {

        $oudeStatus = $this->stof->status;

        $data = [
            'name' => $this->name,
            'fabrikant_id' => $this->fabrikant_id,
            'categorie' => $this->categorie,
            'prijs' => $this->prijs,
            'kleur' => $this->kleur,
            'status' => $this->status,
            'breed' => $this->breed,
            'vooraad' => $this->vooraad,
            'omschrijving' => $this->omschrijving,
        ];

        /*
        | Nieuwe foto gekozen?
        */

        if ($this->foto) {
            $data['foto'] = $this->foto->store('stoffen', 'public');
        }

        $this->stof->update($data);

        /*
        | Status gewijzigd?
        */

        if ($oudeStatus !== $this->status) {
            $this->stof->statusHistory()->create([
                'status' => $this->status,
            ]);
        }

    }

    /*
    |--------------------------------------------------------------------------
    | NIEUWE STOF
    |--------------------------------------------------------------------------
    */

    else {

        $fotoPath = $this->foto->store('stoffen', 'public');

        $stof = Stof::create([
            'name' => $this->name,
            'fabrikant_id' => $this->fabrikant_id,
            'categorie' => $this->categorie,
            'prijs' => $this->prijs,
            'kleur' => $this->kleur,
            'status' => $this->status,
            'breed' => $this->breed,
            'vooraad' => $this->vooraad,
            'omschrijving' => $this->omschrijving,
            'foto' => $fotoPath,
        ]);

        /*
        | Eerste status opslaan
        */

        $stof->statusHistory()->create([
            'status' => $this->status,
        ]);
    }

    return redirect('/stoffen');
}



    
};
?>

<div class="bg-white rounded-2xl shadow-xl p-8">

    <!-- Titel -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Nieuwe stof toevoegen
        </h1>

        <p class="text-gray-500 mt-2">
            Beheer stof informatie, prijs, voorraad en afbeelding.
        </p>
    </div>


    <form wire:submit.prevent="save" class="space-y-8">


        <!-- Basis informatie -->
        <div class="grid md:grid-cols-2 gap-6">


            <!-- Naam -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Stof naam
                </label>

                <input 
                wire:model="name"
                type="text"
                placeholder="Naam stof"
                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 
                text-gray-800 shadow-sm 
                focus:bg-white focus:border-green-500 
                focus:ring-2 focus:ring-green-200 transition">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>



            <!-- Fabrikant -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Fabrikant
                </label>

                <select 
                    wire:model="fabrikant_id"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 
                    text-gray-800 shadow-sm 
                    focus:bg-white focus:border-green-500 
                    focus:ring-2 focus:ring-green-200 transition">

                    <option value="">
                        Selecteer fabrikant
                    </option>

                    @foreach($fabrikanten as $fabrikant)

                    <option value="{{ $fabrikant->id }}">
                        {{ $fabrikant->name }}
                    </option>

                    @endforeach

                </select>


                @error('fabrikant_id')
                <p class="text-red-500 text-sm">
                    {{ $message }}
                </p>
                @enderror

            </div>



            <!-- Categorie -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Categorie
                </label>


                <input 
                    wire:model="categorie"
                    type="text"
                    placeholder="Categorie"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 
                    text-gray-800 shadow-sm 
                    focus:bg-white focus:border-green-500 
                    focus:ring-2 focus:ring-green-200 transition">

                    @error('categorie')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                     @enderror
            </div>




            <!-- Prijs -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Prijs (€)
                </label>


                <input 
                    wire:model="prijs"
                    type="number"
                    placeholder="Prijs"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 
                    text-gray-800 shadow-sm 
                    focus:bg-white focus:border-green-500 
                    focus:ring-2 focus:ring-green-200 transition">

                    @error('prijs')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
            </div>




            <!-- Kleur -->
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kleur
                </label>

                <select
                    wire:model="kleur"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3
                    text-gray-800 shadow-sm
                    focus:bg-white focus:border-green-500
                    focus:ring-2 focus:ring-green-200 transition"
                >
                    <option value="">Kies een kleur</option>
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Green">Green</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Oranje">Oranje</option>
                    <option value="Purple">Purple</option>
                    <option value="Pink">Pink</option>
                    <option value="Grey">Grey</option>
                    <option value="Darkblue">Darkblue</option>
                    <option value="Brown">Brown</option>
                </select>
                @error('kleur')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            
            <!-- breed -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Breed
                </label>


                <input 
                    wire:model="breed"
                    type="number"
                    placeholder="breed"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 
                    text-gray-800 shadow-sm 
                    focus:bg-white focus:border-green-500 
                    focus:ring-2 focus:ring-green-200 transition">

                    @error('breed')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>



            <!-- Voorraad -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Voorraad
                </label>


                <input 
                    wire:model="vooraad"
                    type="number"
                    placeholder="Voorraad"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 
                    text-gray-800 shadow-sm 
                    focus:bg-white focus:border-green-500 
                    focus:ring-2 focus:ring-green-200 transition">

                    @error('vooraad')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>


        </div>



       
<!-- Status -->

<div class="bg-gray-50 border border-gray-300 rounded-2xl p-6">

    <label class="block text-sm font-bold text-gray-800 mb-4">
        Status
    </label>


    <div class="flex flex-wrap gap-4">

        @foreach(App\Enums\Status::cases() as $status)

            <label class="flex items-center gap-3 
                          px-4 py-3
                          bg-white
                          border border-gray-300
                          rounded-xl
                          cursor-pointer
                          hover:border-green-500
                          transition">

                <input 
                    type="radio"
                    wire:model="status"
                    value="{{ $status->value }}"
                    class="w-5 h-5 text-green-600 
                           focus:ring-green-500">


                <span class="text-gray-700 font-medium">
                    {{ $status->value }}
                </span>

            </label>
            

        @endforeach
       
    </div>


    @error('status')
        <p class="text-red-500 text-sm mt-3">
            {{ $message }}
        </p>
    @enderror

</div>



<!-- Foto Upload -->

<div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 
bg-gray-50 hover:border-green-500 transition">

    <label class="block text-sm font-bold text-gray-800 mb-4">
        Product afbeelding
    </label>


    <div class="flex items-center gap-6">


        <!-- Preview -->

        @if (!empty($foto))

            <img src="{{ $foto->temporaryUrl() }}"
                 class="w-24 h-24 rounded-xl object-cover shadow-md border-2 border-white">

        @elseif(!empty($huidigeFoto))

            <img src="{{ asset('storage/'.$huidigeFoto) }}"
                 class="w-24 h-24 rounded-xl object-cover shadow-md border-2 border-white">

        @else

            <div class="w-24 h-24 rounded-xl bg-gray-200 
                        flex items-center justify-center">

                <svg class="w-24 h-24 text-gray-400"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                </svg>

            </div>

        @endif



        <!-- Upload knop -->

        <div>

            <label for="foto"
                class="cursor-pointer inline-flex items-center gap-2
                bg-green-600 hover:bg-green-700
                text-white px-5 py-3 rounded-xl shadow transition">

                📷 Foto kiezen

            </label>


            <input 
                id="foto"
                type="file"
                wire:model="foto"
                accept="image/*"
                class="hidden">


            <p class="text-gray-500 text-xs mt-3">
                PNG, JPG maximaal 2MB
            </p>


            <div wire:loading wire:target="foto"
                 class="text-green-600 text-sm mt-2">

                Foto uploaden...

            </div>

        </div>


    </div>

</div>
        <!-- Omschrijving -->

        <div>

            <label class="block text-sm font-bold text-gray-800 mb-2">
                Beschrijving
            </label>
        
        
            <textarea 
                wire:model="omschrijving"
                rows="5"
                placeholder="Schrijf een duidelijke omschrijving..."
                class="w-full rounded-xl border border-gray-300 bg-gray-50 
                px-4 py-3 text-gray-800 shadow-sm
                focus:bg-white focus:border-green-500
                focus:ring-2 focus:ring-green-200 transition">
            </textarea>
        
        
            @error('omschrijving')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        
        </div>





        <!-- Button -->

        <div class="flex justify-end">


            <button type="submit"
            class="bg-green-600 hover:bg-green-700 
            text-white px-8 py-3 rounded-xl shadow-lg transition">


                Opslaan


            </button>



        </div>




        <div wire:loading wire:target="save"
        class="text-green-600 text-center">

            Bezig met opslaan...

        </div>



    </form>


</div>