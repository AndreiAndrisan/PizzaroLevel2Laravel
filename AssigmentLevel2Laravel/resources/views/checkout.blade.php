@extends('layout/layout')

@section('content')
 <div id="content" class="site-content woocommerce-checkout" tabindex="-1" >
    <div class="col-full">
       <div class="pizzaro-breadcrumb">
          <nav class="woocommerce-breadcrumb" ><a href="{{url('index')}}">Home</a>
             <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>Checkout
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
             <div id="post-9" class="post-9 page type-page status-publish hentry">
                <div class="entry-content">
                   <div class="woocommerce">
                      <form name="checkout"  class="checkout woocommerce-checkout" method="post" action="{{url('checkout/1')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="col2-set" id="customer_details">
                            <div class="col-1">
                               <div class="woocommerce-billing-fields">
                                  <h3>Billing Details</h3>
                                  @include('common/errors')
                                  <p class="form-row form-row form-row-first validate-required" id="billing_first_name_field">
                                     <label for="prenume" class="">First Name </label>
                                     <input type="text" class="input-text " name="prenume" id="prenume" placeholder=""  autocomplete="given-name"  value="{{old('prenume')}}" />
                                  </p>
                                  <p class="form-row form-row form-row-last validate-required" id="billing_last_name_field">
                                     <label for="nume" class="">Last Name </label>
                                     <input type="text" class="input-text " name="nume" id="nume" placeholder=""  autocomplete="family-name"  value="{{old('nume')}}" />
                                  </p>
                                  <div class="clear"></div>
                                  <p class="form-row form-row form-row-first validate-required validate-email" id="billing_email_field">
                                     <label for="email" class="">Email Address</label>
                                     <input type="email" class="input-text " name="email" id="email" placeholder=""  autocomplete="email" value="{{old('email')}}"  />
                                  </p>
                                  <p class="form-row form-row form-row-last validate-required validate-phone" id="billing_phone_field">
                                     <label for="telefon" class="">Phone</label>
                                     <input type="tel" class="input-text " name="telefon" id="telefon" placeholder="Ex: +441111111111"  autocomplete="tel" value="{{old('telefon')}}" />
                                  </p>
                                  <div class="clear"></div>
                                  <p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
                                     <label for="strada" class="">Address</label>
                                     <input type="text" class="input-text " name="strada" id="strada" placeholder="Street address"  autocomplete="address-line1" value="{{old('strada')}}" />
                                  </p>
                                  <p class="form-row form-row form-row-wide address-field" id="billing_address_2_field">
                                     <input type="text" class="input-text " name="adresa" id="adresa" placeholder="Apartment, suite, unit etc."  autocomplete="address-line2" value="{{old('adresa')}}" />
                                  </p>
                                  <p class="form-row form-row form-row-wide address-field validate-required" id="billing_city_field">
                                     <label for="oras" class="">Town / City</label>
                                     <input type="text" class="input-text " name="oras" id="oras" placeholder=""  autocomplete="address-level2" value="{{old('oras')}}" />
                                  </p>
                                  <p class="form-row form-row form-row-first address-field validate-required validate-state" id="billing_state_field">
                                     <label for="judet" class="">State / County</label>
                                     <input type="text" value="{{old('judet')}}" placeholder="" id="judet" name="judet" class="input-text ">
                                  </p>
                               </div>
                            </div>
                            <div class="col-2">
                               <div class="woocommerce-shipping-fields">
                                  <h3>Additional Information</h3>
                                  <p class="form-row form-row notes" id="order_comments_field">
                                     <label for="observatii" class="">Order Notes</label>
                                     <textarea name="observatii" class="input-text " maxlength="100" id="observatii" placeholder="Notes about your order, e.g. special notes for delivery."    rows="2" cols="5"></textarea>
                                  </p>
                               </div>
                            </div>
                         </div>
                         <h3 id="order_review_heading">Your order</h3>
                         <div id="order_review" class="woocommerce-checkout-review-order">
                            <table class="shop_table woocommerce-checkout-review-order-table">
                               <thead>
                                  <tr>
                                     <th class="product-name">Product</th>
                                     <th class="product-total">Total</th>
                                  </tr>
                               </thead>
                               <tbody>
                                @foreach($cart as $cartProduct)
                                  <tr class="cart_item">
                                     <td class="product-name">
                                        {{$cartProduct['product']->nume}}&nbsp;<strong class="product-quantity">&times; {{$cartProduct['quantity']}}</strong>
                                     </td>
                                     <td class="product-total">
                                        <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">&#36;</span>{{$cartProduct['quantity']*$cartProduct['product']->pret}}</span>
                                     </td>
                                  </tr>
                                  @endforeach
                               </tbody>
                               <tfoot>
                                  <tr class="cart-subtotal">
                                     <th>Subtotal</th>
                                     <td>
                                        <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">&#36;</span>{{ (session()->get('price') != 0) ? session()->get('price') : 0}}</span>
                                     </td>
                                  </tr>
                                  <tr class="order-total">
                                     <th>Total</th>
                                     <td>
                                        <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>{{ (session()->get('price') != 0) ? session()->get('price') : 0}}</span></strong>
                                     </td>
                                  </tr>
                               </tfoot>
                            </table>
                            <div id="payment" class="woocommerce-checkout-payment">
                               <div class="form-row place-order">
                                  <noscript>Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.<br/>
                                     <input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" />
                                  </noscript>
                                  <p class="form-row terms wc-terms-and-conditions">
                                     <input type="checkbox" class="input-checkbox" name="terms"  id="terms" value="checked" />
                                     <label for="terms" class="checkbox">I&rsquo;ve read and accept the <a href="terms-and-conditions.html" target="_blank">terms &amp; conditions</a> <span class="required">*</span></label>
                                     <input type="hidden" name="terms-field" value="1" />
                                  </p>
                                  <input class="button alt {{ (session()->get('price') != 0) ? '' : 'disabled'}}" type="submit" name="submit" id="submit" style="text-align: center;" value="Place order" {{ (session()->get('price') != 0) ? "" : "disabled"}}>
                               </div>
                            </div>
                         </div>
                      </form>
                   </div>
                </div>
                <!-- .entry-content -->
             </div>
             <!-- #post-## -->
          </main>
          <!-- #main -->
       </div>
       <!-- #primary -->
    </div>
    <!-- .col-full -->
 </div>
 <!-- #content -->
@endsection