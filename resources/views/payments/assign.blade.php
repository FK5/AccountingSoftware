@extends('layouts.dashboard')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-8">
        <!--------------------------------------------------------------------------------- -->
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Invoice Number</th>
                        <th>Total</th>
                        <th>Amount left</th>
                        <th>Payment ID + remaining</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Invoice Number</th>
                        <th>Total</th>
                        <th>Amount left</th>
                        <th>Payment ID + remaining</th>
                        <th>Amount</th>
                        <th>Actions</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($invoices as $invoice)
                      <tr>
                          <td>{{ $invoice->id }}</td>
                          <td>{{ $invoice->invoice_number }}</td>
                          <td>{{ $invoice->total }}</td>
                          <td>{{ $invoice->amount_unpaid }}</td>
                          <form method="POST" action="{{ route('payments.link',$customer->id) }}">
                            @csrf
                            <td>
                              <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                              <select class="form-select" name="payment_id" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach ($payments as $payment)
                                  <option value="{{$payment->id}}">{{$payment->id."   |   ".$payment->remaining}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                              <input type="number"  class=" @if($errors->has('amount'))is-invalid @endif" name="amount" value="0" min="0" max="100000">
                            </td>
                            <td>
                              <button type="submit" class="btn btn-success">Assign</button>
                            </td>
                        </form>
                        {{-- <td>
                        <form method="POST" action="{{ route('payments.link',$customer->id) }}" id="payoutRequest">
                          @csrf
                            <input type="hidden" name="invoice_id" id="invoice_id" value="{{ $invoice->id }}">
                            <input type="hidden" name="payment_id" id="payment_id" value="{{ $payment->id }}">
                            <button type="submit" class="btn btn-primary btn-sm" id="btnFront" style="cursor: pointer;"> Assign </button>
                        </form>
                      </td>  --}}
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
          </div>
          

        <!--------------------------------------------------------------------------------- -->
      </div>
      
    </div>  
  </div>


@endsection