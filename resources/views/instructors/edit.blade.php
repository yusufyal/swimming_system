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
  <h4>{{__('instructors.EdittheInstructors')}}</h4>
</nav>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form action="{{route('instructors.update',$instructor->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row mb-3">
            <div class="col-md-9">
              <div class="row mb-3">
                <div class="col-md-12 mb-3">
                  <label class="form-label">{{__('instructors.Name')}}</label>
                  <input type="text" name="name" id="name" value="{{old('name',$instructor->name)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('instructors.EntertheName')}}"  />
                </div>
                <div class="col-md-12  mb-3">
                  <label class="form-label">{{__('instructors.Email')}}</label>
                  <input type="email" name="email" id="email" value="{{old('email',$instructor->email)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('instructors.EntertheEmail')}} " />
                </div>
                <div class="col-md-12  mb-3">
                  <label class="form-label">{{__('instructors.Phone')}}</label>
                  <input type="string" name="phone" id="phone" value="{{old('phone',$instructor->phone)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('instructors.EnterthePhone')}}" />
                </div>
                <div class="col-md-12 mb-3">
                  <label for="ageSelect" class="form-label">{{__('instructors.CivilID')}}</label>
                  <input type="text" name="civil_id" name="civil_id" value="{{old('civil_id',$instructor->civil_id)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('instructors.EntertheCivilID')}}" />
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">{{__('instructors.Nationality')}}</label>
                  <input type="text" name="nationality" id="nationality" value="{{old('nationality',$instructor->nationality)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('instructors.EntertheNationality')}}" />
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">{{__('instructors.Date')}}</label>
                  <input type="date" name="date_of_birth" id="date_of_birth" value="{{old('date',$instructor->date_of_birth)}}" class="form-control mb-4 mb-md-0" placeholder="{{__('instructors.EntertheDate')}}" />
                </div>
                <div class="col-md-12 mb-3">
                  <label for="status" class="form-label">{{__('instructors.Level')}}</label>
                  <select class="form-select" name="level_id[]" id="level_id" multiple>
                    @foreach ($levels as $level)
                    <option value="{{ $level->id }}"
                      {{ in_array($level->id, old('level_id', $instructor->levels->pluck('id')->toArray())) ? 'selected' : '' }}>
                      {{ $level->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="col-md-12 mb-3">
                <img src="{{ asset('storage/' . $instructor->image) }}"
                  style="width:200px;height:200px; justify-content:center;border-radius:10px;" alt="image">
                <div class="upload-container mt-4">
                  <label for="image" class="upload-label">
                    <i class="fa-solid fa-arrow-up-from-bracket fa-2x mb-1"></i><br>
                    <span id="file-name-text">{{__('instructors.Upload')}}<br>{{__('instructors.Your')}}  <br>{{__('instructors.Picture')}}</span>
                    <input type="file" id="image" name="image" style="display:none;" onchange="displayFileName()" />
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 d-grid mb-2">
                <a href="{{route('instructors.index')}}" class="btn text-white" style="background: red;">{{__('instructors.Cancel')}}</a>
              </div>
              <div class="col-md-4 d-grid  mb-2">
                <button class="btn text-white" style="background: #042954;" type="submit">{{__('instructors.Update')}}</button>
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
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('date_of_birth').setAttribute('max', today);
  // This is JavaScript to handle the dynamic file name display inside the label
  function displayFileName() {
    const fileInput = document.getElementById('image');
    const fileName = fileInput.files[0]?.name;
    const fileNameText = document.getElementById('file-name-text');
    if (fileName) {
      fileNameText.innerHTML = 'Image: <br>' + fileName; // Show the file name
    }
  }
  $(document).ready(function() {
    $('#level_id').select2();
  });
</script>
@endpush