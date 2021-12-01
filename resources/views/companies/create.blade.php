@extends('layouts.dashboard')

@section('content')

  <form method="POST" class="row-6" action="{{route('companies.store')}}">
    @csrf
    @method('POST')
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control @if($errors->has('company_name'))is-invalid @endif" id="company_name" name="company_name"  aria-describedby="emailHelp">
            @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="legal_name" class="form-label">Legal Name</label>
            <input type="text" class="form-control @if($errors->has('legal_name'))is-invalid @endif" id="legal_name" name="legal_name"  aria-describedby="emailHelp">
            @if ($errors->has('legal_name'))
                    <span class="text-danger">{{ $errors->first('legal_name') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="business_id" class="form-label">Business ID</label>
            <input type="text" class="form-control @if($errors->has('business_id'))is-invalid @endif" id="business_id" name="business_id"  aria-describedby="emailHelp">
            @if ($errors->has('business_id'))
                    <span class="text-danger">{{ $errors->first('business_id') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="company_email" class="form-label">Company E-Mail</label>
            <input type="text" class="form-control @if($errors->has('company_email'))is-invalid @endif" id="company_email" name="company_email"  aria-describedby="emailHelp">
            @if ($errors->has('company_email'))
                    <span class="text-danger">{{ $errors->first('company_email') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="company_phone_number" class="form-label">Company Phone Number</label>
            <input type="text" class="form-control @if($errors->has('company_phone_number'))is-invalid @endif" id="company_phone_number" name="company_phone_number"  aria-describedby="emailHelp">
            @if ($errors->has('company_phone_number'))
                    <span class="text-danger">{{ $errors->first('company_phone_number') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="company_address" class="form-label">Company Address</label>
            <textarea class="form-control @if($errors->has('company_address'))is-invalid @endif" id="company_address" name="company_address" rows="2"></textarea>
            @if ($errors->has('company_address'))
                    <span class="text-danger">{{ $errors->first('company_address') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="industry" class="form-label">Industry</label>
            <input type="text" class="form-control @if($errors->has('industry'))is-invalid @endif" id="industry" name="industry"  aria-describedby="emailHelp">
            @if ($errors->has('industry'))
                    <span class="text-danger">{{ $errors->first('industry') }}</span>
            @endif
          </div>
          <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control @if($errors->has('website'))is-invalid @endif" id="website" name="website"  aria-describedby="emailHelp">
            @if ($errors->has('website'))
                    <span class="text-danger">{{ $errors->first('website') }}</span>
            @endif
          </div>
          {{-- <div class="mb-3">
            <select class="form-select @if($errors->has('user_id'))is-invalid @endif" name="user_id" aria-label="Default select example">
              <option selected>Open this select menu</option>
              @foreach ($users as $user)
                <option>{{ $user->first_name." ".$user->last_name }}</option>
              @endforeach
            </select>
            @if ($errors->has('user_id'))
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
            @endif
          </div> --}}
          @if(Auth::user()->id == 1 or Auth::user()->isManager())
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="approved" name="approved" >
              <label class="form-check-label" for="approved">Approved</label>
            </div>
          @endif
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>  
    </div>
    </form>

@endsection