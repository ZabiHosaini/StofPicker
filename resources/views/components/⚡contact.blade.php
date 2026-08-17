<?php

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
//use App\Mail\ContactMail;


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

        Mail::raw(
            "Naam: {$this->name}\n" .
            "Email: {$this->email}\n" .
            "Telefoon: {$this->phone}\n" .
            "Bedrijf: {$this->company}\n" .
            "Bericht: {$this->message}",
            function ($mail) {
                $mail->to('sayedzabi1987@gmail.com')
                    ->subject('Nieuw contactbericht - StofPicker');
            }
        );

        session()->flash('success', 'Bericht verzonden!');

        $this->reset();
    }
};
?>


<div class="min-h-screen bg-slate-50 py-10 px-4 sm:px-6 lg:px-8">

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition
            class="fixed top-5 right-5 z-50 max-w-sm w-full"
        >
            <div class="rounded-2xl bg-white shadow-xl border border-green-100 p-4">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-900">
                            Bericht verzonden
                        </h3>

                        <p class="text-sm text-slate-600 mt-1">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- CONTACT CARD --}}
    <section class="max-w-5xl mx-auto">

        <div class="grid lg:grid-cols-5 bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200">

            {{-- LEFT SIDE --}}
            <div class="lg:col-span-2 bg-slate-900 text-white p-8 lg:p-10">

                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 mb-6">
                    <svg class="w-7 h-7"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>

                <h1 class="text-3xl font-bold mb-4">
                    Neem contact op
                </h1>

                <p class="text-slate-300 leading-relaxed mb-10">
                    Heb je een vraag over onze wielerkleding, je bestelling
                    of wil je meer informatie? Stuur ons gerust een bericht.
                </p>


                <div class="space-y-6">

                    {{-- EMAIL --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                E-mail
                            </p>

                            <p class="font-medium">
                                sayedzabi1987@gmail.com
                            </p>
                        </div>
                    </div>


                    {{-- PHONE --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Telefoon
                            </p>

                            <p class="font-medium">
                                Neem contact met ons op
                            </p>
                        </div>
                    </div>


                    {{-- RESPONSE --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Reactietijd
                            </p>

                            <p class="font-medium">
                                Zo snel mogelijk
                            </p>
                        </div>
                    </div>

                </div>

            </div>


            {{-- RIGHT SIDE / FORM --}}
            <div class="lg:col-span-3 p-8 lg:p-10">

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">
                        Stuur ons een bericht
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Vul het formulier hieronder in en we nemen zo snel
                        mogelijk contact met je op.
                    </p>
                </div>


                <form wire:submit.prevent="send" class="space-y-5">

                    {{-- NAME + EMAIL --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Naam
                            </label>

                            <input
                                type="text"
                                wire:model="name"
                                placeholder="Uw naam"
                                class="w-full rounded-xl border border-slate-300 bg-slate-50
                                       px-4 py-3 outline-none transition
                                       focus:bg-white focus:border-blue-500 focus:ring-4
                                       focus:ring-blue-100"
                            >

                            @error('name')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                E-mail
                            </label>

                            <input
                                type="email"
                                wire:model="email"
                                placeholder="naam@email.nl"
                                class="w-full rounded-xl border border-slate-300 bg-slate-50
                                       px-4 py-3 outline-none transition
                                       focus:bg-white focus:border-blue-500 focus:ring-4
                                       focus:ring-blue-100"
                            >

                            @error('email')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>


                    {{-- PHONE + COMPANY --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Telefoon
                            </label>

                            <input
                                type="text"
                                wire:model="phone"
                                placeholder="+31 6 12345678"
                                class="w-full rounded-xl border border-slate-300 bg-slate-50
                                       px-4 py-3 outline-none transition
                                       focus:bg-white focus:border-blue-500 focus:ring-4
                                       focus:ring-blue-100"
                            >

                            @error('phone')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Bedrijf
                            </label>

                            <input
                                type="text"
                                wire:model="company"
                                placeholder="Bedrijfsnaam"
                                class="w-full rounded-xl border border-slate-300 bg-slate-50
                                       px-4 py-3 outline-none transition
                                       focus:bg-white focus:border-blue-500 focus:ring-4
                                       focus:ring-blue-100"
                            >

                            @error('company')
                                <span class="block mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>


                    {{-- MESSAGE --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Bericht
                        </label>

                        <textarea
                            rows="6"
                            wire:model="message"
                            placeholder="Typ hier uw bericht..."
                            class="w-full rounded-xl border border-slate-300 bg-slate-50
                                   px-4 py-3 outline-none transition resize-none
                                   focus:bg-white focus:border-blue-500 focus:ring-4
                                   focus:ring-blue-100"
                        ></textarea>

                        @error('message')
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
                                📩 Bericht versturen
                            </span>

                            <span wire:loading>
                                Bericht wordt verzonden...
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>
```
