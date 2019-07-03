@extends('layout/layout')

@section('content')
<!-- /.woocommerce-breadcrumb -->
<div id="content" class="site-content" tabindex="-1" >
  <div class="col-full">
    <div class="pizzaro-breadcrumb">
       <nav class="woocommerce-breadcrumb" itemprop="breadcrumb">
          <a href="{{route('index')}}">Home</a><span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
          <a href="{{url('/'.$product->categorie)}}">{{$product->categorie}}</a>
          <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>{{$product->nume}}
       </nav>
    </div>
    <div id="primary" class="content-area">
      <main id="main" class="site-main" >
        <div itemscope itemtype="http://schema.org/Product" id="product-50" class="post-50 product type-product status-publish has-post-thumbnail product_cat-pizza pa_food-type-veg first instock shipping-taxable purchasable product-type-simple addon-product">
          <div class="single-product-wrapper">
             <div class="product-images-wrapper">
                <div class="images">
                   <a href="../images/single-product/{{$product->imagine_single_product}}" itemprop="image" class="woocommerce-main-image zoom" title="" data-rel="prettyPhoto[product-gallery]">
                   <img width="600" height="600" src="../images/single-product/{{$product->imagine_single_product}}" class="attachment-shop_single size-shop_single wp-post-image" alt=""/>
                   </a>
                   <div class="thumbnails columns-4">
                      <a href="../images/single-product/1.jpg" class="zoom first" title="" data-rel="prettyPhoto[product-gallery]">
                      <img width="180" height="180" src="../images/single-product/{{$product->imagine_single_product}}" class="attachment-shop_thumbnail size-shop_thumbnail" alt=""/>
                      </a>
                      <a href="../images/single-product/2.jpg" class="zoom" title="" data-rel="prettyPhoto[product-gallery]">
                      <img width="180" height="180" src="../images/single-product/2.jpg" class="attachment-shop_thumbnail size-shop_thumbnail" alt=""/>
                      </a>
                   </div>
                </div>
             </div>
             <!-- /.product-images-wrapper -->       
             <div class="summary entry-summary">
                <h1 itemprop="name" class="product_title entry-title">{{$product->nume}}</h1>
                <div itemprop="description">
                   <p>{{$product->descriere}}</p>
                </div>
            	<!-- AddToAny END -->
                <form class="cart" action="{{url('single-product-v1/'.$product->id)}}" method="post" enctype='multipart/form-data'>
                   <div  class="yith_wapo_groups_container">
                      <div class="yith_wapo_groups_container_wrap">
                         <div id="ywapo_value_3" class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="3" data-condition="">
                            <h3 class="h3-category"><span>Price</span></h3>
                            <div class="ywapo_input_container ywapo_input_container_radio">
                               <span class="ywapo_label_price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>{{$product->pret}}</span></span>
                            </div>
                         </div>
                         <div id="ywapo_value_4" class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="4" data-condition="">
                            <h3 class="h3-category"><span>Category</span></h3>
                            <div class="ywapo_input_container ywapo_input_container_radio">
                               <span class="ywapo_label_price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{$product->categorie}}</span></span>
                            </div>
                         </div>
                      </div>
                   </div>
                    @csrf
                     <div class="qty-btn">
                        <label>Quantity</label>
                        <div class="quantity">
                          <input type="hidden" name="price" value="{{$product->pret}}">
                          <input type="hidden" name="id" value="{{$product->id}}">
                          <input type="number" name="quantity" min="1" value="1" title="Qty" class="input-text qty text"/>
                        </div>
                     </div>
                     <input type="submit" class="single_add_to_cart_button button alt ajax_add_to_cart" quantity="1" data-id="{{$product->id}}" value="Add to cart">
                </form>
             </div>
           </div>
            <div class="section-products">
               <h2 class="section-title">Recommended</h2>
               <div class="columns-3">
                  <ul class="products" token="{{csrf_token()}}" category="{{$product->categorie}}" data-id="{{$product->id}}">
                  </ul>
               </div>
            </div>
        </div>
      </main>
    </div>
  </div>
</div>
   <!-- .summary -->
<!-- /.single-product-wrapper -->
@endsection