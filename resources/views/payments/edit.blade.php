@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('payments.update',$payment)}}">
    @csrf
    @method('PUT')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">  
          <div class="mb-3">  
            <input type="hidden" name="customer_id" value="{{ $payment->customer_id }}">
          </div>
          <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <input type="text" class="form-control @if($errors->has('payment_method'))is-invalid @endif" id="payment_method" value="{{ $payment->payment_method }}" name="payment_method"  aria-describedby="emailHelp">
            @if ($errors->has('payment_method'))
                    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
            @endif
          </div>
          <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control @if($errors->has('amount'))is-invalid @endif" id="amount" value="{{ $payment->amount }}" name="amount"  aria-describedby="emailHelp">
            @if ($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
            @endif
          </div>
          
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>  
    </div>
    </form>

@endsection