@extends('layout.secure')
@section('styles')

@endsection

@section('title')
    Update Device
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
                    Update Device
                </div>
                <div class="card-body">
                    <form action="{{ route('secure.devices.update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $item->id ?? '' }}" name="id">
                        <input type="hidden" value="{{ $item->address ?? '' }}" name="oldAddress">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $item->address ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <select class="form-select" id="model" name="model" aria-label="Select model">
                                <option selected>Select model</option>
                                <option value="swm" @isset ($item) @if($item->model == 'swm') selected @endif @endisset>Sindcon Water Meter</option>
                                <option value="swp" @isset ($item) @if($item->model == 'swp') selected @endif @endisset>Sindcon Water Pressure</option>
                                <option value="ci" @isset ($item) @if($item->model == 'ci') selected @endif @endisset>Cybel Incometer</option>
                                <option value="lt" @isset ($item) @if($item->model == 'lt') selected @endif @endisset>Lansitec Tracker</option>
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
