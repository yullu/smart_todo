@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Roles</h5>
            </div>
            <div class="col-md-9">
                <a href="{{ url('roles/create') }}" class="btn btn-outline-success float-end"><i class="bi bi-file-plus"></i> Add Role</a>
            </div>
        </div>
        <hr>
        @include('_message')
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive">
                    <th>Role ID</th>
                    <th>Names</th>
                    <th>Status</th>
                    <th>Action</th>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>
                                @if($role->name =='1')
                                    Admin
                                @else
                                    User

                                @endif
                            </td>
                            <td>{{ $role->status }}</td>
                            <td>
                                <a href="{{ url('roles/edit/'.$role->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                <a href="{{ url('roles/delete/'.$role->id) }}" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $roles->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
