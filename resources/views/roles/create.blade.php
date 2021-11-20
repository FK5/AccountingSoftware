@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('roles.store')}}">
    @csrf
    @method('POST')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control @if($errors->has('name'))is-invalid @endif" id="name" name="name"  aria-describedby="emailHelp">
            @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @if($errors->has('slug'))is-invalid @endif" id="slug" name="slug"  aria-describedby="emailHelp">
            @if ($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
            @endif
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>  
    </div>
    </form>
    
@endsection