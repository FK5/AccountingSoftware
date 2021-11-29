@extends('layouts.dashboard')

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
               @foreach ($users as $user)
                   <tr>
                       <input type="hidden" disabled
                                @foreach ($company->users as $company_user)
                                    @if ($company_user->id== $user->id)
                                    {{ $checked =true }}      
                                        checked
                                    @endif
                                @endforeach    >
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                        @if (!empty($checked) && $checked)
                        @php
                          $checked = false;
                        @endphp   
                          <form action="{{ route('companies.officers.detach' , $company->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <td><button type="submit" class="btn btn-danger">Detach</button></td>
                          </form>
                        @else
                          <form action="{{ route('companies.officers.attach', $company->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <td><button type="submit" class="btn btn-success">Attach</button></td>
                          </form>
                        @endif
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>

@endsection