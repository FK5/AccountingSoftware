@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('users.update',$user->id)}}">
    @csrf
    @method('PATCH')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @if($errors->has('first_name'))is-invalid @endif" value="{{ $user->first_name }}" id="first_name" name="first_name"  aria-describedby="emailHelp">
            @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control @if($errors->has('last_name'))is-invalid @endif" value="{{ $user->last_name }}" id="last_name" name="last_name"  aria-describedby="emailHelp">
            @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-Mail</label>
            <input type="text" class="form-control @if($errors->has('email'))is-invalid @endif" value="{{ $user->email }}" id="email" name="email"  aria-describedby="emailHelp">
            @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @if($errors->has('password'))is-invalid @endif" id="password" name="password"  aria-describedby="emailHelp">
            @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender <h6>[male - female - other]</h6></label>
            <input type="text" class="form-control @if($errors->has('gender'))is-invalid @endif" value="{{ $user->gender }}" id="gender" name="gender"  aria-describedby="emailHelp">
            @if ($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
            @endif
          </div>

          <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" value="{{ $user->date_of_birth }}" id="date_of_birth" name="date_of_birth"
                                            value="2021-11-15"
                                            min="1900-01-01" max="2022-12-31">
            @if ($errors->has('date_of_birth'))
                    <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
            @endif
          </div>

          <div class="mb-1">
            <label for="status" class="form-label">Status: {{ $user->status }}</label>
          </div>
          <div class="mb-3">
            <select class="form-select @if($errors->has('status'))is-invalid @endif" name="status" aria-label="Default select example">
              <option selected>Open this select menu</option>
              <option value="approved">Approved</option>
              <option value="pending">Pending</option>
              <option value="blocked">Blocked</option>
            </select>
            @if ($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
          </div>
          
          <div class="mb-1">
            <label for="role_id" class="form-label">Role: </label>
          </div>
          <div class="mb-3">
            <select class="form-select @if($errors->has('role_id'))is-invalid @endif" name="role_id" aria-label="Default select example">
              <option selected>Open this select menu</option>
              @foreach ($roles as $role)
                <option @if ($user->role_id == $role->id) selected @endif value="{{ $role->id }}">{{ $role->slug }}</option>
              @endforeach
            </select>
            @if ($errors->has('role_id'))
                    <span class="text-danger">{{ $errors->first('role_id') }}</span>
            @endif
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>  
    </div>
    </form>

@endsection