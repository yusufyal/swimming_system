@extends('layout.master')

@push('plugin-styles')
@endpush
<style>
  #arbictext {
    font-size: 22px !important;
  }

  #arbictext2 {
    font-size: 22px !important;
  }

  #english {
    font-size: 12px !important;
    margin-top: -5px !important;
  }

  #english1 {
    font-size: 10px !important;
    margin-top: -5px !important;
  }

  .emptydiv {
    background-color: #f6cb24 !important;
    height: 56px !important;
    margin-top: 5px !important;
  }

  .barcodeimage {
    width: 95%;
    height: 50px;
    position: absolute;
    bottom: 20px;
  }

  .barcodeimagediv {
    margin-left: 14px;
  }

  .QRCode1 {
    width: 100px !important;
    height: 100px !important;
    border: 5px solid #f6cb24;
    border-radius: 5px !important;
  }

  .QRCode {
    width: 100px !important;
    height: 100px !important;
    border: 2px solid #f6cb24;
    border-radius: 1px !important;
  }

  .LogoImage {
    width: 50px;
  }

  .number {
    background-color: black;
    color: #f6cb24;
    font-size: 8px;
  }

  .instagram {
    margin-left: 10px;
  }

  .paragraph {
    font-size: 9px;
  }

  .footer-text {
    background-color: #f6cb24 !important;
  }

  .membershiptext {
    margin-top: -8px !important;
    font-size: 25px;
  }

  .membershiptext1 {
    font-size: 40px !important;
  }

  @media screen and (max-width: 768px) {
    .LogoImage {
      width: 40px !important;
    }

    #arbictext {
      font-size: 15px !important;
    }

    #english {
      font-size: 9px !important;
    }

    #arbictext2 {
      font-size: 15px !important;
    }



    .QRCode1 {
      width: 70px !important;
      height: 70px !important;
      border: 2px solid #f6cb24;
      border-radius: 5px !important;
      margin-top: -15px;
    }

    .QRCode {
      width: 70px !important;
      height: 70px !important;
      border: 5px solid #f6cb24;
      border-radius: 1px !important;
      margin-top: -15px;
    }

    .emptydiv {
      background-color: #f6cb24 !important;
      height: 56px !important;
      margin-top: 2px !important;
    }

    #Membershiptext h5 {
      font-size: 23px !important;
      margin-bottom: 5px;
    }

    #Membershiptext h6 {
      font-size: 14px !important;
    }

    strong {
      font-size: 7px !important;
    }

    #Membershiptext {
      margin-top: -20px;
    }

    .footer-text {
      margin-top: -17px;
    }
  }

  @media screen and (min-width: 768px) and (max-width: 834px) {
    .LogoImage {
      width: 21px !important;
    }

    .QRCode1 {
      width: 60px !important;
      height: 60px !important;
      border: 5px solid #f6cb24;
      border-radius: 5px !important;
      margin-top: -10px;
    }

    .QRCode {
      width: 60px !important;
      height: 60px !important;
      border: 2px solid #f6cb24;
      border-radius: 2px !important;
      margin-top: -10px;
    }

    .emptydiv {
      background-color: #f6cb24 !important;
      height: 43px !important;

    }

    .barcodeimage {
      width: 95%;
      height: 40px !important;
      position: absolute;
      bottom: 10px;
    }

    .barcodeimagediv {
      margin-left: 10px;
    }

    #Membershiptext h5 {
      font-size: 25px !important;
      margin-bottom: 8px;
    }

    #Membershiptext h6 {
      font-size: 15px !important;
      margin-top: 5px !important;
    }

    .logotext p {
      margin-top: -10px !important;
      font-size: 5px;
    }
  }
</style>

@section('content')

<div class="container-fluid mt-2">
  <div class="d-flex mb-3">
    <div Class="ml-2 mr-2">
      <a href="{{ route('print.id.card', $student->id) }}" class="btn text-white" style="background-color:#f6cb24" id="printButton">
        <i class="fas fa-print"></i> {{__('students.PrintIDCard')}}
      </a>
    </div>
    <div style="margin-left:10px;margin-right:10px;">
      <a href="{{ route('print.id.card', $student->id) }}" class="btn  text-white" style="background-color:#f6cb24" id="printButton">
        <i class="fas fa-download"></i> {{ __('students.download') }}
      </a>
    </div>

    <div style="margin-left:10px;margin-right:10px;">
      <a href="https://wa.me/number" class="btn text-white" style="background-color:#f6cb24" target="_blank">
        <i class="fa-brands fa-whatsapp"></i> {{ __('students.whatsapp') }}
      </a>
    </div>


  </div>
  <div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 mb-3">
      <div class="card">
        <div class="card-body mb-3">
          <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <div class="d-flex justify-content-end">
                <div class="pe-2 py-2 logotext">
                  <p class="fs-6 text-end m-0" id="english" style="margin-top:-5px !important; font-size:16px !important; margin-left:10px!important;">{{__('students.QadsiaSwimmingAcademy')}}</p>
                </div>
                <div>
                  <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Logo" class="LogoImage" style="width:50px;">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4 col-md-4 col-lg-4 ">
              <img src="https://qadsiaswimmingacademy.com/public/qrcodes/8f5dc59ad197fc22eb04f1c513339799.png" alt="qrcode" style="width:90px;height: 105px;border:5px solid #f6cb24;border-radius:5px;" class="LogoImage">
            </div>
            <div class="col-8 col-md-8 col-lg-8 py-3" id="Membershiptext">
              <h5 class="membershiptext1">بطاقة عضوية</h5>
              <h6 class="membershiptext">Membership Card</h6>
            </div>
          </div>
        </div>
        <div class="text-center footer-text py-2" style="margin-top:15px;">
          <p class="paragraph"><strong>{{__('students.OlympicSwimming')}}</strong></p>
          <p>
            <strong>
              <span>
                <i class="fa-solid fa-phone p-1 rounded-circle" class="number"></i> + 9 6 5 5 8 0 2 0 8 3
              </span>
              <span class="instagram">
                <i class="fa-brands fa-instagram"></i> {{__('students.QADSIA.SWIMMING.CLUB')}}
              </span>
            </strong>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
            </div>
            <div class="col-8 col-md-8 col-lg-8">
              <div class="d-flex justify-content-end">
                <div class="pe-2 py-2 Logotext">
                  <p class="fs-5 text-end m-0" id="english1" style="margin-top:-5px !important; font-size:16px !important; margin-left:10px !important;">{{__('students.QadsiaSwimmingAcademy')}}</p>
                </div>
                <div>
                  <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Logo" class="LogoImage">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
              <img src="{{asset('storage/'.$student->image)}}" alt="" class="QRCode">
            </div>
            <div class="col-8 col-md-8 col-lg-8">
              <p><strong>{{__('students.Name')}}</strong> <br><span>{{$student->name}}</span></p>
              <p><strong>{{__('students.Phone')}}</strong><br> <span>{{$student->telephone_number}}</span></p>
              <p><strong>{{__('students.Dateofbirth')}}</strong> <br><span>{{\Carbon\Carbon::parse($student->date_of_birth)->format('j M Y')}}</span></p>
            </div>
          </div>
        </div>
        <div class="text-center emptydiv">
        </div>
        <div class="barcodeimagediv">
          <img src="{{ asset( $student->barcode) }}" alt="barccodeImage" class="barcodeimage">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="card mb-3">
    <div class="card-header">
      <h4> {{__('students.StudentInformation')}}</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-3 text-center">
          <img src="{{asset('storage/'.$student->image)}}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; border: 4px solid #f6cb24;">
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-4">
              <p><strong>{{__('students.Name')}} <br></strong> {{$student->name}}</p>
              <p><strong>{{__('students.Phone')}}<br></strong> {{$student->telephone_number}}</p>
              <p><strong>{{__('students.Address')}}<br></strong> {{$student->address}}</p>
              <p><strong>{{__('students.Nationality')}}<br></strong> {{$student->nationality}}</p>
            </div>
            <div class="col-md-4">
              <p><strong>{{__('students.DateofBirth')}}<br></strong> {{ \Carbon\Carbon::parse($student->date_of_birth)->format('F j, Y') }}</p>
              <p><strong>{{__('students.ClassName')}}<br></strong> {{$class->name}}</p>
              <p><strong>{{__('students.ClassStartDate')}}<br></strong> {{ \Carbon\Carbon::parse($student->class_start_date)->format('F j, Y') }}</p>
              <p><strong>{{__('students.ClassEndDate')}}<br></strong> {{ \Carbon\Carbon::parse($student->class_end_date)->format('F j, Y') }}</p>


            </div>
            <div class="col-md-4">
              <p><strong>{{__('students.Nationality')}}<br></strong> {{@$student->nationality}}</p>
              <p><strong>{{__('students.PlaceOfBirth')}}<br></strong> {{@$student->place_of_birth}}</p>
              <p><strong>{{__('students.Payment')}}<br></strong>{{__('students.KWD')}} {{ @$student->payments->sortByDesc('created_at')->first()->amount}}</p>
              @php
              $classEndDate = \Carbon\Carbon::parse($student->class_end_date);
              $today = \Carbon\Carbon::today();
              @endphp
              @if($classEndDate->gte($today))
              <p><strong>{{__('students.Status')}}<br></strong> <span style="color: green; width:80px;" class="badge  bg-success text-white">{{ __('students.Active') }}</span></p>
              @else
              <p><strong>{{__('students.Status')}}<br></strong> <span style="color:white !important;background-color:red!important; width:80px;" class="badge">{{ __('students.Expired') }}</span></p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-3">
    <div class="card-header">
      <h4>{{__('students.Attendance')}}</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-10">
          <p><span style="color:#f6cb24">89%</span> Attendance in last 2 months</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="col-md-2 text-center">
          <a href="#" class="btn text-white" style="background-color:#f6cb24" data-bs-toggle="collapse" data-bs-target="#attendanceHistory" aria-expanded="false" aria-controls="attendanceHistory">{{__('students.ViewDetail')}}</a>
        </div>
      </div>
      <div class="collapse" id="attendanceHistory">
        <div class="card mt-2">
          <div class="card-body">
            <h5>{{__('students.AttendanceHistory')}}</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>{{__('students.Date')}}</th>
                  <th>{{__('students.Day')}}</th>
                  <th>{{__('students.Status')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($attendence as $row)
                <tr>
                  <td>{{$row->date}}</td>
                  <td>{{$row->day}}</td>
                  <td>{{$row->status}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-3">
    <div class="card-header">
      <div class="row">
        <div class="col-md-10">
          <h4>{{__('students.previousStudentHistory')}}</h4>
        </div>
        <div class="col-md-2 text-center">
          <a href="#" class="btn text-white" style="background-color:#f6cb24" data-bs-toggle="collapse" data-bs-target="#studentHistory" aria-expanded="false" aria-controls="studentHistory">{{__('students.History')}}</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="collapse" id="studentHistory">
        <div class="card mt-2">
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>{{__('students.StudentName')}}</th>
                  <th>{{__('students.className')}}</th>
                  <th>{{__('students.PreviousStartDate')}}</th>
                  <th>{{__('students.PreviousEndDate')}}</th>
                  <th>{{__('students.TransferTime')}}</th>
                </tr>
              </thead>
              <tbody>

                @foreach($student->histories as $studentHistory)
                <tr>
                  <td>{{ $studentHistory->student->name }}</td>
                  <td>
                    @if($studentHistory->student->classModel)
                    {{ $studentHistory->classModel->name }}
                    @else
                    {{__('students.NoClassExists')}}
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($studentHistory->previous_class_start_date)->format('j M Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($studentHistory->previous_class_end_date)->format('j M Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($studentHistory->transferred_at)->format('j M Y h:i A') }}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<script src="{{ asset('assets/js/jquery.flot.js') }}"></script>
@endpush