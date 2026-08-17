<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <div class="max-w-6xl mx-auto">
    
        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
    
            <div class="flex flex-col md:flex-row md:items-center gap-8">
    
                {{-- Profielfoto / icoon --}}
                <div class="flex-shrink-0">
                    <img
                        src="{{ asset('images/zabi.jpg') }}"
                        alt=""
                        class="w-32 h-32 rounded-2xl object-cover
                                shadow-sm ring-1 ring-gray-200
                                group-hover:ring-green-300
                                transition"
                    >
                </div>
    
                {{-- Intro --}}
                <div class="flex-1">
    
                    <p class="text-green-600 font-semibold mb-2">
                        Over mij
                    </p>
    
                    <h1 class="text-4xl font-bold text-gray-800 mb-3">
                        Zabi Hosaini
                    </h1>
    
                    <p class="text-xl text-gray-600 mb-4">
                        ICT Applicatieontwikkelaar &amp; Webdeveloper
                    </p>
    
                    <p class="text-gray-500 leading-relaxed max-w-3xl">
                        Ik ben een enthousiaste en praktische ICT'er met ervaring
                        in Laravel, PHP, JavaScript en databases. Naast mijn
                        werkzaamheden houd ik mij graag bezig met webontwikkeling
                        en het bouwen van praktische systemen.
                    </p>
    
                </div>
    
            </div>
    
        </div>
    
    
        {{-- Persoonlijk profiel --}}
        <div class="grid lg:grid-cols-3 gap-8 mb-8">
    
            {{-- Profiel --}}
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm
                        border border-gray-100 p-8">
    
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl bg-green-100
                                flex items-center justify-center">
                        👤
                    </div>
    
                    <h2 class="text-2xl font-bold text-gray-800">
                        Profiel
                    </h2>
                </div>
    
                <p class="text-gray-600 leading-8">
                    Mijn naam is Zabi Hosaini. Ik heb een opleiding MBO niveau 4
                    ICT Applicatieontwikkelaar afgerond aan het Drenthe College
                    in Emmen.
    
                    <br><br>
    
                    Daarnaast heb ik een HBO-opleiding aan de Hanzehogeschool
                    Groningen gevolgd. Deze opleiding heb ik niet afgerond,
                    maar tijdens deze periode heb ik mijn ICT-kennis verder
                    ontwikkeld.
    
                    <br><br>
    
                    Ik combineer mijn ICT-kennis met mijn werkervaring binnen
                    de kledingindustrie. Hierdoor heb ik ervaring met zowel
                    technische als praktische werkzaamheden.
                </p>
    
            </div>
    
    
            {{-- Personalia --}}
            <div class="bg-white rounded-3xl shadow-sm
                        border border-gray-100 p-8">
    
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Personalia
                </h2>
    
                <div class="space-y-4 text-sm">
    
                    <div>
                        <p class="text-gray-400">Naam</p>
                        <p class="font-semibold text-gray-700">
                            Zabi Hosaini
                        </p>
                    </div>
    
                    <div>
                        <p class="text-gray-400">Woonplaats</p>
                        <p class="font-semibold text-gray-700">
                            Assen
                        </p>
                    </div>
    
                    <div>
                        <p class="text-gray-400">Nationaliteit</p>
                        <p class="font-semibold text-gray-700">
                            Nederlands
                        </p>
                    </div>
    
                    <div>
                        <p class="text-gray-400">Rijbewijs</p>
                        <p class="font-semibold text-gray-700">
                            B
                        </p>
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
    
        {{-- Werkervaring --}}
        <div class="bg-white rounded-3xl shadow-sm
                    border border-gray-100 p-8 mb-8">
    
            <div class="flex items-center gap-3 mb-8">
    
                <div class="w-11 h-11 rounded-xl bg-green-100
                            flex items-center justify-center">
                    💼
                </div>
    
                <h2 class="text-2xl font-bold text-gray-800">
                    Werkervaring
                </h2>
    
            </div>
    
    
            <div class="space-y-8">
    
                {{-- SportConfex --}}
                <div class="relative pl-8 border-l-2 border-green-200">
    
                    <div class="absolute -left-2.5 top-0
                                w-5 h-5 rounded-full
                                bg-green-500 border-4 border-white">
                    </div>
    
                    <p class="text-sm font-semibold text-green-600">
                        2018 – heden
                    </p>
    
                    <h3 class="text-xl font-bold text-gray-800 mt-1">
                        SportConfex
                    </h3>
    
                    <p class="text-gray-500 mb-4">
                        Patroonafdeling
                    </p>
    
                    <ul class="space-y-2 text-gray-600">
    
                        
                        <li>• Werken met LECTRA-software voor kledingpatronen.</li>
                        <li>• Orders verwerken en uitvoeren in verschillende computerprogramma's.</li>
                        <li>• Planning bijhouden zodat orders op tijd klaar zijn.</li>
                        <li>• Digitaal versturen van patronen en orders naar productie.</li>
                        <li>• BHV-certificaat.</li>
    
                    </ul>
    
                </div>
    
    
                {{-- United Care --}}
                <div class="relative pl-8 border-l-2 border-gray-200">
    
                    <div class="absolute -left-2.5 top-0
                                w-5 h-5 rounded-full
                                bg-gray-400 border-4 border-white">
                    </div>
    
                    <p class="text-sm font-semibold text-green-600">
                        2017
                    </p>
    
                    <h3 class="text-xl font-bold text-gray-800 mt-1">
                        United Care – Groningen
                    </h3>
    
                    <p class="text-gray-500">
                        Confectieatelier
                    </p>
    
                    <p class="text-gray-600 mt-3 leading-7">
                        Werkzaamheden binnen een confectieatelier waar
                        tilliften en tillbanden worden geproduceerd.
                    </p>
    
                </div>
    
    
                {{-- DotSolutions --}}
                <div class="relative pl-8 border-l-2 border-gray-200">
    
                    <div class="absolute -left-2.5 top-0
                                w-5 h-5 rounded-full
                                bg-gray-400 border-4 border-white">
                    </div>
    
                    <p class="text-sm font-semibold text-green-600">
                        2016
                    </p>
    
                    <h3 class="text-xl font-bold text-gray-800 mt-1">
                        DotSolutions – Hoogeveen
                    </h3>
    
                    <p class="text-gray-500">
                        ICT Stagiair
                    </p>
    
                    <p class="text-gray-600 mt-3 leading-7">
                        Tijdens mijn stage heb ik een systeem ontwikkeld
                        waarmee gegevens van klanten, projecten, collega's,
                        taken en gewerkte uren konden worden opgeslagen,
                        teruggevonden, aangepast en verwijderd.
                    </p>
    
                </div>
    
    
                {{-- AriseMedia --}}
                <div class="relative pl-8 border-l-2 border-gray-200">
    
                    <div class="absolute -left-2.5 top-0
                                w-5 h-5 rounded-full
                                bg-gray-400 border-4 border-white">
                    </div>
    
                    <p class="text-sm font-semibold text-green-600">
                        2015 – 2016
                    </p>
    
                    <h3 class="text-xl font-bold text-gray-800 mt-1">
                        AriseMedia – Assen
                    </h3>
    
                    <p class="text-gray-500">
                        ICT Stagiair
                    </p>
    
                    <p class="text-gray-600 mt-3 leading-7">
                        Voor mijn afstuderen heb ik een platform ontwikkeld
                        met Laravel waarmee bedrijven updates naar hun
                        socialmedia-accounts konden plaatsen.
    
                        Daarnaast heb ik gewerkt aan het admin-gedeelte
                        van een radio website.
                    </p>
    
                </div>
    
    
                {{-- Drenthe College --}}
                <div class="relative pl-8">
    
                    <div class="absolute -left-2.5 top-0
                                w-5 h-5 rounded-full
                                bg-gray-400 border-4 border-white">
                    </div>
    
                    <p class="text-sm font-semibold text-green-600">
                        2013 – 2014
                    </p>
    
                    <h3 class="text-xl font-bold text-gray-800 mt-1">
                        Drenthe College – Emmen
                    </h3>
    
                    <p class="text-gray-500">
                        ICT Stagiair
                    </p>
    
                    <p class="text-gray-600 mt-3">
                        Verschillende schoolprojecten uitgevoerd,
                        waaronder een bank, marktplaats, supermarkt
                        en reisbureau.
                    </p>
    
                </div>
    
            </div>
    
        </div>
    
    
        {{-- Opleiding + vaardigheden --}}
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
    
            {{-- Opleiding --}}
            <div class="bg-white rounded-3xl shadow-sm
                        border border-gray-100 p-8">
    
                <div class="flex items-center gap-3 mb-6">
    
                    <div class="w-11 h-11 rounded-xl bg-blue-100
                                flex items-center justify-center">
                        🎓
                    </div>
    
                    <h2 class="text-2xl font-bold text-gray-800">
                        Opleiding
                    </h2>
    
                </div>
    
                <div class="space-y-6">
    
                    <div>
                        <p class="text-sm text-green-600 font-semibold">
                            2013 – 2016
                        </p>
    
                        <h3 class="font-bold text-gray-800 mt-1">
                            MBO Niveau 4 ICT Applicatieontwikkelaar
                        </h3>
    
                        <p class="text-gray-500">
                            Drenthe College – Emmen
                        </p>
    
                        <span class="inline-block mt-2 px-3 py-1
                                     rounded-full bg-green-100
                                     text-green-700 text-xs font-semibold">
                            Diploma behaald
                        </span>
                    </div>
    
    
                    <div>
                        <p class="text-sm text-green-600 font-semibold">
                            2016
                        </p>
    
                        <h3 class="font-bold text-gray-800 mt-1">
                            HBO – Hanzehogeschool Groningen
                        </h3>
    
                        <p class="text-gray-500">
                            HBO-opleiding gevolgd
                        </p>
    
                        <span class="inline-block mt-2 px-3 py-1
                                     rounded-full bg-gray-100
                                     text-gray-600 text-xs font-semibold">
                            Niet afgerond
                        </span>
                    </div>
    
    
                    <div>
                        <p class="text-sm text-green-600 font-semibold">
                            2002
                        </p>
    
                        <h3 class="font-bold text-gray-800 mt-1">
                            Modeopleiding
                        </h3>
    
                    </div>
    
                </div>
    
            </div>
    
    
            {{-- Computerervaring --}}
            <div class="bg-white rounded-3xl shadow-sm
                        border border-gray-100 p-8">
    
                <div class="flex items-center gap-3 mb-6">
    
                    <div class="w-11 h-11 rounded-xl bg-purple-100
                                flex items-center justify-center">
                        💻
                    </div>
    
                    <h2 class="text-2xl font-bold text-gray-800">
                        Computerervaring
                    </h2>
    
                </div>
    
                <div class="flex flex-wrap gap-3">
    
                    @foreach([
                        'Laravel',
                        'PHP',
                        'Vue.js',
                        'MySQL',
                        'C#.NET',
                        'jQuery',
                        'JavaScript',
                        'HTML',
                        'CSS',
                        'Git'
                    ] as $skill)
    
                        <span class="px-4 py-2 rounded-xl
                                     bg-gray-50 border border-gray-200
                                     text-gray-700 font-medium">
                            {{ $skill }}
                        </span>
    
                    @endforeach
    
                </div>
    
            </div>
    
        </div>
    
    
        {{-- Talen + overige --}}
        <div class="grid md:grid-cols-2 gap-8 mb-8">
    
            <div class="bg-white rounded-3xl shadow-sm
                        border border-gray-100 p-8">
    
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    🌍 Talen
                </h2>
    
                <div class="space-y-4">
    
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">
                            Nederlands
                        </span>
    
                        <span class="text-green-600 font-semibold">
                            Goed
                        </span>
                    </div>
    
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">
                            Engels
                        </span>
    
                        <span class="text-green-600 font-semibold">
                            Goed
                        </span>
                    </div>
    
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">
                            Perzisch
                        </span>
    
                        <span class="text-green-600 font-semibold">
                            Goed
                        </span>
                    </div>
    
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">
                            Arabisch
                        </span>
    
                        <span class="text-green-600 font-semibold">
                            Goed
                        </span>
                    </div>
    
                </div>
    
            </div>
    
    
            <div class="bg-white rounded-3xl shadow-sm
                        border border-gray-100 p-8">
    
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    ⚽ Overige activiteiten
                </h2>
    
                <div class="space-y-4 text-gray-600">
    
                    <p>
                        🎵 Muziek
                    </p>
    
                    <p>
                        🚴 Sport
                    </p>
    
                    <p>
                        💻 Zelfstudie en webontwikkeling
                    </p>
    
                </div>
    
            </div>
    
        </div>
    
    
        {{-- Contact --}}
        <div class="bg-gradient-to-r from-green-600 to-green-500
                    rounded-3xl p-8 md:p-10 text-white">
    
            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between gap-6">
    
                <div>
    
                    <h2 class="text-2xl font-bold mb-2">
                        Interesse in mijn profiel?
                    </h2>
    
                    <p class="text-green-50">
                        Neem gerust contact met mij op.
                    </p>
    
                </div>
    
                <a
                    href="/contact"
                    class="inline-flex items-center justify-center
                           px-6 py-3 rounded-xl
                           bg-white text-green-600
                           font-semibold
                           hover:bg-green-50 transition"
                >
                    Neem contact op →
                </a>
    
            </div>
    
        </div>
    
    </div>
</div>