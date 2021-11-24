@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('customers.update',$customer->id)}}">
    @csrf
    @method('PUT')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @if($errors->has('first_name'))is-invalid @endif" value="{{ $customer->first_name }}" id="first_name" name="first_name"  aria-describedby="emailHelp">
            @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control @if($errors->has('last_name'))is-invalid @endif" value="{{ $customer->last_name }}" id="last_name" name="last_name"  aria-describedby="emailHelp">
            @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" class="form-control @if($errors->has('company'))is-invalid @endif" value="{{ $customer->company }}" id="company" name="company"  aria-describedby="emailHelp">
            @if ($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-Mail</label>
            <input type="text" class="form-control @if($errors->has('email'))is-invalid @endif" value="{{ $customer->email }}" id="email" name="email"  aria-describedby="emailHelp">
            @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control @if($errors->has('phone'))is-invalid @endif" value="{{ $customer->phone }}" id="phone" name="phone"  aria-describedby="emailHelp">
            @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
          </div>
          
          <div class="mb-3">
            {{-- company id --}}
            <label for="company_id" class="form-label">Company ID</label>
            <select class="form-select @if($errors->has('company_id'))is-invalid @endif" name="company_id" aria-label="Default select example">
              @foreach ($companies as $company)
                @if ($company->id == $customer->company_id)
                  <option value="{{ $company->id }}" selected>{{ $company->company_name }}</option>    
                @else
                  <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endif  
              @endforeach
            </select>
            @if ($errors->has('company_id'))
                    <span class="text-danger">{{ $errors->first('company_id') }}</span>
            @endif    
          </div>

          <div class="mb-3">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control @if($errors->has('mobile'))is-invalid @endif" value="{{ $customer->mobile }}" id="mobile" name="mobile"  aria-describedby="emailHelp">
            @if ($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @if($errors->has('address'))is-invalid @endif" value="{{ $customer->address }}" id="address" name="address"  aria-describedby="emailHelp">
            @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>  
    </div>
    </form>

@endsection