@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
    <h4>{{__('classes.AddClasses')}}</h4>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('classes.store') }}" method="post" class="forms-sample">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{__('classes.ClassName')}}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="{{__('classes.EntertheClassName')}}" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-group" for="days">{{__('classes.Days')}} </label>
                            <select name="days[]" id="days" class="js-example-basic-multiple form-select select2" multiple="multiple">
                                <option value="monday" {{ in_array('monday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Monday')}}</option>
                                <option value="tuesday" {{ in_array('tuesday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Tuesday')}}</option>
                                <option value="wednesday" {{ in_array('wednesday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Wednesday')}}</option>
                                <option value="thursday" {{ in_array('thursday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Thursday')}}</option>
                                <option value="friday" {{ in_array('friday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Friday')}}</option>
                                <option value="saturday" {{ in_array('saturday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Saturday')}}</option>
                                <option value="sunday" {{ in_array('sunday', old('days', [])) ? 'selected' : '' }}>{{__('classes.Sunday')}}</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="start_time" class="form-label">{{__('classes.StartTime')}}</label>
                            <div class="input-group flatpickr" id="flatpickr-time">
                                <input type="text" class="form-control" id="start_time" name="start_time" value="{{old('start_time')}}" placeholder="{{__('classes.Selectstarttime')}}" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="end_time" class="form-label">{{__('classes.EndTime')}}</label>
                            <div class="input-group flatpickr" id="flatpickr-time">
                                <input type="text" class="form-control" id="end_time" name="end_time" value="{{old('end_time')}}" placeholder="{{__('classes.Selectendtime')}}" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{__('classes.Level')}}</label>
                            <select name="level_id" id="level_id" class="form-control select2" required>
                                <option value="" disabled selected>{{__('classes.SelectLevel')}}</option>
                                @foreach ($levels as $level)
                                <option value="{{$level->id}}" {{old('level_id')}}>{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{__('classes.Instructor')}}</label>
                            <select name="instructor_id" id="instructor" class="form-control select2" required>
                                <option value="" disabled selected>{{__('classes.SelectInstructor')}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-grid mb-2">
                            <a href="{{route('classes.index')}}" class="btn text-white" style="background: red;">{{__('classes.Cancel')}}</a>
                        </div>
                        <div class="col-md-6 d-grid mb-2">
                            <button class="btn text-white" style="background: green;" type="submit">{{__('classes.Save')}}</button>
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
<script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/pickr.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();
        $('#level_id').on('change', function() {
            const levelId = $(this).val();
            $('#instructor').html('<option value="" disabled selected>Select Instructor</option>');
            if (levelId) {
                $.ajax({
                    url: `/api/instructors/${levelId}`,
                    type: 'GET',
                    success: function(data) {
                        // If data is received, populate the dropdown
                        let options = '<option value="" disabled selected>Select Instructor</option>';
                        if (data.length > 0) {
                            data.forEach(instructor => {
                                options += `<option value="${instructor.id}">${instructor.name}</option>`;
                            });
                        }
                        $('#instructor').html(options);
                    },
                });
            }
        });
        // Handle gender selection
        $('input[name="gender"]').on('change', function() {
            const selectedGender = $(this).val();
            let daysOptions = '';
            if (selectedGender === 'Female') {
                daysOptions = `
                <option value="Saturday,Monday,Wednesday">Saturday, Monday, Wednesday</option>
            `;
            } else {
                daysOptions = `
                <option value="Sunday, Tuesday, Thursday">Sunday, Tuesday, Thursday</option>
                <option value="Friday, Saturday">Friday, Saturday</option>
                <option value="Saturday,Monday,Wednesday">Saturday, Monday, Wednesday</option>
            `;
            }
            // Update days dropdown and trigger change
            $('#days').html(`<option value="" disabled selected>Select Days</option>` + daysOptions).change();
        });
        $('#days').on('change', function() {
            const selectedDays = $(this).val(); // Get the selected value
            let timeOptions = '';
            if (selectedDays === 'Saturday,Monday,Wednesday') {
                timeOptions = `
            <option value="9:00AM-10:30AM">9:00AM - 10:30AM</option>
            <option value="10:30AM-12:00PM">10:30AM - 12:00PM</option>
            <option value="6:30PM-7:30PM">6:30PM - 7:30PM</option>
            <option value="7:30PM-8:30PM">7:30PM - 8:30PM</option>
            <option value="8:30PM-9:30PM">8:30PM - 9:30PM</option>
        `;
            } else if (selectedDays === 'Sunday, Tuesday, Thursday') {
                timeOptions = `
            <option value="4:00PM-5:00PM">4:00PM - 5:00PM</option>
            <option value="5:00PM-6:00PM">5:00PM - 6:00PM</option>
            <option value="6:00PM-7:00PM">6:00PM - 7:00PM</option>
            <option value="7:00PM-8:00PM">7:00PM - 8:00PM</option>
            <option value="8:00PM-9:00PM">8:00PM - 9:00PM</option>
        `;
            } else if (selectedDays === 'Friday, Saturday') {
                timeOptions = `
            <option value="1:00PM-2:30PM">1:00PM - 2:30PM</option>
            <option value="2:30PM-4:00PM">2:30PM - 4:00PM</option>
        `;
            }
            $('#time').html(`<option value="" disabled selected>Select Time</option>` + timeOptions);
        });

    });
</script>
<script>
    document.getElementById('start_date').addEventListener('change', function() {
        var startDate = new Date(this.value); // Get the selected start date
        startDate.setDate(startDate.getDate() + 30); // Add 30 days
        var endDate = startDate.toISOString().split('T')[0]; // Convert to YYYY-MM-DD format
        document.getElementById('end_date').value = endDate; // Set the end date value
    });
</script>
@endpush