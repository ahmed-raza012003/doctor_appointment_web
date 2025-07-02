@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4" style="color: #0f6d81;">Manage Appointments</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($appointments->isEmpty())
                <p class="text-gray-500 text-center text-sm">No appointments found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-sm font-semibold text-gray-700">Patient</th>
                                <th class="text-sm font-semibold text-gray-700">Doctor</th>
                                <th class="text-sm font-semibold text-gray-700">Service</th>
                                <th class="text-sm font-semibold text-gray-700">Date</th>
                                <th class="text-sm font-semibold text-gray-700">Time</th>
                                <th class="text-sm font-semibold text-gray-700">Status</th>
                                <th class="text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($appointments as $appointment)
    <tr>
        <td class="text-sm">{{ $appointment->patient->name ?? 'N/A' }}</td>
        <td class="text-sm">{{ $appointment->doctor->name ?? 'N/A' }}</td>
        <td class="text-sm">{{ $appointment->service->name ?? 'N/A' }}</td>
        <td class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y') }}</td>
        <td class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
        <td class="text-sm">
            <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                @method('POST')
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                  <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>   </select>
            </form>
        </td>
        <td class="text-sm">
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#patientModal{{ $appointment->id }}" title="View Patient Profile">
                <i class="ti ti-user"></i>
            </button>
        </td>
    </tr>

    <!-- Patient Profile Modal -->
    <div class="modal fade" id="patientModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="patientModalLabel{{ $appointment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="patientModalLabel{{ $appointment->id }}" style="color: #0f6d81;">Patient Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> {{ $appointment->patient->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $appointment->patient->email ?? 'N/A' }}</p>
                    <p><strong>CNIC:</strong> {{ $appointment->patient->patient->cnic ?? 'N/A' }}</p>
                    <p><strong>Date of Birth:</strong> {{ $appointment->patient->patient->date_of_birth ? \Carbon\Carbon::parse($appointment->patient->patient->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.table th, .table td {
    vertical-align: middle;
    padding: 0.75rem;
}
.table thead tr {
    background-color: #f8f9fa;
}
.table tbody tr:hover {
    background-color: #e9ecef;
}
.btn-outline-primary {
    color: #11849B;
    border-color: #11849B;
    transition: all 0.2s ease-in-out;
}
.btn-outline-primary:hover {
    background-color: #11849B;
    color: #ffffff;
    border-color: #11849B;
}
.form-select {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem;
    font-size: 0.875rem;
}
.form-select:focus {
    border-color: #11849B;
    box-shadow: 0 0 0 0.2rem rgba(17, 132, 155, 0.25);
    outline: none;
}
</style>
@endsection