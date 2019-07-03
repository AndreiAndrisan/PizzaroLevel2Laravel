@extends('layout/layout')

@section('content')
 <div id="content" class="site-content woocommerce-order-received woocommerce-checkout" tabindex="-1" >
    <div class="col-full">
       <div class="pizzaro-breadcrumb">
          <nav class="woocommerce-breadcrumb">
             <a href="{{url('index')}}">Home</a>
             <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
             <a href="">Checkout</a>
             <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>Order Received
          </nav>
       </div>
       <div id="primary" class="content-area">
          <main id="main" class="site-main" >
             <div class="pizzaro-order-steps">
                <ul>
                   <li class="cart">
                      <span class="step">1</span>Shopping Cart
                   </li>
                   <li class="checkout">
                      <span class="step">2</span>Checkout
                   </li>
                   <li class="complete">
                      <span class="step">3</span>Order Complete
                   </li>
                </ul>
             </div>
             <div id="post-9" class="post-9 page type-page status-publish hentry">
                <header class="entry-header">
                   <h1 class="entry-title">Order Received</h1>
                </header>
                <!-- .entry-header -->
                <div class="entry-content">
                   <div class="woocommerce">
                      <p class="woocommerce-thankyou-order-received">Thank you. Your order has been received.</p>
                      <ul class="woocommerce-thankyou-order-details order_details row">
                         <li class="order col-xs-4">Order Number:<strong>{{$client->id}}</strong></li>
                         <li class="date col-xs-4">Date:<strong><?= date("F j, Y"); ?></strong></li>
                         <li class="total col-xs-4">Total:<strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span><?=$total;?></span></strong></li>
                      </ul>
                      <div class="clear"></div>
                      <h2>Order Details</h2>
                      <table class="shop_table order_details">
                         <thead>
                            <tr>
                               <th class="product-name">Product</th>
                               <th class="product-total">Total</th>
                            </tr>
                         </thead>
                         <tbody>
                             @foreach($cart as $cartProduct)
                              <tr class="order_item">
                                <td class="product-name">
                                    <a href="single-product-v1/{{$cartProduct['product']->id}}">{{$cartProduct['product']->nume}}</a> <strong class="product-quantity">× {{$cartProduct['quantity']}}</strong> 
                                 </td>
                                 <td class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>{{$cartProduct['product']->pret}}</span> </td>
                               </tr>
                              @endforeach
                         </tbody>
                         <tfoot>
                            <tr>
                               <th scope="row">Subtotal:</th>
                               <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>{{$total}}</span></td>
                            </tr>
                            <tr>
                               <th scope="row">Total:</th>
                               <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>{{$total}}</span></td>
                            </tr>
                         </tfoot>
                      </table>
                      <header>
                         <h2>Customer Details</h2>
                      </header>
                      <table class="shop_table customer_details">
                         <tbody>
                            <tr>
                               <th>Email:</th>
                               <td>{{$client->email}}</td>
                            </tr>
                            <tr>
                               <th>Telephone:</th>
                               <td>{{$client->telefon}}</td>
                            </tr>
                         </tbody>
                      </table>
                      <header class="title">
                         <h3>Billing Address</h3>
                      </header>
                      <address>{{$client->prenume.' '.$client->nume}}<br>{{$client->strada}}, {{$client->adresa}}<br>{{$client->oras}}, {{$client->judet}}</address>
                   </div>
                </div>
                <!-- .entry-content -->
             </div>
             <!-- #post-## -->
          </main>
          <!-- #main -->
       </div>
    </div>
    <!-- .col-full -->
 </div>
 <!-- #content -->
 @endsection
        