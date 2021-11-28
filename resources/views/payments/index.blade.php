@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('customers.index') }}" class="btn btn-primary">Create Payment</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Payments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Payment Date</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Payment Date</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($payments as $payment)
                       <tr>
                           <td>{{ $payment->id }}</td>
                           <td>{{ $payment->customer_id }}</td>
                           <td>{{ $payment->payment_date }}</td>
                           <td>{{ $payment->payment_method }}</td>
                           <td>{{ $payment->amount }}</td>
                            <td>
                                <a href="{{ route('payments.edit',$payment->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('payments.delete',$payment->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection