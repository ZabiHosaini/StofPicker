<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Stof;

new class extends Component
{
    public int $cartCount = 0;
    public string $search = '';

    public function mount()
    {
        $this->cartCount = count(session('cart', []));
    }

    #[On('cart-updated')]
    public function refreshCart()
    {
        $this->cartCount = count(session('cart', []));
    }

    public function getSearchResultsProperty()
    {
        return Stof::where('name', 'like', '%' . $this->search . '%')
            ->limit(8)
            ->get();
    }
};
?>

<nav class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">

    <div class="flex items-center justify-between h-20 px-4 sm:px-6 lg:px-8">

        {{-- =========================
             LINKS: LOGO + ZOEKEN
        ========================== --}}
        <div class="flex items-center gap-6">

            {{-- Logo --}}
            <a
                href="/"
                class="flex items-center gap-3 group"
            >

                <div class="w-11 h-11 rounded-2xl overflow-hidden
                            bg-green-100 flex items-center justify-center
                            shadow-sm group-hover:shadow-md transition">

                    <img
                        src="{{ asset('images/fabric.jpg') }}"
                        alt="Logo"
                        class="w-full h-full object-cover"
                    >

                </div>

                <div class="hidden sm:block">
                    <h1 class="text-lg font-bold text-gray-800">
                        StoffenApp
                    </h1>

                    <p class="text-xs text-gray-400">
                        Stoffen & kleding
                    </p>
                </div>

            </a>


           
                        {{-- Zoekbalk --}}
            <div class="relative hidden md:block">

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
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Zoeken..."
                    class="w-64 lg:w-80 rounded-xl
                        border border-gray-200
                        bg-gray-50
                        pl-11 pr-4 py-2.5
                        text-sm text-gray-700
                        placeholder-gray-400
                        outline-none
                        focus:bg-white
                        focus:border-green-400
                        focus:ring-4
                        focus:ring-green-100
                        transition"
                >

                {{-- Zoekresultaten --}}
                @if(strlen($search) >= 2)

                    <div
                        class="absolute top-full left-0 mt-3
                            w-80 lg:w-96
                            bg-white
                            rounded-2xl
                            border border-gray-200
                            shadow-2xl
                            overflow-hidden
                            z-50"
                    >

                        <div class="px-4 py-3 border-b border-gray-100">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Zoekresultaten
                            </p>

                            <p class="text-sm text-gray-700 mt-1">
                                Resultaten voor:
                                <span class="font-semibold text-green-600">
                                    {{ $search }}
                                </span>
                            </p>

                        </div>


                        {{-- Resultaten --}}
                        <div class="max-h-80 overflow-y-auto">

                            @forelse($this->searchResults as $stof)

                                <a
                                    href="{{ route('stof.show', $stof->id) }}"
                                    class="flex items-center gap-3 px-4 py-3
                                        hover:bg-gray-50 transition
                                        border-b border-gray-100"
                                >

                                    {{-- Afbeelding --}}
                                    <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">

                                        @if(!empty($stof->foto))
                                            <img
                                                src="{{ asset('storage/' . $stof->foto) }}"
                                                alt="{{ $stof->name }}"
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                🧵
                                            </div>
                                        @endif

                                    </div>


                                    {{-- Naam --}}
                                    <div class="min-w-0">

                                        <p class="font-semibold text-gray-800 truncate">
                                            {{ $stof->name }}
                                        </p>

                                        @if(isset($stof->prijs))
                                            <p class="text-sm text-green-600 font-medium">
                                                €{{ number_format($stof->prijs, 2, ',', '.') }}
                                            </p>
                                        @endif

                                    </div>

                                </a>

                            @empty

                                <div class="px-5 py-8 text-center">

                                    <div class="text-3xl mb-2">
                                        🔍
                                    </div>

                                    <p class="font-semibold text-gray-700">
                                        Geen stoffen gevonden
                                    </p>

                                    <p class="text-sm text-gray-400 mt-1">
                                        Probeer een andere zoekterm.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- =========================
             RECHTS
        ========================== --}}
        <div class="flex items-center gap-3">

            {{-- Mobile search --}}
            <button
                class="md:hidden w-10 h-10
                       flex items-center justify-center
                       rounded-xl
                       bg-gray-100
                       text-gray-600
                       hover:bg-gray-200
                       transition"
                title="Zoeken"
            >

                <svg
                    class="w-5 h-5"
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

            </button>


            {{-- Winkelwagen --}}
            <div
                x-data="{ open: false }"
                class="relative"
            >

                <button
                    @click="open = !open"
                    class="relative flex items-center gap-2
                           h-11 px-4
                           rounded-xl
                           bg-gray-50
                           border border-gray-200
                           text-gray-700
                           hover:bg-gray-100
                           hover:border-gray-300
                           transition"
                >

                    {{-- Cart icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                        />
                    </svg>


                    <span class="hidden sm:inline font-semibold">
                        Winkelwagen
                    </span>


                    {{-- Badge --}}
                    @if($cartCount > 0)

                        <span
                            class="min-w-6 h-6 px-1.5
                                   flex items-center justify-center
                                   rounded-full
                                   bg-green-600
                                   text-white
                                   text-xs
                                   font-bold"
                        >
                            {{ $cartCount }}
                        </span>

                    @endif


                    {{-- Arrow --}}
                    <svg
                        class="w-4 h-4 text-gray-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd"
                        />
                    </svg>

                </button>


                {{-- =========================
                     CART DROPDOWN
                ========================== --}}
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-3
                           w-80 sm:w-96
                           bg-white
                           border border-gray-200
                           rounded-2xl
                           shadow-2xl
                           overflow-hidden
                           z-50"
                >

                    {{-- Header --}}
                    <div
                        class="px-5 py-4
                               border-b border-gray-100
                               flex items-center justify-between"
                    >

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Winkelwagen
                            </h3>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $cartCount }} artikel(en)
                            </p>
                        </div>

                        <span
                            class="w-9 h-9
                                   rounded-xl
                                   bg-green-100
                                   text-green-600
                                   flex items-center justify-center"
                        >
                            🛒
                        </span>

                    </div>


                    {{-- Cart items --}}
                    <div class="max-h-80 overflow-y-auto">

                        @forelse(session('cart', []) as $key => $value)

                            <div
                                class="flex items-center gap-3
                                       px-5 py-4
                                       border-b border-gray-100
                                       hover:bg-gray-50
                                       transition"
                            >

                            <div class="flex items-center gap-3 p-3">

                                <img
                                    class="h-14 w-14 object-cover rounded-xl bg-gray-100 ring-1 ring-gray-200"
                                    src="{{ asset('storage/wielrennen/visma.jpg') }}"
                                    alt="{{ $value['name'] }}"
                                >
                            
                                <div class="flex-1 min-w-0">
                            
                                    <p class="text-sm font-semibold text-gray-800 truncate">
                                        {{ $value['name'] }}
                                    </p>
                            
                                    <p class="text-xs text-gray-400 mt-1">
                                        Aantal: {{ $value['aantalen'] }}
                                    </p>
                            
                                    <p class="text-sm font-bold text-green-600 mt-1">
                                        €{{ number_format($value['prijs'], 2, ',', '.') }}
                                    </p>
                            
                                </div>
                            
                            </div>

                            </div>

                        @empty

                            <div class="px-5 py-10 text-center">

                                <div
                                    class="w-14 h-14 mx-auto
                                           rounded-2xl
                                           bg-gray-100
                                           flex items-center justify-center
                                           mb-3"
                                >
                                    🛒
                                </div>

                                <p class="font-semibold text-gray-700">
                                    Je winkelwagen is leeg
                                </p>

                                <p class="text-sm text-gray-400 mt-1">
                                    Voeg een product toe aan je winkelwagen.
                                </p>

                            </div>

                        @endforelse

                    </div>


                    {{-- Footer --}}
                    @if($cartCount > 0)

                        <div class="p-4 bg-gray-50 border-t border-gray-100">

                            <a
                                href="{{ route('cart') }}"
                                class="w-full
                                       inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-green-600
                                       px-4 py-3
                                       text-white
                                       font-semibold
                                       hover:bg-green-700
                                       transition"
                            >
                                Winkelwagen bekijken

                                <span>
                                    →
                                </span>

                            </a>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Profiel --}}
