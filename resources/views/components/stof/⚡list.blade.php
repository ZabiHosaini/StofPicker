<?php

use Livewire\Component;
use App\Models\Stof;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Attributes\on;

new class extends Component
{
    use WithPagination;


    public $searchText;

    //public $sort = 'newst';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function toggleSort()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc' ;
    }

    public function sortBy($field)
    { 
       if($this->sortField===$field)
        {
           $this->toggleSort();
           return;
        }
        $this->sortField = $field;
        
        $this->resetPage();

    }



    #[Computed]
    public function stoffen ()
    {    //dd($this->searchText); 
      return  Stof::with('fabrikant') // relationship laden
        ->when($this->searchText, function ($q)
          {
              $q->where('name','like','%'.$this->searchText . '%');
          })
        ->orderBy($this->sortField,$this->sortDirection)
        ->paginate(5);
    }

    public function updatedSearchText()
    {
        $this->resetPage();
    }

    public function deleteStof($id)
    {  
        $this->dispatch("confirm",id: $id);
     
 
      //  session()->flash('success', "De Product is verwijderd!");   in form  Wire:confrim="are you sure ?" /
    }
    #[On('delete')]
    public function delete($id)
    {  
        Stof::find($id)->delete();

        $this->stoffen =  Stof::latest()->get();

        unset($this->stoffen); 
    }

    /* public function OpenCreateForm()
    { 
        $this->indexPage = false;
        $this->createPage = true;
    } */

    #[On('stofCreated')]
    public function stofCreated()
        {
            unset($this->stoffen);
        }

};
?>



    

