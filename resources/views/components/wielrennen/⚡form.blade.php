<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use App\Models\Size;
use App\Models\Kleding;
use App\Models\KledingFoto;
use App\Enums\Geslacht;
use Illuminate\Validation\Rules\Enum;

new class extends Component
{
    use WithFileUploads;

    public $name = '';
    public $geslacht = '';
    public $prijs = '';
    public $omschrijving = '';

    public $fotos = [];
    public $huidigeFotos = [];

    public $selectedSizes = [];
    public $stocks = [];

    public ?Kleding $kleding = null;


    public function mount($id = null)
    {
        if (!$id) {
            return;
        }

        $this->kleding = Kleding::findOrFail($id);

        $this->name = $this->kleding->name;
        $this->geslacht = $this->kleding->geslacht;
        $this->prijs = $this->kleding->prijs;
        $this->omschrijving = $this->kleding->omschrijving;

        $this->selectedSizes = $this->kleding
            ->sizes()
            ->pluck('sizes.id')
            ->toArray();

        foreach ($this->kleding->sizes as $size) {
            $this->stocks[$size->id] = $size->pivot->stock;
        }

        $this->huidigeFotos = $this->kleding
            ->fotos()
            ->pluck('foto')
            ->toArray();
    }


    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|min:3',

            'geslacht' => [
                'required',
                new Enum(Geslacht::class),
            ],

            'prijs' => 'required|numeric|min:0',

            'omschrijving' => 'required|min:3',

            'fotos' => 'nullable|array',

            'fotos.*' => 'image|max:2048',
        ]);


        if ($this->geslacht instanceof Geslacht) {
            $validated['geslacht'] = $this->geslacht->value;
        }


        $fotos = $validated['fotos'] ?? [];

        unset($validated['fotos']);


        if ($this->kleding) {

            $this->kleding->update($validated);

            $kleding = $this->kleding;

        } else {

            $kleding = Kleding::create($validated);
        }


        foreach ($fotos as $foto) {

            $naam = $foto->store('kleding', 'public');

            KledingFoto::create([
                'kleding_id' => $kleding->id,
                'foto' => $naam,
            ]);
        }


        $data = [];

        foreach ($this->selectedSizes as $sizeId) {

            $data[$sizeId] = [
                'stock' => $this->stocks[$sizeId] ?? 0,
            ];
        }

        $kleding->sizes()->sync($data);


        session()->flash(
            'success',
            'Deze kleding is succesvol opgeslagen!'
        );

        return redirect('/wielrennen');
    }


    #[Computed]
    public function totalStock()
    {
        return array_sum($this->stocks);
    }


    #[Computed]
    public function beschikbareSizes()
    {
        if (!$this->geslacht) {
            return collect();
        }

        $gender = $this->geslacht instanceof Geslacht
            ? $this->geslacht->value
            : $this->geslacht;

        return Size::where('gender', $gender)
            ->orderBy('size')
            ->get();
    }

    //delete foto
    public function deleteFoto($foto)
    {
        if (!$this->kleding) {
            return;
        }

        $kledingFoto = KledingFoto::where('kleding_id', $this->kleding->id)
            ->where('foto', $foto)
            ->first();

        if (!$kledingFoto) {
            return;
        }

        // Bestand uit storage verwijderen
        if (\Storage::disk('public')->exists($kledingFoto->foto)) {
            \Storage::disk('public')->delete($kledingFoto->foto);
        }

        // Record uit database verwijderen
        $kledingFoto->delete();

        // Lijst opnieuw laden
        $this->huidigeFotos = $this->kleding
            ->fotos()
            ->pluck('foto')
            ->toArray();
    }
// remove new foto  bij de add foto
    public function removeNewFoto($index)
    {
        unset($this->fotos[$index]);

        $this->fotos = array_values($this->fotos);
    }
};
?>

