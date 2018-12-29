@extends('admin.layouts.app')

@section('title','Cloudinary')

@push('css')
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Cloudinary Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($cloudinary)
                                        <strong>Cloud Name: {{$cloudinary->cloud_name}}</strong><br>
                                        <strong>API_KEY: {{$cloudinary->api_key}}</strong><br>
                                        <strong>API SECRET: Invisible</strong><br>
                                        <strong>Media URL: <a href="{{$cloudinary->media_url}}" target="_blank">Visit Media URL</a></strong><br>
                                        <strong>Created At: {{$cloudinary->created_at}}</strong><hr>
                                        <br>
                                        <a href="{{route('cloudinary.edit', $cloudinary->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('cloudinary.destroy', $cloudinary->id)}}" class="btn btn-danger">Delete</a>
                                    @else
                                        <a href="{{route('cloudinary.create')}}" class="btn btn-warning">Add Info</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
