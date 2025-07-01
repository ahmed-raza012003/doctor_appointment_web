@extends('dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-theme text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add New Timeslot</h5>
            <a href="{{ route('admin.timeslots.index') }}" class="btn btn-light btn-sm">Back to Timeslots</a>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.timeslots.store') }}" id="timeslotForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label fw-medium">Doctor <span class="text-danger">*</span></label>
                            <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required disabled>
                                <option value="">Select a Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id', request()->query('doctor_id')) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="doctor_id" value="{{ old('doctor_id', request()->query('doctor_id')) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="day" class="form-label fw-medium">Day <span class="text-danger">*</span></label>
                            <select class="form-select @error('day') is-invalid @enderror" id="day" name="day" required>
                                <option value="">Select a Day</option>
                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('day')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_time" class="form-label fw-medium">Start Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label fw-medium">End Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-theme px-4"><i class="fas fa-save me-1"></i> Create Timeslot</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded for timeslots/create.blade.php');

    const timeslotForm = document.getElementById('timeslotForm');
    if (timeslotForm) {
        timeslotForm.addEventListener('submit', function(e) {
            let hasError = false;
            const doctorId = document.querySelector('input[name="doctor_id"]').value;
            const day = document.getElementById('day').value;
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (!doctorId) {
                document.getElementById('doctor_id').classList.add('is-invalid');
                hasError = true;
            }
            if (!day) {
                document.getElementById('day').classList.add('is-invalid');
                hasError = true;
            }
            if (!startTime) {
                document.getElementById('start_time').classList.add('is-invalid');
                hasError = true;
            }
            if (!endTime) {
                document.getElementById('end_time').classList.add('is-invalid');
                hasError = true;
            }
            if (startTime && endTime && startTime >= endTime) {
                document.getElementById('end_time').classList.add('is-invalid');
                document.getElementById('end_time').nextElementSibling.textContent = 'End time must be after start time.';
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                console.log('Form submission blocked due to validation errors');
            } else {
                console.log('Form validation passed, submitting');
            }
        });

        // Remove is-invalid class on input change
        ['day', 'start_time', 'end_time'].forEach(id => {
            const input = document.getElementById(id);
            input.addEventListener('input', () => {
                input.classList.remove('is-invalid');
            });
        });
    } else {
        console.error('Timeslot form not found');
    }
});
</script>

<style>
.bg-theme {
    background-color: #11849B !important;
}
.text-theme {
    color: #11849B !important;
}
.border-theme {
    border-color: #11849B !important;
}
.btn-theme {
    background-color: #11849B !important;
    border-color: #11849B !important;
    color: #ffffff !important;
}
.btn-theme:hover {
    background-color: #0a6a7c !important;
    border-color: #0a6a7c !important;
}
.btn-outline-primary {
    color: #11849B !important;
    border-color: #11849B !important;
}
.btn-outline-primary:hover {
    background-color: #11849B !important;
    color: #ffffff !important;
}
</style>
@endsection