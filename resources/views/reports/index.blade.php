@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
  <div class="mb-2 d-flex justify-content-between">
    <h4>Subscription Reports</h4>
  </div>
</nav>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Student Detail</th>
                <th>Place Of Birth</th>
                <th>Date Of Birth</th>
                <th>Nationality</th>
                <th>Address</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($students as $student)
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
                <td>{{$student->place_of_birth}}</td>
                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('j M Y') }}</td>
                <td>{{$student->nationality}}</td>
                <td>{{$student->address}}</td>
                <td>
                  @if($student->status == 'Active')
                  <span style="color: green;width:60px;" class="badge rounded-pill bg-success text-white">{{$student->status}}</span>
                  @elseif($student->status == 'On Hold')
                  <span style="color: #F6CB24;width:60px;" class="badge rounded-pill bg-warning text-white">{{$student->status}}</span>
                  @else
                  <span style="color: red;width:60px;" class="badge rounded-pill bg-danger text-white">{{$student->status}}</span><br>
                  @can('edit student')
                  <span><a href="{{ route('students.edit', $student->id) }}" class="badge rounded-pill bg-info" style="width:60px;">Renew</a></span>
                  @endcan
                  @endif
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

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush