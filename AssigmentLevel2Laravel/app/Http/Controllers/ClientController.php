<?php

namespace App\Http\Controllers;

use App\Product;
use App\Client;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ClientController extends Controller
{
   public function store(Request $request)
    {
        $attributes = $this->validateClient($request);
	    Arr::forget($attributes, 'terms');
	    $client = Client::create($attributes);
	    $cart = session()->get('cart', []);
	    $cartProducts = [];
        foreach ($cart as $cartProduct) {
       		Order::create([
       			'id_order' => $client->id,
       			'id_produs' => $cartProduct['id'],
       			'q_produs' => $cartProduct['quantity']
       		]);
            $product = Product::get()->where('id',$cartProduct['id'])->first(); 
            $temp['quantity'] = $cartProduct['quantity']; 
            $temp['product'] = $product; 
            $cartProducts[]= $temp; 
        }
        $totalPrice = session()->get('price');
        session()->flush();
	    return view('/order-received',['cart'=>$cartProducts,'total'=>$totalPrice,'client'=>$client,]);
    }

     public function validateClient(Request $request)
    {
        return $request->validate([
    		'nume' => 'required|max:30',
    		'prenume' => 'required|max:50', 
    		'email' => 'required|email|max:50', 
    		'telefon' => 'required|max:13|min:11', 
    		'strada' => 'required|max:75', 
    		'adresa' => 'required|max:75', 
    		'oras' => 'required|max:30', 
    		'judet' => 'required|max:30', 
    		'observatii' => 'nullable',
    		'terms' => 'required'
    	]);
    }
}
