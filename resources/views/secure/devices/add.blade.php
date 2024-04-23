@extends('layout.secure')
@section('styles')

@endsection

@section('title')
    Add New Device
@endsection

@section('content')
    @isset($message)
        <div class="row pt-5 ps-5 pe-5">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            </div>
        </div>
    @endisset
    <div class="row p-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Add New Device
                </div>
                <div class="card-body">
                    <form action="{{ route('secure.devices.create') }}" method="post">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <select class="form-select" id="model" name="model" aria-label="Select model">
                                <option selected>Select model</option>
                                <option value="swm">Sindcon Water Meter</option>
                                <option value="swp">Sindcon Water Pressure</option>
                                <option value="ci">Cybel Incometer</option>
                                <option value="lt">Lansitec Tracker</option>
                                <option value="djuwm">DJ Ultrasonic Water Meter</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
