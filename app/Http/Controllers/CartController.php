<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kleding;

class CartController extends Controller
{
   public function addToCart($id)
   {
     // session()->forget('cart');

     $kleding = Kleding::find($id);

     $cart = session('cart', []);

     //dd($cart[$id]['aantalen']);
     
     if (isset($cart[$id])) {
         $cart[$id]['aantalen'] = $cart[$id]['aantalen'] + 1;
     }else{
        $cart[$id] = [
            "name" => $kleding->name,
            "aantalen" => 1,
            "prijs" => $kleding->prijs,
            "omschrijving" => $kleding->omschrijving,
       ];
     }
     
     session()->put("cart",$cart);
      return redirect()->back()->with("success","product added to cart");
   }

   public function cart()
   {
      $cart = session('cart', []);

      foreach ($cart as $id => $item) {
  
          if (!Kleding::find($id)) {
              unset($cart[$id]);
          }
      }
  
      session()->put('cart', $cart);
  
     
      return view("wielrennen.cart");
   }

   public function order()
   {
      
     dd("order");
      
   }

   public function orderSuccess(Request $request)
   {
       return view('orderSuccess');
   }

}
