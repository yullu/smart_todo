@extends('layout.app')
@section('content')
    <div class="container">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <h5 class="text-center"><i class="bi bi-person-lock"></i> Register an account</h5>
                        <hr>
                        @include('_message')
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                           <div class="mb-3">
                               <label>Names</label>
                               <input type="text" name="name" class="form-control">
                               @error('name')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>
                            <div class="mb-3">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success"><i class="bi bi-box-arrow-in-right"></i> Register</button>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="col-md-3"></div>
            </div>

    </div>
@endsection
