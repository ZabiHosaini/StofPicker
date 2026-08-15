
<?php

use Livewire\Component;

new class extends Component
{
    public function logout()
    {
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        return $this->redirectRoute('login');
    }
};
?>

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">

        <div class="flex flex-col md:flex-row md:items-center gap-6">

            {{-- Avatar --}}
            <div class="w-24 h-24 rounded-3xl
                        bg-green-100
                        flex items-center justify-center
                        text-5xl">
                👤
            </div>

            {{-- User information --}}
            <div class="flex-1">

                <p class="text-green-600 font-semibold mb-2">
                    Mijn account
                </p>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                    Welkom, {{ auth()->user()->name }}
                </h1>

                <p class="text-gray-500 mt-2">
                    Beheer hier je profiel, account en bestellingen.
                </p>

            </div>

            {{-- Logout --}}
            <button
                wire:click="logout"
                wire:confirm="Weet je zeker dat je wilt uitloggen?"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-3
                       rounded-xl
                       bg-red-50
                       text-red-600
                       font-semibold
                       hover:bg-red-100
                       transition"
            >
                🚪
                Uitloggen
            </button>

        </div>

    </div>


    {{-- Profile information --}}
    <div class="grid lg:grid-cols-3 gap-8 mb-8">

        {{-- Main profile --}}
        <div class="lg:col-span-2
                    bg-white rounded-3xl
                    shadow-sm
                    border border-gray-100
                    p-8">

            <div class="flex items-center gap-4 mb-7">

                <div class="w-12 h-12 rounded-xl
                            bg-green-100
                            flex items-center justify-center
                            text-2xl">
                    👤
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Profielgegevens
                    </h2>

                    <p class="text-sm text-gray-400 mt-1">
                        Je accountinformatie
                    </p>
                </div>

            </div>


            <div class="space-y-5">

                {{-- Name --}}
                <div>

                    <label class="block text-sm font-semibold
                                  text-gray-600 mb-2">
                        Naam
                    </label>

                    <div class="px-4 py-3 rounded-xl
                                bg-gray-50
                                border border-gray-200
                                text-gray-800">
                        {{ auth()->user()->name }}
                    </div>

                </div>


                {{-- Email --}}
                <div>

                    <label class="block text-sm font-semibold
                                  text-gray-600 mb-2">
                        E-mailadres
                    </label>

                    <div class="px-4 py-3 rounded-xl
                                bg-gray-50
                                border border-gray-200
                                text-gray-800">
                        {{ auth()->user()->email }}
                    </div>

                </div>


                {{-- Account created --}}
                <div>

                    <label class="block text-sm font-semibold
                                  text-gray-600 mb-2">
                        Account aangemaakt
                    </label>

                    <div class="px-4 py-3 rounded-xl
                                bg-gray-50
                                border border-gray-200
                                text-gray-600">
                        {{ auth()->user()->created_at?->format('d-m-Y') }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Status --}}
        <div class="bg-white rounded-3xl
                    shadow-sm
                    border border-gray-100
                    p-8">

            <div class="w-12 h-12 rounded-xl
                        bg-blue-100
                        flex items-center justify-center
                        text-2xl mb-5">
                🛡️
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                Accountstatus
            </h2>

            <p class="text-gray-500 text-sm leading-6 mt-2">
                Je bent momenteel ingelogd op je StoffenApp-account.
            </p>

            <div class="mt-6 p-4 rounded-2xl bg-green-50">

                <div class="flex items-center gap-3">

                    <span class="w-3 h-3 rounded-full bg-green-500"></span>

                    <span class="font-semibold text-green-700">
                        Account actief
                    </span>

                </div>

            </div>

            <div class="mt-5">

                <p class="text-sm text-gray-400">
                    Ingelogd als
                </p>

                <p class="font-semibold text-gray-700 mt-1 break-all">
                    {{ auth()->user()->email }}
                </p>

            </div>

        </div>

    </div>


    {{-- Quick actions --}}
    <div class="bg-white rounded-3xl
                shadow-sm
                border border-gray-100
                p-8 mb-8">

        <div class="mb-7">

            <p class="text-green-600 font-semibold text-sm">
                Mijn account
            </p>

            <h2 class="text-2xl font-bold text-gray-800 mt-1">
                Snelle acties
            </h2>

            <p class="text-gray-500 mt-2">
                Ga snel naar de belangrijkste onderdelen van StoffenApp.
            </p>

        </div>


        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

            {{-- Shop --}}
            <a
                href="{{ route('shop') }}"
                class="group p-6 rounded-2xl
                       bg-gray-50
                       border border-gray-100
                       hover:bg-green-50
                       hover:border-green-200
                       transition"
            >

                <div class="text-3xl mb-4">
                    🛍️
                </div>

                <h3 class="font-bold text-gray-800">
                    Shop
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Bekijk stoffen, matten en andere producten.
                </p>

                <p class="text-green-600 font-semibold text-sm mt-4">
                    Naar shop →
                </p>

            </a>


            {{-- Cart --}}
            <a
                href="{{ route('cart') }}"
                class="group p-6 rounded-2xl
                       bg-gray-50
                       border border-gray-100
                       hover:bg-purple-50
                       hover:border-purple-200
                       transition"
            >

                <div class="text-3xl mb-4">
                    🛒
                </div>

                <h3 class="font-bold text-gray-800">
                    Winkelwagen
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Bekijk de producten die je hebt geselecteerd.
                </p>

                <p class="text-green-600 font-semibold text-sm mt-4">
                    Naar winkelwagen →
                </p>

            </a>


            {{-- Orders --}}
            <a
            href="{{ route('orders') }}"
                class="group p-6 rounded-2xl
                       bg-gray-50
                       border border-gray-100
                       hover:bg-blue-50
                       hover:border-blue-200
                       transition"
            >

                <div class="text-3xl mb-4">
                    📦
                </div>

                <h3 class="font-bold text-gray-800">
                    Mijn bestellingen
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Bekijk je eerdere bestellingen en bestelinformatie.
                </p>

                <p class="text-green-600 font-semibold text-sm mt-4">
                    Bestellingen bekijken →
                </p>

            </a>

        </div>

    </div>


    {{-- Security --}}
    <div class="bg-white rounded-3xl
                shadow-sm
                border border-gray-100
                p-8 mb-8">

        <div class="flex items-center gap-4 mb-7">

            <div class="w-12 h-12 rounded-xl
                        bg-red-100
                        flex items-center justify-center
                        text-2xl">
                🔐
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Accountbeveiliging
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Beheer de beveiliging van je account.
                </p>

            </div>

        </div>


        <div class="grid md:grid-cols-2 gap-5">

            <div class="p-6 rounded-2xl bg-gray-50">

                <div class="text-2xl mb-3">
                    🔑
                </div>

                <h3 class="font-bold text-gray-800">
                    Wachtwoord
                </h3>

                <p class="text-sm text-gray-500 mt-2 leading-6">
                    Houd je account veilig met een sterk wachtwoord.
                </p>

                <a
                    href="{{ route('wachtwoord') }}"
                    class="mt-4 inline-flex items-center
                        text-green-600
                        font-semibold text-sm
                        hover:text-green-700"
                >
                    Wachtwoord wijzigen →
                </a>

            </div>


            <div class="p-6 rounded-2xl bg-gray-50">

                <div class="text-2xl mb-3">
                    📧
                </div>

                <h3 class="font-bold text-gray-800">
                    E-mailadres
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Je account gebruikt:
                </p>

                <p class="font-semibold text-gray-700 mt-2 break-all">
                    {{ auth()->user()->email }}
                </p>

            </div>

        </div>

    </div>


    {{-- Logout --}}
    <div class="bg-red-50
                border border-red-100
                rounded-3xl
                p-8">

        <div class="flex flex-col md:flex-row
                    md:items-center
                    md:justify-between gap-5">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Uitloggen
                </h2>

                <p class="text-gray-500 mt-1">
                    Je kunt veilig uitloggen wanneer je klaar bent.
                </p>

            </div>

            <button
                wire:click="logout"
                wire:confirm="Weet je zeker dat je wilt uitloggen?"
                class="inline-flex items-center justify-center gap-2
                       px-6 py-3
                       rounded-xl
                       bg-red-600
                       text-white
                       font-semibold
                       hover:bg-red-700
                       transition"
            >
                🚪
                Uitloggen
            </button>

        </div>

    </div>

</div>
