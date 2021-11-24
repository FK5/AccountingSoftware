@extends('layouts.dashboard')

@section('content')

    <h3>Select Company</h3>
    @foreach ($companies as $company)
        <a href="{{ route('invoices.index',$company->id) }}" class="btn btn-primary">{{ $company->company_name }}</a>
    @endforeach


@endsection