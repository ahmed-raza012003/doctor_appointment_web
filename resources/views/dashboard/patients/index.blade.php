@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Patients</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.patients.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Patient</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>CNIC</th>
                                <th>Date of Birth</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->id }}</td>
                                    <td>{{ $patient->user->name ?? 'N/A' }}</td>
                                    <td>{{ $patient->cnic }}</td>
                                    <td>{{ $patient->date_of_birth }}</td>
                                    <td>
                                        <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning btn-sm" style="background-color: #ffca2c; border-color: #ffca2c;">Edit</a>
                                        <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
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