@auth
<div
    x-data="{ open: false }"
    class="relative"
>

    <button
        @click="open = !open"
        class="hidden sm:flex
               w-11 h-11
               items-center justify-center
               rounded-xl
               bg-green-100
               text-green-700
               font-bold
               hover:bg-green-200
               transition"
        title="Profiel"
    >
        👤
    </button>

    {{-- Profiel menu --}}
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute right-0 mt-3 w-64
               bg-white
               border border-gray-200
               rounded-2xl
               shadow-2xl
               overflow-hidden
               z-50"
    >

        {{-- User --}}
        <div class="px-5 py-4 border-b border-gray-100">

            <p class="font-bold text-gray-800">
                {{ auth()->user()->name }}
            </p>

            <p class="text-sm text-gray-400 mt-1 truncate">
                {{ auth()->user()->email }}
            </p>

        </div>

        {{-- Profile --}}
        <a
            href="{{ route('profile') }}"
            class="flex items-center gap-3
                   px-5 py-3
                   text-gray-700
                   hover:bg-gray-50
                   transition"
        >
            <span class="text-xl">👤</span>

            <span class="font-medium">
                Mijn profiel
            </span>
        </a>

        {{-- Orders --}}
        <a
            href="{{ route('orders') }}"
            class="flex items-center gap-3
                   px-5 py-3
                   text-gray-700
                   hover:bg-gray-50
                   transition"
        >
            <span class="text-xl">📦</span>

            <span class="font-medium">
                Mijn bestellingen
            </span>
        </a>

        {{-- Logout --}}
        <div class="border-t border-gray-100">

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="w-full
                           flex items-center gap-3
                           px-5 py-3
                           text-red-600
                           hover:bg-red-50
                           transition
                           text-left"
                >
                    <span class="text-xl">🚪</span>

                    <span class="font-medium">
                        Uitloggen
                    </span>

                </button>

            </form>

        </div>

    </div>

</div>

@else

{{-- Niet ingelogd --}}
<a
    href="{{ route('login') }}"
    class="hidden sm:flex
           w-11 h-11
           items-center justify-center
           rounded-xl
           bg-green-100
           text-green-700
           font-bold
           hover:bg-green-200
           transition"
    title="Inloggen"
>
    👤
</a>

@endauth
    
</a>

        </div>

    </div>

</nav>