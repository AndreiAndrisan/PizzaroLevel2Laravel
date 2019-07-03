@extends('layout/layout')

@section('content')
 <div id="content" class="site-content" tabindex="-1" >
    <div class="col-full">
       <div class="pizzaro-breadcrumb">
          <nav class="woocommerce-breadcrumb" ><a href="{{url('cart')}}">Home</a>
             <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>Cart
          </nav>
       </div>
       <!-- .woocommerce-breadcrumb -->
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
             <div id="post-8" class="post-8 page type-page status-publish hentry">
                <div class="entry-content">
                   <div class="woocommerce">
                         <table class="shop_table shop_table_responsive cart" >
                            <thead>
                               <tr>
                                  <th class="product-thumbnail">&nbsp;</th>
                                  <th class="product-name">Product</th>
                                  <th class="product-price">Price</th>
                                  <th class="product-quantity text-center">Quantity</th>
                                  <th class="product-subtotal">Total</th>
                               </tr>
                            </thead>
                            <tbody>
                             @foreach($cart as $cartProduct)
                             <form action="{{url('cart')}}" method="post">
                              @csrf
                                  <tr class="cart_item">                               
                                      <td class="product-thumbnail">
                                         <a href="single-product-v1/{{$cartProduct['product']->id}}">
                                          <img width="180" height="180" src="images/products/{{$cartProduct['product']->imagine_front}}" alt=""/>
                                         </a>
                                         <input type="hidden" name="id" value="{{$cartProduct['product']->id}}">
                                      </td>
                                      <td class="product-name" data-title="Product">
                                         <a href="single-product-v1/{{$cartProduct['product']->id}}">{{$cartProduct['product']->nume}}</a>
                                      </td>
                                      <td class="product-price" data-title="Price">
                                         <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>{{$cartProduct['product']->pret}}</span>
                                         <input type="hidden" name="price" value="{{$cartProduct['product']->pret}}">
                                      </td>
                                      <td class="product-quantity" data-title="Quantity">
                                         <div class="qty-btn">
                                            <label>Quantity</label>
                                            <div class="quantity">
                                               <input type="number" min="1" name="quantity" data-id="{{$cartProduct['product']->id}}" value="{{$cartProduct['quantity']}}" title="Qty" class="input-text qty text"/>
                                            </div>
                                         </div>
                                      </td>
                                       <td>
                                         <input type="submit" class="button" name="update_cart" value="Update Cart" />
                                      </td>
                                      <td class="product-subtotal" data-title="Total">
                                         <span class="woocommerce-Price-amount amount" price="{{$cartProduct['product']->pret}}"><span class="woocommerce-Price-currencySymbol">&#36;</span>{{$cartProduct['quantity']*$cartProduct['product']->pret}}</span>
                                      </td>
                                   </tr>
                                  </form>
                             @endforeach
                                  <tr>
                                    <td colspan="6" class="actions">
                                       <div class="wc-proceed-to-checkout">
                                           <button onclick="location.href='checkout/1';" class="checkout-button button alt wc-forward {{ (session()->get('price') != 0) ? '' : 'disabled'}}" {{ (session()->get('price') != 0) ? "" : "disabled"}}>Proceed to Checkout</button>
                                       </div>
                                    </td>
                                  </tr>
                            </tbody>
                         </table>
                      <div class="cart-collaterals">
                         <div class="cart_totals ">
                            <h2>Cart Totals</h2>
                            <table id="totals" class="shop_table shop_table_responsive">
                               <tr class="cart-subtotal">
                                  <th>Subtotal</th>
                                  <td data-title="Subtotal">
                                     <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>{{(session()->get('price')) ? session()->get('price') : 0}}</span>
                                  </td>
                               </tr>
                               <tr class="order-total">
                                  <th>Total</th>
                                  <td data-title="Total">
                                     <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>{{(session()->get('price')) ? session()->get('price') : 0}}</span></strong>
                                  </td>
                               </tr>
                            </table>
                            <div class="wc-proceed-to-checkout">
                               <button onclick="location.href='checkout/1';" class="checkout-button button alt wc-forward {{ (session()->get('price') != 0) ? '' : 'disabled'}}" {{ (session()->get('price') != 0) ? "" : "disabled"}}>Proceed to Checkout</button>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <!-- .entry-content -->
        </main><!-- #main -->
       </div>
       <!-- #post-## -->
    </div>
    <!-- #primary -->
 </div>
 <!-- .col-full -->
</div>
<!-- #content -->
@endsection
