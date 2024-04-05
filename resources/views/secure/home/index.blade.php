@extends('layout.secure')
@section('styles')
    <meta name="edit-device-url" content="{{ route('secure.devices.edit', ['id' => ':id']) }}">
    <meta name="delete-device-url" content="{{ route('secure.devices.delete', ['id' => ':id']) }}">
    <link href="{{ asset('css/secure/home/index.css') }}" rel="stylesheet" />
@endsection

@section('title')
    Beranda
@endsection

@section('content')
    <div class="row p-2">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('secure.devices.add') }}" class="btn btn-primary">Add New</a>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-12 table-responsive">
            <table
                id="table"
                data-toggle="table"
                data-show-refresh="true"
                data-auto-refresh="true"
                data-url="{{ route('secure.devices.getData') }}"
                data-height="400"
                data-side-pagination="server"
                data-pagination="true">
                <thead>
                <tr>
                    <th data-field="id" data-formatter="numberFormatter">#</th>
                    <th data-field="name">Name</th>
                    <th data-field="model" data-formatter="modelFormatter">Model</th>
                    <th data-field="address">Address</th>
                    <th data-field="lastData">Last Data</th>
                    <th data-field="id" data-formatter="actionFormatter"></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/secure/home/index.js') }}" type="application/javascript"></script>
@endsection
