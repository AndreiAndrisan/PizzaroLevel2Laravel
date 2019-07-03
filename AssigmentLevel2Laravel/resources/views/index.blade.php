@extends('layout/layout')

@section('content')
<div id="content" class="site-content" tabindex="-1">
   <div class="col-full">
      <div class="pizzaro-breadcrumb">
         <nav class="woocommerce-breadcrumb" itemprop="breadcrumb">
            <a {{ (isset($category)) ? 'href='.url('/') : ''}}>Home</a>
            @if(isset($category))
               <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>{{$category}}
            @endif
         </nav>
      </div>
      <div id="primary" class="content-area">
         <main id="main" class="site-main" >
            <div class="columns-3">
               <ul id="products-list" class="products" token="{{csrf_token()}}" data-page="0" {{ (isset($category)) ? 'category='.$category : ''}}>
               </ul> <!-- /.products -->
                <div id="spinner">
                  <img src="{{ URL::asset('images/spinner.gif') }}" width="50" height="50" />
               </div>
            </div>
         </main>
         <!-- #main -->
      </div>
      <!-- #primary -->
   </div>
   <!-- .col-full -->
</div>
@endsection