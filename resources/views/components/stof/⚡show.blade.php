
<?php

use Livewire\Component;
use App\Models\Stof;

new class extends Component
{
    public $stof;
    public $id;
    public $name;
    public $fabrikant;
    public $categorie;
    public $prijs;
    public $kleur;
    public $status;
    public $vooraad;
    public $breed;
    public $omschrijving;
    public $foto;

    public function mount($id)
    {
        $this->stof = Stof::with(['fabrikant', 'statusHistory'])->findOrFail($id);

        $this->id = $this->stof->id;
        $this->name = $this->stof->name;
        $this->fabrikant = $this->stof->fabrikant;
        $this->categorie = $this->stof->categorie;
        $this->prijs = $this->stof->prijs;
        $this->kleur = $this->stof->kleur;
        $this->status = $this->stof->status;
        $this->vooraad = $this->stof->vooraad;
        $this->breed = $this->stof->breed;
        $this->omschrijving = $this->stof->omschrijving;
        $this->foto = $this->stof->foto;
    }
};
?>

<div class="min-h-screen bg-slate-50">

    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">

        <div class="flex items-center gap-2 text-sm text-gray-500">

            <a href="/stoffen"
               class="hover:text-green-600 transition">
                Stoffen
            </a>

            <span>›</span>

            <span class="text-gray-800 font-medium">
                {{ $this->name }}
            </span>

        </div>

    </div>


    <!-- Main product -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="grid lg:grid-cols-2 gap-8">


            <!-- FOTO -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <div class="relative overflow-hidden rounded-2xl bg-gray-100">

                    @if($this->foto)

                        <img
                            src="{{ asset('storage/' . $this->foto) }}"
                            alt="{{ $this->name }}"
                            class="w-full h-[450px] object-cover">

                    @else

                        <div class="h-[450px] flex items-center justify-center">

                            <div class="text-center text-gray-400">

                                <svg
                                    class="w-20 h-20 mx-auto mb-3"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                </svg>

                                <p>Geen afbeelding beschikbaar</p>

                            </div>

                        </div>

                    @endif


                    <!-- Status badge -->

                    <div class="absolute top-5 left-5">

                        @switch($this->status)

                            @case('besteld')

                                <span class="inline-flex items-center gap-2
                                    bg-yellow-100 text-yellow-800
                                    px-4 py-2 rounded-full
                                    text-sm font-bold shadow-sm">

                                    🛒 Besteld

                                </span>

                                @break

                            @case('onderweg')

                                <span class="inline-flex items-center gap-2
                                    bg-blue-100 text-blue-800
                                    px-4 py-2 rounded-full
                                    text-sm font-bold shadow-sm">

                                    🚚 Onderweg

                                </span>

                                @break

                            @case('binnen')

                                <span class="inline-flex items-center gap-2
                                    bg-green-100 text-green-800
                                    px-4 py-2 rounded-full
                                    text-sm font-bold shadow-sm">

                                    ✓ Binnen

                                </span>

                                @break

                            @case('geannuleerd')

                                <span class="inline-flex items-center gap-2
                                    bg-red-100 text-red-800
                                    px-4 py-2 rounded-full
                                    text-sm font-bold shadow-sm">

                                    ✕ Geannuleerd

                                </span>

                                @break

                            @default

                                <span class="bg-gray-100 text-gray-700
                                    px-4 py-2 rounded-full
                                    text-sm font-bold">

                                    {{ ucfirst($this->status) }}

                                </span>

                        @endswitch

                    </div>

                </div>

            </div>


            <!-- PRODUCT INFO -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                <!-- Category -->

                <div class="flex items-center gap-3 mb-4">

                    <span class="bg-purple-100 text-purple-700
                        px-3 py-1 rounded-full text-sm font-semibold">

                        {{ $this->categorie }}

                    </span>

                </div>


                <!-- Title -->

                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">

                    {{ $this->name }}

                </h1>


                <!-- Manufacturer -->

                <p class="mt-3 text-gray-500">

                    Fabrikant:

                    <span class="font-semibold text-gray-800">

                        {{ $this->fabrikant?->name ?? 'Onbekend' }}

                    </span>

                </p>


                <!-- Price -->

                <div class="mt-8 pb-8 border-b border-gray-100">

                    <p class="text-sm text-gray-500 mb-1">
                        Prijs per meter
                    </p>

                    <div class="flex items-end gap-2">

                        <span class="text-4xl font-extrabold text-green-600">

                            € {{ number_format($this->prijs, 2, ',', '.') }}

                        </span>

                        <span class="text-gray-500 mb-1">
                            / meter
                        </span>

                    </div>

                </div>


                <!-- Quick information -->

                <div class="grid grid-cols-2 gap-4 mt-8">


                    <!-- Kleur -->

                    <div class="rounded-2xl bg-slate-50 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-white
                                flex items-center justify-center shadow-sm">

                                🎨

                            </div>

                            <div>

                                <p class="text-xs text-gray-500 uppercase font-semibold">
                                    Kleur
                                </p>

                                <p class="font-bold text-gray-800 mt-1">
                                    {{ $this->kleur }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Breedte -->

                    <div class="rounded-2xl bg-slate-50 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-white
                                flex items-center justify-center shadow-sm">

                                📏

                            </div>

                            <div>

                                <p class="text-xs text-gray-500 uppercase font-semibold">
                                    Breedte
                                </p>

                                <p class="font-bold text-gray-800 mt-1">
                                    {{ $this->breed }} cm
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Voorraad -->

                    <div class="rounded-2xl bg-slate-50 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-white
                                flex items-center justify-center shadow-sm">

                                📦

                            </div>

                            <div>

                                <p class="text-xs text-gray-500 uppercase font-semibold">
                                    Voorraad
                                </p>

                                <p class="font-bold text-gray-800 mt-1">

                                    {{ $this->vooraad }} meter

                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Fabrikant -->

                    <div class="rounded-2xl bg-slate-50 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-white
                                flex items-center justify-center shadow-sm">

                                🏭

                            </div>

                            <div>

                                <p class="text-xs text-gray-500 uppercase font-semibold">
                                    Fabrikant
                                </p>

                                <p class="font-bold text-gray-800 mt-1">
                                    {{ $this->fabrikant?->name ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="flex flex-wrap gap-3 mt-8">

                    <a
                        href="/edit/{{ $this->id }}"
                        class="flex-1 min-w-[180px] text-center
                        bg-blue-600 hover:bg-blue-700
                        text-white font-semibold
                        px-6 py-3.5 rounded-xl
                        shadow-sm transition">

                        ✏️ Stof bewerken

                    </a>


                    <a
                        href="/stoffen"
                        class="flex-1 min-w-[180px] text-center
                        bg-gray-100 hover:bg-gray-200
                        text-gray-800 font-semibold
                        px-6 py-3.5 rounded-xl
                        transition">

                        ← Terug naar stoffen

                    </a>

                </div>

            </div>

        </div>


        <!-- DESCRIPTION -->

        <div class="grid lg:grid-cols-3 gap-8 mt-8">


            <!-- Description -->

            <div class="lg:col-span-2 bg-white rounded-3xl
                shadow-sm border border-gray-100 p-8">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-11 h-11 rounded-xl
                        bg-green-100 text-green-600
                        flex items-center justify-center text-xl">

                        📝

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Omschrijving
                        </h2>

                        <p class="text-sm text-gray-500">
                            Informatie over deze stof
                        </p>

                    </div>

                </div>


                <div class="text-gray-600 leading-8 text-base">

                    @if($this->omschrijving)

                        {{ $this->omschrijving }}

                    @else

                        <p class="text-gray-400 italic">
                            Er is nog geen omschrijving toegevoegd.
                        </p>

                    @endif

                </div>

            </div>


            <!-- Summary -->

            <div class="bg-white rounded-3xl
                shadow-sm border border-gray-100 p-8">

                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    Samenvatting
                </h2>


                <div class="space-y-5">


                    <div class="flex justify-between gap-4">

                        <span class="text-gray-500">
                            Naam
                        </span>

                        <span class="font-semibold text-gray-800 text-right">
                            {{ $this->name }}
                        </span>

                    </div>


                    <div class="border-t"></div>


                    <div class="flex justify-between gap-4">

                        <span class="text-gray-500">
                            Categorie
                        </span>

                        <span class="font-semibold text-gray-800">
                            {{ $this->categorie }}
                        </span>

                    </div>


                    <div class="border-t"></div>


                    <div class="flex justify-between gap-4">

                        <span class="text-gray-500">
                            Kleur
                        </span>

                        <span class="font-semibold text-gray-800">
                            {{ $this->kleur }}
                        </span>

                    </div>


                    <div class="border-t"></div>


                    <div class="flex justify-between gap-4">

                        <span class="text-gray-500">
                            Breedte
                        </span>

                        <span class="font-semibold text-gray-800">
                            {{ $this->breed }} cm
                        </span>

                    </div>


                    <div class="border-t"></div>


                    <div class="flex justify-between gap-4">

                        <span class="text-gray-500">
                            Voorraad
                        </span>

                        <span class="font-bold text-green-600">
                            {{ $this->vooraad }} meter
                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- STATUS HISTORY -->

        <div class="bg-white rounded-3xl
            shadow-sm border border-gray-100
            p-8 mt-8">

            <div class="flex items-center gap-3 mb-8">

                <div class="w-11 h-11 rounded-xl
                    bg-blue-100 text-blue-600
                    flex items-center justify-center text-xl">

                    🕒

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-gray-900">
                        Status geschiedenis
                    </h2>

                    <p class="text-gray-500 text-sm">
                        Overzicht van alle statuswijzigingen
                    </p>

                </div>

            </div>


            <div class="relative">

                @forelse($this->stof->statusHistory->sortByDesc('created_at') as $history)

                    <div class="flex gap-5 relative">


                        <!-- Timeline -->

                        <div class="flex flex-col items-center">

                            <div class="w-4 h-4 rounded-full
                                bg-green-500
                                ring-4 ring-green-100
                                shrink-0">
                            </div>


                            @if(!$loop->last)

                                <div class="w-0.5 flex-1 bg-gray-200 my-2"></div>

                            @endif

                        </div>


                        <!-- Content -->

                        <div class="pb-8 flex-1">

                            <div class="flex flex-wrap items-center justify-between gap-3">

                                <span class="inline-flex items-center
                                    bg-green-50 text-green-700
                                    px-3 py-1 rounded-full
                                    text-sm font-semibold">

                                    {{ ucfirst($history->status) }}

                                </span>


                                <span class="text-sm text-gray-400">

                                    {{ $history->created_at->format('d-m-Y H:i') }}

                                </span>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-10">

                        <div class="text-4xl mb-3">
                            🕒
                        </div>

                        <p class="text-gray-500">
                            Er is nog geen statusgeschiedenis.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>
```
