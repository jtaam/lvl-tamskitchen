@extends('admin.layouts.app')

@section('title','Login')

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    @include('admin.layouts.partials.msg')
                    <div class="card p-3" >
                        <div class="card-header bg-primary mb-4" data-background-color="purple">
                            <h4 class="title">Login</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Log In</button>

                                <a href="{{ route('welcome') }}" class="btn btn-danger">Back</a>
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
