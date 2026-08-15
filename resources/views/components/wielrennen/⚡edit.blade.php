<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Size;
use App\Models\Kleding;
use App\Models\KledingFoto;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $id;
};
?>

<div class="w-full min-h-screen flex mt-10">

    <!-- CONTENT -->
    <section class="px-4 md:px-8 w-full">
        <div class="max-w-xl mx-auto">
           <div class="mb-12">
              <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl dark:text-slate-50">
                  Kleding Toevoegen
              </h2>
              <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">
                 Have a question, need support, or want to discuss your next project? We’re here to help.
              </p>
           </div>
           <livewire:wielrennen.form :id="$id"/> 

          
        </div>
     </section>

</div>