@extends('admin.layouts.app')

@section('title','Google Map Create')

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts.partials.msg')
                    <div class="card">

                        <div class="card-content">
                            <form method="POST" action="{{ route('map.store') }}">
                                @csrf
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">Add Google Map Detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="cloud_name">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="api_key">API KEY</label>
                                                    <input type="text" class="form-control" name="api_key" id="api_key">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="latitude">Latitude</label>
                                                    <input type="text" class="form-control" name="latitude" id="latitude">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="longitude">Longitude</label>
                                                    <input type="text" class="form-control" name="longitude" id="longitude">
                                                </div>
                                            </div>

                                        </div>
                                        <a href="{{ route('map.index') }}" class="btn btn-danger">Back</a>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
