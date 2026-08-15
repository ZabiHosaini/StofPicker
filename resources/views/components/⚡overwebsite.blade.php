
<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">

        <div class="flex flex-col md:flex-row items-center gap-8">

            <div class="w-28 h-28 rounded-3xl bg-green-100
                        flex items-center justify-center text-6xl">
                🧵
            </div>

            <div>

                <p class="text-green-600 font-semibold mb-2">
                    Over deze website
                </p>

                <h1 class="text-4xl font-bold text-gray-800 mb-3">
                    Welkom bij StoffenApp
                </h1>

                <p class="text-lg text-gray-500 max-w-3xl leading-relaxed">
                    StoffenApp is een moderne webapplicatie waarmee gebruikers
                    eenvoudig stoffen, matten en andere producten kunnen
                    bekijken, zoeken en beheren. De website is ontworpen om
                    producten overzichtelijk te presenteren en het vinden van
                    de juiste informatie zo eenvoudig mogelijk te maken.
                </p>

            </div>

        </div>

    </div>


    {{-- Wat is StoffenApp --}}
    <div class="grid md:grid-cols-2 gap-8 mb-8">

        <div class="bg-white rounded-3xl shadow-sm
                    border border-gray-100 p-8">

            <div class="w-12 h-12 rounded-xl bg-green-100
                        flex items-center justify-center text-2xl mb-5">
                🧵
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Wat is StoffenApp?
            </h2>

            <p class="text-gray-600 leading-7 mb-4">
                StoffenApp is ontwikkeld als een overzichtelijke en
                gebruiksvriendelijke webshop voor het bekijken van
                verschillende producten. De applicatie maakt het mogelijk
                om producten op een duidelijke manier te presenteren,
                zodat bezoekers snel kunnen zien wat er beschikbaar is.
            </p>

            <p class="text-gray-600 leading-7">
                Naast het bekijken van producten kunnen gebruikers producten
                zoeken, productinformatie bekijken en producten toevoegen
                aan hun winkelwagen. Hierdoor vormt StoffenApp één centrale
                plek voor het ontdekken en beheren van producten.
            </p>

        </div>


        <div class="bg-white rounded-3xl shadow-sm
                    border border-gray-100 p-8">

            <div class="w-12 h-12 rounded-xl bg-blue-100
                        flex items-center justify-center text-2xl mb-5">
                🎯
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Het doel van de website
            </h2>

            <p class="text-gray-600 leading-7 mb-4">
                Het belangrijkste doel van StoffenApp is om producten op een
                eenvoudige, moderne en overzichtelijke manier beschikbaar
                te maken voor bezoekers.
            </p>

            <p class="text-gray-600 leading-7">
                De gebruiker hoeft niet door veel verschillende pagina's te
                zoeken. Dankzij de shop, zoekfunctie en winkelwagen kunnen
                belangrijke functies snel worden gevonden en gebruikt.
            </p>

        </div>

    </div>


    {{-- Shop uitleg --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-start gap-4 mb-6">

            <div class="w-12 h-12 rounded-xl bg-green-100
                        flex items-center justify-center text-2xl shrink-0">
                🛍️
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    De Shop
                </h2>

                <p class="text-green-600 font-medium mt-1">
                    Producten overzichtelijk bekijken
                </p>

            </div>

        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-gray-600 leading-7 mb-4">
                    De shop is het centrale onderdeel van StoffenApp.
                    Hier kunnen bezoekers verschillende producten bekijken.
                    Elk product kan worden voorzien van belangrijke informatie,
                    zoals de naam, prijs, afbeelding, voorraad en beschrijving.
                </p>

                <p class="text-gray-600 leading-7">
                    De producten worden op een overzichtelijke manier
                    weergegeven zodat bezoekers eenvoudig verschillende
                    producten kunnen vergelijken en een product kunnen
                    selecteren voor meer informatie.
                </p>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <h3 class="font-bold text-gray-800 mb-4">
                    Wat kan de gebruiker in de shop?
                </h3>

                <ul class="space-y-3 text-gray-600">

                    <li class="flex gap-3">
                        <span class="text-green-600">✓</span>
                        Producten bekijken
                    </li>

                    <li class="flex gap-3">
                        <span class="text-green-600">✓</span>
                        Productafbeeldingen bekijken
                    </li>

                    <li class="flex gap-3">
                        <span class="text-green-600">✓</span>
                        Prijzen bekijken
                    </li>

                    <li class="flex gap-3">
                        <span class="text-green-600">✓</span>
                        Beschikbaarheid controleren
                    </li>

                    <li class="flex gap-3">
                        <span class="text-green-600">✓</span>
                        Productdetails openen
                    </li>

                    <li class="flex gap-3">
                        <span class="text-green-600">✓</span>
                        Product toevoegen aan de cart
                    </li>

                </ul>

            </div>

        </div>

    </div>


    {{-- Matten --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-12 h-12 rounded-xl bg-orange-100
                        flex items-center justify-center text-2xl">
                🧶
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Matten en stoffen
                </h2>

                <p class="text-orange-600 font-medium mt-1">
                    Verschillende producten binnen één platform
                </p>

            </div>

        </div>

        <p class="text-gray-600 leading-7 mb-4">
            Binnen StoffenApp kunnen verschillende soorten producten worden
            aangeboden. Een belangrijk onderdeel hiervan zijn matten en
            stoffen. Deze producten kunnen ieder hun eigen informatie,
            afbeeldingen, prijzen en beschikbaarheid hebben.
        </p>

        <p class="text-gray-600 leading-7">
            Door producten duidelijk te categoriseren blijft de shop
            overzichtelijk. Hierdoor kan een bezoeker gemakkelijker bepalen
            welk type product hij of zij zoekt en vervolgens de bijbehorende
            productinformatie bekijken.
        </p>

    </div>


    {{-- Search --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-12 h-12 rounded-xl bg-blue-100
                        flex items-center justify-center text-2xl">
                🔍
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Live Search
                </h2>

                <p class="text-blue-600 font-medium mt-1">
                    Snel producten vinden
                </p>

            </div>

        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-gray-600 leading-7 mb-4">
                    StoffenApp beschikt over een zoekfunctie waarmee
                    bezoekers snel naar producten kunnen zoeken. De
                    zoekfunctie is bedoeld om het zoeken naar een specifiek
                    product eenvoudiger en sneller te maken.
                </p>

                <p class="text-gray-600 leading-7">
                    Bij een live search kan de gebruiker tijdens het typen
                    direct relevante resultaten zien. Hierdoor hoeft de
                    gebruiker niet telkens een volledige pagina opnieuw te
                    laden.
                </p>

            </div>

            <div class="bg-blue-50 rounded-2xl p-6">

                <h3 class="font-bold text-gray-800 mb-4">
                    De zoekfunctie kan zoeken op:
                </h3>

                <div class="space-y-3 text-gray-600">

                    <div class="flex items-center gap-3">
                        <span class="text-xl">🔎</span>
                        Productnaam
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xl">🏷️</span>
                        Categorie
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xl">🧶</span>
                        Type product
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xl">💰</span>
                        Productinformatie
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Cart --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-12 h-12 rounded-xl bg-purple-100
                        flex items-center justify-center text-2xl">
                🛒
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Winkelwagen / Cart
                </h2>

                <p class="text-purple-600 font-medium mt-1">
                    Producten bewaren en beheren
                </p>

            </div>

        </div>

        <p class="text-gray-600 leading-7 mb-4">
            Wanneer een bezoeker een product interessant vindt, kan het
            product worden toegevoegd aan de winkelwagen. De cart geeft
            vervolgens een overzicht van de geselecteerde producten.
        </p>

        <p class="text-gray-600 leading-7 mb-6">
            Binnen de winkelwagen kunnen producten worden gecontroleerd en
            kunnen aantallen worden aangepast. Hierdoor heeft de gebruiker
            altijd een duidelijk overzicht van de geselecteerde producten
            voordat een bestelling verder wordt verwerkt.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-gray-50 rounded-2xl p-5">
                <div class="text-2xl mb-2">➕</div>
                <h3 class="font-bold text-gray-800">
                    Toevoegen
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Producten aan de winkelwagen toevoegen.
                </p>
            </div>

            <div class="bg-gray-50 rounded-2xl p-5">
                <div class="text-2xl mb-2">🔢</div>
                <h3 class="font-bold text-gray-800">
                    Aantal aanpassen
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Het aantal producten wijzigen.
                </p>
            </div>

            <div class="bg-gray-50 rounded-2xl p-5">
                <div class="text-2xl mb-2">🗑️</div>
                <h3 class="font-bold text-gray-800">
                    Verwijderen
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Producten uit de cart verwijderen.
                </p>
            </div>

            <div class="bg-gray-50 rounded-2xl p-5">
                <div class="text-2xl mb-2">💰</div>
                <h3 class="font-bold text-gray-800">
                    Totaal
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Het totale bedrag overzichtelijk bekijken.
                </p>
            </div>

        </div>

    </div>


    {{-- Product informatie --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-12 h-12 rounded-xl bg-yellow-100
                        flex items-center justify-center text-2xl">
                📦
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Productinformatie
                </h2>

                <p class="text-yellow-600 font-medium mt-1">
                    Alles wat je over een product wilt weten
                </p>

            </div>

        </div>

        <p class="text-gray-600 leading-7 mb-6">
            Elk product kan uitgebreide informatie bevatten. Het doel
            hiervan is dat een bezoeker voldoende informatie heeft om
            een product goed te kunnen bekijken en vergelijken.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

            @foreach([
                ['icon' => '🏷️', 'title' => 'Productnaam', 'text' => 'De naam van het product wordt duidelijk weergegeven.'],
                ['icon' => '💰', 'title' => 'Prijs', 'text' => 'De actuele prijs van het product kan worden bekeken.'],
                ['icon' => '📦', 'title' => 'Voorraad', 'text' => 'De beschikbaarheid van het product kan worden weergegeven.'],
                ['icon' => '🖼️', 'title' => 'Afbeelding', 'text' => 'Producten kunnen met duidelijke afbeeldingen worden getoond.'],
                ['icon' => '📝', 'title' => 'Beschrijving', 'text' => 'Een product kan een uitgebreide omschrijving bevatten.'],
                ['icon' => '🧶', 'title' => 'Categorie', 'text' => 'Producten kunnen worden ingedeeld in verschillende categorieën.'],
            ] as $item)

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="text-2xl mb-3">
                        {{ $item['icon'] }}
                    </div>

                    <h3 class="font-bold text-gray-800">
                        {{ $item['title'] }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-6">
                        {{ $item['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>


    {{-- Gebruikerservaring --}}
    <div class="grid md:grid-cols-2 gap-8 mb-8">

        <div class="bg-white rounded-3xl shadow-sm
                    border border-gray-100 p-8">

            <div class="w-12 h-12 rounded-xl bg-pink-100
                        flex items-center justify-center text-2xl mb-5">
                ❤️
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Gebruiksvriendelijkheid
            </h2>

            <p class="text-gray-600 leading-7">
                Bij de ontwikkeling van StoffenApp staat gebruiksgemak
                centraal. De interface is overzichtelijk opgebouwd en
                belangrijke functies zoals de shop, zoekfunctie en
                winkelwagen zijn gemakkelijk bereikbaar.
            </p>

        </div>


        <div class="bg-white rounded-3xl shadow-sm
                    border border-gray-100 p-8">

            <div class="w-12 h-12 rounded-xl bg-indigo-100
                        flex items-center justify-center text-2xl mb-5">
                📱
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Responsive ontwerp
            </h2>

            <p class="text-gray-600 leading-7">
                De website is ontworpen om goed te werken op verschillende
                schermformaten. Hierdoor kan StoffenApp worden gebruikt
                op een desktop, laptop, tablet en mobiele telefoon.
            </p>

        </div>

    </div>


    {{-- Technologie --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-11 h-11 rounded-xl bg-purple-100
                        flex items-center justify-center text-2xl">
                ⚙️
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Gebruikte technologie
                </h2>

                <p class="text-gray-500 mt-1">
                    Moderne technologie voor een betrouwbare webapplicatie
                </p>

            </div>

        </div>

        <p class="text-gray-600 leading-7 mb-6">
            StoffenApp is ontwikkeld met verschillende moderne
            webtechnologieën. Iedere technologie heeft een eigen rol
            binnen de applicatie en draagt bij aan de werking,
            snelheid en gebruiksvriendelijkheid van de website.
        </p>

        <div class="flex flex-wrap gap-3">

            @foreach([
                'Laravel',
                'PHP',
                'Livewire',
                'Blade',
                'Tailwind CSS',
                'MySQL',
                'JavaScript',
                'Alpine.js'
            ] as $technology)

                <span class="px-4 py-2 rounded-xl
                             bg-gray-50 border border-gray-200
                             text-gray-700 font-medium">
                    {{ $technology }}
                </span>

            @endforeach

        </div>

    </div>


    {{-- Waarom deze website --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="w-12 h-12 rounded-xl bg-blue-100
                    flex items-center justify-center text-2xl mb-5">
            💻
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Waarom deze website?
        </h2>

        <p class="text-gray-600 leading-7 mb-4">
            StoffenApp is ontwikkeld als praktisch ICT-project waarin
            verschillende onderdelen van moderne webdevelopment samenkomen.
            Het project laat zien hoe een webapplicatie kan worden opgebouwd
            met een database, backend, frontend en interactieve functies.
        </p>

        <p class="text-gray-600 leading-7">
            Naast het technische gedeelte is er aandacht besteed aan
            een duidelijke gebruikerservaring. De bezoeker moet zonder
            ingewikkelde stappen producten kunnen vinden, informatie
            kunnen bekijken en producten kunnen beheren in de winkelwagen.
        </p>

    </div>


    {{-- Toekomst --}}
    <div class="bg-white rounded-3xl shadow-sm
                border border-gray-100 p-8 mb-8">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-12 h-12 rounded-xl bg-green-100
                        flex items-center justify-center text-2xl">
                🚀
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Mogelijkheden voor de toekomst
                </h2>

                <p class="text-green-600 font-medium mt-1">
                    StoffenApp kan verder worden uitgebreid
                </p>

            </div>

        </div>

        <p class="text-gray-600 leading-7 mb-5">
            De huidige structuur van StoffenApp biedt een goede basis
            voor verdere ontwikkeling. In de toekomst kunnen extra
            functies worden toegevoegd om de webshop nog completer
            te maken.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

            @foreach([
                ['icon' => '👤', 'title' => 'Gebruikersaccounts', 'text' => 'Registreren, inloggen en persoonlijke gegevens beheren.'],
                ['icon' => '❤️', 'title' => 'Wishlist', 'text' => 'Favoriete producten bewaren voor later.'],
                ['icon' => '💳', 'title' => 'Online betalen', 'text' => 'Een volledige betaalfunctie integreren.'],
                ['icon' => '📦', 'title' => 'Bestellingen', 'text' => 'Bestellingen bekijken en orderstatus volgen.'],
                ['icon' => '⭐', 'title' => 'Reviews', 'text' => 'Klanten kunnen producten beoordelen.'],
                ['icon' => '📊', 'title' => 'Dashboard', 'text' => 'Producten, voorraad en bestellingen beheren.'],
            ] as $future)

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="text-2xl mb-3">
                        {{ $future['icon'] }}
                    </div>

                    <h3 class="font-bold text-gray-800">
                        {{ $future['title'] }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-6">
                        {{ $future['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>


    {{-- Ontwikkelaar --}}
    <div class="bg-gradient-to-r from-green-600 to-green-500
                rounded-3xl p-8 md:p-10 text-white">

        <div class="flex flex-col md:flex-row md:items-center gap-6">

            <div class="w-20 h-20 rounded-2xl bg-white/15
                        flex items-center justify-center text-4xl shrink-0">
                👨‍💻
            </div>

            <div>

                <h2 class="text-2xl font-bold mb-3">
                    Ontwikkeld door Zabi Hosaini
                </h2>

                <p class="text-green-50 leading-7 max-w-4xl">
                    StoffenApp is ontwikkeld als persoonlijk ICT-project
                    waarin Laravel, PHP, Livewire en moderne frontend-
                    technieken worden gecombineerd. Het project is gericht
                    op het bouwen van een complete, overzichtelijke en
                    gebruiksvriendelijke webshop waarin producten,
                    zoekfunctionaliteit en een winkelwagen samenkomen.
                </p>

            </div>

        </div>

    </div>

</div>
```
