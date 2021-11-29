@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('companies.create')}}" class="btn btn-primary">Create Company</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Companies</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Legal Name</th>
                        <th>Business ID</th>
                        <th>Comapny E-Mail</th>
                        <th>Comapny Phone Number</th>
                        <th>Comapny Address</th>
                        <th>Industry</th>
                        <th>Website</th>
                        <th>Approved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Legal Name</th>
                        <th>Business ID</th>
                        <th>Comapny E-Mail</th>
                        <th>Comapny Phone Number</th>
                        <th>Comapny Address</th>
                        <th>Industry</th>
                        <th>Website</th>
                        <th>Approved</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($companies as $company)
                       <tr>
                           <td>{{ $company->id }}</td>
                           <td>{{ $company->company_name }}</td>
                           <td>{{ $company->legal_name }}</td>
                           <td>{{ $company->business_id }}</td>
                           <td>{{ $company->company_email }}</td>
                           <td>{{ $company->company_phone_number }}</td>
                           <td>{{ $company->company_address }}</td>
                           <td>{{ $company->industry }}</td>
                           <td>{{ $company->website }}</td>
                           <td>
                                @if ($company->approved)
                                    Approved
                                @else
                                    Not Approved
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('companies.assign',$company->id) }}" class="btn btn-success">Assign Officer</a>
                                <a href="{{ route('companies.edit',$company->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('companies.delete',$company->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection