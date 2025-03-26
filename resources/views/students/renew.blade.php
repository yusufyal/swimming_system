@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
<style>
    #image {
        display: none;
    }

    .upload-label {
        display: inline-block;
        cursor: pointer;
        text-align: center;
    }

    input[type="file"]:valid+label #file-name-text {
        display: block;
    }

    .upload-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 200px;
        height: 200px;
        background-color: #fdf1d1;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 16px;
        font-family: Arial, sans-serif;
        color: #333;
        cursor: pointer;
    }

    .upload-icon {
        font-size: 50px;
        color: #333;
        margin-bottom: 10px;
    }

    .upload-label span {

        text-align: center;
    }
</style>

@section('content')

@include('includes.messages')

<nav class="page-breadcrumb">
    <h4>{{__('students.HistoryofStudent')}}</h4>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form action="{{route('students.update',$student->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.Name')}}</label>
                                    <input type="text" name="name" id="name" value="{{old('name',$student->name)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheName')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.DateofBirth')}}</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{old('date_of_birth',$student->date_of_birth)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.Enterthedateofbirth')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.ClassStartDate')}}</label>
                                    <input type="date" name="class_start_date" id="class_start_date" value="{{old('class_start_date',$student->class_start_date)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.Entertheclassstartdate')}}" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.ClassEndDate')}}</label>
                                    <input type="date" name="class_end_date" id="class_end_date" value="{{old('class_end_date',$student->class_end_date)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.Entertheclassenddate')}}" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.CivilID')}}</label>
                                    <input type="text" name="civil_id" id="civil_id" value="{{old('civil_id',$student->civil_id)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheCivilID')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.RegistrationID')}}</label>
                                    <input type="text" name="registration_id" id="registration_id" value="{{old('registration_id',$student->registration_id)}}" class="form-control mb-4 mb-md-0"  readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.Nationality')}}</label>
                                    <input type="text" name="nationality" id="nationality" value="{{old('nationality',$student->nationality)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheNationality')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.PlaceOfBirth')}}</label>
                                    <input type="text" name="place_of_birth" id="place_of_birth" value="{{old('place_of_birth',$student->place_of_birth)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheAddress')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.Address')}}</label>
                                    <input type="text" name="address" id="address" value="{{old('address',$student->address)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheAddress')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.TelephoneNumber')}}</label>
                                    <input type="string" name="telephone_number" id="telephone_number" value="{{old('telephone_number',$student->telephone_number)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheTelephoneNumber')}}" readonly />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.ReciptNumber')}}</label>
                                    <input type="string" name="recipt_number" id="recipt_number" value="{{old('recipt_number',$student->recipt_number)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('students.EntertheReciptNumber')}}"  />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.Payment')}}</label>
                                    <input type="text" name="amount" id="amount" value="{{ old('amount', optional($student->payments->sortByDesc('created_at')->first())->amount) }}"
                                        class="form-control mb-4 mb-md-0"
                                        placeholder="Enter the Payment amount" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="status" class="form-label">{{__('students.Status')}}</label>
                                    <select class="form-select" name="status" id="status" >
                                        <option selected disabled>{{__('students.Selectstatus')}}</option>
                                        <option value="Active" {{ old('status', $student->status) == 'Active' ? 'selected' : '' }}>{{__('students.Active')}}</option>
                                        <option value="Expired" {{ old('status', $student->status) == 'Expired' ? 'selected' : '' }}>{{__('students.Expired')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{__('students.Gender')}}</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input gender-filter" name="gender" id="genderMale"
                                                value="Male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="genderMale">{{__('students.Male')}}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input gender-filter" name="gender" id="genderFemale"
                                                value="Female" {{ old('gender', $student->gender ?? '') == 'Female' ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="genderFemale">{{__('students.Female')}}</label>
                                        </div>
                                        <input type="hidden" name="gender" id="gender" value="{{ old('gender', $student->gender ?? '') }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="class_model_id">{{__('students.Class')}}</label>
                                    <select id="class_model_id" name="class_model_id" class="form-control select2" >
                                        <option value="" selected disabled>{{__('students.SelectClass')}}</option>
                                        @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ old('class_model_id', $student->class_model_id) == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col">
                                            <p id="instructor_id"></p>
                                        </div>
                                        <div class="col">
                                            <p id="level_name"></p>
                                        </div>
                                        <div class="col">
                                            <p id="day"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <p id="start_time"></p>
                                        </div>
                                        <div class="col-4">
                                            <p id="end_time"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-grid mb-2">
                                    <a href="{{route('students.index')}}" class="btn text-white" style="background: red;">{{__('students.Cancel')}}</a>
                                </div>
                                <div class="col-md-6 d-grid mb-2">
                                    <button class="btn text-white" style="background: #042954;" type="submit">{{__('students.Update')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="col-md-12 mb-3">
                                @if('image')
                                <img src="{{asset('storage/'.$student->image)}}" style="width:200px;height:200px; justify-content:center;border-radius:10px;" alt="image">
                                @endif
                                <div class="upload-container mt-4">
                                    <label for="image" class="upload-label">
                                        <i class="fa-solid fa-arrow-up-from-bracket fa-2x mb-1"></i><br>
                                        <span id="file-name-text">{{__('students.Upload')}}<br>{{__('students.Your')}}  <br>{{__('students.Picture')}}</span>

                                        <input type="file" id="image" name="image" style="display:none;" onchange="displayFileName()" disabled />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')

<script>
    $(document).ready(function() {
        $('#class_model_id').on('change', function() {
            var classId = $(this).val();
            if (classId) {
                $.ajax({
                    url: "{{ route('get-class-details') }}",
                    method: 'GET',
                    data: {
                        class_model_id: classId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#instructor_id').html('<span style="font-weight: bold;">Instructor <br>' + '</span>' + (response.instructor ? response.instructor.name : 'N/A'));
                            // Display level name
                            $('#level_name').html('<span style="font-weight: bold;">Level<br>' + '</span>' + (response.level ? response.level.name : 'N/A'));
                            // Display time and day
                            $('#start_time').html('<span style="font-weight: bold;">Start Time <br>' + '</span>' + (response.start_time ? response.start_time : 'N/A'));
                            $('#end_time').html('<span style="font-weight: bold;">End Time <br>' + '</span>' + (response.end_time ? response.end_time : 'N/A'));
                            $('#day').html('<span style="font-weight: bold;">Day<br>' + '</span>' + (response.day ? response.day : 'N/A'));
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Failed to fetch class details. Please try again.');
                    }
                });
            }
        });
        $('#class_model_id').trigger('change');
    });

    // future date hide
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date_of_birth').setAttribute('max', today);
   document.getElementById('joining_date').value = new Date().toISOString().split('T')[0];

    // This is JavaScript to handle the dynamic file name display inside the label
    function displayFileName() {
        const fileInput = document.getElementById('image');
        const fileName = fileInput.files[0]?.name;
        const fileNameText = document.getElementById('file-name-text');
        if (fileName) {
            fileNameText.innerHTML = 'Image: <br>' + fileName;
        }
    }
</script>

<script>
    document.querySelectorAll('.gender-filter').forEach((radio) => {
        radio.addEventListener('change', function() {
            const selectedGender = this.value;
            fetchClassesByGender(selectedGender);
        });
    });

    // Function to fetch and populate classes based on selected gender
    function fetchClassesByGender(gender) {
        fetch(`/get-classes-by-gender?gender=${gender}`)
            .then(response => response.json())
            .then(data => {
                const classDropdown = document.getElementById('class_model_id');
                classDropdown.innerHTML = '<option value="" selected disabled>Select Class</option>';
                // Populate the class dropdown with options
                data.forEach(classItem => {
                    const option = document.createElement('option');
                    option.value = classItem.id;
                    option.textContent = classItem.name;
                    if (classItem.id == "{{ old('class_model_id', $student->class_model_id ?? '') }}") {
                        option.selected = true;
                    }
                    classDropdown.appendChild(option);
                });
            }).catch(error => console.error('Error fetching classes:', error));
    }
    // If a gender is already selected (for edit), fetch the corresponding classes
    document.addEventListener('DOMContentLoaded', function() {
        const selectedGender = document.querySelector('input[name="gender"]:checked')?.value;
        if (selectedGender) {
            fetchClassesByGender(selectedGender);
        }
    });
</script>


@endpush