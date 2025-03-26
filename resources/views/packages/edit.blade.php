@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@include('includes.messages')

<nav class="page-breadcrumb">
    <h4>Add the Package</h4>
</nav>
<div class="row">
    <div class="col-md-10 grid-margin">
        <form action="{{route('packages.update',$package->id)}}" method="POST" class="forms-sample">
            @csrf
            @method('put')
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name',$package->name) }}" class="form-control mb-4 mb-md-0" placeholder="Enter the Name" />
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Detail</label>
                    <input type="text" name="detail" id="detail" value="{{ old('detail',$package->detail) }}" class="form-control mb-4 mb-md-0" placeholder="Enter the Detail" />
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="price" id="price" value="{{ old('price',$package->price) }}" class="form-control mb-4 mb-md-0" placeholder="Enter the Price" />
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Days</label>
                    <input type="text" name="days" id="days" value="{{ old('days',$package->days) }}" class="form-control mb-4 mb-md-0" placeholder="Enter the day" />
                </div>
                <div class="col-md-6 d-grid mb-2">
                    <a href="{{route('packages.index')}}" class="btn text-white" style="background: #FFA201;">Cancel</a>
                </div>
                <div class="col-md-6 d-grid">
                    <button class="btn text-white" style="background: #042954;" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

