@extends('admin/layout-admin/layout-admin')

@section('content')
<!-- Top Menu Items -->
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{route('index-admin')}}"><i class="fa fa-fw fa-table"></i> Categories</a>
            </li>
            <li class="active">
                <a href="{{url('admin/products')}}"><i class="fa fa-fw fa-table"></i> Products</a>
            </li>
            <li>
                <a href="{{url('admin/orders')}}"><i class="fa fa-fw fa-table"></i> Orders</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">{{($product) ? 'Edit' : 'Add' }} Product</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-table"></i> Products</li>
                    <li class="active">
                        @if($product)
                        <i class="fa fa-pencil"></i> Edit
                        @else
                        <i class="fa fa-plus"></i> Add
                        @endif
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12"> 
                @include('admin/common/errors')
                <form method="post" action="{{($product) ? url('admin/edit-product/'.$product->id) : url('admin/edit-product')}}" enctype="multipart/form-data">
                    @csrf
                    @if($product)
                        @method('PATCH')
                    @endif
                    <div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 padding-1" ><label for="nume">Name</label></div>
                            <div class="col-md-4 padding-1" >
                                <input class="form-control" type="text" name="nume" value="{{old('nume') ? old('nume') : $product['nume'] }}" required>
                            </div>
                        </div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 padding-1" ><label for="pret">Price</label></div>
                            <div class="col-md-4 padding-1" >
                                <input class="form-control" type="text" name="pret" value="{{old('pret') ? old('pret') : $product['pret'] }}" required>
                            </div>
                        </div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 padding-1" ><label for="descriere">Descritpion</label></div>
                            <div class="col-md-4 padding-1" >
                                <textarea class="form-control" name="descriere" rows="4" required>{{old('descriere') ? old('descriere') : $product['descriere'] }}</textarea>
                            </div>
                        </div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 padding-1" ><label for="categorie">Category</label></div>
                            <div class="col-md-4 padding-1" >
                                <select name="categorie" class="form-control" required>d
                                    @foreach( $categories as $category)
                                        <option value="{{ $category->nume }}"
                                        @if(old('categorie') == $category->nume)
                                            {{'selected'}}
                                        @else 
                                            @if(!old('categorie') && $category->nume == $product['categorie'])
                                                {{'selected'}}
                                            @else
                                                {{''}} 
                                            @endif
                                        @endif >{{$category->nume }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 margin-1 vertical-align" style="height:100px;"><span class="media-middle"><label>Front Page Image</label></span>
                            </div>
                            <div class="col-md-4 padding-1" >
                                <img style="width:100px;height:100px;" src="{{($product) ? '../../images/products/'.$product['imagine_front'] : '' }}" alt="Empty" onerror="this.style.display='none'"/>
                            </div>
                            <div class="col-md-4 padding-1 vertical-align" style="height:100px;">
                                <input type="hidden" name="fimage" value="{{ ($product) ? $product['imagine_front'] : '' }}">
                                <input type="file" name="imagine_front" id="imagine_front" {{($product) ? '' : 'required' }}>
                            </div>
                        </div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 margin-1 vertical-align" style="height:100px;"><span class="media-middle"><label>Single Product Image</label></span></div>
                             <div class="col-md-4 padding-1" >
                                <img style="width:100px;height:100px;" src="{{ ($product) ? '../../images/single-product/'.$product['imagine_single_product'] : '' }}" alt="Empty" onerror="this.style.display='none'"/>
                             </div>
                            <div class="col-md-4 padding-1 vertical-align" style="height:100px;">
                                <input type="hidden" name="simage" value="{{ ($product) ? $product['imagine_single_product'] : '' }}">
                                <input type="file" name="imagine_single_product" id="imagine_single_product"  {{($product) ? '' : 'required' }}>
                            </div>
                        </div>
                    </div>
                    <input class="repair-row btn btn-success" type="submit" name="submit" value="{{ ($product) ? 'Edit' : 'Add' }}">
                </form>
@endsection
