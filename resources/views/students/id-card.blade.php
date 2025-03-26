<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student ID Card-{{$student->id}}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
              </div>
              <div class="col-8">
                <div class="d-flex justify-content-end">
                  <div class="pe-2 py-2">
                    <p class="fs-6 text-end m-0" style="margin-top:-5px !important;font-size:16px !important;margin-left:10px!important;">{{__('students.QadsiaSwimmingAcademy')}}</p>
                  </div>
                  <div class="">
                    <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Logo" style="width:50px;">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <img src="https://qadsiaswimmingacademy.com/public/qrcodes/8f5dc59ad197fc22eb04f1c513339799.png" alt="QR Code" style="width:90px;height: 105px;border:5px solid #FFC107;border-radius:5px;">
              </div>
              <div class="col-8 py-3">
                <h5 style="font-size:43px;">بطاقة عضوية</h5>
                <h6 style="margin-top:-8px !important;font-size:30px;">Membership Card</h6>
              </div>
            </div>
          </div>
          <div class="text-center  footer-text py-3" style="background-color:#FFC107 !important;margin-top:22px !important;">
            <p style="font-size:11px;color:#000000;"><strong>{{__('students.OlympicSwimming')}}</strong></p>
            <p style="margin-top:-8px !important;">
              <strong>
                <span>
                  <i class="fa-solid fa-phone p-1 rounded-circle" style="background-color:black; color:#FFC107; font-size:8px;"></i> + 9 6 5 5 8 0 2 0 8 3
                </span>
                <span style="margin-left:10px;">
                  <i class="fa-brands fa-instagram"></i> {{__('students.QADSIA.SWIMMING.CLUB')}}
                </span>
              </strong>
            </p>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
              </div>
              <div class="col-8">
                <div class="d-flex justify-content-end">
                  <div class="pe-2 py-3" style="margin-top:10px;">
                    <p class="fs-6 text-end m-0" style="margin-top:-20px !important; font-size:16px !important;margin-left:10px!important;">{{__('students.QadsiaSwimmingAcademy')}}</p>
                  </div>
                  <div class="">
                    <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Logo" style="width:50px;">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <img src="{{asset('storage/'.$student->image)}}" alt="" style="width:100px;height:110px;border:2px solid #FFC107;border-radius:5px;">
              </div>
              <div class="col-8 col-md-8 col-lg-8">
                <span><strong>{{__('students.Name')}}</strong><br> <span>{{$student->name}}</span></span><br>
                <span><strong>{{__('students.Phone')}}</strong> <br><span>{{$student->telephone_number}}</span></span><br>
                <span><strong>{{__('students.Dateofbirth')}}</strong><br> <span>{{\Carbon\Carbon::parse($student->date_of_birth)->format('j M Y')}}</span></span><br>
              </div>
            </div>
          </div>
          <div class="text-center mt-3" style="background-color:#FFC107 !important;height:84px;">
            <div></div>
          </div>
          <div style="margin-left:14px;">
            <img src="{{ asset( $student->barcode) }}" alt="Logo" style="width:95%;height:70px;position:absolute;bottom:30px;">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('load', function() {
      setTimeout(function() {
        window.print();
      }, 500);
    });
  </script>

</body>

</html>