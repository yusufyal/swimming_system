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

  /* Make the table wrapper scrollable */
  .table-responsive {
    overflow-x: auto;
    position: relative;
  }

  /* Sticky S.No column for LTR */
  #datatablestudent:dir(ltr) th:first-child,
  #datatablestudent:dir(ltr) td:first-child {
    position: sticky;
    left: 0;
    background: white;
    z-index: 1;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  }

  /* Sticky S.No column for RTL */
  #datatablestudent:dir(rtl) th:first-child,
  #datatablestudent:dir(rtl) td:first-child {
    position: sticky;
    right: 0;
    background: white;
    z-index: 1;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
  }

  /* Sticky Student Detail column for LTR */
  #datatablestudent:dir(ltr) th:nth-child(2),
  #datatablestudent:dir(ltr) td:nth-child(2) {
    position: sticky;
    left: 50px;
    /* Adjust as needed */
    background: white;
    z-index: 1;
  }

  /* Sticky Student Detail column for RTL */
  #datatablestudent:dir(rtl) th:nth-child(2),
  #datatablestudent:dir(rtl) td:nth-child(2) {
    position: sticky;
    right: 50px;
    background: white;
    z-index: 1;
  }

  #datatablestudent thead th {
    position: sticky;
    top: 0;
    z-index: 2;
  }

  /* Prevent header overlap on sticky columns */
  #datatablestudent:dir(ltr) thead th:first-child,
  #datatablestudent:dir(ltr) thead th:nth-child(2),
  #datatablestudent:dir(rtl) thead th:first-child,
  #datatablestudent:dir(rtl) thead th:nth-child(2) {
    z-index: 3;
  }
</style>
@section('content')
@include('includes.messages')

