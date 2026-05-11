<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});



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
 });

//fabrikant
Route::get('fabrikant' , function (){
  
    return view('fabrikant.index');

 });
 Route::get('fabrikant/create' , function (){
  
    return view('fabrikant.create');

 });
 Route::get('fabrikant/edit/{id}' , function($id){

   return view('fabrikant.edit',['id'=>$id]);
   

 }); 

 //contact
 Route::get('contact', function(){
  
    return view('contact');

 });

 //wielrennen

 Route::get('wielrennen', function(){

    return view('wielrennen.index');
 });
 
 Route::get('wielrennen/create', function(){

    return view('wielrennen.create');
 });


require __DIR__.'/auth.php';
