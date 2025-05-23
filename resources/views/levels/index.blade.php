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
    <h4>{{__('levels.ListofLevels')}}</h4>
    @can('create level')
    <a href="{{route('levels.create')}}" class="btn btn-sm text-white" style="background-color:#f6cb24;border-radius:15px;">{{__('levels.AddLevel')}}</a>
    @endcan
  </div>
</nav>
<div class="mb-2">
  <h6 style="color:#f6cb24">{{__('levels.TotalLevels')}} {{$totalLevels}}</h6>
</div>
<div class="row">
 
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatablelevel" class="table" dir="{{ session('direction', 'ltr') }}">
            <thead>
              <tr>
                <th>{{__('levels.S.No')}}</th>
                <th>{{__('levels.LevelName')}}</th>
                <th>{{__('levels.Action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($levels as $level)
              <tr>
                <td>{{ $level->id}}</td>
                <td>{{ $level->name}}</td>
                <td>
                  <div>
                    <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:13px !important;">
                      <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="action">
                      @can('edit level')
                      <li>
                        <a class="dropdown-item mb-2" href="{{route('levels.edit',$level->id)}}">
                          <span style=" color: green;"> <i class="fas fa-edit" style="font-size: 17px; color: green;"></i> {{__('levels.Edit')}} </span>
                        </a>
                      </li>
                      @endcan

                      @can('delete level')
                      <li>
                        <form id="delete-form-{{ $level->id }}" action="{{ route('levels.destroy', $level->id) }}" method="POST" style="display: inline-block; margin-left:14px">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;" onclick="confirmDelete({{ $level->id }})">
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