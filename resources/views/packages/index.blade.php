@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
  <div class="mb-2 d-flex justify-content-between">
    <h4>List of Packages</h4>
    @can('create package')
    <a href="{{route('packages.create')}}" class="btn btn-sm " style="background-color:#FFC107;border-radius:15px;">Add Package</a>
    @endcan
  </div>
</nav>
<h6 style="color:#FFA500">List of Packages</h6>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card" style="border-radius:15px !important;">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatableattendance" class="table">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Detail</th>
                <th>price</th>
                <th>Day</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($packages as $package)
              <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->detail}}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->days}}</td>
                <td>
                  <div>
                    <a href="#" id="action" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:13px !important;">
                      <i class="fas fa-ellipsis-v" style="font-size: 24px; color: grey;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="action">
                      @can('edit package')
                      <li>
                        <a class="dropdown-item mb-2" href="{{ route('packages.edit',  $package->id) }}" aria-label="Edit Student">
                          <span style="color:green;"><i class="fas fa-edit" style="font-size: 17px; color: green;"></i> Edit</span>
                        </a>
                      </li>
                      @endcan
                      @can('delete package')
                      <li>
                        <form action="{{route('packages.destroy',  $package ->id )}}" method="POST" style="display: inline-block; margin-left:14px" class="delete-form">
                          @csrf
                          @method('delete')
                          <button type="button" class="dropdown-item delete-button" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <span style="color: red;">
                              <i class="fas fa-trash" style="font-size: 17px; color: red;"></i> Delete
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

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
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
@endpush