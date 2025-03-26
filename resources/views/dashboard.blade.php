@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      @can('show student')
      <div class="col-md-4 grid-margin stretch-card">

        <div class="card" style="border-radius:17px;background-color:rgba(0, 0, 0, 1)">
          <a href="{{route('students.index')}}">
            <div class="card-body d-flex justify-content-around align-items-center">
              <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 75px; height: 75px; background-color: #f6cb24;">
                <img src="{{ asset('assets/images/others/education.png') }}" alt="education.png" style="width: 50px; height: 50px;">
              </div>
              <div>
                <h6 class="card-title mb-0 text-white">{{__('dashboard.TotalStudents')}}</h6>
                <h6 class="card-title mb-0  text-center mt-2" style="color:#f6cb24;">{{$studentTotal->count()}}</h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endcan

      @can('show student')
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="border-radius:17px;background-color:rgba(0, 0, 0, 1)">
          <a href="{{route('students.index')}}">
            <div class="card-body d-flex justify-content-around align-items-center">
              <div class="rounded-circle d-flex justify-content-around align-items-center" style="width:75px;height:75px;background-color:#f6cb24">
                <img src="{{ asset('assets/images/others/graduates.png') }}" alt="graduates.png" style="width: 50px; height: 50px;">
              </div>
              <div>
                <h6 class="card-title mb-0 text-white">{{__('dashboard.ActiveStudents')}}</h6>
                <h6 class="card-title mb-0 text-center mt-2" style="color:#f6cb24;">
                  {{ $activeStudent->count()}}
                </h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endcan

      @can('show student')
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="border-radius: 17px; background-color: rgba(0, 0, 0, 1);">
          <a href="{{route('students.index')}}">
            <div class="card-body d-flex justify-content-around align-items-center">
              <div class="rounded-circle d-flex justify-content-center align-items-center"
                style="width: 75px; height: 75px; background-color: #f6cb24;">
                <img src="{{ asset('assets/images/others/funds.png') }}" alt="funds.png"
                  style="width: 50px; height: 50px;">
              </div>
              <div>
                <h6 class="card-title mb-0 text-white">{{__('dashboard.Earning')}}</h6>
                <h6 class="card-title mb-0  text-center mt-2 totalPayment" style="color: #f6cb24;">
                  {{ $totalPayment }} {{__('dashboard.currency')}}
                </h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endcan

      @can('show student')
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="border-radius:17px;background-color:rgba(0, 0, 0, 1)">
          <a href="{{route('subscriptions.index')}}">
            <div class="card-body d-flex justify-content-around align-items-center">
              <div class="rounded-circle d-flex justify-content-center align-items-center" style="width:75px;height:75px;background-color:#f6cb24">
                <img src="{{ asset('assets/images/others/crown.png') }}" alt="crown.png" style="width: 50px; height: 50px;">
              </div>
              <div>
                <h6 class="card-title mb-0 text-white">{{__('dashboard.Subscriptions')}}</h6>
                <h6 class="card-title mb-0  text-center mt-2" style="color:#f6cb24;">
                  {{$totalSubscriptions}}
                </h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endcan

      @can('show class')
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="border-radius:17px;background-color:rgba(0, 0, 0, 1)">
          <a href="{{route('classes.index')}}">
            <div class="card-body d-flex justify-content-around align-items-center">
              <div class="rounded-circle d-flex justify-content-around align-items-center" style="width:75px;height:75px;background-color:#f6cb24">
                <img src="{{ asset('assets/images/others/training.png') }}" alt="training.png" style="width: 50px; height: 50px;">
              </div>

              <div>
                <h6 class="card-title mb-0 text-white">{{__('dashboard.TotalClasses')}}</h6>
                <h6 class="card-title mb-0  text-center mt-2" style="color:#f6cb24;">
                  {{ $totalClasses}}
                </h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endcan

      @can('view instructor')

      <div class="col-md-4 grid-margin stretch-card">

        <div class="card" style="border-radius:17px;background-color:rgba(0, 0, 0, 1)">
          <a href="{{route('instructors.index')}}">
            <div class="card-body d-flex justify-content-around align-items-center">
              <div class="rounded-circle d-flex justify-content-around align-items-center" style="width:75px;height:75px;background-color:#f6cb24">
                <img src="{{ asset('assets/images/others/school.png') }}" alt="school.png" style="width: 50px; height: 50px;">
              </div>
              <div>
                <h6 class="card-title mb-0 text-white">{{__('dashboard.Instructors')}}</h6>
                <h6 class="card-title mb-0  text-center mt-2" style="color:#f6cb24;">
                  {{ $instructors->count()}}
                </h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endcan

    </div>

  </div>


</div>
<div class="row">
  <h4 class="mb-3">{{__('dashboard.LivetrackingStudent')}}</h4>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('dashboard.StudentId')}}</th>
                <th> {{__('students.StudentName')}}</th>
                <th>{{__('classes.ClassName')}}</th>
                <th>{{__('dashboard.payment')}}</th>
                <th>{{__('dashboard.Status')}}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($students as $student)
              <tr>
                <td>{{ $student->id }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $student->image) }}"
                      class="rounded-circle mb-2"
                      style="width: 20px; height: 20px;"
                      alt="{{ $student->name }}'s Image">
                    <span class="d-block font-weight-bold" style="margin-left: 10px;margin-right: 10px !important;">
                      {{ $student->name }}
                    </span>
                  </div>
                </td>
                <td>
                  @if ($student->classModel)
                  {{ $student->classModel->name }}
                  @else
                  <span class="text-muted">{{ __('dashboard.no_class') }}</span>
                  @endif
                </td>
                <td>
                  @if ($student->payments->isNotEmpty())
                  <span class="totalPayment">
                    {{ __('dashboard.currency') }} {{ $student->payments->sortByDesc('created_at')->first()->amount }}
                  </span>
                  @else
                  <span class="text-danger">{{ __('dashboard.no_payment') }}</span>
                  @endif
                </td>
                <td>
                  @if ($student->status === 'Active')
                  <span class="badge rounded-pill bg-success text-white" style="color: green; width: 80px;">
                    {{ __('dashboard.Active') }}
                  </span>
                  @else
                  <span class="badge rounded-pill text-white" style="background-color: red; width: 80px;">
                    {{ __('dashboard.Expired') }}
                  </span>
                  @endif
                </td>

              </tr>
              @endforeach

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<script src="{{ asset('assets/js/jquery.flot.js') }}"></script>
@endpush