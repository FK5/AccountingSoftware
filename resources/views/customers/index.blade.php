@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('customers.create')}}" class="btn btn-primary">Create Customer</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Customers</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($customers as $customer)
                       <tr>
                           <td>{{ $customer->id }}</td>
                           <td>{{ $customer->first_name }}</td>
                           <td>{{ $customer->last_name }}</td>
                           <td>{{ $customer->company }}</td>
                           <td>{{ $customer->email }}</td>
                           <td>{{ $customer->phone }}</td>
                           <td>{{ $customer->mobile }}</td>
                           <td>{{ $customer->address }}</td>
                            <td>
                                <a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('customers.delete',$customer->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection