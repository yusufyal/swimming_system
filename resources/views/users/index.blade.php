@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

<style>
    table[dir="rtl"] th {
        text-align: right !important;
    }

    table[dir="ltr"] th {
        text-align: left !important;
    }

    .swal2-styled.swal2-default-outline:focus {
        box-shadow: none !important;
    }

    .swal2-actions:not(.swal2-loading) .swal2-styled:active {
        background-image: none !important;
        border-color: white !important;
    }

    .swal2-actions:not(.swal2-loading) .swal2-styled:hover {
        background-image: none !important;
        border-color: white !important;
    }

    .swal2-actions:not(.swal2-loading) .swal2-styled {
        background-image: none !important;
        border-color: white !important;
    }

    .border-danger,
    .swal2-popup .swal2-actions button.swal2-cancel {
        border: none !important;
    }
</style>

@section('content')
@include('includes.messages')

<div class="d-flex justify-content-between">
    <div>
        <h4>{{__('users.AllUsers')}}</h4>
    </div>
    <div class="mb-4">
        @can('create user')
        <a href="{{route('users.create')}}" class="btn btn-sm text-white" style="background-color:#f6cb24;border-radius:15px;">{{__('users.AddUser')}}</a>
        @endcan
    </div>
</div>
<div class="mb-2">
    <h6 style="color:#f6cb24">{{__('users.TotalUsers')}} {{$totalUsers}}</h6>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" dir="{{ session('direction', 'ltr') }}">
                        <thead>
                            <tr>
                                <th>{{ __('users.ID') }}</th>
                                <th>{{ __('users.Name') }}</th>
                                <th>{{ __('users.Email') }}</th>
                                <th>{{ __('users.Role') }}</th>
                                <th>{{ __('users.Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span>
                                        @if ($user->getRoleNames()->isNotEmpty())
                                        <span class="badge rounded-pill" style="width:85px;background-color:#f6cb24">{{ $user->getRoleNames()->first() }}</span>
                                        @else
                                        {{__('users.Noroleassigned')}}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:13px !important;">
                                            <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="action">
                                            @can('edit user')
                                            <li>
                                                <a class="dropdown-item mb-2" href="{{ route('users.edit', $user->id) }}" aria-label="View Student">
                                                    <span style="color:green;"><i class="fas fa-edit" style="font-size: 17px; color: green;"></i> {{__('users.Edit')}}</span>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('delete user')
                                            <li>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block; margin-left:14px">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;" onclick="confirmDelete({{ $user->id }})">
                                                        <span style="color: red;">
                                                            <i class="fas fa-trash" style="font-size: 17px; color: red;"></i> {{ __('levels.Delete') }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

@endpush