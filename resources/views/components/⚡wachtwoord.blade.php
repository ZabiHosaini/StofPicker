<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        $validated = $this->validate([
            'current_password' => [
                'required',
                'string',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                PasswordRule::defaults(),
                'confirmed',
            ],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset([
            'current_password',
            'password',
            'password_confirmation',
        ]);

        session()->flash('success', 'Je wachtwoord is gewijzigd.');
    }
};
?>

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

        <div class="flex items-center gap-4 mb-8">

            <div class="w-12 h-12 rounded-xl bg-green-100
                        flex items-center justify-center text-2xl">
                🔐
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Wachtwoord wijzigen
                </h1>

                <p class="text-gray-500 mt-1">
                    Wijzig het wachtwoord van je account.
                </p>
            </div>

        </div>

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-green-50
                        border border-green-200 p-4
                        text-green-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit="updatePassword" class="space-y-6">

            {{-- Huidig wachtwoord --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Huidig wachtwoord
                </label>

                <input
                    type="password"
                    wire:model="current_password"
                    autocomplete="current-password"
                    class="w-full rounded-xl border border-gray-200
                           px-4 py-3
                           focus:border-green-500
                           focus:ring-green-500"
                >

                @error('current_password')
                    <p class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Nieuw wachtwoord --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nieuw wachtwoord
                </label>

                <input
                    type="password"
                    wire:model="password"
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-gray-200
                           px-4 py-3
                           focus:border-green-500
                           focus:ring-green-500"
                >

                @error('password')
                    <p class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Bevestigen --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nieuw wachtwoord bevestigen
                </label>

                <input
                    type="password"
                    wire:model="password_confirmation"
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-gray-200
                           px-4 py-3
                           focus:border-green-500
                           focus:ring-green-500"
                >

            </div>

            <button
                type="submit"
                class="px-6 py-3 rounded-xl
                       bg-green-600 text-white
                       font-semibold
                       hover:bg-green-700 transition"
            >
                Wachtwoord wijzigen
            </button>

        </form>

    </div>

</div>