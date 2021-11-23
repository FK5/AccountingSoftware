@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('products.create')}}" class="btn btn-primary">Create Product or Service</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Products and Services</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Sales Price</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Sales Price</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($products as $product)
                       <tr>
                           <td>{{ $product->id }}</td>
                           <td>{{ $product->title }}</td>
                           <td>{{ $product->description }}</td>
                           <td>{{ $product->sku }}</td>
                           <td>{{ $product->category_id }}</td>
                           <td>{{ $product->company_id }}</td>
                           <td>{{ $product->sales_price }}</td>
                           <td>{{ $product->cost }}</td>
                            <td>
                                <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('products.delete',$product->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection