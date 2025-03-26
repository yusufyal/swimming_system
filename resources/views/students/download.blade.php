<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Membership Card</title>
  <style>
    .card-container {
      display: flex;
      gap: 20px;
    }

    .card {
      width: 470px;
      height: 280px;
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .card-header {
      background-color: #fff;
      padding: 10px;
      display: flex;
      justify-content: start;
      align-items: center;
    }

    .card-header img {
      height: 50px;
    }

    .card-header h1 {
      font-size: 16px;
      margin-right: 10px;
      text-align: center;
    }

    .card-body {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
    }

    .qr-code {
      width: 90px;
      height: 90px;
      background: #f4f4f4;
      border: 2px solid #ddd;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: -25px !important;
    }

    .qr-code img {
      max-width: 100%;
      max-height: 100%;
    }

    .barcode {
      width: 100%;
      height: 50px;
      background: #f4f4f4;
      border: 2px solid #ddd;
      margin-top: 10px;
    }

    .barcode img {
      width: 100%;
      height: 100%;
    }

    .card-body h2 {
      font-size: 28px;
      margin: 0;
      text-align: center;
      margin-right: 30px !important;
    }

    .card-footer {
      background-color: #FFC107 !important;
      text-align: center;
      font-size: 12px;
      padding: 10px;
      position: absolute;
      bottom: 0;
      width: 100%;
    }

    .card-footer p {
      margin: 0;
      font-size: 10px !important;
    }

    .card-footer span {
      display: block;
      margin-top: 3px;
    }

    #barcode {
      width: 457px;
      position: absolute !important;
      z-index: 1 !important;
      bottom: 20px !important;
      margin-left: 5px !important;

    }
  </style>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;display: flex; justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;">
  <div class="card-container">
    <div class="card" style="margin-top:10px">
      <div class="card-header" dir="rtl">
        <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Qadsia Logo">
        <h1>Qadsia Swimming Academy</h1>
      </div>
      <div class="card-body">
        <div class="qr-code">
          <img src="{{public_path( 'qrcodes/'.$student->qr_code)}}" alt="Barcode">
        </div>
        <div class="text">
          <h2>بطاقة عضوية<br>Membership Card</h2>
        </div>
      </div>
      <div class="card-footer">
        <p>Abdullah Al-Salem Al-Sabah Olympic Swimming Complex
          Qadsia Sports Club - Hawally - Kuwait</p>
        <span>+965 580 2083 | @ QADSIA.SWIMMING.CLUB</span>

      </div>
    </div>

    <div style="margin-top:10px">

      <div class="card">
        <div class="card-header" dir="rtl">
          <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Qadsia Logo">
          <h1>Qadsia Swimming Academy</h1>
        </div>
        <div class="card-body">
          <div class="qr-code">
            <img src="{{ public_path('storage/'.$student->image) }}" alt="Seal">
          </div>
          <div style="margin-right:180px !important;">
            <strong>Name</strong><br> <span>{{$student->name}}</span><br>
            <strong>Phone</strong><br> <span>{{$student->telephone_number}}</span><br>
            <strong>Date Of Birth</strong><br> <span>{{\Carbon\Carbon::parse($student->date_of_birth)->format('j M Y')}}</span><br>

          </div>
        </div>
        <div class="card-footer" style="height:30px">

        </div>
        <div style="width:100%">
          <img src="{{public_path( 'barcodes/'.$student->barcode)}}" />

        </div>
      </div>


    </div>
  </div>
</body>

</html>