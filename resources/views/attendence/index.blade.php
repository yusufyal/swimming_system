@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
  <div class="mb-2 d-flex justify-content-between">
    <h4>{{__('attendance.AttendenceHistory')}}</h4>
  </div>
 
</nav>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatableattendance" class="table">
            <thead>
              <tr>
                <th>{{__('attendance.StudentName')}}</th>
                <th>{{__('attendance.Date')}}</th>
                <th>{{__('attendance.Day')}}</th>
                <th>{{__('attendance.ClockIn')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($attendences as $attendence)
              <tr>
                <td>{{$attendence->student->name}}</td>
                <td>{{$attendence->date}}</td>
                <td>{{$attendence->day}}</td>
                <td>{{$attendence->clock_in}}</td>
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

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush
