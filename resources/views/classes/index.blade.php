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

<nav class="page-breadcrumb">
  <h4 class="mb-4">{{__('classes.ListofClasses')}}</h4>
  <div class="mb-4" style="border-radius: 15px;">
    <form action="{{ route('classes.index') }}" method="GET" class="row g-3 align-items-center" style="border: 2px solid #e5e5e5; border-radius: 15px; padding: 15px;">
      <div class="col-md-5">
        <label for="name" class="form-label">{{__('classes.ClassName')}}</label>
        <input type="text" name="name" class="form-control" id="name"
          placeholder="{{__('classes.ClassName')}}"
          style="border-radius: 10px;"
          value="{{ request('name') }}" />
      </div>
      <div class="col-md-5">
        <label for="instructor_name" class="form-label">{{__('classes.InstructorName')}}</label>
        <input type="text" name="instructor_name" class="form-control" id="instructor_name"
          placeholder="{{__('classes.InstructorName')}}"
          style="border-radius: 10px;"
          value="{{ request('instructor_name') }}" />
      </div>
      <div class="col-md-2 d-flex align-items-end pt-4">
        <button type="submit" class="btn btn-sm me-2 text-white" style="background-color: #f6cb24; border-radius: 15px;margin-left:10px !important;">{{__('classes.Search')}}</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 15px;">{{__('classes.Clear')}}</a>
      </div>
    </form>
  </div>

  <div class="row mb-2 align-items-center">
    <div class="col-md-2 mb-2">
      <h6 class="mb-1" style="color:#f6cb24">{{__('classes.TotalClasses')}} {{$totalClasses}}</h6>
    </div>
    <div class="col-md-5">
      <form action="{{ route('classImport') }}" method="POST" enctype="multipart/form-data">
        @CSRF
        <div class="input-group mb-3">
          <input type="file" class="form-control" id="file_import" name="file_import">
          <button type="submit" class="input-group-text text-white" style="background-color:#f6cb24">{{__('classes.Import')}} </button>
        </div>
      </form>
    </div>
    <div class="col-md-5">
      <div class="d-flex justify-content-end align-items-center">
        @can('create class')
        <form action="{{ route('classExport') }}" method="get" class="d-flex align-items-center me-3">
          @CSRF
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
        <a href="{{route('classes.create')}}" class="btn btn-sm text-white" style="background-color:#f6cb24; border-radius:15px;margin-top:-15px!important">
          {{__('classes.AddClass')}}
        </a>
        @endcan
      </div>
    </div>
  </div>
</nav>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatableclass" class="table" dir="{{ session('direction', 'ltr') }}">
            <thead>
              <tr>
                <th>{{__('classes.ClassName')}}</th>
                <th>{{__('classes.Instructor')}}</th>
                <th>{{__('classes.Level')}}</th>
                <th>{{__('classes.StartTime')}}</th>
                <th>{{__('classes.EndTime')}}</th>
                <th>{{__('classes.Days')}}</th>
                <th>{{__('classes.Status')}}</th>
                <th>{{__('classes.Action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($classes as $class)
              <tr>
                <td>{{$class->name}}</td>
                <td>
                  @if ($class->instructor)
                  {{$class->instructor->name}}
                  @else
                  {{__('classes.Instructornotexist')}}
                  @endif
                </td>
                <td>
                  @if ($class->level)
                  {{$class->level->name}}
                  @else
                  {{__('classes.Levelnotexist')}}
                  @endif
                </td>
                <td>{{$class->start_time}}</td>
                <td>{{$class->end_time}}</td>
                <td>{{ is_array($class->days) ? implode(', ', array_map(fn($day) => __('classes.' . ucfirst($day)), $class->days)) : __('classes.' . ucfirst($class->day)) }}</td>
                <td>
                  @if($class->status == 'Active')
                  <span style="color: green;width:80px" class="badge rounded-pill bg-success text-white"> {{ __('classes.Active') }}</span>
                  @else
                  <span style="color: red;background-color:red;width:80px" class="badge rounded-pill text-white">{{ __('classes.Expired') }}</span><br>
                  @endif
                </td>
                <td>
                  <div>
                    <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:13px !important;">
                      <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="action">

                      @can('edit class')
                      <li>
                        <a class="dropdown-item" href="{{ route('classes.edit', $class->id) }}">
                          <span style="color: green;"><i class="fas fa-edit" style="font-size: 17px; color: green;"></i> {{__('classes.Edit')}} </span>
                        </a>
                      </li>
                      @endcan
                      @can('show class')
                      <li>
                        <a class="dropdown-item mb-2" href="{{ route('classes.view', $class->id) }}" aria-label="View Student">
                          <span style="color:#f6cb24;">
                            <i class="fa-regular fa-eye" style="font-size: 17px; color:#f6cb24;"></i> {{__('classes.View')}}
                          </span>
                        </a>
                      </li>
                      @endcan
                      @can('delete class')
                      <li>
                        <form id="delete-form-{{ $class->id }}" action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: inline-block; margin-left:14px">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;" onclick="confirmDelete({{ $class->id }})">
                            <span style="color: red;">
                              <i class="fas fa-trash" style="font-size: 17px; color: red;"></i> {{ __('classes.Delete') }}
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