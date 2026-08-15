
<?php

use Livewire\Component;
use App\Models\Fabrikant;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Attributes\On;

new class extends Component
{
    use WithPagination;

    public $searchText = '';

    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function toggle()
    {
        $this->sortDirection = $this->sortDirection === 'desc'
            ? 'asc'
            : 'desc';
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->toggle();
            return;
        }

        $this->sortField = $field;
        $this->sortDirection = 'asc';

        $this->resetPage();
    }

    public function updatedSearchText()
    {
        $this->resetPage();
    }

    #[Computed]
    public function fabrikanten()
    {
        return Fabrikant::query()
            ->when($this->searchText, function ($q) {
                $q->where(function ($query) {
                    $query
                        ->where('name', 'like', '%' . $this->searchText . '%')
                        ->orWhere('adres', 'like', '%' . $this->searchText . '%')
                        ->orWhere('email', 'like', '%' . $this->searchText . '%')
                        ->orWhere('contactPersoon', 'like', '%' . $this->searchText . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm', id: $id);
    }

    #[On('delete')]
    public function delete($id)
    {
        $fabrikant = Fabrikant::find($id);

        if ($fabrikant) {
            $fabrikant->delete();

            session()->flash(
                'success',
                'De fabrikant is succesvol verwijderd.'
            );
        }

        unset($this->fabrikanten);
    }

    #[On('fabrikantCreated')]
    public function fabrikantCreated()
    {
        unset($this->fabrikanten);
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
                            <span class="text-2xl">🏭</span>
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">
                                Fabrikanten
                            </h1>

                            <p class="text-gray-500 mt-1">
                                Beheer fabrikanten, contactgegevens en leveranciers.
                            </p>
                        </div>

                    </div>

                </div>


                <a
                    href="/fabrikant/create"
                    class="inline-flex items-center justify-center gap-2
                           bg-green-600 hover:bg-green-700
                           text-white font-semibold
                           px-6 py-3 rounded-xl
                           shadow-sm hover:shadow-md
                           transition"
                >
                    <span class="text-xl">+</span>
                    Nieuwe fabrikant
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
                        placeholder="Zoeken naar fabrikant..."
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
                    >

                </div>

            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Table header --}}
            <div class="px-6 py-5 border-b border-gray-100">

                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Fabrikanten overzicht
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Bekijk en beheer alle fabrikanten.
                    </p>
                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    {{-- ================= THEAD ================= --}}
                    <thead class="bg-gray-50 border-b border-gray-100">

                        <tr class="text-xs font-semibold uppercase tracking-wider text-gray-500">

                            <th class="px-6 py-4 text-left">
                                Logo
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
                                Adres
                            </th>

                            <th class="px-6 py-4 text-left">
                                Telefoon
                            </th>

                            <th class="px-6 py-4 text-left">
                                E-mail
                            </th>

                            <th class="px-6 py-4 text-left">
                                Contactpersoon
                            </th>

                            <th class="px-6 py-4 text-center">
                                Acties
                            </th>

                        </tr>

                    </thead>


                    {{-- ================= TBODY ================= --}}
                    <tbody class="divide-y divide-gray-100">

                        @forelse($this->fabrikanten as $fabrikant)

                            <tr class="group hover:bg-gray-50/80 transition duration-200">

                                {{-- Logo --}}
                                <td class="px-6 py-5">

                                    <a href="/fabrikant/show/{{ $fabrikant->id }}">

                                        @if($fabrikant->logo)

                                            <img
                                                src="{{ asset('storage/' . $fabrikant->logo) }}"
                                                alt="{{ $fabrikant->name }}"
                                                class="w-16 h-16 rounded-2xl object-cover
                                                       shadow-sm ring-1 ring-gray-200
                                                       group-hover:ring-green-300
                                                       transition"
                                            >

                                        @else

                                            <div
                                                class="w-16 h-16 rounded-2xl
                                                       bg-gray-100
                                                       ring-1 ring-gray-200
                                                       flex items-center justify-center
                                                       group-hover:ring-green-300
                                                       transition"
                                            >
                                                <span class="text-2xl">
                                                    🏭
                                                </span>
                                            </div>

                                        @endif

                                    </a>

                                </td>


                                {{-- Naam --}}
                                <td class="px-6 py-5">

                                    <a
                                        href="{{ route('fabrikant.show', $fabrikant->id) }}"
                                        class="font-semibold text-blue-600 hover:underline"
                                    >
                                        {{ $fabrikant->name }}
                                    </a>

                                    <p class="text-xs text-gray-400 mt-1">
                                        #{{ $fabrikant->id }}
                                    </p>

                                </td>


                                {{-- Adres --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-9 h-9 rounded-xl
                                                   bg-gray-100
                                                   flex items-center justify-center"
                                        >
                                            <span class="text-sm">
                                                📍
                                            </span>
                                        </div>

                                        <span class="text-gray-700">
                                            {{ $fabrikant->adres ?: 'Geen adres' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Telefoon --}}
                                <td class="px-6 py-5">

                                    @if($fabrikant->telefoon)

                                        <a
                                            href="tel:{{ $fabrikant->telefoon }}"
                                            class="inline-flex items-center gap-2
                                                   text-gray-700
                                                   hover:text-green-600
                                                   transition"
                                        >
                                            <span>📞</span>

                                            {{ $fabrikant->telefoon }}
                                        </a>

                                    @else

                                        <span class="text-gray-400">
                                            Geen telefoon
                                        </span>

                                    @endif

                                </td>


                                {{-- Email --}}
                                <td class="px-6 py-5">

                                    @if($fabrikant->email)

                                        <a
                                            href="mailto:{{ $fabrikant->email }}"
                                            class="inline-flex items-center gap-2
                                                   text-gray-700
                                                   hover:text-green-600
                                                   transition"
                                        >
                                            <span>✉️</span>

                                            {{ $fabrikant->email }}
                                        </a>

                                    @else

                                        <span class="text-gray-400">
                                            Geen e-mail
                                        </span>

                                    @endif

                                </td>


                                {{-- Contactpersoon --}}
                                <td class="px-6 py-5">

                                    @if($fabrikant->contactPersoon)

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 rounded-full
                                                       bg-green-100
                                                       text-green-700
                                                       flex items-center justify-center
                                                       font-bold"
                                            >
                                                {{ strtoupper(substr($fabrikant->contactPersoon, 0, 1)) }}
                                            </div>

                                            <span class="font-medium text-gray-700">
                                                {{ $fabrikant->contactPersoon }}
                                            </span>

                                        </div>

                                    @else

                                        <span class="text-gray-400">
                                            Geen contactpersoon
                                        </span>

                                    @endif

                                </td>


                                {{-- Acties --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-2">

                                        {{-- Bekijken --}}
                                        <a
                                            href="/fabrikant/show/{{ $fabrikant->id }}"
                                            title="Bekijken"
                                            class="w-10 h-10
                                                   flex items-center justify-center
                                                   rounded-xl
                                                   bg-gray-100
                                                   text-gray-600
                                                   hover:bg-gray-200
                                                   transition"
                                        >
                                            👁️
                                        </a>


                                        {{-- Bewerken --}}
                                        <a
                                            href="/fabrikant/edit/{{ $fabrikant->id }}"
                                            title="Bewerken"
                                            class="w-10 h-10
                                                   flex items-center justify-center
                                                   rounded-xl
                                                   bg-blue-50
                                                   text-blue-600
                                                   hover:bg-blue-100
                                                   transition"
                                        >
                                            ✏️
                                        </a>


                                        {{-- Verwijderen --}}
                                        <button
                                            wire:click="confirmDelete({{ $fabrikant->id }})"
                                            title="Verwijderen"
                                            class="w-10 h-10
                                                   flex items-center justify-center
                                                   rounded-xl
                                                   bg-red-50
                                                   text-red-600
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

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-16 h-16 rounded-2xl
                                                   bg-gray-100
                                                   flex items-center justify-center
                                                   mb-4"
                                        >
                                            <span class="text-3xl">
                                                🏭
                                            </span>
                                        </div>

                                        <h3 class="text-lg font-bold text-gray-800">
                                            Geen fabrikanten gevonden
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
            {{ $this->fabrikanten->links() }}
        </div>

    </div>

</div>


@script

<script>

    $wire.on("confirm", (event) => {

        Swal.fire({

            title: "Fabrikant verwijderen?",

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

                    text: "De fabrikant is succesvol verwijderd.",

                    icon: "success",

                    confirmButtonColor: "#16a34a"

                });

            }

        });

    });


    window.Echo.channel('fabrikants')

        .listen('.create', (e) => {

            console.log('Nieuwe fabrikant:', e);

            Livewire.dispatch('fabrikantCreated');

        });

</script>

@endscript

