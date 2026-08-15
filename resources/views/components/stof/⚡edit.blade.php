<?php

use Livewire\Component;
use App\Models\Stof;
use App\Models\Fabrikant;
use Livewire\WithFileUploads;



new class extends Component
{
    use WithFileUploads;

   
    public $id;
    

};
?>

<div class="min-h-screen bg-gray-50 py-10">

   <section>

       <div class="max-w-5xl mx-auto px-4">

           <livewire:stof.form :id="$id"/>

       </div>

   </section>

</div>