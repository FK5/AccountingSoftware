@extends('layouts.dashboard')

@section('content')
  <form method="POST" class="row-6" action="{{route('products.update', $product->id)}}">
    @csrf
    @method('PUT')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @if($errors->has('title'))is-invalid @endif" value="{{ $product->title }}" id="title" name="title"  aria-describedby="emailHelp">
            @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @if($errors->has('description'))is-invalid @endif"  id="description" name="description" rows="2">{{ $product->description }}</textarea>
            @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control @if($errors->has('sku'))is-invalid @endif" value="{{ $product->sku }}" id="sku" name="sku"  aria-describedby="emailHelp">
            @if ($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
            @endif
          </div>
          
          <div class="mb-3">
            {{-- category --}}
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select @if($errors->has('category_id'))is-invalid @endif" name="category_id" aria-label="Default select example">
              @foreach ($categories as $category)
                @if ($category->id == $product->category_id)
                  <option value="{{ $category->id }}" selected>{{ $category->name }}</option>    
                @else
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif  
              @endforeach
            </select>
            @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
            @endif    
          </div>

          <div class="mb-3">
            {{-- company --}}
            <label for="company_id" class="form-label">Company</label>
            <select class="form-select @if($errors->has('company_id'))is-invalid @endif" name="company_id" aria-label="Default select example">
              @foreach ($companies as $company)
                @if ($company->id == $product->company_id)
                  <option value="{{ $company->id }}" selected>{{ $company->company_name }}</option>     
                @else
                  <option value="{{ $company->id }}">{{ $company->company_name }}</option> 
                @endif
              @endforeach
            </select>
            @if ($errors->has('company_id'))
                    <span class="text-danger">{{ $errors->first('company_id') }}</span>
            @endif
          </div>

          <div class="mb-3">
            <label for="sales_price" class="form-label">Sales Price</label>
            <input type="text" class="form-control @if($errors->has('sales_price'))is-invalid @endif" value="{{ $product->sales_price }}" id="sales_price" name="sales_price"  aria-describedby="emailHelp">
            @if ($errors->has('sales_price'))
                    <span class="text-danger">{{ $errors->first('sales_price') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="text" class="form-control @if($errors->has('cost'))is-invalid @endif" value="{{ $product->cost }}" id="cost" name="cost"  aria-describedby="emailHelp">
            @if ($errors->has('cost'))
                    <span class="text-danger">{{ $errors->first('cost') }}</span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>  
    </div>
    </form>

@endsection