<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product)
    {
        $product = Product::get()->where('id',$product)->first(); 
        return view('/single-product-v1',['product'=>$product,]);
    }

     /**
     * Display the order list (cart) from the session.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($check = null)
    {
        $cart = session()->get('cart', []);
        $cartProducts = [];
        foreach ($cart as $cartProduct) {
            $product = Product::get()->where('id',$cartProduct['id'])->first(); 
            $temp['quantity'] = $cartProduct['quantity']; 
            $temp['product'] = $product; 
            $cartProducts[]= $temp; 
        }
        if($check == null) {
            return view('/cart',['cart'=>$cartProducts,]);
        } else {
            if(session()->get('price')) {
                return view('/checkout',['cart'=>$cartProducts,]);
            } else {
                return view('/index');
            }
        }
    }

    public function addToCart(Request $request)
    {
        //dd('here');
        $cart = session()->get('cart', []);
        $price = session()->get('price');
        $found = false;
        foreach ($cart as &$product) {
            if ($product['id'] == $request->id) {
                $product['quantity']+= $request->quantity;
                $found = true;
                break;
            }
        }
        if($found == true) {
            $price += ($request->price*$request->quantity);
            session()->put('cart', $cart);
            session()->put('price', $price);
        }
        else {  // if no item was found put it in cart
             session()->push('cart', [
            'id' => $request->id,
            'quantity' => $request->quantity,
            ]);
             $price += ($request->price*$request->quantity);
            session()->put('price', $price);
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        //dd($request);
        $cart = session()->get('cart', []);
        $price = session()->get('price');
        $found = false;
        foreach ($cart as &$product) {
            if ($product['id'] == $request->id) {
                if($product['quantity'] < $request->quantity) {
                    $price += $request->price * ($request->quantity - $product['quantity']);
                } else {
                    $price -= $request->price * ($product['quantity'] - $request->quantity);
                }
                $product['quantity'] = $request->quantity;
                $found = true;
                break;
            }
        }
        if($found == true) {
            session()->put('cart', $cart);
            session()->put('price', $price);
        }

        return redirect()->back();
    }




    // Admin***********************************************************
    
    public function indexAdmin()
    {
        $products = Product::get(); 
        return view('/admin/products',['products'=>$products,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/edit-product')->with('product', null);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('/admin/edit-product',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateProduct($request);
        $attribute = 'imagine_front';
        $folder = '/images/products/';
         if ($request->has('imagine_front')) {
            $newImageName = $this->addImage($request, $attribute, $folder);
            // Give the new name of the uploaded image together with the extension
            $attributes['imagine_front'] = $newImageName;
        }

        $folder = '/images/single-product/';
        $attribute = 'imagine_single_product';
        if ($request->has('imagine_single_product')) {
            $newImageName2 = $this->addImage($request, $attribute, $folder);
            // Give the name of the new image together with the extension
            $attributes['imagine_single_product'] = $newImageName2;
        }
        Product::create($attributes);
        return redirect('/admin/products')->with('successful', 'Successful! Product '.$request->nume.' was created.');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $this->validateProduct($request);
        $attribute = 'imagine_front';
        $folder = '/images/products/';
         if ($request->has('imagine_front')) {
            $newImageName = $this->addImage($request, $attribute, $folder);
            // Give the new name of the uploaded image together with the extension
            $attributes['imagine_front'] = $newImageName;
        }

        $folder = '/images/single-product/';
        $attribute = 'imagine_single_product';
        if ($request->has('imagine_single_product')) {
            $newImageName2 = $this->addImage($request, $attribute, $folder);
            // Give the name of the new image together with the extension
            $attributes['imagine_single_product'] = $newImageName2;
        }
        $product->update($attributes);
        return redirect('/admin/products')->with('successful', 'Successful! Product '.$request->nume.' was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $folder = '/images/products/';
        $this->deleteImage($folder, 'public', $product->imagine_front);
        $folder = '/images/single-product/';
        $this->deleteImage($folder, 'public', $product->imagine_single_product);
        $product->delete();
        return redirect()->back()->with('successful', 'Successful! Product '.$product->nume.' was deleted.');
    }

    public function validateProduct(Request $request)
    {
        return $request->validate([
            'nume' => 'required|max:50',
            'pret' => 'required|integer|max:10000',
            'descriere' => 'required|max:150',
            'categorie' => 'required|max:30|exists:categorie,nume',
            'imagine_front' => 'required_if:fimage,0,|image|mimes:jpeg,jpg,png|max:2048',
            'imagine_single_product' => 'required_if:simage,0,|image|mimes:jpeg,jpg,png|max:2048',
        ],
        [ 
            'imagine_front.required_if' => 'The imagine front field is required.',
            'imagine_single_product.required_if' => 'The imagine single product field is required.',
        ]);
    }

    public function addImage(Request $request, $attribute, $folder)
    {
        // Get image file
            $image = $request->file($attribute);
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('nume')).'_'.time();

            // Define folder path
            //$folder = '/images/products/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadImage($image, $folder, 'public', $name);
            if($request->has('fimage')) {
                $this->deleteImage($folder, 'public', $request->fimage);
            }
            return $name.'.'.$image->getClientOriginalExtension();
    }
}
