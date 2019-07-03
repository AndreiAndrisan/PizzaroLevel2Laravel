<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class OrderController extends Controller
{
    public function index()
    {
    	$orders = Client::get(['id', 'nume', 'prenume']);
    	//dd($orders);
    	return view('/admin/orders',['orders' => $orders]);
	}

	public function view($order)
    {
    	$orders = Client::get(['id', 'nume', 'prenume']);
    	$client = Client::get()->where('id',$order)->first();
    	$products = $client->products;
		$totalPrice = 0;
		foreach ($products as $product) {
			$totalPrice += $product->pret*$product->pivot->q_produs;
		}
    	return view('/admin/orders', ['orders' => $orders, 'client' => $client, 'products' => $products, 'total' => $totalPrice]);
	}

	public function destroy($client)
    {
    	$client = Client::find($client);
        $client->delete();
        return redirect('/admin/orders')->with('successful', 'Successful! Order number '.$client->id.' was deleted.');
    }
}
