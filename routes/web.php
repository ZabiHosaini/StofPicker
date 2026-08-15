<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CartController;
use App\Livewire\Fabrikant\Create;
use App\Models\Kleding;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
   // Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
//profile
Route::get('profile' , function (){
  
   return view('profile');

})->name('profile');
//password
Route::get('wachtwoord' , function (){
  
   return view('wachtwoord');

})->name('wachtwoord');

//orders 

Route::get('orders' , function (){
  
   return view('orders');

})->name('orders');


//sfot
 Route::get('stoffen' , function (){
  
    return view('stof.index');

 });
 Route::get('create' , function (){
  
    return view('stof.create');

 });

  Route::get('edit/{id}' , function ($id){

    return view('stof.edit',['id' => $id]);
 }); 
 
 Route::get('show/{id}' , function ($id){
      
    return view('stof.show',['id' => $id]);
 })->name('stof.show');

// Fabrikant

Route::get('fabrikant', function () {
   return view('fabrikant.index');
})->name('fabrikant.index');

Route::get('fabrikant/create', function () {
   return view('fabrikant.create');
})->name('fabrikant.create');

Route::get('fabrikant/edit/{id}', function ($id) {
   return view('fabrikant.edit', ['id' => $id]);
})->name('fabrikant.edit');

Route::get('fabrikant/show/{id}', function ($id) {
   return view('fabrikant.show', ['id' => $id]);
})->name('fabrikant.show');

 //contact
 Route::get('contact', function(){
  
    return view('contact');

 });

 //wielrennen

 Route::get('shop', function(){

    return view('wielrennen.shop');
 })->name('shop');


 Route::get('/wielrennen/show/{kleding}', function (Kleding $kleding) {
   return view('wielrennen.show', compact('kleding'));
})->name('wielrennen.show');

 Route::get('wielrennen', function(){

   return view('wielrennen.index');
})->name('wielrennen.index');
 
 Route::get('wielrennen/create', function(){

    return view('wielrennen.create');
   })->name('wielrennen.create');

   Route::get('wielrennen/edit/{id}', function($id){

      return view('wielrennen.edit',['id'=>$id]);
     })->name('wielrennen.edit');
  
 //card
 Route::get('add-to-cart/{id}',[CartController::class,'addToCart'])->name('add.to.cart');
 Route::get('cart',[CartController::class,'cart'])->name('cart');

 Route::get('/order',[CartController::class,'order'])->name('order.post');
 
 Route::get('/order-success',[CartController::class,'orderSuccess'])->name('order.success');

//over mij 
 Route::get('/over-mij', function () {
   return view('over-mij');
})->name('over-mij');

//over web site 

Route::get('/over-website', function () {
   return view('over-website');
})->name('over-website');


require __DIR__.'/auth.php';



