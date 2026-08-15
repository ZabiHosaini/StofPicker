<?php

use Livewire\Component;
use App\Models\Kleding;
use Livewire\Attributes\On;

new class extends Component
{
    public $kledings = [];
    public $selected = [];


    public function mount()
    {
        //$this->kledings = Kleding::with('sizes')->get();
        $this->kledings = Kleding::with(['sizes', 'fotos'])->get();

    }
   
    //increase
    public function increaseStock($kledingId, $sizeId)
    {
        $kleding = Kleding::findOrFail($kledingId);

        $currentStock = $kleding->sizes()
            ->where('size_id', $sizeId)
            ->first()
            ->pivot
            ->stock;

        $kleding->sizes()->updateExistingPivot($sizeId, [
            'stock' => $currentStock + 1,
        ]);

        $this->kledings = Kleding::with('sizes')->get();
    }

    //decrease
    public function decreaseStock($kledingId, $sizeId)
    {
        $kleding = Kleding::findOrFail($kledingId);

        $currentStock = $kleding->sizes()
            ->where('size_id', $sizeId)
            ->first()
            ->pivot
            ->stock;

        if ($currentStock > 0) {
            $kleding->sizes()->updateExistingPivot($sizeId, [
                'stock' => $currentStock - 1,
            ]);
        }

        $this->kledings = Kleding::with('sizes')->get();
    }
    

    public function deleteShirt($id)
    {   //dd("delete");
        $this->dispatch("confirm",id: $id);
    }

    #[On('delete')]
    public function delete($id)
    { 
        $kleding = Kleding::findOrFail($id);

        // verwijder eerst de koppelingen in kleding_size
        $kleding->sizes()->detach();

        // verwijder daarna de kleding zelf
        $kleding->delete();

        // lijst opnieuw laden
        $this->kledings = Kleding::with('sizes')->get();
    }

};
?>

<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900">
            Wielren Kleding
        </h1>
        @if ($this->selected)
        <p>{{ count($this->selected) }}</p>
        
        @endif
        <a href="/wielrennen/create"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow-md transition">
            + Toevoegen
        </a>
        
    </div>
    <div class="w-full overflow-x-auto bg-white shadow rounded-lg">
        
        <table class="w-full text-sm text-left text-gray-700">
        
            <!-- Header -->
            <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                <tr>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">select</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline"></th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Name</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Prijs</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline" width="100px">Omschrijving</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Geslacht</th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline"></th>
                <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline"></th>
                
                

                </tr>
            </thead>
        
            <!-- Body -->
            <tbody>
                
                @foreach ($kledings as $kleding)
                
            <tr class="border-b odd:bg-white even:bg-gray-100 hover:bg-gray-50">
            <td class="px-6 py-4"><input type="checkbox" value="{{$kleding->id}}" wire:model.live="selected">
                </td>
                <td class="px-6 py-4">
                    @if($kleding->fotos->count() > 0)

                    <img 
                        class="rounded object-cover"
                        src="{{ asset('storage/' . $kleding->fotos->first()->foto) }}"
                        width="100"
                        height="100"
                        alt="{{ $kleding->name }}">
                
                        @else
                        
                            <img 
                                class="rounded object-cover"
                                src="{{ asset('storage/no-image.png') }}"
                                width="100"
                                height="100"
                                alt="Geen foto">
                        
                        @endif
                </td>
                
{{--                     <td class="px-6 py-4"><img class="rounded-full" src="{{asset('storage/wielrennen/visma.jpg') }}" width="80" alt="">{{ $value['name']}}</td>
            --}}                   <td class="px-6 py-4"><a class="text-blue-600 hover:underline" href="wielrennen/show/{{$kleding->id}}">{{ $kleding->name }}</a>  </td> 
                <td class="px-6 py-4">${{ $kleding->prijs }}</td>
                
                <td class="px-6 py-4">{{ $kleding->omschrijving }} </td>
                <td class="px-6 py-4">{{ $kleding->geslacht }} </td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach ($kleding->sizes as $size)
                            <div class="flex items-center gap-2 border rounded px-2 py-1">
                                <span class="font-semibold">{{ strtoupper($size->name) }}</span>
                
                                <button wire:click="decreaseStock({{ $kleding->id }}, {{ $size->id }})"
                                        class="w-6 h-6 bg-gray-200 rounded">
                                    -
                                </button>
                
                                <span>{{ $size->pivot->stock }}</span>
                
                                <button wire:click="increaseStock({{ $kleding->id }}, {{ $size->id }})"
                                        class="w-6 h-6 bg-green-500 text-white rounded">
                                    +
                                </button>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td class="flex px-6 py-4">

                    <a href="/wielrennen/edit/{{$kleding->id}}"  Wire:key="{{ $kleding->id }}" class="text-blue-600 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                    </a>
                    
                    <a wire:click.prevent="deleteShirt('{{ $kleding->id }}')"   wire:key="{{ $kleding->id }}" href="#" class="text-red-600 hover:underline ml-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                

                    
                </td>
            </tr>
                @endforeach   
                
            </tbody>
            </table></div>
        </div>

        @script 
        <script>
           $wire.on("confirm", (event) => {
         
         Swal.fire({
         title: "Are you sure?",
         text: "You won't be able to revert this!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Yes, delete it!"
         }).then((result) => {
         if (result.isConfirmed)
           {
             $wire.dispatch("delete", { id: event.id });
 
             Swal.fire({
             title: "Deleted!",
             text: "Your file has been deleted.",
             icon: "success"
             });
 
           }
         });
        });
          </script>
       
        
        
        
        
        @endscript