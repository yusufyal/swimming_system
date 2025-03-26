@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
  <h4>Add New Enrollment</h4>
</nav>
<div class="row">
  <div class="col-md-10 grid-margin">
    <form action="{{route('enrollments.store')}}" method="POST" class="forms-sample" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <div class="col-md-10 mb-3">
          <label class="form-label">Student:</label>
          <select class="form-select" name="student_id" id="student_id">
            <option value="" selected disabled hidden>Select Student</option>
            @foreach ($data['students'] as $student)
            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
              {{ $student->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Class:</label>
          <select class="form-select" name="class_id" id="class_id">
            <option value="" selected disabled hidden>Select Class</option>
            @foreach ($data['class_models'] as $class)
            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
              {{ $class->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Level:</label>
          <select class="form-select" name="level_id" id="level_id">
            <option value="" selected disabled hidden>Select Level</option>
            @foreach ($data['levels'] as $level)
            <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
              {{ $level->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Instructor:</label>
          <select class="form-select" name="instructor_id" id="instructor_id">
            <option value="" selected disabled hidden>Select Instructor</option>
            @foreach ($data['instructors'] as $instructor)
            <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
              {{ $instructor->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Date of Join</label>
          <input type="date" name="date_of_join" id="date_of_join" value="{{old('date_of_join')}}" class="form-control mb-4 mb-md-0" placeholder="Enter the date of join" />
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Date of Expire</label>
          <input type="date" name="date_of_expire" id="date_of_expire" value="{{old('date_of_expire')}}" class="form-control mb-4 mb-md-0" placeholder="Enter the date of expire" />
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Day's:</label>
          <select name="day[]" id="day" class="js-example-basic-multiple form-select" multiple="multiple" aria-placeholder="Select Days">
            <option value="monday" {{ in_array('monday', old('day', [])) ? 'selected' : '' }}>Monday</option>
            <option value="tuesday" {{ in_array('tuesday', old('day', [])) ? 'selected' : '' }}>Tuesday</option>
            <option value="wednesday" {{ in_array('wednesday', old('day', [])) ? 'selected' : '' }}>Wednesday</option>
            <option value="thursday" {{ in_array('thursday', old('day', [])) ? 'selected' : '' }}>Thursday</option>
            <option value="friday" {{ in_array('friday', old('day', [])) ? 'selected' : '' }}>Friday</option>
            <option value="saturday" {{ in_array('saturday', old('day', [])) ? 'selected' : '' }}>Saturday</option>
            <option value="sunday" {{ in_array('sunday', old('day', [])) ? 'selected' : '' }}>Sunday</option>
          </select>
        </div>
        <div class="col-md-10 mb-3">
          <label class="form-label">Time:</label>
          <div class="input-group flatpickr" id="flatpickr-time">
            <input type="text" class="form-control" id="time" name="time" value="{{ old('time') }}" placeholder="Select time" data-input>
            <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <button type="submit" class="btn btn-success btn-sm">Enroll Student</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#class_id, #level_id').on('change', function() {
      var class_id = $('#class_id').val();
      var level_id = $('#level_id').val();
      if (class_id && level_id) {
        $.ajax({
          url: "{{ route('get-instructors') }}",
          method: 'GET',
          data: {
            class_model_id: class_id,
            level_id: level_id
          },
          success: function(response) {
            $('#instructor_id').empty();
            $('#instructor_id').append('<option value="" selected disabled hidden>Select Instructor</option>');
            $.each(response.instructors, function(index, instructor) {
              $('#instructor_id').append('<option value="' + instructor.id + '">' + instructor.name + '</option>');
            });
          },
          error: function(response) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              let errorMessages = '<ul>';
              $.each(errors, function(field, messages) {
                $.each(messages, function(index, message) {
                  errorMessages += '<li>' + message + '</li>';
                });
              });
              errorMessages += '</ul>';
              $('#error-messages').html(errorMessages).show();
            } else {
              alert("Error fetching instructors.");
            }
          }
        });
      }
    });
  });
</script>
@endpush