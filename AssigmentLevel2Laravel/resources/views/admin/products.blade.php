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
            <div class="col-lg-12">
                <h1 class="page-header">Products</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-table"></i> Products<a class="text-success btn" href="{{url('admin/edit-product')}}"><i class="fa fa-fw fa-plus"></i></a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    @if(session()->has('successful'))
                        <p class="alert alert-success">{{session()->get('successful')}}</p>
                    @endif
                    @include('admin/common/errors')
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="col-xs-2 text-center">Name</th>
                                <th class="col-xs-1 text-center">Price</th>
                                <th class="col-xs-4 text-center">Description</th>
                                <th class="col-xs-1 text-center">Category</th>
                                <th class="text-center">Front Page Image</th>
                                <th class="text-center">Single Product Page Image</th>
                                <th class="text-center col-sm-1">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)                            
                            <tr>
                                <td class="text-center">{{ $product->nume }}</td>
                                <td class="text-center">{{ $product->pret }}</td>
                                <td>{{ $product->descriere }}</td>
                                <td class="text-center">{{ $product->categorie }}</td>
                                <td class="text-center"><img style="width:100px;" src="../images/products/{{ $product->imagine_front }}" alt=""/></td>
                                <td class="text-center"><img style="width:100px;" src="../images/single-product/{{ $product->imagine_single_product }}" alt=""/></td>
                                <td class="text-center mx-auto">
                                    <a class="text-primary btn" href="{{url('admin/edit-product/'.$product->id)}}"><i class="fa fa-fw fa-pencil"></i>
                                    </a>
                                    <form action="{{url('admin/products/'.$product->id)}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete text-danger btn" href="admin/products/{{$product->id}}" style="background: transparent;"><i class="fa fa-fw fa-remove"></i></button></td>
                                    </form>
                                </td>
                            </tr>
                           @endforeach
                            <tr>
                                <td colspan="7"><a style="width: 100%;" class="text-success btn" href="{{url('admin/edit-product')}}"><i class="fa fa-fw fa-plus"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
@endsection