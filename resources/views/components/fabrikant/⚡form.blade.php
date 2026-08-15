<?php

use Livewire\Component;
use App\Models\Fabrikant;
use Livewire\WithFileUploads;
use App\Events\FabrikantCreate;

new class extends Component
{
   use WithFileUploads;


    public ?Fabrikant $fabrikant = null;

    public $name;
    public $adres;
    public $telefoon;
    public $contactPersoon;
    public $email;
    public $logo;
    public $huidigeLogo;
    public $id;
    

   
    public function mount($id = null)
    {  
        if (!$id) {
            return;
        }

        $this->fabrikant = Fabrikant::findOrFail($id);

        $this->name = $this->fabrikant->name;
        $this->adres = $this->fabrikant->adres;
        $this->telefoon = $this->fabrikant->telefoon;
        $this->contactPersoon = $this->fabrikant->contactPersoon;
        $this->email = $this->fabrikant->email;
        $this->huidigeLogo = $this->fabrikant->logo;
    }

    public function save()
{
    $validated = $this->validate([
        'name' => 'required|min:3',
        'adres' => 'required|min:3',
        'telefoon' => 'required|min:3',
        'contactPersoon' => 'required|min:3',
        'email' => 'required|email',
    ]);

    // logo alleen toevoegen als nieuw bestand
    if ($this->logo) {
        $validated['logo'] = $this->logo->store('logos', 'public');
    }

    if ($this->fabrikant) {

        // update bestaande
        $this->fabrikant->update($validated);
        session()->flash('success','Deze leverancire is geupdated!');

    } else {
  
        // create nieuwe
        $fabrikant = Fabrikant::create($validated);
        session()->flash('success','Deze leverancire is Created!');

        // laravel reverb  live 


        event(new FabrikantCreate($fabrikant));   
     }

    $this->dispatch('fabrikantUpdated'); //voor add stof


    return redirect('/fabrikant');
}
    

};

?>

<div class="bg-white rounded-2xl shadow-xl p-8">


    <!-- Titel -->

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Nieuwe fabrikant toevoegen
        </h1>

        <p class="text-gray-500 mt-2">
            Beheer fabrikant informatie en contactgegevens.
        </p>

    </div>




<form wire:submit.prevent="save" class="space-y-8">



    <!-- Basis informatie -->

    <div class="grid md:grid-cols-2 gap-6">



        <!-- Naam -->

        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Naam fabrikant
            </label>


            <div class="relative">

                <input
                wire:model="name"
                type="text"
                placeholder="Naam fabrikant"

                class="
                w-full rounded-xl
                border border-gray-300
                bg-gray-50
                px-4 py-3 pr-10
                text-gray-800
                shadow-sm

                focus:bg-white
                focus:border-green-500
                focus:ring-2
                focus:ring-green-200
                transition">


                @if($name && !$errors->has('name'))

                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-green-500">
                    ✔
                </span>

                @endif


            </div>


            @error('name')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
            @enderror


        </div>






        <!-- Email -->

        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Email
            </label>


            <div class="relative">

                <input
                wire:model="email"
                type="email"
                placeholder="Email adres"

                class="
                w-full rounded-xl
                border border-gray-300
                bg-gray-50
                px-4 py-3 pr-10
                text-gray-800
                shadow-sm

                focus:bg-white
                focus:border-green-500
                focus:ring-2
                focus:ring-green-200">


                @if($email && !$errors->has('email'))

                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-green-500">
                    ✔
                </span>

                @endif


            </div>

        </div>





        <!-- Adres -->

        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Adres
            </label>


            <input
            wire:model="adres"
            type="text"
            placeholder="Adres"

            class="
            w-full rounded-xl
            border border-gray-300
            bg-gray-50
            px-4 py-3
            shadow-sm

            focus:bg-white
            focus:border-green-500
            focus:ring-2
            focus:ring-green-200">

        </div>





        <!-- Telefoon -->

        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Telefoon
            </label>


            <input
            wire:model="telefoon"
            type="text"
            placeholder="Telefoonnummer"

            class="
            w-full rounded-xl
            border border-gray-300
            bg-gray-50
            px-4 py-3
            shadow-sm

            focus:bg-white
            focus:border-green-500
            focus:ring-2
            focus:ring-green-200">

        </div>





        <!-- Contact -->

        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Contactpersoon
            </label>


            <input
            wire:model="contactPersoon"
            type="text"
            placeholder="Contactpersoon"

            class="
            w-full rounded-xl
            border border-gray-300
            bg-gray-50
            px-4 py-3
            shadow-sm">

        </div>



    </div>






    <!-- Logo upload -->

    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50">

        <label class="block text-sm font-bold text-gray-800 mb-4">
            Logo fabrikant
        </label>


        <div class="flex items-center gap-6">


            @if($logo)

                <img src="{{ $logo->temporaryUrl() }}"
                class="w-24 h-24 rounded-xl object-cover shadow">


            @elseif($huidigeLogo)

                <img src="{{asset('storage/'.$huidigeLogo)}}"
                class="w-24 h-24 rounded-xl object-cover shadow">


            @else

                <div class="w-24 h-24 bg-gray-200 rounded-xl flex items-center justify-center">
                    Logo
                </div>

            @endif



            <label for="logo"
            class="cursor-pointer bg-green-600 text-white px-5 py-3 rounded-xl">

                📷 Kies logo

            </label>


            <input
            id="logo"
            type="file"
            wire:model="logo"
            class="hidden">


        </div>


    </div>






    <!-- Button -->

    <div class="flex justify-end">


        <button
        type="submit"

        class="
        bg-green-600
        hover:bg-green-700
        text-white
        px-8
        py-3
        rounded-xl
        shadow-lg
        transition">


            Opslaan


        </button>


    </div>




</form>


</div>