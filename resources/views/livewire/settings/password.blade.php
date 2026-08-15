<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => [
                    'required',
                    'string',
                    'current_password',
                ],

                'password' => [
                    'required',
                    'string',
                    Password::defaults(),
                    'confirmed',
                ],
            ]);
        } catch (ValidationException $e) {
            $this->reset(
                'current_password',
                'password',
                'password_confirmation'
            );

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset(
            'current_password',
            'password',
            'password_confirmation'
        );

        $this->dispatch('password-updated');
    }
};
?>
<x-layoutPickker.layout>

    <div class="max-w-3xl mx-auto px-4 py-10">

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
                        required
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
                        required
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


                {{-- Bevestiging --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nieuw wachtwoord bevestigen
                    </label>

                    <input
                        type="password"
                        wire:model="password_confirmation"
                        autocomplete="new-password"
                        required
                        class="w-full rounded-xl border border-gray-200
                               px-4 py-3
                               focus:border-green-500
                               focus:ring-green-500"
                    >

                </div>


                {{-- Button --}}
                <div class="flex items-center gap-4">

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-xl
                               bg-green-600 text-white
                               font-semibold
                               hover:bg-green-700 transition"
                    >
                        Wachtwoord wijzigen
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-layoutPickker.layout>