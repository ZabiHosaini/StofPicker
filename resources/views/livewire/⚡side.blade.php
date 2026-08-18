<?php

use Livewire\Component;

new class extends Component
{
    public int $cartCount = 0;

  public function mount()
  {
      $this->cartCount = count(session('cart', []));
  }

  #[On('cart-updated')]
  public function refreshCart()
  {
      $this->cartCount = count(session('cart', []));
  }
};
?>

<div class="min-h-screen bg-gray-50">

    <div class="flex min-h-screen">

        {{-- ================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ================================================= --}}

        <aside
            class="
                hidden lg:flex
                fixed left-0 top-0 bottom-0
                w-64
                bg-white
                border-r border-gray-200
                flex-col
                z-40
            "
        >

            {{-- Logo --}}
            <div class="h-20 px-5 flex items-center border-b border-gray-100">

                <a
                    href="/"
                    class="flex items-center gap-3"
                >

                    <div
                        class="
                            w-11 h-11
                            rounded-2xl
                            bg-green-100
                            flex items-center justify-center
                            text-2xl
                        "
                    >
                        🧵
                    </div>

                    <div>
                        <h1 class="font-bold text-lg text-gray-800">
                            Stoffen
                        </h1>

                        <p class="text-xs text-gray-400">
                            Beheer systeem
                        </p>
                    </div>

                </a>

            </div>


            {{-- Navigatie --}}
            <div class="flex-1 p-4 overflow-y-auto">

                <p
                    class="
                        px-3 mb-3
                        text-xs
                        font-semibold
                        uppercase
                        tracking-wider
                        text-gray-400
                    "
                >
                    Algemeen
                </p>


                <nav class="space-y-1">

                    {{-- Home --}}
                    {{-- <a
                        href="/"
                        class="
                            flex items-center gap-3
                            px-3 py-3
                            rounded-xl
                            text-gray-600
                            hover:bg-gray-50
                            hover:text-green-600
                            transition
                        "
                    >

                        <span class="text-xl">
                            🏠
                        </span>

                        <span class="font-medium">
                            Home
                        </span>

                    </a> --}}

                     {{-- Shop --}}
                     <a
                     href="/shop"
                     class="
                         flex items-center gap-3
                         px-3 py-3
                         rounded-xl
                         text-gray-600
                         hover:bg-green-50
                         hover:text-green-600
                         transition
                     "
                 >

                     <span class="text-xl">
                         🛒
                     </span>

                     <span class="font-medium">
                         Shop
                     </span>

                 </a>


                    {{-- Stoffen --}}
                    <a
                        href="/stoffen"
                        class="
                            flex items-center gap-3
                            px-3 py-3
                            rounded-xl
                            text-gray-600
                            hover:bg-green-50
                            hover:text-green-600
                            transition
                        "
                    >

                        <span class="text-xl">
                            🧵
                        </span>

                        <span class="font-medium">
                            Stoffen
                        </span>

                    </a>


                    {{-- Fabrikanten --}}
                    <a
                        href="/fabrikant"
                        class="
                            flex items-center gap-3
                            px-3 py-3
                            rounded-xl
                            text-gray-600
                            hover:bg-green-50
                            hover:text-green-600
                            transition
                        "
                    >

                        <span class="text-xl">
                            🏭
                        </span>

                        <span class="font-medium">
                            Leveranciers
                        </span>

                    </a>

                </nav>


                {{-- Wielrennen --}}
                <p
                    class="
                        px-3
                        mt-8 mb-3
                        text-xs
                        font-semibold
                        uppercase
                        tracking-wider
                        text-gray-400
                    "
                >
                kleding beheer 
                </p>


                <nav class="space-y-1">

                    {{-- Kleding lijst --}}
                    <a
                        href="/wielrennen"
                        class="
                            flex items-center gap-3
                            px-3 py-3
                            rounded-xl
                            text-gray-600
                            hover:bg-green-50
                            hover:text-green-600
                            transition
                        "
                    >

                        <span class="text-xl">
                            🚴
                        </span>

                        <span class="font-medium">
                            Kleding
                        </span>

                    </a>


                    {{-- Kleding toevoegen --}}
                    <a
                        href="/wielrennen/create"
                        class="
                            flex items-center gap-3
                            px-3 py-3
                            rounded-xl
                            text-gray-600
                            hover:bg-green-50
                            hover:text-green-600
                            transition
                        "
                    >

                        <span class="text-xl">
                            ➕
                        </span>

                        <span class="font-medium">
                            Kleding toevoegen
                        </span>

                    </a>
                    {{-- Mijn maat --}}
                    <a
                    href="{{ route('mijn-maat') }}"
                    class="
                        flex items-center gap-3
                        px-3 py-3
                        rounded-xl
                        text-gray-600
                        hover:bg-blue-50
                        hover:text-blue-600
                        transition
                    "
                    >

                    <span class="w-6 h-6 flex items-center justify-center">
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
                                d="M4 4h16v16H4z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 4v4M12 4v2M16 4v4M8 20v-4M12 20v-2M16 20v-4"
                            />
                        </svg>
                    </span>

                    <span class="font-medium">
                        Mijn maat
                    </span>

                    </a>


                   

                </nav>


                {{-- Overig --}}
                <p
                    class="
                        px-3
                        mt-8 mb-3
                        text-xs
                        font-semibold
                        uppercase
                        tracking-wider
                        text-gray-400
                    "
                >
                    Overig
                </p>


                <nav class="space-y-1">
                  <a
                      href="/over-website"
                      class="
                          flex items-center gap-3
                          px-3 py-3
                          rounded-xl
                          text-gray-600
                          hover:bg-green-50
                          hover:text-green-600
                          transition
                      "
                  >
                      <span class="text-xl">
                        🌐
                      </span>

                      <span class="font-medium">
                          Over website
                      </span>
                  </a>
                  <a
                      href="/over-mij"
                      class="
                          flex items-center gap-3
                          px-3 py-3
                          rounded-xl
                          text-gray-600
                          hover:bg-green-50
                          hover:text-green-600
                          transition
                      "
                  >
                      <span class="text-xl">
                          👨‍💻
                      </span>

                      <span class="font-medium">
                          Over mij
                      </span>
                  </a>




                    {{-- Contact --}}
                    <a
                        href="/contact"
                        class="
                            flex items-center gap-3
                            px-3 py-3
                            rounded-xl
                            text-gray-600
                            hover:bg-green-50
                            hover:text-green-600
                            transition
                        "
                    >

                        <span class="text-xl">
                            ✉️
                        </span>

                        <span class="font-medium">
                            Contact
                        </span>

                    </a>

                </nav>

            </div>


            {{-- Sidebar onderkant --}}
            <div class="p-4 border-t border-gray-100">

                <div
                    class="
                        bg-green-50
                        rounded-2xl
                        p-4
                    "
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="
                                w-10 h-10
                                rounded-xl
                                bg-green-100
                                flex items-center justify-center
                            "
                        >
                            💚
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-gray-800">
                                Voorraadbeheer
                            </p>

                            <p class="text-xs text-gray-500">
                                Alles onder controle
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </aside>


        {{-- ================================================= --}}
        {{-- CONTENT --}}
        {{-- ================================================= --}}

        <main class="w-full lg:ml-64">

            {{-- Mobiele sidebar --}}
            <div
                x-data="{ open: false }"
                class="lg:hidden"
            >

                {{-- Mobile navbar --}}
                <div
                    class="
                        h-16
                        bg-white
                        border-b border-gray-200
                        flex items-center
                        justify-between
                        px-4
                    "
                >

                    <button
                        @click="open = true"
                        class="
                            w-10 h-10
                            rounded-xl
                            bg-gray-100
                            flex items-center justify-center
                        "
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                    </button>


                    <span class="font-bold text-gray-800">
                        Stoffen
                    </span>


                    <div class="w-10"></div>

                </div>


                {{-- Mobile sidebar --}}
                <div
                    x-show="open"
                    x-transition
                    class="fixed inset-0 z-50"
                >

                    {{-- Overlay --}}
                    <div
                        @click="open = false"
                        class="
                            absolute inset-0
                            bg-black/40
                        "
                    ></div>


                    {{-- Menu --}}
                    <aside
                        class="
                            relative
                            w-72
                            h-full
                            bg-white
                            shadow-2xl
                            p-5
                        "
                    >

                        <div
                            class="
                                flex items-center
                                justify-between
                                mb-8
                            "
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="
                                        w-10 h-10
                                        rounded-xl
                                        bg-green-100
                                        flex items-center justify-center
                                    "
                                >
                                    🧵
                                </div>

                                <span class="font-bold text-gray-800">
                                    Stoffen
                                </span>

                            </div>


                            <button
                                @click="open = false"
                                class="
                                    w-9 h-9
                                    rounded-lg
                                    bg-gray-100
                                "
                            >
                                ✕
                            </button>

                        </div>


                        <nav class="h-16 bg-white border-b border-gray-200 shadow-sm px-4 lg:px-6">
                          <div class="h-full flex items-center justify-between">
                      
                              {{-- Links: sidebar button + titel --}}
                              <div class="flex items-center gap-4">
                      
                                  {{-- Sidebar toggle --}}
                                  <label
                                      for="my-drawer-4"
                                      class="btn btn-square btn-ghost text-gray-600 hover:bg-gray-100"
                                      aria-label="Open sidebar"
                                  >
                                      <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          fill="none"
                                          viewBox="0 0 24 24"
                                          stroke-width="2"
                                          stroke="currentColor"
                                          class="w-6 h-6"
                                      >
                                          <path
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M4 6h16M4 12h16M4 18h16"
                                          />
                                      </svg>
                                  </label>
                      
                                  {{-- Titel --}}
                                  <div class="hidden sm:block">
                                      <h1 class="text-lg font-bold text-gray-800">
                                          Stoffenbeheer
                                      </h1>
                      
                                      <p class="text-xs text-gray-400">
                                          Beheer je voorraad
                                      </p>
                                  </div>
                      
                              </div>
                      
                      
                              {{-- Midden: zoeken --}}
                              <div class="hidden md:block flex-1 max-w-xl mx-8">
                      
                                  <div class="relative">
                      
                                      <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                          fill="none"
                                          viewBox="0 0 24 24"
                                          stroke="currentColor"
                                      >
                                          <path
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                          />
                                      </svg>
                      
                                      <input
                                          type="text"
                                          placeholder="Zoeken..."
                                          class="w-full rounded-xl border border-gray-200
                                                 bg-gray-50 pl-10 pr-4 py-2.5
                                                 text-sm text-gray-700
                                                 outline-none
                                                 focus:bg-white
                                                 focus:border-green-400
                                                 focus:ring-4 focus:ring-green-100
                                                 transition"
                                      >
                      
                                  </div>
                      
                              </div>
                      
                      
                              {{-- Rechts --}}
                              <div class="flex items-center gap-2">
                      
                                  {{-- Stoffen --}}
                                  <a
                                      href="/stoffen"
                                      wire:current="text-green-600 bg-green-50"
                                      class="hidden lg:flex items-center gap-2 px-3 py-2
                                             rounded-xl text-sm font-medium text-gray-600
                                             hover:bg-gray-100 transition"
                                  >
                                      🧵
                                      Stoffen
                                  </a>
                      
                                  {{-- Leveranciers --}}
                                  <a
                                      href="/fabrikant"
                                      wire:current="text-green-600 bg-green-50"
                                      class="hidden lg:flex items-center gap-2 px-3 py-2
                                             rounded-xl text-sm font-medium text-gray-600
                                             hover:bg-gray-100 transition"
                                  >
                                      🏭
                                      Leveranciers
                                  </a>
                      
                                  {{-- Winkelwagen --}}
                                  <div x-data="{ open: false }" class="relative">
                      
                                      <button
                                          @click="open = !open"
                                          class="relative flex items-center justify-center
                                                 w-11 h-11 rounded-xl
                                                 bg-gray-50 text-gray-600
                                                 hover:bg-green-50 hover:text-green-600
                                                 transition"
                                      >
                      
                                          🛒
                      
                                          @if($cartCount > 0)
                                              <span
                                                  class="absolute -top-1 -right-1
                                                         min-w-5 h-5 px-1
                                                         flex items-center justify-center
                                                         rounded-full
                                                         bg-green-600 text-white
                                                         text-xs font-bold"
                                              >
                                                  {{ $cartCount }}
                                              </span>
                                          @endif
                      
                                      </button>
                      
                      
                                      {{-- Cart dropdown --}}
                                      <div
                                          x-show="open"
                                          @click.outside="open = false"
                                          x-transition
                                          class="absolute right-0 mt-3 w-80
                                                 bg-white rounded-2xl
                                                 shadow-xl border border-gray-100
                                                 overflow-hidden z-50"
                                      >
                      
                                          <div class="px-4 py-3 border-b border-gray-100">
                                              <h3 class="font-bold text-gray-800">
                                                  Mijn winkelwagen
                                              </h3>
                      
                                              <p class="text-xs text-gray-400">
                                                  {{ $cartCount }} artikel(en)
                                              </p>
                                          </div>
                      
                      
                                          @forelse(session('cart', []) as $key => $value)
                      
                                              <div class="flex gap-3 px-4 py-4 border-b border-gray-100">
                      
                                                  <img
                                                      src="{{ asset('storage/wielrennen/visma.jpg') }}"
                                                      class="w-12 h-12 rounded-xl object-cover"
                                                      alt=""
                                                  >
                      
                                                  <div>
                                                      <p class="text-sm font-semibold text-gray-800">
                                                          {{ $value['name'] }}
                                                      </p>
                      
                                                      <p class="text-xs text-gray-500">
                                                          Aantal: {{ $value['aantalen'] }}
                                                      </p>
                      
                                                      <p class="text-xs text-green-600 font-semibold">
                                                          €{{ $value['prijs'] }}
                                                      </p>
                                                  </div>
                      
                                              </div>
                      
                                          @empty
                      
                                              <div class="px-4 py-8 text-center">
                                                  <div class="text-3xl mb-2">
                                                      🛒
                                                  </div>
                      
                                                  <p class="text-sm text-gray-500">
                                                      Je winkelwagen is leeg.
                                                  </p>
                                              </div>
                      
                                          @endforelse
                      
                      
                                          @if($cartCount > 0)
                      
                                              <div class="p-4">
                      
                                                  <a
                                                      href="{{ route('cart') }}"
                                                      class="block w-full text-center
                                                             bg-green-600 hover:bg-green-700
                                                             text-white font-semibold
                                                             rounded-xl py-2.5
                                                             transition"
                                                  >
                                                      Bekijk winkelwagen
                                                  </a>
                      
                                              </div>
                      
                                          @endif
                      
                                      </div>
                      
                                  </div>
                      
                              </div>
                      
                          </div>
                      </nav>

                    </aside>

                </div>

            </div>


            {{-- Pagina --}}
            <div class="p-4 sm:p-6 lg:p-8">

                {{ $slot }}

            </div>

        </main>

    </div>

</div>