@extends('layouts.dashboard')

@section('content')

    <h3>Do you really want to delete it</h3>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Cancel</a>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    <form>
  
@endsection