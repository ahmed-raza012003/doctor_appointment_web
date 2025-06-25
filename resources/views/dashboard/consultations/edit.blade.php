@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Service</h5>
                <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data" id="serviceForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient</label>
                        <select class="form-control @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                            <option value="">Select a Patient</option>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $service->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->user->name }} ({{ $patient->cnic }})</option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                            <option value="">Select a Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $service->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }} ({{ $doctor->email }})</option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $service->date) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time', $service->time) }}" required>
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="services" class="form-label">Services</label>
                        <input type="text" class="form-control @error('services') is-invalid @enderror" id="services" name="services" value="{{ old('services', $service->services) }}" required>
                        @error('services')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks', $service->remarks) }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #11849B; border-color: #11849B;">Update Service</button>
                </form>
            </div>
        </div>
    </div>
@endsection