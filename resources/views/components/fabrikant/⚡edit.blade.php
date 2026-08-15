<?php

use Livewire\Component;
use App\Models\Fabrikant;
use Livewire\WithFileUploads;

new class extends Component
{
   public $id;  
};
?>
<div class="min-h-screen bg-gray-50 py-10">

   <section>

       <div class="max-w-5xl mx-auto px-4">

           <livewire:fabrikant.form :id="$id"/>

       </div>

   </section>

</div>