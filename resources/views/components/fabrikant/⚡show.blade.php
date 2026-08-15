<?php

use Livewire\Component;
use App\Models\Fabrikant;

new class extends Component
{
    public Fabrikant $fabrikant;

    public function mount($id)
    {
        $this->fabrikant = Fabrikant::findOrFail($id);
    }
};
?>

<div class="bg-white rounded-2xl shadow-xl p-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                {{ $fabrikant->name }}
            </h1>

            <p class="text-gray-500 mt-2">
                Informatie en contactgegevens van deze fabrikant.
            </p>
        </div>

        <div class="flex gap-3">

            {{-- Terug --}}
            <a
                href="{{ route('fabrikant.index') }}"
                class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition"
            >
                ← Terug
            </a>

            {{-- Bewerken --}}
            <a
                href="{{ route('fabrikant.edit', $fabrikant->id) }}"
                class="px-5 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition"
            >
                ✏️ Bewerken
            </a>

        </div>

    </div>


    {{-- Informatie --}}
    <div class="grid md:grid-cols-2 gap-8">

        {{-- Logo --}}
        <div class="bg-gray-50 rounded-2xl p-6">

            <h2 class="text-lg font-bold text-gray-800 mb-4">
                Logo
            </h2>

            @if($fabrikant->logo)

                <img
                    src="{{ asset('storage/'.$fabrikant->logo) }}"
                    alt="{{ $fabrikant->name }}"
                    class="w-48 h-48 object-cover rounded-2xl shadow"
                >

            @else

                <div
                    class="w-48 h-48 rounded-2xl bg-gray-200
                           flex items-center justify-center
                           text-gray-400"
                >
                    Geen logo
                </div>

            @endif

        </div>


        {{-- Gegevens --}}
        <div class="space-y-4">

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-400">
                    Naam
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $fabrikant->name }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-400">
                    Adres
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $fabrikant->adres }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-400">
                    Telefoon
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $fabrikant->telefoon }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-400">
                    Email
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $fabrikant->email }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-400">
                    Contactpersoon
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $fabrikant->contactPersoon }}
                </p>
            </div>

        </div>

    </div>

</div>