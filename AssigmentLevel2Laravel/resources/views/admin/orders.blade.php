@extends('admin/layout-admin/layout-admin')

@section('content')
<!-- Top Menu Items -->
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{route('index-admin')}}"><i class="fa fa-fw fa-table"></i> Categories</a>
            </li>
            <li>
                <a href="{{url('admin/products')}}"><i class="fa fa-fw fa-table"></i> Products</a>
            </li>
            <li class="active">
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
                <h1 class="page-header">
                    Orders
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-table"></i> Orders
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    @if(session()->has('successful'))
                        <p class="alert alert-success">{{ session()->get('successful') }}</p>
                    @endif
                    @include('admin/common/errors')
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">ID Order</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center col-sm-2">Details/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)     
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->prenume }}</td>
                                <td class="text-center">{{ $order->nume }}</td>
                                <td class="text-center"><a class="view text-info btn" href="{{url('admin/orders/'.$order->id)}}"><i class="fa fa-fw fa-eye"></i></a>
                                    <form action="{{url('admin/orders/'.$order->id)}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete text-danger btn" href="admin/orders/{{$order->id}}" style="background: transparent;"><i class="fa fa-fw fa-remove"></i></button></td>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @isset($client)
            <div class="col-lg-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>First Name</th>
                                <td>{{ $client->prenume }}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{ $client->nume }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $client->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $client->telefon }}</td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td>{{ $client->strada }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $client->adresa }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $client->oras }}</td>
                            </tr>
                            <tr>
                                <th>County</th>
                                <td>{{ $client->judet }}</td>
                            </tr>
                            @if($client->observatii)
                            <tr>
                                <th>Comments</th>
                                <td>{{ $client->observatii }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endisset
            @isset($products)
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)                              
                            <tr>
                                <td class="text-center">{{ $product->nume }}</td>
                                <td class="text-center">{{ $product->categorie }}</td>
                                <td class="text-center">{{ $product->pret }}</td>
                                <td class="text-center">{{ $product->pivot->q_produs }}</td>
                                <td class="text-center">{{ $product->pret*$product->pivot->q_produs }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">Total Order Price</th>
                                <td class="text-center" colspan="4">{{ $total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @endisset
@endsection
