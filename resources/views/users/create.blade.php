@extends('layout.app')
@section('content')
    <div class="container">
        <h5>Create User</h5>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('users') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" >
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label>Role Name</label>
                        <select name="role_id" class="form-control">
                            <option value="">--Select--</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success"><i class="bi bi-bookmarks"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

