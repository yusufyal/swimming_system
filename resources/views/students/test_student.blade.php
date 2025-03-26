@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
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

<div class="container my-2">
    <nav class="page-breadcrumb mt-3">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="mb-4">{{__('students.Studentsfortest')}} </h4>
            </div>

        </div>
        <h6 style="color:#f6cb24"> {{__('students.totalStudent')}} {{$countStudent}}</h6>

    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card " style="border-radius:15px !important;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablestudent" class="table" dir="{{ session('direction', 'ltr') }}">

                            <thead>
                                <tr>
                                    <th>{{ __('students.S.No') }}</th>
                                    <th>{{ __('students.StudentDetail') }}</th>
                                    <th>{{ __('students.Classes') }}</th>
                                    <th>{{ __('students.StudentType') }}</th>
                                    <th>{{ __('students.PlaceOfBirth') }}</th>
                                    <th>{{ __('students.DateOfBirth') }}</th>
                                    <th>{{ __('students.RegisterDate') }}</th>
                                    <th>{{ __('students.Nationality') }}</th>
                                    <th>{{ __('students.ReciptNumber') }}</th>
                                    <th>{{ __('students.CivilID') }}</th>
                                    <th>{{ __('students.RegistrationID') }}</th>
                                    <th>{{ __('students.Address') }}</th>
                                    <th>{{ __('students.Payment') }}</th>
                                    <th>{{ __('students.ClassStartDate') }}</th>
                                    <th>{{ __('students.ClassEndDate') }}</th>
                                    <th>{{ __('students.Status') }}</th>
                                    <th>{{ __('students.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testStudents as $testStudent)
                                <tr>
                                    <td>{{$testStudent->id}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($testStudent->image)
                                            <img src="{{asset('storage/'.$testStudent->image)}}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                                            @else
                                            <img src="{{ asset('images/default.png') }}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                                            @endif
                                            <span class="d-block font-weight-bold" style="margin-left: 10px;margin-right: 10px !important;">{{$testStudent->name}}</span>
                                        </div>
                                        <div class="mt-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-phone-volume" style="width: 20px; text-align: center;"></i>
                                                <span style="margin-left: 10px;margin-right: 10px !important;">{{$testStudent->telephone_number}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($testStudent->classModel)
                                        {{ $testStudent->classModel->name }}
                                        @else
                                        {{__('students.NoClassExists')}}
                                        @endif

                                    </td>
                                    <td>
                                        @if ($testStudent->is_test=="1")
                                        <span class="badge rounded-pill" style="width:80px;background-color:  #042954; color: white;">{{__('students.Test')}}</span>
                                        @else
                                        <span style="width:80px;background-color: #28a745" class="badge rounded-pill text-white">{{__('students.Regular')}}</span>
                                        @endif
                                    </td>
                                    <td>{{$testStudent->place_of_birth}}</td>
                                    <td>{{\Carbon\Carbon::parse($testStudent->date_of_birth)->format('j M Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($testStudent->joining_date)->format('j M Y')}}</td>
                                    <td>{{$testStudent->nationality}}</td>
                                    <td>{{$testStudent->recipt_number}}</td>
                                    <td>{{$testStudent->civil_id}}</td>
                                    <td>{{$testStudent->registration_id}}</td>
                                    <td>{{$testStudent->address}}</td>
                                    <td>
                                        @if($testStudent->payments->isNotEmpty())
                                        {{__('students.KWD')}} {{ $testStudent->payments->sortByDesc('created_at')->first()->amount }}
                                        @else
                                        {{__('students.Noamountexists')}}
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($testStudent->class_start_date)->format('j M Y') }}</td>
                                    <td>
                                        @php
                                        $classEndDate = \Carbon\Carbon::parse($testStudent->class_end_date);
                                        $today = \Carbon\Carbon::today();
                                        @endphp
                                        {{ $classEndDate->format('j M Y') }} <br>
                                    </td>

                                    <td>
                                        @if($classEndDate->gte($today))
                                        <span style="color: green; width:80px;" class="badge rounded-pill bg-success text-white">{{ __('students.Active') }}</span>
                                        @else
                                        <span style="color:white !important;background-color:red!important; width:80px;" class="badge rounded-pill">{{ __('students.Expired') }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div>
                                            <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:13px !important;">
                                                <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="action">
                                                @can('edit student')
                                                <li>
                                                    <a class="dropdown-item mb-2" href="{{ route('students.edit', $testStudent->id) }}" aria-label="Edit Student">
                                                        <span style="color:green;"><i class="fas fa-edit" style="font-size: 17px; color: green;"></i> {{__('students.Edit')}}</span>
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('show student')
                                                <li>
                                                    <a class="dropdown-item mb-2" href="{{ route('students.view', $testStudent->id) }}" aria-label="View Student">
                                                        <span style="color:#17a2b8;"> <i class="fa-regular fa-eye" style="font-size: 17px; color:#17a2b8;"></i> {{__('students.View')}} </span>
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('edit student')
                                                <li>
                                                    <a class="dropdown-item mb-2" href="{{ route('students.renew', $testStudent->id) }}" aria-label="Renew Student">
                                                        <span style="color:#FFA500;">
                                                            <i class="fas fa-sync" style="font-size: 17px; color:#FFA500;"></i> {{__('students.Renew')}}
                                                        </span>
                                                    </a>
                                                </li>
                                                @endcan

                                                @can('delete student')
                                                <li>
                                                    <form id="delete-form-{{ $testStudent->id }}" action="{{ route('students.destroy', $testStudent->id) }}" method="POST" style="display: inline-block; margin-left:14px">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;" onclick="confirmDelete({{ $testStudent->id }})">
                                                            <span style="color: red;">
                                                                <i class="fas fa-trash" style="font-size: 17px; color: red;"></i> {{ __('students.Delete') }}
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