<?php

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\ContactConfirmationMail;

new class extends Component
{
     public $name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'nullable',
        'company' => 'nullable',
        'message' => 'required|min:10',
    ];

    public function send()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'message' => $this->message,
        ];

        // 1. Mail naar jou
        Mail::to('sayedzabi1987@gmail.com')
            ->send(new ContactMail($data));

        // 2. Bevestiging naar de klant
       /*  Mail::to($this->email)
            ->send(new ContactConfirmationMail($data)); */
            $this->reset();
        session()->flash('success', 'Bericht verzonden! Je ontvangt ook een bevestiging per e-mail.');
    }
};
?>


<div class="min-h-screen bg-slate-50 py-10 px-4 sm:px-6 lg:px-8">

    <section class="max-w-5xl mx-auto">

        <div class="grid lg:grid-cols-5 bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200">

            {{-- LEFT SIDE --}}
            <div class="lg:col-span-2 bg-slate-900 text-white p-8 lg:p-10">

                {{-- ICON --}}
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 mb-6">
                    <svg class="w-7 h-7"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>

                <h1 class="text-3xl font-bold mb-4">
                    Vind jouw maat
                </h1>

                <p class="text-slate-300 leading-relaxed mb-10">
                    Met jouw lichaamsmaten kunnen we bepalen welke maat
                    wielerkleding het beste bij je past.
                </p>


                {{-- INFO --}}
                <div class="space-y-6">

                    {{-- MEASUREMENT --}}
                    <div class="flex gap-4">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Lichaamsmaten
                            </p>

                            <p class="font-medium">
                                Meet jezelf in centimeters
                            </p>
                        </div>

                    </div>


                    {{-- ACCURACY --}}
                    <div class="flex gap-4">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Persoonlijk advies
                            </p>

                            <p class="font-medium">
                                Afgestemd op jouw lichaam
                            </p>
                        </div>

                    </div>


                    {{-- RESULT --}}
                    <div class="flex gap-4">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Resultaat
                            </p>

                            <p class="font-medium">
                                Ontvang direct je maatadvies
                            </p>
                        </div>

                    </div>

                </div>


                {{-- RESULT ON LEFT --}}
                @if ($this->result !== null)

                    <div class="mt-10 pt-8 border-t border-white/10">

                        <p class="text-sm text-slate-400">
                            Jouw aanbevolen maat
                        </p>

                        <div class="mt-2 text-6xl font-black text-white">
                            {{ $this->result }}
                        </div>

                    </div>

                @endif

            </div>


            {{-- RIGHT SIDE --}}
            <div class="lg:col-span-3 p-8 lg:p-10">

                <div class="mb-8">

                    <h2 class="text-2xl font-bold text-slate-900">
                        Bereken je maat
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Vul hieronder je lichaamsmaten in. Gebruik een
                        meetlint en vul alles in centimeters in.
                    </p>

                </div>


                {{-- FORM --}}
                <form wire:submit.prevent="calculate" class="space-y-5">

                    {{-- HEIGHT + CHEST --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- HEIGHT --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Lengte
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    step="0.1"
                                    wire:model="height"
                                    placeholder="Bijv. 178"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-50
                                           px-4 py-3 pr-14 outline-none transition
                                           focus:bg-white focus:border-blue-500 focus:ring-4
                                           focus:ring-blue-100"
                                >

                                <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                    cm
                                </span>

                            </div>

                            @error('height')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- CHEST --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Borst
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    step="0.1"
                                    wire:model="chest"
                                    placeholder="Bijv. 96"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-50
                                           px-4 py-3 pr-14 outline-none transition
                                           focus:bg-white focus:border-blue-500 focus:ring-4
                                           focus:ring-blue-100"
                                >

                                <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                    cm
                                </span>

                            </div>

                            @error('chest')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>


                    {{-- WAIST + HIPS --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- WAIST --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Taille
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    step="0.1"
                                    wire:model="waist"
                                    placeholder="Bijv. 82"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-50
                                           px-4 py-3 pr-14 outline-none transition
                                           focus:bg-white focus:border-blue-500 focus:ring-4
                                           focus:ring-blue-100"
                                >

                                <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                    cm
                                </span>

                            </div>

                            @error('waist')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- HIPS --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Heup
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    step="0.1"
                                    wire:model="hips"
                                    placeholder="Bijv. 98"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-50
                                           px-4 py-3 pr-14 outline-none transition
                                           focus:bg-white focus:border-blue-500 focus:ring-4
                                           focus:ring-blue-100"
                                >

                                <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                    cm
                                </span>

                            </div>

                            @error('hips')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>


                    {{-- SHOULDER + SLEEVE --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- SHOULDER --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Schouderbreedte
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    step="0.1"
                                    wire:model="shoulder"
                                    placeholder="Bijv. 44"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-50
                                           px-4 py-3 pr-14 outline-none transition
                                           focus:bg-white focus:border-blue-500 focus:ring-4
                                           focus:ring-blue-100"
                                >

                                <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                    cm
                                </span>

                            </div>

                            @error('shoulder')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- SLEEVE --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Mouwlengte
                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    step="0.1"
                                    wire:model="sleeveLength"
                                    placeholder="Bijv. 62"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-50
                                           px-4 py-3 pr-14 outline-none transition
                                           focus:bg-white focus:border-blue-500 focus:ring-4
                                           focus:ring-blue-100"
                                >

                                <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                    cm
                                </span>

                            </div>

                            @error('sleeveLength')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>


                    {{-- INSEAM --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Binnenbeenlengte
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="inseam"
                                placeholder="Bijv. 82"
                                class="w-full rounded-xl border border-slate-300 bg-slate-50
                                       px-4 py-3 pr-14 outline-none transition
                                       focus:bg-white focus:border-blue-500 focus:ring-4
                                       focus:ring-blue-100"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('inseam')
                            <span class="block mt-1 text-sm text-red-500">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <div class="pt-2">

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="w-full rounded-xl bg-blue-600 hover:bg-blue-700
                                   text-white font-semibold py-3.5 px-6
                                   shadow-lg shadow-blue-600/20
                                   transition duration-300
                                   disabled:opacity-60"
                        >

                            <span wire:loading.remove>
                                📏 Mijn maat berekenen
                            </span>

                            <span wire:loading>
                                Maat wordt berekend...
                            </span>

                        </button>

                    </div>

                </form>


                {{-- RESULT CARD --}}
                @if ($this->result !== null)

                    <div class="mt-8 rounded-2xl border border-blue-100 bg-blue-50 p-6">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center flex-shrink-0">

                                <svg class="w-6 h-6"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>

                            </div>

                            <div>

                                <p class="text-sm text-blue-600 font-semibold">
                                    Ons maatadvies
                                </p>

                                <p class="text-slate-900 text-xl font-bold">
                                    Wij adviseren maat {{ $this->result }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </section>

</div>

