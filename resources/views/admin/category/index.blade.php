@extends('admin.layouts.app')

@section('title','Categories')

@push('css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <style>
  .category-img{width: 150px;height: auto;}
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
                <h4 class="card-title ">All Categories</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="table" class="table table-striped">
                    <a href="{{route('category.create')}}" class="btn btn-success btn-sm pull-right"><i class="material-icons">add_to_photos</i></a>
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Slug
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
                      @foreach($categories as $key=>$category)
                        <tr>
                          <td>
                            {{$key + 1}}
                          </td>
                          <td>
                            {{$category->name}}
                          </td>
                          <td>
                            {{$category->slug}}
                          </td>
                          <td>
                            {{$category->created_at}}
                          </td>
                          <td>
                            {{$category->updated_at}}
                          </td>
                          <td>
                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                            <form id="delete-form-{{$category->id}}" action="{{route('category.destroy', $category->id)}}" style="display: none;" method="post">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm"
                            onclick="if(confirm('Are you sure to delete?')){
                              event.preventDefault();
                              document.getElementById('delete-form-{{$category->id}}').submit();
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
