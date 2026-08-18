<?php

use Livewire\Component;

use App\Models\SizeChartSize;

new class extends Component
{
    public string $height = '';
    public string $chest = '';
    public string $waist = '';
    public string $hips = '';
    public string $shoulder = '';
    public string $sleeveLength = '';
    public string $inseam = '';

    public $result = null;

    public function calculate(): void
    {
        $this->validate([
            'height' => 'required|numeric|min:100|max:250',
            'chest' => 'required|numeric|min:50|max:200',
            'waist' => 'required|numeric|min:40|max:200',
            'hips' => 'required|numeric|min:50|max:200',
            'shoulder' => 'required|numeric|min:20|max:100',
            'sleeveLength' => 'required|numeric|min:20|max:120',
            'inseam' => 'required|numeric|min:30|max:120',
        ]);

        $sizes = SizeChartSize::where('size_chart_id', 1)->get();

        $bestSize = null;
        $bestScore = -1;

        foreach ($sizes as $size) {
            $score = 0;

            if ($this->chest >= $size->chest_min &&
                $this->chest <= $size->chest_max) {
                $score++;
            }

            if ($this->waist >= $size->waist_min &&
                $this->waist <= $size->waist_max) {
                $score++;
            }

            if ($this->hips >= $size->hips_min &&
                $this->hips <= $size->hips_max) {
                $score++;
            }

            if ($this->height >= $size->body_length_min &&
                $this->height <= $size->body_length_max) {
                $score++;
            }

            if ($this->shoulder >= $size->shoulder_min &&
                $this->shoulder <= $size->shoulder_max) {
                $score++;
            }

            if ($this->sleeveLength >= $size->sleeve_length_min &&
                $this->sleeveLength <= $size->sleeve_length_max) {
                $score++;
            }

            if ($this->inseam >= $size->inseam_min &&
                $this->inseam <= $size->inseam_max) {
                $score++;
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestSize = $size->size;
            }
        }

        $this->result = $bestSize;
    }
};
?>

<div class="min-h-screen bg-slate-50 py-12 px-4">

    <div class="max-w-4xl mx-auto">

        {{-- HEADER --}}
        <div class="text-center mb-10">

            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                Maatadvies
            </p>

            <h1 class="mt-2 text-4xl font-bold text-slate-900">
                Vind jouw perfecte maat
            </h1>

            <p class="mt-3 text-slate-500 max-w-2xl mx-auto">
                Vul je lichaamsmaten in en wij adviseren je welke maat
                het beste bij jou past.
            </p>

        </div>
            
        {{-- RESULTAAT --}}
        @if ($result !== null)

            <div class="mb-8 rounded-3xl bg-slate-900 text-white p-8 text-center shadow-xl">

                <p class="text-sm uppercase tracking-wider text-slate-400">
                    Jouw aanbevolen maat
                </p>

                <div class="mt-3 text-7xl font-black">
                    {{ $result }}
                </div>

                <p class="mt-4 text-slate-300">
                    Op basis van jouw ingevulde lichaamsmaten.
                </p>

            </div>

        @endif


        {{-- FORMULIER --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-6 sm:p-10">

            <form wire:submit.prevent="calculate">

                <div class="grid sm:grid-cols-2 gap-6">


                    {{-- LENGTE --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Lengte
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="height"
                                placeholder="bijv. 178"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('height')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- BORST --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Borst
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="chest"
                                placeholder="bijv. 96"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('chest')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- TAILLE --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Taille
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="waist"
                                placeholder="bijv. 82"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('waist')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- HEUP --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Heup
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="hips"
                                placeholder="bijv. 98"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('hips')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- SCHOUDER --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Schouderbreedte
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="shoulder"
                                placeholder="bijv. 44"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('shoulder')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- MOUWLENGTE --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Mouwlengte
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="sleeveLength"
                                placeholder="bijv. 62"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('sleeveLength')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- BINNENBEEN --}}
                    <div class="sm:col-span-2">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Binnenbeenlengte
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                step="0.1"
                                wire:model="inseam"
                                placeholder="bijv. 82"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 pr-14
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                       outline-none"
                            >

                            <span class="absolute right-4 top-3.5 text-sm text-slate-400">
                                cm
                            </span>

                        </div>

                        @error('inseam')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="mt-8">

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full rounded-xl bg-blue-600 hover:bg-blue-700
                               text-white font-semibold py-4 px-6
                               transition shadow-lg shadow-blue-600/20
                               disabled:opacity-60"
                    >

                        <span wire:loading.remove>
                            Mijn maat berekenen
                        </span>

                        <span wire:loading>
                            Berekenen...
                        </span>

                    </button>

                </div>

            </form>

        </div>


        {{-- INFO --}}
        <div class="mt-6 text-center text-sm text-slate-400">
            Alle maten zijn in centimeters.
        </div>

    </div>

</div>