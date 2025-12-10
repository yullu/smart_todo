@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Users</h5>
            </div>
            <div class="col-md-9">
                <a href="{{ url('users/create') }}" class="btn btn-outline-success float-end"><i class="bi bi-file-plus"></i> Add User</a>
            </div>
        </div>
        <hr>
        @include('_message')
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive">
                    <th>Names</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role_id =='1')
                                Admin
                            @else
                                User

                            @endif
                        </td>
                        <td>
                            <a href="{{ url('users/edit/'.$user->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            <a href="{{ url('users/delete/'.$user->id) }}" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

