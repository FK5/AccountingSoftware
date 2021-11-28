@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('payments.store')}}">
    @csrf
    @method('POST')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">  
          <div class="mb-3">  
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
          </div>
          <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <input type="text" class="form-control @if($errors->has('payment_method'))is-invalid @endif" id="payment_method" name="payment_method"  aria-describedby="emailHelp">
            @if ($errors->has('payment_method'))
                    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
            @endif
          </div>
          <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control @if($errors->has('amount'))is-invalid @endif" id="amount" name="amount"  aria-describedby="emailHelp">
            @if ($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
            @endif
          </div>
          
          <!--------------------------------------------------------------------------------- -->
            {{-- <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>Invoice Number</th>
                          <th>Total</th>
                          <th>Amount left</th>
                          <th>Amount</th>
                      </tr>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Invoice Number</th>
                          <th>Total</th>
                          <th>Amount left</th>
                          <th>Amount</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($invoices as $invoice)
                          <tr>
                              <td>{{ $invoice->id }}</td>
                              <td>{{ $invoice->invoice_number }}</td>
                              <td>{{ $invoice->total }}</td>
                              <td></td>
                              <td>
                                <input type="number" name="amount[]" value="0" min="0" max="100">
                              </td>
                          </tr>
                      @endforeach
                    </tbody>
                </table>
            </div> --}}

          <!--------------------------------------------------------------------------------- -->
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>  
    </div>
    </form>

@endsection