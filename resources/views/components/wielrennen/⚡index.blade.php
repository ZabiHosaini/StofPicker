
<?php

use Livewire\Component;
use App\Models\Kleding;
use Livewire\Attributes\On;

new class extends Component
{
    public $kledings = [];
    public $selected = [];

    public function mount()
    {
        $this->loadKledings();
    }

    private function loadKledings()
    {
        $this->kledings = Kleding::with(['sizes', 'fotos'])->get();
    }

    public function increaseStock($kledingId, $sizeId)
    {
        $kleding = Kleding::findOrFail($kledingId);

        $size = $kleding->sizes()
            ->where('sizes.id', $sizeId)
            ->first();

        if (!$size) {
            return;
        }

        $kleding->sizes()->updateExistingPivot($sizeId, [
            'stock' => $size->pivot->stock + 1,
        ]);

        $this->loadKledings();
    }

    public function decreaseStock($kledingId, $sizeId)
    {
        $kleding = Kleding::findOrFail($kledingId);

        $size = $kleding->sizes()
            ->where('sizes.id', $sizeId)
            ->first();

        if (!$size) {
            return;
        }

        if ($size->pivot->stock > 0) {
            $kleding->sizes()->updateExistingPivot($sizeId, [
                'stock' => $size->pivot->stock - 1,
            ]);
        }

        $this->loadKledings();
    }

    public function deleteShirt($id)
    {
        $this->dispatch('confirm', id: $id);
    }

    #[On('delete')]
    public function delete($id)
    {
        $kleding = Kleding::findOrFail($id);

        $kleding->sizes()->detach();
        $kleding->delete();

        $this->loadKledings();

        $this->dispatch('deleted');
    }
};
?>

<div class="min-h-screen bg-slate-50 p-4 md:p-8">

    {{-- HEADER --}}
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-primary text-primary-content flex items-center justify-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 7l6-4 3 3 3-3 6 4-2 5-3-2v11H8V10l-3 2-2-5z"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">
                            Kleding
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            Beheer producten en voorraad
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('wielrennen.create') }}"
               class="btn btn-primary shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Nieuwe kleding
            </a>

        </div>


        {{-- STATISTIEKEN --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

            {{-- PRODUCTEN --}}
            <div class="card bg-white shadow-sm border border-slate-200">
                <div class="card-body p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Producten
                            </p>

                            <p class="text-3xl font-bold text-slate-900">
                                {{ count($kledings) }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>

                    </div>

                </div>
            </div>


            {{-- GESELECTEERD --}}
            <div class="card bg-white shadow-sm border border-slate-200">
                <div class="card-body p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Geselecteerd
                            </p>

                            <p class="text-3xl font-bold text-slate-900">
                                {{ count($selected) }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                    </div>

                </div>
            </div>


            {{-- ACTIEF --}}
            <div class="card bg-white shadow-sm border border-slate-200">
                <div class="card-body p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Status
                            </p>

                            <p class="text-xl font-bold text-emerald-600">
                                Actief
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- TABEL --}}
        <div class="card bg-white shadow-sm border border-slate-200 overflow-hidden">

            {{-- TABEL HEADER --}}
            <div class="px-6 py-5 border-b border-slate-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Productoverzicht
                    </h2>

                    <p class="text-sm text-slate-500">
                        Bekijk en beheer je wielrenkleding.
                    </p>
                </div>

                @if(count($selected) > 0)
                    <div class="badge badge-primary badge-lg">
                        {{ count($selected) }} geselecteerd
                    </div>
                @endif

            </div>


            {{-- RESPONSIVE TABEL --}}
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-100 text-slate-600 text-xs uppercase tracking-wide">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                <input
                                    type="checkbox"
                                    class="checkbox checkbox-sm"
                                >
                            </th>

                            <th class="px-6 py-4 text-left">
                                Product
                            </th>

                            <th class="px-6 py-4 text-left">
                                Prijs
                            </th>

                            <th class="px-6 py-4 text-left">
                                Geslacht
                            </th>

                            <th class="px-6 py-4 text-left min-w-[300px]">
                                Voorraad
                            </th>

                            <th class="px-6 py-4 text-right">
                                Acties
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-200">

                        @forelse($kledings as $kleding)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- SELECT --}}
                                <td class="px-6 py-5 align-middle">

                                    <input
                                        type="checkbox"
                                        value="{{ $kleding->id }}"
                                        wire:model.live="selected"
                                        class="checkbox checkbox-sm"
                                    >

                                </td>


                                {{-- PRODUCT --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        {{-- FOTO --}}
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 shrink-0">

                                            @if($kleding->fotos->count() > 0)

                                                <img
                                                    src="{{ asset('storage/' . $kleding->fotos->first()->foto) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $kleding->name }}"
                                                >

                                            @else

                                                <div class="w-full h-full flex items-center justify-center text-slate-400">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-7 h-7"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="1.5"
                                                              d="M3 16l5-5 4 4 3-3 6 6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- INFO --}}
                                        <div class="min-w-0">

                                            <a
                                                href="{{ route('wielrennen.show', $kleding->id) }}"
                                                class="font-semibold text-slate-900 hover:text-primary hover:underline"
                                            >
                                                {{ $kleding->name }}
                                            </a>

                                            <p class="text-sm text-slate-500 truncate max-w-xs mt-1">
                                                {{ $kleding->omschrijving }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- PRIJS --}}
                                <td class="px-6 py-5">

                                    <span class="font-semibold text-slate-900">
                                        € {{ number_format($kleding->prijs, 2, ',', '.') }}
                                    </span>

                                </td>


                                {{-- GESLACHT --}}
                                <td class="px-6 py-5">

                                    @if($kleding->geslacht === 'Heren')

                                        <span class="badge badge-info">
                                            Heren
                                        </span>

                                    @elseif($kleding->geslacht === 'Dames')

                                        <span class="badge badge-secondary">
                                            Dames
                                        </span>

                                    @elseif($kleding->geslacht === 'Kids')

                                        <span class="badge badge-warning">
                                            Kids
                                        </span>

                                    @else

                                        <span class="badge badge-ghost">
                                            {{ $kleding->geslacht }}
                                        </span>

                                    @endif

                                </td>


                                {{-- VOORRAAD --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-wrap gap-2">

                                        @foreach($kleding->sizes as $size)

                                            <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">

                                                <div class="px-2 py-1.5 text-xs font-bold text-slate-700 bg-slate-50">
                                                    {{ strtoupper($size->size) }}
                                                </div>

                                                <button
                                                    wire:click="decreaseStock({{ $kleding->id }}, {{ $size->id }})"
                                                    class="w-7 h-8 flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
                                                >
                                                    −
                                                </button>

                                                <span class="min-w-7 text-center text-sm font-semibold">
                                                    {{ $size->pivot->stock }}
                                                </span>

                                                <button
                                                    wire:click="increaseStock({{ $kleding->id }}, {{ $size->id }})"
                                                    class="w-7 h-8 flex items-center justify-center text-slate-500 hover:bg-emerald-50 hover:text-emerald-600 transition"
                                                >
                                                    +
                                                </button>

                                            </div>

                                        @endforeach

                                    </div>

                                </td>


                                {{-- ACTIES --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        {{-- BEKIJK --}}
                                        <a
                                            href="{{ route('wielrennen.show', $kleding->id) }}"
                                            class="btn btn-sm btn-ghost btn-square"
                                            title="Bekijken"
                                        >
                                        👁️
                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('wielrennen.edit', $kleding->id) }}"
                                            class="btn btn-sm btn-ghost btn-square text-blue-600 hover:bg-blue-50"
                                            title="Bewerken"
                                        >
                                        ✏️
                                        </a>


                                        {{-- DELETE --}}
                                        <button
                                            wire:click="deleteShirt({{ $kleding->id }})"
                                            class="btn btn-sm btn-ghost btn-square text-red-600 hover:bg-red-50"
                                            title="Verwijderen"
                                        >
                                        🗑️
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-8 h-8 text-slate-400"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.5"
                                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                                            </svg>

                                        </div>

                                        <h3 class="font-semibold text-slate-700">
                                            Nog geen producten
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Voeg je eerste wielrenkleding toe.
                                        </p>

                                        <a
                                            href="{{ route('wielrennen.create') }}"
                                            class="btn btn-primary btn-sm mt-4"
                                        >
                                            Product toevoegen
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- DELETE SCRIPT --}}
    @script

    <script>

        $wire.on("confirm", (event) => {

            Swal.fire({
                title: "Product verwijderen?",
                text: "Dit product kan daarna niet meer worden hersteld.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#64748b",
                confirmButtonText: "Ja, verwijderen",
                cancelButtonText: "Annuleren"
            }).then((result) => {

                if (result.isConfirmed) {

                    $wire.dispatch("delete", {
                        id: event.id
                    });

                }

            });

        });


        $wire.on("deleted", () => {

            Swal.fire({
                title: "Verwijderd!",
                text: "Het product is verwijderd.",
                icon: "success",
                timer: 1800,
                showConfirmButton: false
            });

        });

    </script>

    @endscript

</div>
```
