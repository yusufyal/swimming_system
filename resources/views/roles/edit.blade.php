@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
    <h4 class="card-title">{{__('roles.EditRole')}}</h4>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="name" class="form-label">{{__('roles.Name')}}</label>
                            <input id="name" class="form-control" name="name" value="{{ old('name',$role->name) }}" type="text" placeholder="{{__('roles.EnterroleName')}}" required>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>{{__('roles.Permission')}}</strong>
                                <br />
                                @foreach ($permissions as $permission)
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="name" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }}>
                                    {{ $permission->name }}</label>
                                <br />
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col d-grid">
                            <a href="{{route('roles.index')}}" class="btn text-white" style="background: red;">{{__('roles.Cancel')}}</a>
                        </div>
                        <div class="col d-grid">
                            <button class="btn text-white" style="background: #042954;" type="submit">{{__('roles.Update')}}</button>
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