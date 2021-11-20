@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('roles.update',$role->id)}}">
    @csrf
    @method('PUT')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control @if($errors->has('name'))is-invalid @endif" value="{{ $role->name }}" id="name" name="name"  aria-describedby="emailHelp">
            @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @if($errors->has('slug'))is-invalid @endif" value="{{ $role->slug }}" id="slug" name="slug"  aria-describedby="emailHelp">
            @if ($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
            @endif
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>  
    </div>
    </form>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
               @foreach ($permissions as $permission)
                   <tr>
                       <input type="hidden" disabled
                                @foreach ($role->permissions as $role_permission)
                                    @if ($role_permission->id == $permission->id)
                                    {{ $checked =true }}      
                                        checked
                                    @endif
                                @endforeach    >
                       <td>{{ $permission->id }}</td>
                       <td>{{ $permission->name }}</td>
                       <td>{{ $permission->slug }}</td>
                        @if (!empty($checked) &&$checked)
                        @php
                          $checked = false;
                        @endphp   
                          <form action="{{ route('roles.permissions.detach',$role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                            <td><button type="submit" class="btn btn-danger">Detach</button></td>
                          </form>
                        @else
                          <form action="{{ route('roles.permissions.attach',$role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                            <td><button type="submit" class="btn btn-success">Attach</button></td>
                          </form>
                        @endif
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>

@endsection