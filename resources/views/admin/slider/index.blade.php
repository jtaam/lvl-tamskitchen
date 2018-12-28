@extends('layouts.app')

@section('title','Slider')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <style>
        .slider-img{width: 150px;height: auto;}
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Slider</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped">
                                    <a href="{{route('slider.create')}}" class="btn btn-success btn-sm pull-right"><i class="material-icons">add_to_photos</i></a>
                                    <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Sub Title
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Created At
                                    </th>
                                    <th>
                                        Updated At
                                    </th>
                                    <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $key=>$slider)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {{$slider->title}}
                                        </td>
                                        <td>
                                            {{$slider->sub_title}}
                                        </td>
                                        <td>
                                          <img class="slider-img"
                                          @if (config('app.env')=='local')
                                            src="/uploads/slider/{{$slider->image}}"
                                          @else
                                            src="{{$slider->image}}"
                                          @endif
                                            alt="{{$slider->title}}" />
                                        </td>
                                        <td>
                                            {{$slider->created_at}}
                                        </td>
                                        <td>
                                            {{$slider->updated_at}}
                                        </td>
                                        <td>
                                            <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                                            <form id="delete-form-{{$slider->id}}" action="{{route('slider.destroy', $slider->id)}}" style="display: none;" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="if(confirm('Are you sure to delete?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{$slider->id}}').submit();
                                                }else{
                                                    event.preventDefault();
                                                }">
                                                <i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
