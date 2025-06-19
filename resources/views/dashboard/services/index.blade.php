@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Services</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Service</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Services</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->patient->user->name ?? 'N/A' }}</td>
                                    <td>{{ $service->doctor->name ?? 'N/A' }}</td>
                                    <td>{{ $service->date }}</td>
                                    <td>{{ $service->time }}</td>
                                    <td>{{ $service->services }}</td>
                                    <td>{{ $service->remarks ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm" style="background-color: #ffca2c; border-color: #ffca2c;">Edit</a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="background-color: #dc3545; border-color: #dc3545;" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection