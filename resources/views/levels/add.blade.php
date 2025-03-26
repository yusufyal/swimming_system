@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
  <h4>{{__('levels.AddtheLevels')}}</h4>
</nav>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form action="{{route('levels.store')}}" method="post">
          @csrf
          <div class="row mb-3">
            <div class="col-md-12 mb-3">
              <label class="form-label">{{__('levels.Name')}}</label>
              <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control mb-4 mb-md-0" placeholder="{{__('levels.EntertheName')}}" />
            </div>
            <div class="row mt-3">
              <div class="col d-grid mb-2">
                <a href="{{route('levels.index')}}" class="btn text-white" style="background: red;">{{__('levels.Cancel')}}</a>
              </div>
              <div class="col d-grid mb-2">
                <button class="btn text-white" style="background: green;" type="submit">{{__('levels.Save')}}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

