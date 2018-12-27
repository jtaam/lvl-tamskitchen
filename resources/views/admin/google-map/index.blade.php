@extends('layouts.app')

@section('title','map')

@push('css')
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Map Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($map)
                                        <strong>Title: {{$map->title}}</strong><br>
                                        <strong>API_KEY: {{$map->api_key}}</strong><br>
                                        <strong>LATITUDE: {{$map->latitude}}</strong><br>
                                        <strong>LONGITUDE: {{$map->longitude}}</strong><br>
                                        <strong>Created At: {{$map->created_at}}</strong><hr>
                                        <br>
                                        <a href="{{route('map.edit', $map->id)}}" class="btn btn-info"><i class="material-icons">edit</i>Edit</a>
                                        <form id="delete-form-{{$map->id}}" action="{{route('map.destroy', $map->id)}}" style="display: none;" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-danger"
                                                onclick="if(confirm('Are you sure to delete?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{$map->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }">
                                            <i class="material-icons">delete</i>DELETE</button>

                                    @else
                                        <a href="{{route('map.create')}}" class="btn btn-warning">Add Info</a>
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