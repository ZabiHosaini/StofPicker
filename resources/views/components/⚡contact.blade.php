<?php

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    public function submit(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Mail::raw(
            "Naam: {$validated['name']}\n"
            . "E-mail: {$validated['email']}\n\n"
            . "Bericht:\n{$validated['message']}",
            function ($mail) use ($validated) {
                $mail
                    ->to('sayedzabi1987@gmail.com')
                    ->replyTo(
                        $validated['email'],
                        $validated['name']
                    )
                    ->subject(
                        'Nieuw contactbericht van ' . $validated['name']
                    );
            }
        );

        $this->reset();

        session()->flash(
            'success',
            'Bedankt voor je bericht! We hebben je bericht ontvangen.'
        );
    }
};
?>

<div class="mx-auto max-w-4xl px-6 py-12">

    {{-- Header --}}
    <div class="mb-8">

        <p class="mb-2 font-semibold text-green-600">
            Contact
        </p>

        <h1 class="text-4xl font-bold text-gray-800">
            Neem contact met mij op
        </h1>

        <p class="mt-4 text-gray-600 leading-7">
            Heb je een vraag, opmerking of wil je contact met mij opnemen?
            Vul dan het formulier hieronder in.
        </p>

        <p class="mt-3 text-gray-600">
            Je kunt mij ook rechtstreeks mailen via
            <a
                href="mailto:sayedzabi1987@gmail.com"
                class="font-semibold text-green-600 hover:underline"
            >
                sayedzabi1987@gmail.com
            </a>
        </p>

    </div>


    {{-- Succesmelding --}}
    @if (session('success'))

        <div
            class="mb-6 rounded-2xl border border-green-200
                   bg-green-50 p-5 text-green-700"
        >
            <div class="flex items-center gap-3">

                <span class="text-xl">
                    ✓
                </span>

                <p class="font-medium">
                    {{ session('success') }}
                </p>

            </div>
        </div>

    @endif


    {{-- Formulier --}}
    <div
        class="rounded-3xl border border-gray-100
               bg-white p-8 shadow-sm md:p-10"
    >

        <form wire:submit="submit" class="space-y-6">

            {{-- Naam --}}
            <div>

                <label
                    for="name"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Naam
                </label>

                <input
                    wire:model="name"
                    type="text"
                    id="name"
                    autocomplete="name"
                    placeholder="Je naam"
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-gray-800
                           outline-none transition
                           focus:border-green-500
                           focus:bg-white
                           focus:ring-2 focus:ring-green-100"
                >

                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- E-mail --}}
            <div>

                <label
                    for="email"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    E-mailadres
                </label>

                <input
                    wire:model="email"
                    type="email"
                    id="email"
                    autocomplete="email"
                    placeholder="jouw@email.nl"
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-gray-800
                           outline-none transition
                           focus:border-green-500
                           focus:bg-white
                           focus:ring-2 focus:ring-green-100"
                >

                @error('email')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Bericht --}}
            <div>

                <label
                    for="message"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Bericht
                </label>

                <textarea
                    wire:model="message"
                    id="message"
                    rows="7"
                    placeholder="Schrijf hier je bericht..."
                    class="w-full resize-y rounded-xl border
                           border-gray-200 bg-gray-50 px-4 py-3
                           text-gray-800 outline-none transition
                           focus:border-green-500
                           focus:bg-white
                           focus:ring-2 focus:ring-green-100"
                ></textarea>

                @error('message')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Knop --}}
            <div class="pt-2">

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex w-full items-center
                           justify-center rounded-xl
                           bg-green-600 px-6 py-3.5
                           font-semibold text-white
                           transition hover:bg-green-700
                           disabled:cursor-not-allowed
                           disabled:opacity-50"
                >

                    <span wire:loading.remove>
                        Verstuur bericht →
                    </span>

                    <span wire:loading>
                        Bericht wordt verzonden...
                    </span>

                </button>

            </div>

        </form>

    </div>


    {{-- E-mail onderaan --}}
    <div class="mt-6 text-center">

        <p class="text-sm text-gray-500">
            Liever rechtstreeks mailen?
        </p>

        <a
            href="mailto:sayedzabi1987@gmail.com"
            class="mt-1 inline-block font-semibold
                   text-green-600 hover:underline"
        >
            sayedzabi1987@gmail.com
        </a>

    </div>

</div>