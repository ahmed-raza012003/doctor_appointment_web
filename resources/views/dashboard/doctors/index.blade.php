@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body p-4">
            
                <h5 class="card-title fw-semibold mb-3">Doctors List</h5>
                                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary" style="background-color: #11849B; border-color: #11849B;">Add New Doctor</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <table class="table table-hover">
               
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Experience</th>
                            <th>Patients Satisfied</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->email ?? 'N/A' }}</td>
                                <td>{{ $doctor->phone_number ?? 'N/A' }}</td>
                                <td>{{ $doctor->experience }} years</td>
                                <td>{{ $doctor->patients_satisfied }}</td>
                                <td>
                                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
  color:#11849B;
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