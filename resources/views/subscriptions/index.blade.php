@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
  <div class="mb-2 d-flex justify-content-between">
    <h4>List of Subscription </h4>
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
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Payment Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach($subscriptions as $subscription)
              <tr>
                <td>
                  @if($subscription->student)
                  ({{$subscription->student->id}}) {{$subscription->student->name}}
                  @endif
                </td>
                <td> {{$subscription->amount}} </td>
                <td>{{ \Carbon\Carbon::parse($subscription->payment_date)->format('j M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($subscription->payment_time)->format('H:i A') }}</td>
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