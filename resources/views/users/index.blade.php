@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($users as $user)
                       <tr>
                           <td>{{ $user->id }}</td>
                           <td>{{ $user->first_name }}</td>
                           <td>{{ $user->last_name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ $user->gender }}</td>
                           <td>{{ $user->date_of_birth }}</td>
                           <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('users.delete',$user->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection