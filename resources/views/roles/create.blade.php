@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Add Roles</h5>
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
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="status" value="active">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success"><i class="bi bi-bookmarks"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
