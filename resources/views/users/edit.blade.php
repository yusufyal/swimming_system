@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">

        <h4 class="card-title">{{__('users.EditUsers')}}</h4>

</nav>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="user_id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label"> {{__('users.Name')}}</label>
                            <input id="name" class="form-control" name="name" type="text" value="{{ old('name', $user->name) }}" placeholder="{{__('users.EnterUsername')}}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="email" class="form-label">{{__('users.Email')}}</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" onvolumechange="{{__('users.Enteremail')}}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="password" class="form-label">{{__('users.Password')}} </label>
                            <input type="password" name="password" id="password" value="{{old('password',$user->password)}}" placeholder="{{__('users.Enterpassword')}}" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="role"><strong>{{__('users.Roles')}}</strong></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled {{ old('role', $userRole) ? '' : 'selected' }}>{{__('users.Selectrole')}}...</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role', $userRole) == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col d-grid">
                            <a href="{{route('users.index')}}" class="btn text-white" style="background: red;">{{__('users.Cancel')}}</a>
                        </div>
                        <div class="col d-grid">
                            <button class="btn text-white" style="background: #042954;" type="submit">{{__('users.Update')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection