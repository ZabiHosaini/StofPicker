<?php

use Livewire\Component;
use App\Models\Orders;
use App\Models\Kleding;

new class extends Component
{
    public $kleding;
    public $prijs;
    public $aantalen;
    public $product;
    public $amount = 0;

    public function updateAantal($key, $aantal)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['aantalen'] = $aantal;
        }

        session()->put('cart', $cart);
    }

    public function removeFromCart($key)
    { 
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
        }

        session()->put('cart', $cart);

        // update nav cart
        $this->dispatch('cart-updated');

        $this->dispatch('$refresh');
    }

    public function saveOrder()
{
    $order = Orders::create([
        "user_id" => 1,
        "amount" => 0
    ]);

    $amount = 0;

    foreach (session("cart") as $key => $value) {
      //dd($value);
        $order->kledings()->create([
            "kleding_id" => $value["kleding_id"],
            "aantalen" => $value["aantalen"],
            "prijs" => $value["prijs"],
        ]);

        $amount += $value["aantalen"] * $value["prijs"];
    }

    $order->amount = $amount;
    $order->save();

    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    $successURL = route('order.success', [
        'order_id' => $order->id
    ]) . '?session_id={CHECKOUT_SESSION_ID}';

    $response = $stripe->checkout->sessions->create([
        'success_url' => $successURL,
        'cancel_url' => route('cart'),

        'payment_method_types' => ['ideal'],

        'customer_email' => 'sayedzabi1987@gmail.com',

        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',

                    'product_data' => [
                        'name' => 'Shopping',
                    ],

                    'unit_amount' => $amount * 100,
                ],
                'quantity' => 1,
            ],
        ],

        'mode' => 'payment',
    ]);

     // Betaling is succesvol
     session()->forget('cart');

    return redirect($response->url);

}

public function orderSuccess(Request $request)
{
    dd($request->all());
}


};
?>