<div class="container my-2">
  <nav class="page-breadcrumb mt-3">
    <h4 class="mb-4">{{__('students.ListofStudents')}} </h4>

    <div class="mb-4" style="border-radius: 15px;">
      <form action="{{ route('students.index') }}" method="GET" class="row g-3 align-items-center" style="border: 2px solid #e5e5e5; border-radius: 15px; padding: 8px;">
        <div class="row">
          <div class="col-md-10 mb-2">
            <input type="text" name="search" class="form-control" id="search" placeholder="{{__('students.Search')}}..." style="border-radius: 10px;" value="{{ request('search') }}" />
          </div>
          <div class="col-md-2 d-flex align-items-end mb-1">
            <button type="submit" class="btn btn-sm me-4 text-white" style="background-color:#f6cb24;border-radius:15px;margin-left:10px !important;">{{__('students.Search')}}</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm" style="border-radius:15px;padding:5px 20px;">{{__('students.Clear')}}</a>
          </div>
        </div>
      </form>
    </div>
    <div class="row mb-2 align-items-center">
      <div class="col-md-2 mb-2">
        <h6 style="color:#f6cb24"> {{__('students.TotalStudents')}} {{$countStudent}}</h6>
      </div>
      <div class="col-md-5">
        <form action="{{ route('studentImport') }}" method="POST" enctype="multipart/form-data">
          @CSRF
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="file_import" name="file_import">
            <button type="submit" class="input-group-text text-white" style="background-color:#f6cb24">{{__('classes.Import')}} </button>
          </div>
        </form>
      </div>
      <div class="col-md-5">
        <div class="d-flex justify-content-end align-items-center">
          @can('create student')
          <form action="{{ route('studentExport') }}" method="get" class="d-flex align-items-center me-3">
            <select class="form-select select2 me-2" name="type" id="type" style="width: 140px;" required>
              <option selected disabled>{{__('students.Select Format')}}</option>
              <option value="xlsx">{{__('students.XLSX')}}</option>
              <option value="csv">{{__('students.CSV')}}</option>
              <option value="tsv">{{__('students.TSV')}}</option>
              <option value="xls">{{__('students.XLS')}}</option>
            </select>
            <button class="btn btn-sm text-white" style="background-color:#f6cb24; border-radius:15px;" type="submit">
              {{__('students.Export')}}
            </button>
          </form>
          <a href="{{ route('students.create') }}" class="btn btn-sm text-white" style="background-color:#f6cb24; border-radius:15px;margin-top:-15px!important">
            {{__('students.Register')}}
          </a>
          @endcan
        </div>
      </div>
    </div>
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
                  <th>{{ __('students.comment') }}</th>
                  <th>{{ __('students.Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                @if ($student->is_test == "0")
                <tr>
                  <td>{{$student->id}}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      @if ($student->image)
                      <img src="{{asset('storage/'.$student->image)}}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                      @else
                      <img src="{{ asset('images/default.png') }}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                      @endif
                      <span class="d-block font-weight-bold" style="margin-left: 10px;margin-right: 10px !important;">{{$student->name}}</span>
                    </div>
                    <div class="mt-2">
                      <div class="d-flex align-items-center">
                        <i class="fa-solid fa-phone-volume" style="width: 20px; text-align: center;"></i>
                        <span style="margin-left: 10px;margin-right: 10px !important;">+965 {{$student->telephone_number}}</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    @if($student->classModel)
                    {{ $student->classModel->name }}
                    @else
                    {{__('students.NoClassExists')}}
                    @endif
                  </td>
                  <td>
                    @if ($student->is_test=="1")
                    <span class="badge rounded-pill" style="width:80px;background-color: #042954; color: white;">{{__('students.Test')}}</span>
                    @else
                    <span style="width:80px;background-color: #28a745" class="badge rounded-pill text-white">{{__('students.Regular')}}</span>
                    @endif
                  </td>
                  <td>{{$student->place_of_birth}}</td>
                  <td>{{\Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($student->joining_date)->format('d/m/Y')}}</td>
                  <td>{{$student->nationality}}</td>
                  <td>{{$student->recipt_number}}</td>
                  <td>{{$student->civil_id}}</td>
                  <td>{{$student->registration_id}}</td>
                  <td>{{$student->address}}</td>
                  <td>
                    @if($student->payments->isNotEmpty())
                    {{__('students.KWD')}} {{ $student->payments->sortByDesc('created_at')->first()->amount }}
                    @else
                    {{__('students.Noamountexists')}}
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($student->class_start_date)->format('d/m/Y') }}</td>
                  <td>
                    @php
                    $classEndDate = \Carbon\Carbon::parse($student->class_end_date);
                    $today = \Carbon\Carbon::today();
                    @endphp
                    {{ $classEndDate->format('d/m/Y') }} <br>
                  </td>

                  <td>
                    @if($classEndDate->gte($today))
                    <span style="color: green; width:80px;" class="badge rounded-pill bg-success text-white">{{ __('students.Active') }}</span>
                    @else
                    <span style="color:white !important;background-color:red!important; width:80px;" class="badge rounded-pill">{{ __('students.Expired') }}</span>
                    @endif
                  </td>
                  
                   <td>
                    <div class="example">
                      <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal-{{$student->id}}">
                        <span style="width:80px !important; margin-top:-5px;padding:7px 0px" class="badge rounded-pill text-white bg-warning ">{{ __('students.comment') }}</span>
                      </button>
                      <div class="modal fade" id="reasonModal-{{$student->id}}" tabindex="-1" aria-labelledby="reasonModalTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title text-warning" id="reasonModalTitle">Comment</h5>
                            </div>
                            <div class="modal-body">
                              {{$student->comment}}
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-sm bg-warning text-white" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div>
                      <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:13px !important;">
                        <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="action">
                        @can('edit student')
                        <li>
                          <a class="dropdown-item mb-2" href="{{ route('students.edit', $student->id) }}" aria-label="Edit Student">
                            <span style="color:green;"><i class="fas fa-edit" style="font-size: 17px; color: green;"> </i> {{__('students.Edit')}} </span>
                          </a>
                        </li>
                        @endcan
                        @can('show student')
                        <li>
                          <a class="dropdown-item mb-2" href="{{ route('students.view', $student->id) }}" aria-label="View Student">
                            <span style="color:#17a2b8;"> <i class="fa-regular fa-eye" style="font-size: 17px; color:#17a2b8;"></i> {{__('students.View')}} </span>
                          </a>
                        </li>
                        @endcan
                        @can('edit student')
                        <li>
                          <a class="dropdown-item mb-2" href="{{ route('students.renew', $student->id) }}" aria-label="Renew Student">
                            <span style="color:#f6cb24;">
                              <i class="fas fa-sync" style="font-size: 17px; color:#f6cb24;"></i> {{__('students.Renew')}}
                            </span>
                          </a>
                        </li>
                        @endcan
                        @can('delete student')
                        <li>
                          <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline-block; margin-left:14px">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;" onclick="confirmDelete({{ $student->id }})">
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
                @endif
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