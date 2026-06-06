<?php

use Livewire\Component;
use App\Models\Stof;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Attributes\on;

new class extends Component
{
    use WithPagination;

    public $indexPage = true;
    public $createPage = false;

    public $searchText;

    //public $sort = 'newst';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function toggleSort()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc' ;
    }

    public function sortBy($field)
    { 
       if($this->sortField===$field)
        {
           $this->toggleSort();
           return;
        }
        $this->sortField = $field;
        
        $this->resetPage();

    }



    #[Computed]
    public function stoffen ()
    {    //dd($this->searchText); 
      return  Stof::with('fabrikant') // relationship laden
        ->when($this->searchText, function ($q)
          {
              $q->where('name','like','%'.$this->searchText . '%');
          })
        ->orderBy($this->sortField,$this->sortDirection)
        ->paginate(5);
    }

    public function updatedSearchText()
    {
        $this->resetPage();
    }

    public function deleteStof($id)
    {  
        $this->dispatch("confirm",id: $id);
     
 
      //  session()->flash('success', "De Product is verwijderd!");   in form  Wire:confrim="are you sure ?" /
    }
    #[On('delete')]
    public function delete($id)
    {  
        Stof::find($id)->delete();

        $this->stoffen =  Stof::latest()->get();

        unset($this->stoffen); 
    }

    public function OpenCreateForm()
    { 
        $this->indexPage = false;
        $this->createPage = true;
    }
};
?>



    
<div class="w-full max-w-8xl mx-2 bg-gray-100">  @session("success")
     
    <div x-data="{show:true}"  wire:key="flash-message"
          x-init="setTimeout(() =>  show = false, 2500)" x-show = "show"                 
          class="fixed top-5 right-5 z-50
          bg-teal-100 border-t-4 border-teal-500 rounded-b
          text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
          <p class="font-bold">{{ $value }}</p>
            <p class="text-sm">{{ $value }}</p>
          </div>
        </div>
     </div>
   
   @endsession
        @if ($indexPage)
        <div class="flex justify-between p-8 items-center mt-4">
            <div class="flex space-x-6">
            <h1 class="text-3xl font-bold text-slate-900 mb-1 md:text-4xl dark:text-slate-50">StoffenLijst</h1>
            <input wire:model.live="searchText" type="text" class="rounded shadow border border-1 focus-within:outline-bg-gray-50  placeholder-gray w-72 px-3 py-1" placeholder="Zoeken naar Stof....">
            </div>
            <div>
            <a href="/create" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                + Toevoegen
            </a>
            </div>
            
        </div>
        <div class="p-8 mt-0">

                <div class="overflow-x-auto bg-white shadow rounded-lg">
                    <table class="min-w-full text-sm text-left text-gray-700">
                
                    <!-- Header -->
                    <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                        <tr>
                        <th class="px-6 py-3"></th>
                        <th class="px-6 py-3">
                            @if ($this->sortDirection==='asc')
                              <a class="text-gray-700 hover:text-gray-900 hover:underline" href="#" wire:click.prevent="sortBy('name')">Naam(a-z)</a>
                            @else
                              <a class="text-gray-700 hover:text-gray-900 hover:underline" href="#" wire:click.prevent="sortBy('name')">Naam(z-a)</a>
                            @endif
                            
                        </th>
                        <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Fabrikant</th>
                        <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Categorie</th>
                        <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Prijs</th>
                        <th class="px-6 py-3 text-gray-700 hover:text-gray-900 hover:underline">Actie</th>
                        </tr>
                    </thead>
                
                    <!-- Body -->
                    <tbody>
                        @foreach ($this->stoffen as $stof )
                        <tr class="border-b hover:bg-gray-50">
                        
                        <td class="px-6 py-4"><img class="rounded-full" src="{{asset('storage/'.$stof->foto) }}" width="80" alt=""></td>
                        <td class="px-6 py-4"><a class="text-blue-600 hover:underline" href="/show/{{$stof->id}}">{{ $stof->name}}</a>  </td>
                        <td class="px-6 py-4">{{ $stof->fabrikant?->name}}</td>
                        <td class="px-6 py-4">{{ $stof->categorie}}</td>
                        <td class="px-6 py-4">{{ $stof->prijs}}$</td>
                        

                        <td class="flex px-6 py-4">
                        <a href="/edit/{{$stof->id}}"  Wire:key="{{ $stof->id }}" class="text-blue-600 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>
                            </a>
                            <a wire:click="deleteStof({{ $stof->id }})"  Wire:key="{{ $stof->id }}" href="#" class="text-red-600 hover:underline ml-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                            </svg>
                            </a>
                        </td>
                        </tr>
                        @endforeach   
                    </tbody>
                    </table>
                </div>

        </div><!-- end Main table -->
        {{ $this->stoffen->links() }}
        @endif
        @if ($createPage)
            @include('stof.create')
        @endif
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

    