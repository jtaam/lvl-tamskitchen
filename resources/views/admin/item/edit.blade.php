@extends('layouts.app')

@section('title','Edit Category')

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
                            <h4 class="title">Update Category</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('category.update', $category->id) }}" >
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Title</label>
                                            <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('category.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
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