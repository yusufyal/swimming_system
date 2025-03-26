@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

<style>
  table[dir="rtl"] th {
    text-align: right !important;
  }

  table[dir="ltr"] th {
    text-align: left !important;
  }
</style>

@include('includes.messages')

<div class="row mb-3">
  <div class="col-md-12">
    <form method="Get" action="{{route('attendence.studentDetails')}}">
      <div class="row">
        <div class="col-md-3 mb-1">
          <input type="date" name="filter_date" id="filter_date" value="{{ old('filter_date', request()->get('filter_date', '')) }}" class="form-control" placeholder="Filter by Date">
        </div>
        <div class="col-md-5 mb-1">
          <input type="text" name="filter_class" id="filter_class" value="{{ old('filter_class', request()->get('filter_class', '')) }}" class="form-control" placeholder="Search By Class Name">
        </div>
        <div class="col-md-2 mb-1 ">
          <button type="submit" class="btn w-100 mb-1" style="background-color:#f6cb24;border-radius:15px;padding:8px 23px;">Filter</button>
        </div>
        <div class="col-2">
          <a href="{{ route('attendence.studentDetails') }}" class="btn btn-secondary btn-sm mb-1" style="border-radius:15px;padding:8px 23px;">{{__('students.Clear')}}</a>
        </div>

      </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card " style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive pt-3">
          <table id="datatableattendance" class="table" dir="{{ session('direction', 'ltr') }}">
            <thead>
              <tr>
                <th>{{__('students.StudentName')}}</th>
                <th>{{ __('students.Classes') }}</th>
                <th>{{ __('students.PlaceOfBirth') }}</th>
                <th>{{__('attendance.Address')}}</th>
                <th>{{ __('students.Nationality') }}</th>
                <th>{{__('attendance.Attendence')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="{{asset('storage/'.$student->image)}}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                    <span class="d-block font-weight-bold" style="margin-left: 10px;">{{$student->name}}</span>
                  </div>
                  <div class="mt-2">
                    <div class="d-flex align-items-center">
                      <i class="fa-solid fa-phone-volume" style="width: 20px; text-align: center;"></i>
                      <span style="margin-left: 10px;">{{$student->telephone_number}}</span>
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
                <td>{{$student->place_of_birth}}</td>
                <td>{{$student->address}}</td>
                <td>{{$student->nationality}}</td>

                @can('show attendance')
                <td>
                  <a href="{{ route('attendence.attendenceDetails', ['id' => $student->id]) }}" class="btn btn-sm text-white" style="background-color:#f6cb24;border-radius:15px;">{{__('attendance.SeeHistory')}}</a>
                </td>
                @endcan
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