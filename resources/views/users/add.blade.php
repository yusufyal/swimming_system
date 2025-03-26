@extends('layout.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">

        <h4 class="card-title">{{__('users.AddNewUser')}}</h4>

</nav>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">{{__('users.Name')}}</label>
                            <input id="name" class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="{{__('users.EnterUsername')}}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="email" class="form-label">{{__('users.Email')}}</label>
                            <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="{{__('users.Enteremail')}}" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="password" class="form-label">{{__('users.Password')}}</label>
                            <input type="password" name="password" id="password" value="{{old('password')}}" placeholder="{{__('users.Enterpassword')}}" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="role"><strong>{{__('users.Roles')}}</strong></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>{{__('users.Selectrole')}}...</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mt-3">
                            <div class="col d-grid">
                                <a href="{{route('users.index')}}" class="btn text-white" style="background:red;">{{__('users.Cancel')}}</a>
                            </div>
                            <div class="col d-grid">
                                <button class="btn text-white" style="background: green;" type="submit">{{__('users.Save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush