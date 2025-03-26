@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">

  <div class="mb-4 mt-2" style="border-radius: 15px;">
    <form action="{{ route('classes.view', $class->id) }}" method="GET" class="row g-3 align-items-center" style="border: 2px solid #e5e5e5; border-radius: 15px; padding: 8px;">
      <input type="hidden" name="class_module_id" value="{{ request('class_module_id') }}">
      <div class="row">
        <div class="col-md-10 mb-2">
          <input type="text" name="search" class="form-control" id="search" placeholder="{{__('students.Search')}}..." style="border-radius: 10px;" value="{{ request('search') }}" />
        </div>
        <div class="col-md-2 d-flex align-items-end mb-1">
          <button type="submit" class="btn btn-sm me-4 text-white" style="background-color:#f6cb24;border-radius:15px;margin-left:10px !important;">{{__('students.Search')}}</button>
          <a href="{{ route('classes.view', $class->id) }}?{{ http_build_query(request()->except('search')) }}" class="btn btn-secondary btn-sm" style="border-radius:15px;padding:5px 20px;">{{__('students.Clear')}}</a>
        </div>
      </div>
    </form>
  </div>

  <div class="row mb-2 align-items-center">

    <div class="col-sm-6 col-md-6 mb-2">
      <div class="mb-2 d-flex justify-content-between">
        <h4>{{__('classes.ClassName')}} : {{$class->name}}</h4>
      </div>
    </div>

    <div class="col-sm-6 col-md-6 mb-2">
      <div class="d-flex justify-content-end align-items-center">

        <form action="{{route('classExportHistory', $class->id)}}" method="get" class="d-flex align-items-center me-3">
          <select class="form-select select2 me-2" name="type" id="type" style="width: 140px;" required>
            <option selected disabled>{{__('students.Select Format')}}</option>
            <option value="xlsx">{{__('classes.XLSX')}}</option>
            <option value="csv">{{__('classes.CSV')}}</option>
            <option value="tsv">{{__('classes.TSV')}}</option>
            <option value="xls">{{__('classes.XLS')}}</option>
          </select>
          <button class="btn btn-sm text-white" style="background-color:#f6cb24; border-radius:15px;" type="submit">
            {{__('classes.Export')}}
          </button>
        </form>

      </div>
    </div>
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatableclass" class="table">
            <thead>
              <tr>
                <th>{{__('classes.StudentName')}}</th>
                <th>{{__('classes.ClassName')}}</th>
                <th>{{__('classes.PlaceOfBirth')}}</th>
                <th>{{__('classes.DateOfBirth')}}</th>
                <th>{{__('classes.JoiningDate')}}</th>
                <th>{{__('classes.Nationality')}}</th>
                <th>{{__('classes.ReciptNumber')}}</th>
                <th>{{__('classes.CivilID')}}</th>
                <th>{{__('classes.RegistrationID')}}</th>
                <th>{{__('classes.Address')}}</th>
                <th>{{__('classes.Payment')}}</th>
                <th>{{ __('students.ClassStartDate') }}</th>
                <th>{{ __('students.ClassEndDate') }}</th>
                <th>{{ __('students.Status') }}</th>
                <th>{{__('classes.History')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($class->students as $student)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    @if ($student->image)
                    <img src="{{asset('storage/'.$student->image)}}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                    @else
                    <img src="{{ asset('images/default.png') }}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                    @endif
                    <span class="d-block font-weight-bold" style="margin-left: 10px;">{{$student->name}}</span>
                  </div>
                  <div class="mt-2">
                    <div class="d-flex align-items-center">
                      <i class="fa-solid fa-phone-volume" style="width: 20px; text-align: center;"></i>
                      <span style="margin-left: 10px;">+965 {{$student->telephone_number}}</span>
                    </div>
                  </div>
                </td>
                <td>
                  @if($student->classModel)
                  {{ $student->classModel->name }}
                  @else
                  {{__('classes.No Class Exists')}}
                  @endif
                </td>
                <td>{{$student->place_of_birth}}</td>
                <td>{{\Carbon\Carbon::parse($student->date_of_birth)->format('j M Y')}}</td>
                <td>{{\Carbon\Carbon::parse($student->joining_date)->format('j M Y')}}</td>
                <td>{{$student->nationality}}</td>
                <td>{{$student->recipt_number}}</td>
                <td>{{$student->civil_id}}</td>
                <td>{{$student->registration_id}}</td>
                <td>{{$student->address}}</td>
                <td>
                  @if($student->payments->isNotEmpty())
                  {{__('classes.KWD')}} {{ $student->payments->sortByDesc('created_at')->first()->amount }}
                  @else
                  {{__('classes.Noamountexists')}}
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($student->class_start_date)->format('j M Y') }}</td>
                <td>
                  @php
                  $classEndDate = \Carbon\Carbon::parse($student->class_end_date);
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

                @can('show class')
                <td>
                  <a href="{{ route('attendence.attendenceDetails', ['id' => $student->id]) }}" class="btn btn-sm" style="background-color:#f6cb24;border-radius:15px;"> {{__('classes.SeeHistory')}} </a>
                </td>
                @endcan
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

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush