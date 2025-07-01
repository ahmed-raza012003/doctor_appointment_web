@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title fw-semibold">Manage Timeslots for {{ $doctor->name }}</h5>
                <div>
                    <a href="{{ route('admin.timeslots.create') }}?doctor_id={{ $doctor->id }}" class="btn btn-primary me-2" style="background-color: #11849B; border-color: #11849B;">Add New Timeslot</a>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-primary" style="color: #11849B; border-color: #11849B;">Back to Doctors</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($timeslots as $timeslot)
                        <tr>
                            <td>{{ $timeslot->day }}</td>
                            <td>{{ \Carbon\Carbon::parse($timeslot->start_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($timeslot->end_time)->format('h:i A') }}</td>
                            <td>
                                <a href="{{ route('admin.timeslots.edit', $timeslot->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.timeslots.destroy', $timeslot->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this timeslot?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No timeslots found for this doctor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.table th, .table td {
    vertical-align: middle;
}
.btn-outline-primary, .btn-outline-danger {
    transition: all 0.2s ease-in-out;
    color: #11849B;
    border-color: #11849B;
}
.btn-outline-primary:hover {
    background-color: #11849B;
    color: #ffffff;
    border-color: #11849B;
}
.btn-outline-danger:hover {
    background-color: #dc3545;
    color: #ffffff;
}
</style>
@endsection