<div class="min-h-screen bg-gray-50">

    {{-- Flash message --}}
    @session('success')
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 2500)"
            x-show="show"
            x-transition
            class="fixed top-5 right-5 z-50 bg-white border-l-4 border-green-500 rounded-xl shadow-xl px-5 py-4"
        >
            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                    <span class="text-green-600 text-xl">✓</span>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">
                        Succes
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $value }}
                    </p>
                </div>

            </div>
        </div>
    @endsession


    <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100">
                            <span class="text-2xl">🧵</span>
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">
                                Stoffen
                            </h1>

                            <p class="text-gray-500 mt-1">
                                Beheer je stoffen, prijzen, voorraad en fabrikanten.
                            </p>
                        </div>

                    </div>
                </div>


                <a
                    href="/create"
                    class="inline-flex items-center justify-center gap-2
                           bg-green-600 hover:bg-green-700
                           text-white font-semibold
                           px-6 py-3 rounded-xl
                           shadow-sm hover:shadow-md transition"
                >
                    <span class="text-xl">+</span>
                    Nieuwe stof
                </a>

            </div>


            {{-- Search --}}
            <div class="mt-8">

                <div class="relative w-full lg:max-w-xl">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                        <svg
                            class="w-5 h-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                            />
                        </svg>

                    </div>


                    <input
                        wire:model.live="searchText"
                        type="text"
                        placeholder="Zoeken naar stof..."
                        class="w-full rounded-2xl
                               border border-gray-200
                               bg-gray-50
                               pl-12 pr-4 py-3.5
                               text-gray-700
                               placeholder-gray-400
                               outline-none
                               focus:bg-white
                               focus:border-green-400
                               focus:ring-4
                               focus:ring-green-100
                               transition"
                    />

                </div>

            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Table header --}}
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Stoffen overzicht
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Bekijk en beheer alle stoffen.
                    </p>
                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50 border-b border-gray-100">

                        <tr class="text-xs font-semibold uppercase tracking-wider text-gray-500">

                            <th class="px-6 py-4 text-left">
                                Foto
                            </th>

                            <th class="px-6 py-4 text-left">

                                <button
                                    wire:click="sortBy('name')"
                                    class="flex items-center gap-2 hover:text-green-600 transition"
                                >
                                    Naam

                                    @if($sortField === 'name')
                                        <span class="text-green-600">
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        </span>
                                    @endif

                                </button>

                            </th>

                            <th class="px-6 py-4 text-left">
                                Fabrikant
                            </th>

                            <th class="px-6 py-4 text-left">
                                Categorie
                            </th>

                            <th class="px-6 py-4 text-left">
                                Prijs
                            </th>

                            <th class="px-6 py-4 text-left">
                                Kleur
                            </th>

                            <th class="px-6 py-4 text-left">
                                Voorraad
                            </th>

                            <th class="px-6 py-4 text-left">
                                Breedte
                            </th>

                            <th class="px-6 py-4 text-left">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center">
                                Actie
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($this->stoffen as $stof)

                            <tr class="group hover:bg-gray-50/80 transition duration-200">

                                {{-- Foto --}}
                                <td class="px-6 py-5">

                                    <a href="/show/{{ $stof->id }}">

                                        <div class="relative w-16 h-16">

                                            <img
                                                src="{{ asset('storage/' . $stof->foto) }}"
                                                alt="{{ $stof->name }}"
                                                class="w-16 h-16 rounded-2xl
                                                       object-cover shadow-sm
                                                       ring-1 ring-gray-200
                                                       group-hover:ring-green-300
                                                       transition"
                                            >

                                        </div>

                                    </a>

                                </td>


                                {{-- Naam --}}
                                <td class="px-6 py-5">

                                    <a
                                        href="/show/{{ $stof->id }}"
                                        class="font-bold text-gray-800 hover:text-green-600 transition"
                                    >
                                        {{ $stof->name }}
                                    </a>

                                    <p class="text-xs text-gray-400 mt-1">
                                        #{{ $stof->id }}
                                    </p>

                                </td>


                                {{-- Fabrikant --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-500 text-sm">
                                                🏭
                                            </span>
                                        </div>

                                        <span class="text-gray-700 font-medium">
                                            {{ $stof->fabrikant?->name ?? 'Onbekend' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Categorie --}}
                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex items-center
                                               bg-purple-50 text-purple-700
                                               border border-purple-100
                                               px-3 py-1.5
                                               rounded-full
                                               text-sm font-semibold"
                                    >
                                        {{ $stof->categorie }}
                                    </span>

                                </td>


                                {{-- Prijs --}}
                                <td class="px-6 py-5">

                                    <div class="font-bold text-green-600 text-base">
                                        € {{ number_format($stof->prijs, 2, ',', '.') }}
                                    </div>

                                    <div class="text-xs text-gray-400">
                                        per meter
                                    </div>

                                </td>


                                {{-- Kleur --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                
                                        <span
                                            class="w-5 h-5 rounded-full ring-2 ring-white shadow"
                                            style="background-color: {{ $stof->kleur }}"
                                        ></span>
                                
                                        <span class="text-gray-700">
                                            {{ $stof->kleur }}
                                        </span>
                                
                                    </div>
                                </td>


                                {{-- Voorraad --}}
                                <td class="px-6 py-5">

                                    @if($stof->vooraad > 0)

                                        <div>

                                            <span class="font-bold text-gray-800">
                                                {{ $stof->vooraad }}
                                            </span>

                                            <span class="text-gray-400 text-sm">
                                                meter
                                            </span>

                                        </div>


                                        @if($stof->vooraad < 10)

                                            <span class="text-xs text-orange-500 font-medium">
                                                Lage voorraad
                                            </span>

                                        @else

                                            <span class="text-xs text-green-500 font-medium">
                                                Op voorraad
                                            </span>

                                        @endif

                                    @else

                                        <span class="text-red-500 font-semibold text-sm">
                                            Uitverkocht
                                        </span>

                                    @endif

                                </td>


                                {{-- Breedte --}}
                                <td class="px-6 py-5">

                                    <span class="font-semibold text-gray-700">
                                        {{ $stof->breed }}
                                    </span>

                                    <span class="text-gray-400 text-sm">
                                        cm
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-5">

                                    @switch($stof->status)

                                        @case('besteld')

                                            <span
                                                class="inline-flex items-center gap-2
                                                       bg-yellow-50 text-yellow-700
                                                       border border-yellow-100
                                                       px-3 py-1.5
                                                       rounded-full
                                                       text-sm font-semibold"
                                            >
                                                <span>🛒</span>
                                                Besteld
                                            </span>

                                            @break


                                        @case('onderweg')

                                            <span
                                                class="inline-flex items-center gap-2
                                                       bg-blue-50 text-blue-700
                                                       border border-blue-100
                                                       px-3 py-1.5
                                                       rounded-full
                                                       text-sm font-semibold"
                                            >
                                                <span>🚚</span>
                                                Onderweg
                                            </span>

                                            @break


                                        @case('binnen')

                                            <span
                                                class="inline-flex items-center gap-2
                                                       bg-green-50 text-green-700
                                                       border border-green-100
                                                       px-3 py-1.5
                                                       rounded-full
                                                       text-sm font-semibold"
                                            >
                                                <span>✓</span>
                                                Binnen
                                            </span>

                                            @break


                                        @case('geannuleerd')

                                            <span
                                                class="inline-flex items-center gap-2
                                                       bg-red-50 text-red-700
                                                       border border-red-100
                                                       px-3 py-1.5
                                                       rounded-full
                                                       text-sm font-semibold"
                                            >
                                                <span>✕</span>
                                                Geannuleerd
                                            </span>

                                            @break


                                        @default

                                            <span
                                                class="inline-flex items-center
                                                       bg-gray-100 text-gray-600
                                                       px-3 py-1.5
                                                       rounded-full
                                                       text-sm font-semibold"
                                            >
                                                Onbekend
                                            </span>

                                    @endswitch

                                </td>


                                {{-- Acties --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-2">

                                        {{-- Bekijken --}}
                                        <a
                                            href="/show/{{ $stof->id }}"
                                            title="Bekijken"
                                            class="w-10 h-10
                                                   flex items-center justify-center
                                                   rounded-xl
                                                   bg-gray-100 text-gray-600
                                                   hover:bg-gray-200
                                                   transition"
                                        >
                                            👁️
                                        </a>


                                        {{-- Bewerken --}}
                                        <a
                                            href="/edit/{{ $stof->id }}"
                                            title="Bewerken"
                                            class="w-10 h-10
                                                   flex items-center justify-center
                                                   rounded-xl
                                                   bg-blue-50 text-blue-600
                                                   hover:bg-blue-100
                                                   transition"
                                        >
                                            ✏️
                                        </a>


                                        {{-- Verwijderen --}}
                                        <button
                                            wire:click="deleteStof({{ $stof->id }})"
                                            title="Verwijderen"
                                            class="w-10 h-10
                                                   flex items-center justify-center
                                                   rounded-xl
                                                   bg-red-50 text-red-600
                                                   hover:bg-red-100
                                                   transition"
                                        >
                                            🗑️
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-16 h-16 rounded-2xl
                                                   bg-gray-100
                                                   flex items-center justify-center
                                                   mb-4"
                                        >
                                            <span class="text-3xl">
                                                🧵
                                            </span>
                                        </div>

                                        <h3 class="text-lg font-bold text-gray-800">
                                            Geen stoffen gevonden
                                        </h3>

                                        <p class="text-gray-500 mt-1">
                                            Probeer een andere zoekterm.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Pagination --}}
        <div class="mt-6">
            {{ $this->stoffen->links() }}
        </div>

    </div>

</div>


@script

<script>

    $wire.on("confirm", (event) => {

        Swal.fire({
            title: "Stof verwijderen?",
            text: "Deze actie kan niet ongedaan worden.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#16a34a",
            cancelButtonColor: "#dc2626",
            confirmButtonText: "Ja, verwijderen",
            cancelButtonText: "Annuleren"
        }).then((result) => {

            if (result.isConfirmed) {

                $wire.dispatch("delete", {
                    id: event.id
                });

                Swal.fire({
                    title: "Verwijderd!",
                    text: "De stof is succesvol verwijderd.",
                    icon: "success",
                    confirmButtonColor: "#16a34a"
                });

            }

        });

    });


    window.Echo.channel('stofs')
        .listen('.create', (e) => {

            console.log('Nieuwe stof:', e);

            Livewire.dispatch('stofCreated');

        });

</script>

@endscript


    