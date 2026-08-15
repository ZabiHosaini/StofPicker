
<?php

use Livewire\Component;
use App\Models\Kleding;

new class extends Component
{
    public $kleding;
    public $activeFoto;

    public bool $maatNietBeschikbaar = false;

    public $naam = '';
    public $email = '';
    public $bericht = '';

    public ?int $selectedSize = null;

    public function mount($id)
    {
        $this->kleding = Kleding::with([
            'fotos',
            'sizes'
        ])->findOrFail($id);

        $this->activeFoto = $this->kleding->fotos->first()?->foto;
    }

    public function addToCart($kledingId, $sizeId)
    {
        $kleding = Kleding::findOrFail($kledingId);

        $size = $kleding->sizes()
            ->where('sizes.id', $sizeId)
            ->first();

        if (!$size || $size->pivot->stock <= 0) {
            return;
        }

        $cartKey = $kledingId . '-' . $sizeId;

        $cart = session('cart', []);

        if (isset($cart[$cartKey])) {

            $cart[$cartKey]['aantalen']++;

        } else {

            $cart[$cartKey] = [
                'kleding_id' => $kledingId,
                'size_id' => $sizeId,
                'name' => $kleding->name,
                'size' => $size->size,
                'aantalen' => 1,
                'prijs' => $kleding->prijs,
            ];
        }

        $kleding->sizes()->updateExistingPivot($sizeId, [
            'stock' => $size->pivot->stock - 1
        ]);

        session()->put('cart', $cart);

        $this->dispatch('cart-updated');
    }

    public function verstuurVraag()
    {
        $this->validate([
            'naam' => 'required|min:2',
            'email' => 'required|email',
            'bericht' => 'required|min:5',
        ]);

        // Hier kun je later mail/logica toevoegen.
    }
};
?>

<div class="min-h-screen bg-gray-50 py-8">

    <div class="max-w-6xl mx-auto px-4 sm:px-6">


        {{-- =====================================================
            PRODUCT
        ====================================================== --}}

        <div class="bg-white rounded-3xl shadow-sm border border-gray-200
                    overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">


                {{-- =================================================
                    FOTO'S
                ================================================== --}}

                <div class="p-5 sm:p-8">

                    {{-- Grote foto --}}
                    @if($activeFoto)

                        <div
                            class="w-full aspect-square rounded-2xl
                                   overflow-hidden bg-gray-100
                                   border border-gray-200"
                        >

                            <img
                                src="{{ asset('storage/' . $activeFoto) }}"
                                class="w-full h-full object-cover"
                                alt="{{ $kleding->name }}"
                            >

                        </div>

                    @else

                        <div
                            class="w-full aspect-square rounded-2xl
                                   bg-gray-100 flex items-center
                                   justify-center text-gray-400"
                        >
                            Geen foto beschikbaar
                        </div>

                    @endif


                    {{-- Thumbnails --}}
                    @if($kleding->fotos->count() > 1)

                        <div class="flex gap-3 mt-4 overflow-x-auto pb-2">

                            @foreach($kleding->fotos as $foto)

                                <button
                                    type="button"
                                    wire:click="$set(
                                        'activeFoto',
                                        '{{ $foto->foto }}'
                                    )"
                                    class="shrink-0 w-20 h-20
                                           rounded-xl overflow-hidden
                                           border-2 transition

                                           {{ $activeFoto === $foto->foto
                                                ? 'border-green-600 ring-2 ring-green-100'
                                                : 'border-gray-200 hover:border-green-400'
                                           }}"
                                >

                                    <img
                                        src="{{ asset('storage/' . $foto->foto) }}"
                                        class="w-full h-full object-cover"
                                        alt="{{ $kleding->name }}"
                                    >

                                </button>

                            @endforeach

                        </div>

                    @endif

                </div>



                {{-- =================================================
                    PRODUCT INFO
                ================================================== --}}

                <div class="p-5 sm:p-8 lg:p-10 flex flex-col">


                    {{-- Gender --}}
                    <span
                        class="text-xs font-bold uppercase
                               tracking-wider text-green-600"
                    >
                        {{ $kleding->geslacht }}
                    </span>


                    {{-- Naam --}}
                    <h1
                        class="text-3xl sm:text-4xl font-bold
                               text-gray-900 mt-2"
                    >
                        {{ $kleding->name }}
                    </h1>


                    {{-- Prijs --}}
                    <div
                        class="text-3xl font-bold text-gray-900 mt-5"
                    >
                        € {{ number_format($kleding->prijs, 2, ',', '.') }}
                    </div>


                    {{-- Divider --}}
                    <div class="border-t border-gray-200 my-6"></div>


                    {{-- Omschrijving --}}
                    <div>

                        <h2 class="font-bold text-gray-900 mb-2">
                            Productinformatie
                        </h2>

                        <p
                            class="text-gray-500 leading-relaxed"
                        >
                            {{ $kleding->omschrijving }}
                        </p>

                    </div>


                    {{-- Maten --}}
                    <div class="mt-8">

                        <div class="flex items-center justify-between mb-3">

                            <h2 class="font-bold text-gray-900">
                                Kies je maat
                            </h2>

                            <span class="text-xs text-gray-400">
                                Klik op een maat om toe te voegen
                            </span>

                        </div>


                        <div class="flex flex-wrap gap-2">

                            @foreach($kleding->sizes as $size)

                                @if($size->pivot->stock > 0)

                                    <button
                                        type="button"
                                        wire:click="addToCart(
                                            {{ $kleding->id }},
                                            {{ $size->id }}
                                        )"
                                        class="min-w-[70px] px-4 py-3
                                               rounded-xl border
                                               border-gray-300
                                               bg-white
                                               text-gray-700
                                               font-semibold
                                               hover:bg-green-600
                                               hover:text-white
                                               hover:border-green-600
                                               transition"
                                    >

                                        <span>
                                            {{ $size->size }}
                                        </span>

                                        <span
                                            class="block text-[10px]
                                                   opacity-50 mt-0.5"
                                        >
                                            {{ $size->pivot->stock }}
                                            beschikbaar
                                        </span>

                                    </button>

                                @else

                                    <button
                                        type="button"
                                        disabled
                                        class="min-w-[70px] px-4 py-3
                                               rounded-xl border
                                               border-gray-200
                                               bg-gray-100
                                               text-gray-400
                                               font-semibold
                                               cursor-not-allowed"
                                    >

                                        <span>
                                            {{ $size->size }}
                                        </span>

                                        <span
                                            class="block text-[10px]
                                                   mt-0.5"
                                        >
                                            Uitverkocht
                                        </span>

                                    </button>

                                @endif

                            @endforeach

                        </div>

                    </div>


                    {{-- Winkelwagen --}}
                    <a
                        href="{{ route('cart') }}"
                        class="mt-8 w-full
                               flex items-center justify-center
                               gap-2
                               bg-green-600
                               hover:bg-green-700
                               text-white
                               font-semibold
                               rounded-xl
                               px-6 py-4
                               shadow-sm
                               transition"
                    >
                        🛒 Naar winkelwagen
                    </a>


                    {{-- Maat niet beschikbaar --}}
                    <div
                        class="mt-6 pt-6
                               border-t border-gray-200"
                    >

                        <label
                            class="flex items-center gap-3
                                   cursor-pointer"
                        >

                            <input
                                type="checkbox"
                                wire:model.live="maatNietBeschikbaar"
                                class="checkbox checkbox-success"
                            >

                            <span
                                class="text-sm font-medium
                                       text-gray-700"
                            >
                                Mijn maat staat er niet bij
                            </span>

                        </label>


                        @if($maatNietBeschikbaar)

                            <div
                                x-data
                                x-transition
                                class="mt-5 p-5
                                       bg-gray-50
                                       rounded-2xl
                                       border border-gray-200"
                            >

                                <h3
                                    class="font-bold text-gray-800 mb-1"
                                >
                                    Mis je een maat?
                                </h3>

                                <p
                                    class="text-sm text-gray-500 mb-4"
                                >
                                    Laat je gegevens achter en we nemen
                                    contact met je op.
                                </p>


                                <div class="space-y-3">

                                    <input
                                        type="text"
                                        wire:model="naam"
                                        class="input input-bordered
                                               w-full bg-white"
                                        placeholder="Naam"
                                    >

                                    @error('naam')
                                        <p class="text-red-500 text-xs">
                                            {{ $message }}
                                        </p>
                                    @enderror


                                    <input
                                        type="email"
                                        wire:model="email"
                                        class="input input-bordered
                                               w-full bg-white"
                                        placeholder="E-mailadres"
                                    >

                                    @error('email')
                                        <p class="text-red-500 text-xs">
                                            {{ $message }}
                                        </p>
                                    @enderror


                                    <textarea
                                        wire:model="bericht"
                                        class="textarea textarea-bordered
                                               w-full bg-white"
                                        rows="4"
                                        placeholder="Welke maat zoek je?"
                                    ></textarea>

                                    @error('bericht')
                                        <p class="text-red-500 text-xs">
                                            {{ $message }}
                                        </p>
                                    @enderror


                                    <button
                                        type="button"
                                        wire:click="verstuurVraag"
                                        wire:loading.attr="disabled"
                                        class="btn btn-success
                                               w-full text-white"
                                    >
                                        Verstuur aanvraag
                                    </button>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```
