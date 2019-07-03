@extends('admin/layout-admin/layout-admin')

@section('content')
<!-- Top Menu Items -->
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="{{route('index-admin')}}"><i class="fa fa-fw fa-table"></i> Categories</a>
            </li>
            <li>
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
                <h1 class="page-header">Categories</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-table"></i> Categories<a class="text-success btn" href="admin/edit-category"><i class="fa fa-fw fa-plus"></i></a>
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Class</th>
                                <th class="text-center col-sm-3">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($categories as $category)
                             <tr>
                                <td class="text-center">{{$category->nume}}</td>
                                <td class="text-center">{{$category->clasa}}</td>
                                <td class="text-center"><a class="text-primary btn" href="admin/edit-category/{{$category->id}}"><i class="fa fa-fw fa-pencil"></i></a>
                                    <form action="{{url('admin/'.$category->id)}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete text-danger btn" href="admin/{{$category->id}}" style="background: transparent;"><i class="fa fa-fw fa-remove"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><a style="width: 100%;" class="text-success btn" href="admin/edit-category"><i class="fa fa-fw fa-plus"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
@endsection