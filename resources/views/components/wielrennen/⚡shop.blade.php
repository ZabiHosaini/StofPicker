
<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Kleding;

new class extends Component
{
    public array $filters = [
        'geslacht' => null,
        'sizes' => [],
    ];

    public array $selectedSize = [];

    #[Computed]
    public function kledings()
    {
        return Kleding::query()
            ->with([
                'fotos',
                'sizes' => function ($query) {
                    if (!empty($this->filters['sizes'])) {
                        $query->whereIn('sizes.id', $this->filters['sizes']);
                    }
                }
            ])
            ->when($this->filters['geslacht'], function ($query, $geslacht) {
                $query->where('geslacht', $geslacht);
            })
            ->when(!empty($this->filters['sizes']), function ($query) {
                $query->whereHas('sizes', function ($q) {
                    $q->whereIn('sizes.id', $this->filters['sizes']);
                });
            })
            ->get();
    }

    #[Computed]
    public function beschikbareSizes()
    {
        return \App\Models\Size::query()
            ->when($this->filters['geslacht'], function ($query, $geslacht) {
                $query->where('gender', $geslacht);
            })
            ->orderBy('id')
            ->get();
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
            class="fixed top-5 right-5 z-50 bg-white border border-green-200
                   rounded-2xl shadow-xl px-5 py-4"
        >
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10
                            rounded-full bg-green-100 text-green-600">
                    ✓
                </div>

                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $value }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Je winkelmandje is bijgewerkt.
                    </p>
                </div>
            </div>
        </div>
    @endsession


    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
            Kleding
        </h1>

        <p class="mt-2 text-gray-500">
            Ontdek onze kleding en kies jouw favoriete maat.
        </p>

    </div>


    <div class="flex flex-col lg:flex-row gap-8">


        {{-- =====================================================
            FILTER SIDEBAR
        ====================================================== --}}

        <aside class="lg:w-64 shrink-0">

            <div
                class="sticky top-6 bg-white rounded-2xl
                       border border-gray-200 shadow-sm p-6"
            >

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-lg font-bold text-gray-900">
                            Filters
                        </h2>

                        <p class="text-xs text-gray-400 mt-1">
                            Vind jouw kleding
                        </p>
                    </div>

                    <div
                        class="w-9 h-9 rounded-xl bg-green-50
                               flex items-center justify-center text-green-600"
                    >
                        ⚙
                    </div>

                </div>


                {{-- Gender --}}
                <div class="mb-8">

                    <h3 class="text-sm font-bold text-gray-700 mb-3">
                        Geslacht
                    </h3>

                    <div class="space-y-2">

                        <label
                            class="flex items-center gap-3 p-3 rounded-xl
                                   cursor-pointer hover:bg-gray-50 transition"
                        >
                            <input
                                type="radio"
                                wire:model.live="filters.geslacht"
                                value=""
                                class="radio radio-sm"
                            >

                            <span class="text-sm text-gray-700">
                                Alle kleding
                            </span>
                        </label>


                        <label
                            class="flex items-center gap-3 p-3 rounded-xl
                                   cursor-pointer hover:bg-gray-50 transition"
                        >
                            <input
                                type="radio"
                                wire:model.live="filters.geslacht"
                                value="Heren"
                                class="radio radio-sm"
                            >

                            <span class="text-sm text-gray-700">
                                Heren
                            </span>
                        </label>


                        <label
                            class="flex items-center gap-3 p-3 rounded-xl
                                   cursor-pointer hover:bg-gray-50 transition"
                        >
                            <input
                                type="radio"
                                wire:model.live="filters.geslacht"
                                value="Dames"
                                class="radio radio-sm"
                            >

                            <span class="text-sm text-gray-700">
                                Dames
                            </span>
                        </label>


                        <label
                            class="flex items-center gap-3 p-3 rounded-xl
                                   cursor-pointer hover:bg-gray-50 transition"
                        >
                            <input
                                type="radio"
                                wire:model.live="filters.geslacht"
                                value="Kids"
                                class="radio radio-sm"
                            >

                            <span class="text-sm text-gray-700">
                                Kids
                            </span>
                        </label>

                    </div>

                </div>


                {{-- Sizes --}}
                <div>

                    <h3 class="text-sm font-bold text-gray-700 mb-3">
                        Maat
                    </h3>

                    <div class="grid grid-cols-2 gap-2">

                        @foreach($this->beschikbareSizes as $size)

                            <label class="cursor-pointer">

                                <input
                                    type="checkbox"
                                    wire:model.live="filters.sizes"
                                    value="{{ $size->id }}"
                                    class="hidden peer"
                                >

                                <div
                                    class="text-center py-2.5 rounded-xl
                                        border border-gray-200
                                        text-sm font-medium
                                        text-gray-600
                                        peer-checked:bg-green-600
                                        peer-checked:text-white
                                        peer-checked:border-green-600
                                        hover:border-green-400
                                        transition"
                                >
                                    {{ $size->size }}
                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>

            </div>

        </aside>



        {{-- =====================================================
            PRODUCTEN
        ====================================================== --}}

        <main class="flex-1 min-w-0">

            <div class="flex items-center justify-between mb-5">

                <p class="text-sm text-gray-500">
                    {{ $this->kledings->count() }}
                    {{ $this->kledings->count() === 1 ? 'product' : 'producten' }}
                </p>

            </div>


            <div
                class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3
                       gap-6"
            >

                @forelse($this->kledings as $kleding)

                    <article
                        wire:key="kleding-{{ $kleding->id }}"
                        class="group bg-white rounded-2xl overflow-hidden
                               border border-gray-200 shadow-sm
                               hover:shadow-xl hover:-translate-y-1
                               transition-all duration-300"
                    >

                        {{-- FOTO'S --}}
                        <a
                            href="{{ route('wielrennen.show', $kleding->id) }}"
                            class="block"
                        >

                            <figure
                                class="hover-gallery w-full
                                       aspect-[5/4]
                                       overflow-hidden
                                       bg-gray-100"
                            >

                                @forelse($kleding->fotos as $foto)

                                    <img
                                        src="{{ asset('storage/' . $foto->foto) }}"
                                        alt="{{ $kleding->name }}"
                                        class="w-full h-full object-cover"
                                    >

                                @empty

                                    <div
                                        class="w-full h-full flex
                                               items-center justify-center
                                               text-gray-400"
                                    >
                                        Geen foto
                                    </div>

                                @endforelse

                            </figure>

                        </a>


                        {{-- INFO --}}
                        <div class="p-5">

                            <div class="flex items-start justify-between gap-3">

                                <div>

                                    <h2
                                        class="font-bold text-lg text-gray-900
                                               group-hover:text-green-600
                                               transition"
                                    >
                                        {{ $kleding->name }}
                                    </h2>

                                    <span
                                        class="inline-block mt-1
                                               text-xs font-semibold
                                               uppercase tracking-wide
                                               text-green-600"
                                    >
                                        {{ $kleding->geslacht }}
                                    </span>

                                </div>


                                <div
                                    class="text-lg font-bold text-gray-900
                                           whitespace-nowrap"
                                >
                                    €{{ number_format($kleding->prijs, 2, ',', '.') }}
                                </div>

                            </div>


                            <p
                                class="mt-3 text-sm text-gray-500
                                       line-clamp-2 leading-relaxed"
                            >
                                {{ $kleding->omschrijving }}
                            </p>


                            {{-- Maten --}}
                            <div class="mt-5">

                                <p
                                    class="text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wide mb-2"
                                >
                                    Kies je maat
                                </p>


                                <div class="flex flex-wrap gap-2">

                                    @foreach($kleding->sizes as $size)

                                        <button
                                            wire:click="addToCart(
                                                {{ $kleding->id }},
                                                {{ $size->id }}
                                            )"

                                            @if($size->pivot->stock == 0)
                                                disabled
                                            @endif

                                            class="min-w-[54px]
                                                   px-3 py-2
                                                   rounded-xl
                                                   border
                                                   text-xs font-semibold
                                                   transition

                                                   {{ $size->pivot->stock == 0
                                                        ? 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed'
                                                        : 'bg-white text-gray-700 border-gray-200 hover:bg-green-600 hover:text-white hover:border-green-600'
                                                   }}"
                                        >

                                            {{ $size->size }}

                                            @if($size->pivot->stock > 0)
                                                <span class="ml-1 text-[10px] opacity-60">
                                                    {{ $size->pivot->stock }}
                                                </span>
                                            @endif

                                        </button>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </article>

                @empty

                    <div
                        class="sm:col-span-2 xl:col-span-3
                               bg-white rounded-2xl border
                               border-gray-200 p-12 text-center"
                    >

                        <div
                            class="w-16 h-16 mx-auto mb-4
                                   rounded-full bg-gray-100
                                   flex items-center justify-center
                                   text-2xl"
                        >
                            🔍
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg">
                            Geen producten gevonden
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Probeer een andere filter of maat.
                        </p>

                    </div>

                @endforelse

            </div>

        </main>

    </div>

</div>

