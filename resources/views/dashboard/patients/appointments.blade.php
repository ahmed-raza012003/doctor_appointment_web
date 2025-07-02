@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4" style="color: #0f6d81;">My Appointments</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($appointments->isEmpty())
                <p class="text-gray-500 text-center text-sm">You have no appointments booked.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-sm font-semibold text-gray-700">Doctor</th>
                                <th class="text-sm font-semibold text-gray-700">Service</th>
                                <th class="text-sm font-semibold text-gray-700">Date</th>
                                <th class="text-sm font-semibold text-gray-700">Time</th>
                                <th class="text-sm font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td class="text-sm">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                                    <td class="text-sm">{{ $appointment->service->name ?? 'N/A' }}</td>
                                    <td class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y') }}</td>
                                    <td class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                    <td class="text-sm">
                                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full 
                                            @if($appointment->status == 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status == 'confirmed')
                                                bg-green-100 text-green-800
                                            @else
                                                bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
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
</style>
@endsection
