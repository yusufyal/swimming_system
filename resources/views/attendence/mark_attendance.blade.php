<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attemdance Marked</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    #imageContainer.hidden {
        display: none !important;
    }
</style>

<body>
    <div class="container mt-1">
        <div style="margin-top:30px;">
            <input type="text" id="barcodeInput" class="form-control" placeholder="{{__('attendance.placeholderattendance')}}" autofocus oninput="searchStudentAttendance()" />
        </div>
        <div class="mt-4 d-flex align-items justify-content-center" id="attendanceResult"></div>
    </div>

    <!-- Added ID to image container -->
    <div class="container mt-5 d-flex justify-content-center align-items-center" id="imageContainer">
        <img src='/assets/images/others/qadsia.png' style='height: 270px; width: 270px;'>
    </div>

    <script>
        document.getElementById('barcodeInput').addEventListener('input', function() {
            const imageContainer = document.getElementById('imageContainer');

            if (this.value.trim() !== '') {
                imageContainer.classList.add('hidden'); // Add class to hide
            } else {
                imageContainer.classList.remove('hidden'); // Remove class to show
            }
        });
    </script>

    <script>
        let inputTimeout;
        let recordTimeout;
        let currentSearchTerm = '';

        function searchStudentAttendance() {
            const barcodeInput = document.getElementById('barcodeInput');
            const registrationId = barcodeInput.value;

            if (registrationId.trim() === '') {
                return;
            }

            // Clear the previous timeouts if there's new input
            clearTimeout(inputTimeout);
            clearTimeout(recordTimeout);

            if (registrationId !== currentSearchTerm) {
                currentSearchTerm = registrationId;
                $.ajax({
                    url: '/fetch-attendance',
                    method: 'GET',
                    data: {
                        registration_id: registrationId
                    },
                    success: function(response) {
                        if (response.success) {
                            const studentHtml = `
                        <div class="container">
                          <div class="m-1 mt-1" style="border: 2px solid  #FFC107; display: flex; justify-content: center; align-items: center; height: 40px;border-radius:8px;">
                                <p style="color: ${response.data.attendance_message.message_color}; margin: 0;">
                                    <strong>${response.data.attendance_message.message}</strong>
                                </p>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                            <img src="/storage/${response.data.image}" 
                                                 alt="Profile Picture" 
                                                 class="img-fluid rounded-circle" 
                                                 style="width: 150px; height: 150px; border: 4px solid #FFC107;">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <span><strong>{{__('اسم')}}<br></strong>${response.data.name}</span><br>
                                                    <span><strong>{{__('رقم التليفون')}}<br></strong>${response.data.telephone_number}</span><br>
                                                    <span><strong>{{__('عنوان')}}<br></strong>${response.data.address}</span><br>
                                                    <span><strong>{{__('اسم الفصل')}}<br></strong>${response.data.class}</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <span><strong>{{__('تاريخ الميلاد')}}<br></strong>${new Date(response.data.date_of_birth).toLocaleDateString('en-GB')}</span><br>
                                                    <span><strong>{{__('جنس')}}<br></strong>${response.data.gender}</span><br>
                                                    <span><strong>{{__('مكان الميلاد')}}<br></strong>${response.data.place_of_birth}</span><br>
                                                </div>
                                                <div class="col-md-4">
                                                    <span><strong>{{__('جنسية')}}<br></strong>${response.data.nationality}</span><br>
                                                  <span><strong>{{__('تاريخ التسجيل')}}<br></strong>${new Date(response.data.joining_date).toLocaleDateString('en-GB')}</span><br>
                                                    <span><strong>{{ __('حالة') }}<br></strong>
                                                        <span class="badge 
                                                            ${response.data.status === 'Expired' ? 'bg-danger' : ''}
                                                            ${response.data.status === 'Active' ? 'bg-success' : ''}
                                                            text-white">
                                                            ${response.data.status || 'Unknown'}
                                                        </span>
                                                  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <h5>{{__('students.AttendanceHistory')}}</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>{{__('students.Status')}}</th>
                                            <th>{{__('students.Day')}}</th>
                                                <th>{{__('students.Date')}}</th>
                                                <th>{{__('students.time')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${response.attendance.map(row => `
                                                <tr>
                                                    <td>${row.status}</td>
                                                    <td>${row.day}</td>
                                                    <td>${new Date(row.date).getDate().toString().padStart(2, '0')}/${(new Date(row.date).getMonth() + 1).toString().padStart(2, '0')}/${new Date(row.date).getFullYear().toString().slice(-2)}</td>
                                                    <td>${row.clock_in}</td>
                                                    </tr>
                                            `).join('')}
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                      
                        </div>
                        
                          `;

                            document.getElementById('attendanceResult').innerHTML = studentHtml;

                        } else {
                            document.getElementById('attendanceResult').innerHTML = `
                            <div>
                                <img src='/assets/images/others/qadsia.png' style='height: 200px; width: 200px;'>
                           <p style="color: #dc3545; font-size: 1.2rem; font-weight: 600; text-align: center; 
                                margin-top: 15px; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
                                animation: pulse 1.5s infinite;">
                                    ⚠️ Invalid Registration ID<br>
                                    <span style="font-size: 1rem; color: #6c757d; display: block; margin-top: 8px;">
                                        Please check and try again
                                    </span>
                            </p>
                            </div>
                        `;
                        }

                    },
                    error: function() {
                        document.getElementById('attendanceResult').innerHTML = `
                            <div>
                                <img src='/assets/images/others/qadsia.png' style='height: 200px; width: 200px;'>
                                <p style="color: #dc3545; font-size: 1.2rem; font-weight: 600; text-align: center; 
                                        margin-top: 15px; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
                                        animation: pulse 1.5s infinite;">
                                    ⚠️ Invalid Registration ID<br>
                                    <span style="font-size: 1rem; color: #6c757d; display: block; margin-top: 8px;">
                                        Please check and try again
                                    </span>
                                </p>
                            </div>
                        `;
                    }

                });
            }

            // Start a new timeout to clear the input field after 1 second of inactivity
            inputTimeout = setTimeout(function() {
                barcodeInput.value = ''; // Clear the input field
            }, 1000);

            // Start a new timeout to clear the displayed record after 1 minute of inactivity
            recordTimeout = setTimeout(function() {
                document.getElementById('attendanceResult').innerHTML = '';
            }, 120000);

        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>