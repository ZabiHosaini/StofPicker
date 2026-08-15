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
    $this->kleding = Kleding::find($id);

    $this->activeFoto = $this->kleding->fotos->first()->foto ?? null;
}

public function addToCart($kledingId, $sizeId)
    {  
        $kleding = Kleding::findOrFail($kledingId);

        $size = $kleding->sizes()
            ->where('sizes.id', $sizeId)
            ->first();

        if (!$size || $size->pivot->stock <= 0) return;

        $cartKey = $kledingId.'-'.$sizeId;

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

    // session()->forget('cart');
    }
};
?>

<div class="max-w-6xl mx-auto p-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- FOTO GEBIED -->
        <div>

            <!-- GROTE FOTO -->
            <div class="w-full aspect-square rounded-xl overflow-hidden shadow">
                <img 
                    src="{{ asset('storage/'.$activeFoto) }}"
                    class="w-full h-full object-cover"
                    alt="{{ $kleding->name }}"
                >
            </div>


            <!-- KLEINE FOTO'S -->
            <div class="flex gap-3 mt-4 flex-wrap">

                @foreach($kleding->fotos as $foto)

                    <button
                        wire:click="$set('activeFoto','{{ $foto->foto }}')"
                        class="
                            w-20 h-20 
                            rounded-lg 
                            overflow-hidden 
                            border-2
                            hover:border-blue-500
                            transition
                            {{ $activeFoto == $foto->foto ? 'border-blue-600' : 'border-gray-300' }}
                        "
                    >

                        <img
                            src="{{ asset('storage/'.$foto->foto) }}"
                            class="w-full h-full object-cover"
                            alt=""
                        >

                    </button>

                @endforeach

            </div>

        </div>


        <!-- PRODUCT INFO -->
        <div class="space-y-5">

            <h1 class="text-3xl font-bold">
                {{ $kleding->name }}
            </h1>


            <p class="text-gray-600">
                {{ $kleding->omschrijving }}
            </p>


            <div class="text-2xl font-bold text-green-600">
                € {{ $kleding->prijs }}
            </div>


            <div>
                <h3 class="font-semibold mb-3">
                    Kies maat
                </h3>


                <div class="flex gap-2 flex-wrap">

                    @foreach($kleding->sizes as $size)

                        <button
                            wire:click="addToCart({{ $kleding->id }}, {{ $size->id }})"
                            class="btn btn-outline"
                        >
                            {{ $size->size }}
                            ({{ $size->pivot->stock }})
                        </button>

                    @endforeach

                </div>

            </div>


        </div>

    </div>
    <a
    href="{{ route('cart')}}"
    class="btn btn-primary btn-lg w-full mt-8">

    Naar winkelwagen

</a>
<div class="mt-6">

    <label class="flex items-center gap-2 cursor-pointer">
        <input 
            type="checkbox" 
            wire:model.live="maatNietBeschikbaar"
            class="checkbox"
        >

        <span>
            Mijn maat staat er niet bij
        </span>
    </label>


    @if($maatNietBeschikbaar)

        <div class="mt-5 space-y-4">

            <input
                type="text"
                wire:model="naam"
                class="input input-bordered w-full"
                placeholder="Naam"
            >


            <input
                type="email"
                wire:model="email"
                class="input input-bordered w-full"
                placeholder="Email"
            >


            <textarea
                wire:model="bericht"
                class="textarea textarea-bordered w-full"
                rows="5"
                placeholder="Schrijf hier je bericht..."
            ></textarea>


            <button
                wire:click="verstuurVraag"
                class="btn btn-primary"
            >
                Versturen
            </button>

        </div>

    @endif

</div>
</div>


