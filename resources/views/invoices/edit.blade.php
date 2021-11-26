@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('invoices.update',$invoice)}}">
    @csrf
    @method('PUT')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">  
          <div class="mb-3">  
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
          </div>
          <div class="mb-3">
            <label for="billing_address" class="form-label">Billing Address</label>
            <input type="text" class="form-control @if($errors->has('billing_address'))is-invalid @endif" id="billing_address" value="{{ $invoice->billing_address }}" name="billing_address"  aria-describedby="emailHelp">
            @if ($errors->has('billing_address'))
                    <span class="text-danger">{{ $errors->first('billing_address') }}</span>
            @endif
          </div>
          <!--  USE DATABASE NOW()  -->
          {{-- <div class="mb-3">
            <label for="invoice_date" class="form-label">Invoice Date</label>
            <input type="date" id="start" name="invoice_date"
                                            value="2021-11-15"
                                            min="2020-01-01" max="2022-12-31">
            @if ($errors->has('invoice_date'))
                    <span class="text-danger">{{ $errors->first('invoice_date') }}</span>
            @endif
          </div> --}}
          <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" id="start" value="{{ $invoice->due_date }}" name="due_date"
                                            min="2020-01-01" max="2022-12-31">
            @if ($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
            @endif
          </div>
          <!--------------------------------------------------------------------------------- -->
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($products as $product)
                      @php
                          $quantity = 0;
                      @endphp
                      @foreach ($invoice_items as $item)
                        @if ($item->product_title == $product->title && $item->unit_price == $product->sales_price)
                          @php
                            $quantity = $item->quantity;
                          @endphp
                        @endif
                      @endforeach
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->sales_price }}</td>
                            <td>
                              <input type="hidden" name="product_title[]" value="{{ $product->title }}">
                              <input type="hidden" name="sales_price[]" value="{{ $product->sales_price }}">
                              <input type="number" name="quantity[]" value="{{ $quantity }}" min="0" max="100">
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>

          <!--------------------------------------------------------------------------------- -->
          <!--  SHOULD BE AUTO GENERATED  -->
          {{-- <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control @if($errors->has('invoice_number'))is-invalid @endif" id="invoice_number" name="invoice_number"  aria-describedby="emailHelp">
            @if ($errors->has('invoice_number'))
                    <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
            @endif
          </div> --}}
          <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="text" class="form-control @if($errors->has('discount'))is-invalid @endif" id="discount" value="{{ $invoice->discount }}" name="discount"  aria-describedby="emailHelp">
            @if ($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
            @endif
            <select class="form-select" name="discount_type" aria-label="Default select example">
              <option value="amount" selected>$</option>
              <option value="percent">%</option>

            </select>
          </div>
          <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <input type="text" class="form-control @if($errors->has('notes'))is-invalid @endif" id="notes" value="{{ $invoice->notes }}" name="notes"  aria-describedby="emailHelp">
            @if ($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
            @endif
          </div>
          <!--  SHOULD BE AUTO CALCULATED  -->
          <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input disabled type="text" class="form-control @if($errors->has('subtotal'))is-invalid @endif" id="subtotal" value="{{ $invoice->subtotal }}" name="subtotal"  aria-describedby="emailHelp">
            @if ($errors->has('subtotal'))
                    <span class="text-danger">{{ $errors->first('subtotal') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input disabled type="text" class="form-control @if($errors->has('total'))is-invalid @endif" id="total" value="{{ $invoice->total }}" name="total"  aria-describedby="emailHelp">
            @if ($errors->has('total'))
                    <span class="text-danger">{{ $errors->first('total') }}</span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>  
    </div>
    </form>

    @if ($errors->any())
    <div class="mt-5">
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
        
    @endif

@endsection