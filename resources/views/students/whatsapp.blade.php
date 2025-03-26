<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
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
    background-color: #FFC107 !important;
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
    border: 5px solid #FFC107;
    border-radius: 5px !important;
  }

  .QRCode {
    width: 100px !important;
    height: 100px !important;
    border: 2px solid #FFC107;
    border-radius: 1px !important;
  }

  .LogoImage {
    width: 50px;
  }

  .number {
    background-color: black;
    color: #FFC107;
    font-size: 8px;
  }

  .instagram {
    margin-left: 10px;
  }

  .paragraph {
    font-size: 9px;
  }

  .footer-text {
    background-color: #FFC107 !important;
  }

  .membershiptext {
    margin-top: -8px !important;
    font-size: 25px;
  }

  .membershiptext1 {
    font-size: 42px !important;
  }
</style>

<body >

    <div style="margin-top: 20px;margin-left:50px;">

        <div style="display:flex;">

            <div style="width:500px; margin-right:20px;">
                <div style="border: 1px solid #FFC107; border-radius: 8px; padding: 10px;">
                    <div>
                        <div style="display:flex;justify-content:end;">
                            <div class="d-flex justify-content-end">
                                <div style="margin-top:10px;margin-right:8px;">
                                    <p style="font-size: 16px; margin-top: -5px; text-align: right; color: #FFC107;">Qadsia Swimming Academy</p>
                                </div>
                                <div>
                                    <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Logo" style="width: 50px;">
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin:0px 30px;">
                            <div>
                                <img src="{{asset('assets/images/others/qrcode.png')}}" alt="qrcode" style="width: 90px; height: 105px; border: 5px solid #FFC107; border-radius: 5px;">
                            </div>
                            <div style="padding:20px;">
                                <h5 style="font-size: 42px; margin-top: -8px; font-weight: bold;">بطاقة عضوية</h5>
                                <h6 style="font-size: 25px; font-weight: normal;">Membership Card</h6>
                            </div>
                        </div>
                    </div>
                    <div style="background-color: #FFC107;text-align:center; padding: 5px;">
                        <p style="font-size: 11px; font-weight: bold;color:black !important;">Abdullah Al-Salem Olympic Swimming Complex Qadsia Sports Club - Hawally, Kuwait</p>
                        <p style="font-size: 10px; color: #fff;margin-top:-12px !important;">
                            <strong>
                                <span style="font-size: 12px; color:black;">+965 58020283</span>
                                <span style="margin-left: 10px; font-size: 12px;color:black !important;margin-top:-10px !important;">
                                    <i class="fa-brands fa-instagram" style="color:black !important;"></i> Qadsia Swimming Club
                                </span>
                            </strong>
                        </p>
                    </div>
                </div>
            </div>

            <div style="width:500px; margin-right:20px;">
                <div style="border: 1px solid #FFC107; border-radius: 8px; padding: 10px;padding-bottom:29px;">
                    <div>
                        <div style="display:flex;justify-content:end;">
                            <div class="d-flex justify-content-end">
                                <div style="margin-top:10px;margin-right:8px;">
                                    <p style="font-size: 16px; margin-top: -5px; text-align: right; color: #FFC107;">Qadsia Swimming Academy</p>
                                </div>
                                <div>
                                    <img src="{{asset('assets/images/others/qadsia.png')}}" alt="Logo" style="width: 50px;">
                                </div>
                            </div>
                        </div>
                        <div style="display:flex; justify-content:space-between;margin:0px 30px;">
                            <div>
                                <img src="{{asset('storage/'.$student->image)}}" alt="QRCode" style="width: 100px; height: 100px; border: 2px solid #FFC107; border-radius: 1px;">
                            </div>
                            <div style="margin-right:190px;">
                                <p style="font-size: 12px;margin-top:-5px"><strong>Name:</strong><br> <span style="font-size: 14px;">{{$student->name}}</span></p>
                                <p style="font-size: 12px;margin-top:-14px;"><strong>Phone:</strong><br> <span style="font-size: 14px;">{{$student->telephone_number}}</span></p>
                                <p style="font-size: 12px;margin-top:-16px;"><strong>Date of Birth:</strong><br> <span style="font-size: 14px;">{{\Carbon\Carbon::parse($student->date_of_birth)->format('j M Y')}}</span></p>
                            </div>
                        </div>
                    </div>
                    <div style="background-color: #FFC107; height: 60px;"></div>
                    <div style="margin-left: 14px;margin-top:-70px;">
                        <img src="{{ asset( $student->barcode) }}" alt="Barcode Image" style="width: 95%; height: 50px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>