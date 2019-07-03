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
                <h1 class="page-header">{{($category)?'Edit':'Add'}} Category</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-table"></i> Categories</li>
                    <li class="active">
                        @if($category)
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
            <div class="col-offset-lg-3 col-lg-6"> 
                @include('admin/common/errors')
               <form method="post" action="{{($category) ? url('admin/edit-category/'.$category->id) : url('admin/edit-category')}}" enctype="multipart/form-data">
                @csrf
                @if($category)
                    @method('PATCH')
                @endif
                    <div>
                        <div class="row repair-row page-header">
                            <div class="col-md-4 padding-1" ><label for="nume">Name</label></div>
                            <div class="col-md-4 padding-1" >
                                <input class="form-control" type="text" name="nume" value="{{old('nume') ? old('nume') : $category['nume'] }}" required>
                            </div>
                        </div>
                         <div class="row repair-row page-header">
                            <div class="col-md-4 padding-1" ><label for="clasa">Class</label></div>
                            <div class="col-md-4 padding-1" >
                                <input class="form-control" type="text" name="clasa" value="{{old('clasa') ? old('clasa') : $category['clasa'] }}" required>
                            </div>
                        </div>
                    </div>
                    <input class="repair-row btn btn-success" type="submit" name="submit" value="{{($category) ? 'Edit' : 'Add'}}">
                </form>
            </div>
@endsection
