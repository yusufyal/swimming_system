@extends('layout.master')
@section('title', 'Add Role')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
        <h4 >{{__('roles.AddNewRole')}}</h4>

</nav>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
               <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="name" class="form-label">{{__('roles.Name')}}</label>
                            <input id="name" class="form-control" name="name" type="text" value="{{old('name')}}" placeholder="{{__('roles.EnterYourRoleName')}}">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                            <div class="form-group">
                                <strong>{{__('roles.Permission')}}</strong>
                                <br />
                                @foreach ($permissions as $permission)
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="name">
                                    {{ $permission->name }}</label>
                                <br />
                                @endforeach
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3 d-grid">
                                <a href="{{route('roles.index')}}" class="btn text-white" style="background: red;">{{__('roles.Cancel')}}</a>
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn text-white" style="background: green;" type="submit">{{__('roles.Save')}}</button>
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