@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Editing Roles - <i>{{ $role->name }}</i></h5>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('roles') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label>Role Name</label>
                        <select name="name" class="form-control">
                            <option value="">--Select--</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="status" value="active">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success"><i class="bi bi-bookmarks"></i> Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
