@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($roles as $role)
                       <tr>
                           <td>{{ $role->id }}</td>
                           <td>{{ $role->name }}</td>
                           <td>{{ $role->slug }}</td>
                            <td>
                                <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('roles.delete',$role->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection