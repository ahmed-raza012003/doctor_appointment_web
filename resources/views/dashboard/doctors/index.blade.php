@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Doctors</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Doctor</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Experience</th>
                                <th>Patients Satisfied</th>
                                <th>Profile Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->id }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->email ?? '-' }}</td>
                                    <td>{{ $doctor->phone_number ?? '-' }}</td>
                                    <td>{{ $doctor->experience }} years</td>
                                    <td>{{ $doctor->patients_satisfied }}</td>
                                    <td>
                                        @if ($doctor->profile_image)
                                            <img src="{{ Storage::url($doctor->profile_image) }}" alt="{{ $doctor->name }}" style="max-width: 50px; height: auto; border-radius: 4px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
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