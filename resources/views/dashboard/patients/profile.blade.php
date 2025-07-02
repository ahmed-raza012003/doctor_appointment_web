
@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4" style="color: #0f6d81;">My Profile</h5>

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

            <form action="{{ route('patient.profile.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="cnic" class="form-label fw-semibold text-gray-700">CNIC</label>
                    <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic', $patient->cnic ?? '') }}" maxlength="15" required>
                </div>
                <div>
                    <label for="date_of_birth" class="form-label fw-semibold text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="background-color: #11849B; border-color: #11849B;">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-label {
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}
.form-control {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.75rem;
    font-size: 0.875rem;
    width: 100%;
    transition: all 0.2s ease-in-out;
}
.form-control:focus {
    border-color: #11849B;
    box-shadow: 0 0 0 0.2rem rgba(17, 132, 155, 0.25);
    outline: none;
}
.btn-primary {
    transition: all 0.2s ease-in-out;
}
.btn-primary:hover {
    background-color: #0f6d81;
    border-color: #0f6d81;
}
</style>
@endsection
