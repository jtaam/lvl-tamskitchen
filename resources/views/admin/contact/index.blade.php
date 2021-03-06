@extends('admin.layouts.app')

@section('title','Contact')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <style>
    .table-responsive a{margin: 15px;}
    .paginate_button{
      cursor: pointer;
      background: #ab47bc;
      padding: 5px 8px;
      color: white;
    }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Contact Messages</h4>
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
                                            Subject
                                        </th>

                                        <th>
                                            Sent At
                                        </th>
                                        <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $key=>$contact)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {{$contact->name}}
                                        </td>
                                        <td>
                                            {{$contact->subject}}
                                        </td>
                                        <td>
                                            {{$contact->created_at}}
                                        </td>
                                        <td>
                                            <a href="{{route('contact.show',$contact->id)}}" class="btn btn-info btn-sm"><i class="material-icons">details</i></a>

                                            <form id="delete-form-{{$contact->id}}" action="{{route('contact.destroy', $contact->id)}}" style="display: none;" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="if(confirm('Are you sure to delete?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{$contact->id}}').submit();
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
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
