@extends('layouts.dashboard')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('customers.index') }}" class="btn btn-primary">Create Invoice</a>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Invoices</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Billing Address</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Invoice Number</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Billing Address</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Invoice Number</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach ($invoices as $invoice)
                       <tr>
                           <td>{{ $invoice->id }}</td>
                           <td>{{ $invoice->customer_id }}</td>
                           <td>{{ $invoice->billing_address }}</td>
                           <td>{{ $invoice->invoice_date }}</td>
                           <td>{{ $invoice->due_date }}</td>
                           <td>{{ $invoice->invoice_number }}</td>
                           <td>{{ $invoice->discount }}</td>
                           <td>{{ $invoice->subtotal }}</td>
                           <td>{{ $invoice->total }}</td>
                            <td>
                                <a href="{{ route('invoices.edit',$invoice->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('invoices.delete',$invoice->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection