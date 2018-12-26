@extends('layouts.app')

@section('title','Category Update')

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Edit Cloudinary Credentials</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('cloudinary.update',$cloudinary->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">Update Cloudinary Detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="cloud_name">Cloud Name</label>
                                                    <input type="text" class="form-control" name="cloud_name" id="cloud_name" value="{{$cloudinary->cloud_name}}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="api_key">API KEY</label>
                                                    <input type="text" class="form-control" name="api_key" id="api_key" value="{{$cloudinary->api_key}}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="api_secret">API SECRET</label>
                                                    <input type="password" class="form-control" name="api_secret" id="api_secret">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" for="media_url">MEDIA URL</label>
                                                    <input type="text" class="form-control" name="media_url" id="media_url" value="{{$cloudinary->media_url}}">
                                                </div>
                                            </div>

                                        </div>
                                        <a href="{{ route('cloudinary.index') }}" class="btn btn-danger">Back</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
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