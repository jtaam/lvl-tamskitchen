@extends('admin.layouts.app')

@section('title','Reservation')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Reservation Requests</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped">
                                    <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Time & Date
                                    </th>
                                    <th>
                                        Message
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($reservations as $key=>$reservation)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {{$reservation->name}}
                                        </td>
                                        <td>
                                            {{$reservation->phone}}
                                        </td>
                                        <td>
                                            {{$reservation->email}}
                                        </td>
                                        <td>
                                            {{$reservation->date_and_time}}
                                        </td>
                                        <td>
                                            {{$reservation->message}}
                                        </td>
                                        <td>
                                            @if($reservation->status == true)
                                                <span class="label label-info">Confirmed</span>
                                            @else
                                                <span class="label label-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reservation->status == false)
                                            <form id="status-form-{{$reservation->id}}" action="{{route('reservation.status',$reservation->id)}}" style="display: none;" method="post">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-info btn-sm"
                                                    onclick="if(confirm('Confirm this reservation request?')){
                                                            event.preventDefault();
                                                            document.getElementById('status-form-{{$reservation->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }">
                                                <i class="material-icons">done</i></button>
                                            @endif

                                            @if($reservation->status == true)
                                                <form id="delete-form-{{$reservation->id}}" action="{{route('reservation.destroy',$reservation->id)}}" style="display: none;" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="if(confirm('Are you sure to delete?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{$reservation->id}}').submit();
                                                    }else{
                                                        event.preventDefault();
                                                    }">
                                                    <i class="material-icons">delete</i></button>
                                            @endif
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
