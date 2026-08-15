<?php

use Livewire\Component;
use App\Models\Orders;

new class extends Component
{
    public function with()
    {
        return [
            'orders' => Orders::where('user_id', auth()->id())
                ->with('kledings.kleding')
                ->latest()
                ->get(),
        ];
    }
};
?>

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">

        <div class="flex flex-col md:flex-row md:items-center gap-6">

            <div class="w-20 h-20 rounded-3xl
                        bg-blue-100
                        flex items-center justify-center
                        text-4xl">
                📦
            </div>

            <div>

                <p class="text-blue-600 font-semibold mb-2">
                    Mijn account
                </p>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                    Mijn bestellingen
                </h1>

                <p class="text-gray-500 mt-2">
                    Bekijk hier je eerdere bestellingen en de details
                    van je aankopen.
                </p>

            </div>

        </div>

    </div>


    {{-- Orders --}}
    @if($orders->count())

        <div class="space-y-6">

            @foreach($orders as $order)

                <div class="bg-white rounded-3xl
                            shadow-sm
                            border border-gray-100
                            overflow-hidden">

                    {{-- Order header --}}
                    <div class="p-6 border-b border-gray-100">

                        <div class="flex flex-col md:flex-row
                                    md:items-center
                                    md:justify-between gap-4">

                            <div>

                                <p class="text-sm text-gray-400">
                                    Bestelling
                                </p>

                                <h2 class="text-xl font-bold text-gray-800">
                                    #{{ $order->id }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $order->created_at?->format('d-m-Y H:i') }}
                                </p>

                            </div>


                            {{-- Status --}}
                            <div>

                                @php
                                    $status = $order->status ?? 'pending';

                                    $statusClasses = match ($status) {
                                        'completed', 'paid', 'delivered'
                                            => 'bg-green-100 text-green-700',

                                        'cancelled'
                                            => 'bg-red-100 text-red-700',

                                        'processing', 'shipped'
                                            => 'bg-blue-100 text-blue-700',

                                        default
                                            => 'bg-yellow-100 text-yellow-700',
                                    };

                                    $statusText = match ($status) {
                                        'completed' => 'Voltooid',
                                        'paid' => 'Betaald',
                                        'delivered' => 'Geleverd',
                                        'cancelled' => 'Geannuleerd',
                                        'processing' => 'In behandeling',
                                        'shipped' => 'Verzonden',
                                        default => 'In afwachting',
                                    };
                                @endphp

                                <span class="inline-flex items-center
                                             px-4 py-2
                                             rounded-xl
                                             text-sm font-semibold
                                             {{ $statusClasses }}">
                                    {{ $statusText }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Products --}}
                    <div class="p-6">

                        <h3 class="font-bold text-gray-800 mb-4">
                            Producten
                        </h3>

                        <div class="space-y-4">

                            @foreach($order->kledings as $item)

                                <div class="flex items-center gap-4
                                            p-4
                                            rounded-2xl
                                            bg-gray-50">

                                    {{-- Image --}}
                                    <div class="w-16 h-16 rounded-xl
                                                bg-white
                                                border border-gray-200
                                                flex items-center
                                                justify-center
                                                overflow-hidden">

                                        @if($item->product?->image)
                                            <img
                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}"
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <span class="text-2xl">
                                                🧵
                                            </span>
                                        @endif

                                    </div>


                                    {{-- Product information --}}
                                    <div class="flex-1 min-w-0">

                                        <h4 class="font-semibold text-gray-800">
                                            {{ $item->kleding?->name ?? 'Kleding' }}
                                        </h4>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Aantal: {{ $item->aantalen }}
                                        </p>
                                        

                                    </div>


                                    {{-- Price --}}
                                    <div class="text-right">

                                        <p class="font-bold text-gray-800">
                                            
                                            € {{ number_format($item->prijs * $item->aantalen, 2, ',', '.') }} 
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- Order footer --}}
                    <div class="px-6 py-5
                                bg-gray-50
                                border-t border-gray-100">

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center
                                    sm:justify-between gap-4">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Totaalbedrag
                                </p>

                                <p class="text-2xl font-bold text-gray-800">
                                    €  {{ number_format($order->amount, 2, ',', '.') }}
                                </p>

                            </div>


                            <a
                                href="#"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-3
                                       rounded-xl
                                       bg-green-600
                                       text-white
                                       font-semibold
                                       hover:bg-green-700
                                       transition"
                            >
                                Bekijk bestelling →
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- No orders --}}
        <div class="bg-white rounded-3xl
                    shadow-sm
                    border border-gray-100
                    p-12 text-center">

            <div class="w-20 h-20 rounded-3xl
                        bg-gray-100
                        flex items-center justify-center
                        text-4xl
                        mx-auto mb-6">
                📦
            </div>

            <h2 class="text-2xl font-bold text-gray-800">
                Nog geen bestellingen
            </h2>

            <p class="text-gray-500 mt-2 max-w-md mx-auto">
                Je hebt nog geen bestelling geplaatst.
                Bekijk onze shop en ontdek onze stoffen, matten
                en andere producten.
            </p>

            <a
                href="{{ route('shop') }}"
                class="inline-flex items-center gap-2
                       mt-6
                       px-6 py-3
                       rounded-xl
                       bg-green-600
                       text-white
                       font-semibold
                       hover:bg-green-700
                       transition"
            >
                🛍️
                Naar de shop
            </a>

        </div>

    @endif

</div>