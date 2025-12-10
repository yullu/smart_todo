@extends('layout.app')
@section('content')
    <div class="container">
        <h2 class="mb-3">System Audit Trail</h2>
        <hr>
        @include('_message')

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
                <th>IP Address</th>
                <th>Date & Time</th>
            </tr>
            </thead>
            <tbody>
            @forelse($logs as $index => $log)
                <tr>
                    <td>{{ $logs->firstItem() + $index }}</td>
                    <td>{{ $log->causer ? $log->causer->name : 'System' }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->properties['ip'] ?? 'N/A' }}</td>
                    <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No logs found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->

            {{ $logs->links('pagination::bootstrap-5') }}

    </div>
@endsection