<div>

    <form wire:submit.prevent="save" class="space-y-8">

        {{-- Naam + prijs --}}
        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Naam
                </label>

                <input
                    wire:model="name"
                    type="text"
                    placeholder="Naam kleding"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50
                           px-4 py-3 text-gray-800 shadow-sm
                           focus:bg-white focus:border-green-500
                           focus:ring-2 focus:ring-green-200 transition"
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Prijs (€)
                </label>

                <input
                    wire:model="prijs"
                    type="number"
                    step="0.01"
                    min="0"
                    placeholder="Prijs"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50
                           px-4 py-3 text-gray-800 shadow-sm
                           focus:bg-white focus:border-green-500
                           focus:ring-2 focus:ring-green-200 transition"
                >

                @error('prijs')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>


        {{-- Geslacht --}}
        <div class="bg-gray-50 border border-gray-300 rounded-2xl p-6">

            <label class="block text-sm font-bold text-gray-800 mb-4">
                Geslacht
            </label>

            <div class="flex flex-wrap gap-4">

                @foreach(App\Enums\Geslacht::cases() as $geslachtOption)

                    <label
                        class="flex items-center gap-3 px-4 py-3
                               bg-white border border-gray-300
                               rounded-xl cursor-pointer
                               hover:border-green-500 transition"
                    >

                        <input
                            type="radio"
                            wire:model.live="geslacht"
                            name="geslacht"
                            value="{{ $geslachtOption->value }}"
                            class="w-5 h-5 text-green-600 focus:ring-green-500"
                        >

                        <span class="text-gray-700 font-medium">
                            {{ $geslachtOption->value }}
                        </span>

                    </label>

                @endforeach

            </div>

            @error('geslacht')
                <p class="text-red-500 text-sm mt-3">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- Maten --}}
        <div
            x-data="{
                selectedSizes: $wire.entangle('selectedSizes'),
                stocks: $wire.entangle('stocks')
            }"
            class="bg-gray-50 border border-gray-300 rounded-2xl p-6"
        >

            <label class="block text-sm font-bold text-gray-800 mb-4">
                Maten & voorraad
            </label>

            @if($geslacht)

                <div class="space-y-3">

                    @foreach($this->beschikbareSizes as $size)

                        <div
                            class="flex items-center justify-between gap-3
                                   bg-white border border-gray-200
                                   rounded-xl px-4 py-3"
                        >

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="checkbox"
                                    x-model="selectedSizes"
                                    value="{{ $size->id }}"
                                    class="w-5 h-5 rounded text-green-600
                                           focus:ring-green-500"
                                >

                                <span class="text-gray-700 font-medium">
                                    {{ $size->size }}
                                </span>

                            </label>


                            <input
                                x-show="selectedSizes.includes('{{ $size->id }}')"
                                x-transition
                                type="number"
                                min="0"
                                wire:model.live="stocks.{{ $size->id }}"
                                placeholder="Aantal"
                                class="w-28 rounded-lg border border-gray-300
                                       bg-gray-50 px-3 py-2
                                       focus:bg-white focus:border-green-500
                                       focus:ring-2 focus:ring-green-200"
                            >

                        </div>

                    @endforeach

                </div>

            @else

                <p class="text-gray-500 text-sm">
                    Kies eerst Heren, Dames of Kids.
                </p>

            @endif


            <div
                class="mt-5 pt-4 border-t border-gray-200
                       flex justify-between"
            >

                <span class="font-semibold text-gray-700">
                    Totaal voorraad
                </span>

                <span class="font-bold text-gray-800">
                    {{ $this->totalStock }}
                </span>

            </div>

        </div>


        {{-- Foto's --}}
        <div
            class="border-2 border-dashed border-gray-300
                   rounded-2xl p-6 bg-gray-50
                   hover:border-green-500 transition"
        >

            <label class="block text-sm font-bold text-gray-800 mb-4">
                Kleding foto's
            </label>


            <label
                for="fotos"
                class="cursor-pointer inline-flex items-center gap-2
                       bg-green-600 hover:bg-green-700
                       text-white px-5 py-3 rounded-xl shadow transition"
            >
                📷 Foto's kiezen
            </label>


            <input
                id="fotos"
                type="file"
                wire:model="fotos"
                accept="image/*"
                multiple
                class="hidden"
            >


            <p class="text-gray-500 text-xs mt-3">
                Meerdere foto's toegestaan. PNG/JPG, maximaal 2MB per foto.
            </p>


            <div
                wire:loading
                wire:target="fotos"
                class="text-green-600 text-sm mt-3"
            >
                Foto's uploaden...
            </div>


            @error('fotos')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror


            {{-- Bestaande foto's --}}
            @if(!empty($huidigeFotos))

                <div class="mt-6">

                    <p class="text-sm font-semibold text-gray-700 mb-3">
                        Bestaande foto's
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                        @foreach($huidigeFotos as $foto)

                            <div class="relative group">

                                <img
                                    src="{{ asset('storage/' . $foto) }}"
                                    class="w-full h-32 object-cover rounded-xl shadow-md"
                                >

                                <button
                                    type="button"
                                    wire:click="deleteFoto('{{ $foto }}')"
                                    wire:confirm="Weet je zeker dat je deze foto wilt verwijderen?"
                                    class="absolute top-2 right-2
                                        w-8 h-8
                                        flex items-center justify-center
                                        rounded-full
                                        bg-red-600 text-white
                                        hover:bg-red-700
                                        shadow-lg
                                        opacity-0 group-hover:opacity-100
                                        transition"
                                    title="Foto verwijderen"
                                >
                                    ✕
                                </button>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- Nieuwe foto's --}}
            @if(!empty($fotos))

                <div class="mt-6">

                    <p class="text-sm font-semibold text-gray-700 mb-3">
                        Nieuwe foto's
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                        @foreach($fotos as $index => $foto)

                            <div class="relative group">

                                <img
                                    src="{{ $foto->temporaryUrl() }}"
                                    class="w-full h-32 object-cover rounded-xl shadow-md"
                                >

                                {{-- Foto verwijderen voordat hij opgeslagen is --}}
                                <button
                                    type="button"
                                    wire:click="removeNewFoto({{ $index }})"
                                    class="absolute top-2 right-2
                                        w-8 h-8
                                        flex items-center justify-center
                                        rounded-full
                                        bg-red-600 text-white
                                        hover:bg-red-700
                                        shadow-lg
                                        opacity-0 group-hover:opacity-100
                                        transition"
                                    title="Foto verwijderen"
                                >
                                    ✕
                                </button>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>


        {{-- Omschrijving --}}
        <div>

            <label class="block text-sm font-bold text-gray-800 mb-2">
                Omschrijving
            </label>

            <textarea
                wire:model="omschrijving"
                rows="5"
                placeholder="Schrijf een duidelijke omschrijving..."
                class="w-full rounded-xl border border-gray-300
                       bg-gray-50 px-4 py-3 text-gray-800 shadow-sm
                       focus:bg-white focus:border-green-500
                       focus:ring-2 focus:ring-green-200 transition"
            ></textarea>

            @error('omschrijving')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- Opslaan --}}
        <div class="flex justify-end">

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="save"
                class="bg-green-600 hover:bg-green-700
                       disabled:opacity-50
                       text-white px-8 py-3
                       rounded-xl shadow-lg transition"
            >
                Opslaan
            </button>

        </div>


        <div
            wire:loading
            wire:target="save"
            class="text-green-600 text-center"
        >
            Bezig met opslaan...
        </div>

    </form>

</div>