<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 2m2-2 2 2m8-2 2 2m-2-2-2 2M9 19.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm9 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-slate-900">
                        Mijn winkelwagen
                    </h1>

                    <p class="text-sm text-slate-500">
                        Bekijk je producten en rond je bestelling af.
                    </p>
                </div>
            </div>
        </div>


        @if(count(session('cart', [])) > 0)

            @php
                $total = 0;
                $cartCount = 0;
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- PRODUCTEN --}}
                <div class="lg:col-span-2 space-y-4">

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                        {{-- HEADER --}}
                        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                            <div>
                                <h2 class="font-bold text-lg text-slate-900">
                                    Producten
                                </h2>

                                <p class="text-sm text-slate-500">
                                    {{ count(session('cart', [])) }} product(en)
                                </p>
                            </div>
                        </div>


                        {{-- CART ITEMS --}}
                        <div class="divide-y divide-slate-200">

                            @foreach(session('cart', []) as $key => $value)

                                @php
                                    $subtotal = $value['aantalen'] * $value['prijs'];
                                    $total += $subtotal;
                                    $cartCount += $value['aantalen'];
                                @endphp

                                <div
                                    wire:key="cart-{{ $key }}"
                                    class="p-5 sm:p-6 hover:bg-slate-50 transition"
                                >

                                    <div class="flex flex-col sm:flex-row gap-5">

                                        {{-- FOTO --}}
                                        <div class="shrink-0">

                                            @php
                                                $kleding = \App\Models\Kleding::with('fotos')->find($value['kleding_id']);
                                            @endphp

                                            @if($kleding && $kleding->fotos->count())
                                                <img
                                                    src="{{ asset('storage/' . $kleding->fotos->first()->foto) }}"
                                                    alt="{{ $value['name'] }}"
                                                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-xl object-cover border border-slate-200"
                                                >
                                            @else
                                                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center">
                                                    <span class="text-xs text-slate-400">
                                                        Geen foto
                                                    </span>
                                                </div>
                                            @endif

                                        </div>


                                        {{-- PRODUCT INFO --}}
                                        <div class="flex-1 min-w-0">

                                            <div class="flex justify-between gap-4">

                                                <div>
                                                    <h3 class="text-lg font-bold text-slate-900">
                                                        {{ $value['name'] }}
                                                    </h3>

                                                    <div class="mt-1 flex items-center gap-2">
                                                        <span class="text-sm text-slate-500">
                                                            Maat:
                                                        </span>

                                                        <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                                            {{ $value['size'] }}
                                                        </span>
                                                    </div>
                                                </div>


                                                {{-- VERWIJDEREN --}}
                                                <button
                                                    type="button"
                                                    wire:click="removeFromCart('{{ $key }}')"
                                                    class="text-slate-400 hover:text-red-600 transition"
                                                    title="Verwijderen"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10"/>
                                                    </svg>
                                                </button>

                                            </div>


                                            {{-- PRIJS --}}
                                            <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                                <div>
                                                    <span class="text-sm text-slate-500">
                                                        Prijs per stuk
                                                    </span>

                                                    <div class="font-semibold text-slate-900">
                                                        € {{ number_format($value['prijs'], 2, ',', '.') }}
                                                    </div>
                                                </div>


                                                {{-- AANTAL --}}
                                                <div>
                                                    <label class="text-sm text-slate-500 block mb-1">
                                                        Aantal
                                                    </label>

                                                    <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden bg-white">

                                                        <button
                                                            type="button"
                                                            wire:click="updateAantal('{{ $key }}', {{ max(1, $value['aantalen'] - 1) }})"
                                                            class="w-9 h-9 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition"
                                                        >
                                                            −
                                                        </button>

                                                        <input
                                                            type="number"
                                                            min="1"
                                                            value="{{ $value['aantalen'] }}"
                                                            wire:change="updateAantal('{{ $key }}', $event.target.value)"
                                                            class="w-12 h-9 text-center border-x border-slate-300 outline-none"
                                                        >

                                                        <button
                                                            type="button"
                                                            wire:click="updateAantal('{{ $key }}', {{ $value['aantalen'] + 1 }})"
                                                            class="w-9 h-9 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition"
                                                        >
                                                            +
                                                        </button>

                                                    </div>
                                                </div>


                                                {{-- SUBTOTAL --}}
                                                <div class="text-left sm:text-right">

                                                    <span class="text-sm text-slate-500">
                                                        Subtotaal
                                                    </span>

                                                    <div class="text-lg font-bold text-slate-900">
                                                        € {{ number_format($subtotal, 2, ',', '.') }}
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- VERDER WINKELEN --}}
                    <div>
                        <a
                            href="{{ url('shop') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-green-600 transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>

                            Verder winkelen
                        </a>
                    </div>

                </div>


                {{-- ORDER SUMMARY --}}
                <div class="lg:col-span-1">

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-6">

                        <h2 class="text-xl font-bold text-slate-900">
                            Bestelling
                        </h2>

                        <div class="mt-6 space-y-4">

                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">
                                    Producten
                                </span>

                                <span class="font-medium text-slate-900">
                                    {{ $cartCount }}
                                </span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">
                                    Subtotaal
                                </span>

                                <span class="font-medium text-slate-900">
                                    € {{ number_format($total, 2, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">
                                    Verzending
                                </span>

                                <span class="font-semibold text-green-600">
                                    Gratis
                                </span>
                            </div>

                            <div class="border-t border-slate-200 pt-4">

                                <div class="flex justify-between items-center">

                                    <span class="text-lg font-bold text-slate-900">
                                        Totaal
                                    </span>

                                    <span class="text-2xl font-extrabold text-green-600">
                                        € {{ number_format($total, 2, ',', '.') }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- BETALEN --}}
                        <button
                            type="button"
                            wire:click="saveOrder"
                            wire:loading.attr="disabled"
                            class="mt-6 w-full rounded-xl bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white font-bold py-3.5 shadow-sm transition flex items-center justify-center gap-2"
                        >

                            <span wire:loading.remove wire:target="saveOrder">
                                Betalen
                            </span>

                            <span wire:loading wire:target="saveOrder">
                                Bezig met verwerken...
                            </span>

                            <svg
                                wire:loading.remove
                                wire:target="saveOrder"
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 9V7a5 5 0 00-10 0v2m-2 0h14l-1 10H6L5 9z"/>
                            </svg>

                        </button>


                        {{-- BETALING INFO --}}
                        <div class="mt-5 rounded-xl bg-slate-50 p-4">

                            <div class="flex gap-3">

                                <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2V9a6 6 0 00-12 0v10a2 2 0 002 2zm6-10V7a2 2 0 10-4 0v2h4z"/>
                                </svg>

                                <div>
                                    <p class="text-sm font-semibold text-slate-700">
                                        Veilig betalen
                                    </p>

                                    <p class="text-xs text-slate-500 mt-1">
                                        Je betaling wordt veilig verwerkt via Stripe.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @else

            {{-- LEGE WINKELWAGEN --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm py-16 px-6 text-center">

                <div class="mx-auto w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center">

                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 2m2-2 2 2m8-2 2 2m-2-2-2 2M9 19.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm9 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>

                </div>

                <h2 class="mt-5 text-2xl font-bold text-slate-900">
                    Je winkelwagen is leeg
                </h2>

                <p class="mt-2 text-slate-500">
                    Je hebt nog geen producten toegevoegd aan je winkelwagen.
                </p>

                <a
                    href="{{ url('shop') }}"
                    class="inline-flex mt-6 items-center justify-center rounded-xl bg-green-600 hover:bg-green-700 px-6 py-3 text-white font-semibold transition"
                >
                    Bekijk de kleding
                </a>

            </div>

        @endif

    </div>
</div>
```
