@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
  <div class="mb-2 d-flex justify-content-between">
    <h4>List of Enrollments</h4>
    @can('create enrollment')
    <a href="{{route('enrollments.create')}}" class="btn btn-sm" style="background-color:#FFC107;border-radius:15px;">Add Enrollment</a>
    @endcan
  </div>
  <h6 style="color:#FFA500">List of Enrollments</h6>
</nav>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Student Name</th>
                <th>Instructor Name</th>
                <th>Level</th>
                <th>Class Name</th>
                <th>Time</th>
                <th>Day</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $enrollments as $enrollment)
              <tr>
                <td>{{$enrollment->id}}</td>
                <td>
                  @if($enrollment->student)
                  {{$enrollment->student->name}}
                  @else
                  Student not Exist
                  @endif
                </td>
                <td>
                  @if($enrollment->instructor)
                  {{$enrollment->instructor->name}}
                  @else
                  Student not Exist
                  @endif
                </td>
                <td>
                  @if($enrollment->level)
                  {{$enrollment->level->name}}
                  @else
                  Level not Exist
                  @endif
                </td>
                <td>
                  @if($enrollment->classModel)
                  {{$enrollment->classModel->name}}
                  @else
                  Class not Exist
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($enrollment->time)->format('g:i A') }}</td>
                <td>{{ is_array($enrollment->day) ? implode(', ', $enrollment->day) : $enrollment->day }}</td>
                <td>
                  @if($enrollment->status == 'Active')
                  <span style="color: green;">{{$enrollment->status}}</span>
                  @elseif($enrollment->status == 'On Hold')
                  <span style="color: #F6CB24;">{{$enrollment->status}}</span>
                  @else
                  <span style="color: red;">{{$enrollment->status}}</span>
                  @endif
                </td>
                <td>
                  <div>
                    <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="action">
                      <li>
                        <a class="dropdown-item" href="{{ route('enrollments.edit', $enrollment->id) }}">
                          <span style="color: green"> <i class="fas fa-edit" style="font-size: 17px; color: green;"></i> Edit</span>
                        </a>
                      </li>
                      <li>
                        <form action="{{route('enrollments.destroy', $enrollment->id)}}" method="POST" style="display: inline-block; margin-left:14px" class="delete-form">
                          @csrf
                          @method('delete')
                          <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <span style="color: red;">
                              <i class="fas fa-trash" style="font-size: 17px; color: red;"></i> Delete
                            </span>
                          </button>
                        </form>
                      </li>
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-button').forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const userConfirmed = confirm("Are you sure you want to delete this record?");
        if (userConfirmed) {
          this.closest('form').submit();
        }
      });
    });
  });
</script>


@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush