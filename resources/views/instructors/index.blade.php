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
    .swal2-styled.swal2-default-outline:focus{
    box-shadow: none !important;
  }
  .swal2-actions:not(.swal2-loading) .swal2-styled:active{
    background-image: none !important;
    border-color: white !important;
  }
  .swal2-actions:not(.swal2-loading) .swal2-styled:hover{
    background-image: none !important;
    border-color: white !important;
  }
  .swal2-actions:not(.swal2-loading) .swal2-styled{
    background-image: none !important;
    border-color: white !important;
  }
  .border-danger, .swal2-popup .swal2-actions button.swal2-cancel{
    border: none !important;
  }
  </style>

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
  <div class="mb-2 d-flex justify-content-between">
    <h4>{{__('instructors.ListofInstructors')}}</h4>
    @can('create instructor')
    <a href="{{route('instructors.create')}}" class="btn btn-sm text-white" style="background-color:#f6cb24;border-radius:15px;">{{__('instructors.AddInstructor')}}</a>
  @endcan
  </div>
</nav>
<div class="mb-2">
<h6 style="color:#f6cb24">{{__('instructors.TotalInstructors')}} {{$totalInstructors}}</h>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatableinstructor" class="table" dir="{{ session('direction', 'ltr') }}">
            <thead>
              <tr>
                <th>{{__('instructors.S.No')}}</th>
                <th>{{__('instructors.Name')}}</th>
                <th>{{__('instructors.Email')}}</th>
                <th>{{__('instructors.Level')}}</th>
                <th>{{__('instructors.Nationality')}}</th>
                <th>{{__('instructors.CivilID')}}</th>
                <th>{{__('instructors.DateofBirth')}}</th>
                <th>{{__('instructors.Action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($instructors as $instructor)
              <tr>
                <td>{{ $instructor->id}}</td>
                <td>
                    <div class="d-flex align-items-center">
                      @if ($instructor->image)
                      <img src="{{asset('storage/'.$instructor->image)}}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                      @else
                      <img src="{{ asset('images/default.png') }}" class="rounded-circle mb-2" style="width: 20px; height: 20px;" alt="image">
                      @endif
                      <span class="d-block font-weight-bold" style="margin-left: 10px !important;margin-right: 10px !important;">{{$instructor->name}}</span>
                    </div>
                    <div class="mt-2">
                      <div class="d-flex align-items-center">
                        <i class="fa-solid fa-phone-volume" style="width: 20px; text-align: center;"></i>
                        <span style="margin-left: 10px !important;margin-right: 10px !important;">{{$instructor->phone}}</span>
                      </div>
                    </div>
                  </td>
                <td>{{$instructor->email}}</td>
                <td>
                  @if ($instructor->levels->isNotEmpty())
                  @foreach ($instructor->levels as $level)
                  {{ $level->name }}<br>
                  @endforeach
                  @else
                  {{__('instructors.NoLevelexist')}}
                  @endif
                </td>
                <td>{{$instructor->nationality}}</td>
                <td>{{$instructor->civil_id}}</td>
                <td>{{Carbon\Carbon::parse($instructor->date_of_birth)->format('j M Y')}}</td>
                <td>
                  <div>
                    <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="action">
                      @can('edit instructor')
                      <li>
                        <a class="dropdown-item" href="{{route('instructors.edit',$instructor->id)}}">
                          <span style="color: green;"><i class="fas fa-edit" style="font-size: 17px; color: green;"> </i>   {{__('instructors.Edit')}} </span>
                        </a>
                      </li>
                      @endcan
                    
                      @can('delete instructor')
                      <li>
                        <form id="delete-form-{{ $instructor->id }}" action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" style="display: inline-block; margin-left:14px">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;" onclick="confirmDelete({{ $instructor->id }})">
                            <span style="color: red;">
                              <i class="fas fa-trash" style="font-size: 17px; color: red;"></i> {{ __('instructors.Delete') }}
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