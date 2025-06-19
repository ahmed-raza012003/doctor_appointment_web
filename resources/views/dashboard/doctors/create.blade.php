@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Add Doctor</h5>
                <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data" id="doctorForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience (years)</label>
                        <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}" required>
                        @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="patients_satisfied" class="form-label">Patients Satisfied</label>
                        <input type="number" class="form-control @error('patients_satisfied') is-invalid @enderror" id="patients_satisfied" name="patients_satisfied" value="{{ old('patients_satisfied') }}" required>
                        @error('patients_satisfied')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <div class="drop-zone text-center p-4" id="dropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 4px; color: #ffffff;">
                            <i class="fas fa-cloud-upload-alt fa-2x"></i>
                            <p class="mb-1">Drag & Drop to Upload File</p>
                            <p class="mb-2">OR</p>
                            <button type="button" class="btn btn-light btn-sm" id="browseButton">Browse File</button>
                            <span id="fileName" class="text-white mt-2 d-block">No file chosen</span>
                            <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*">
                        </div>
                        @error('profile_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="specializations" class="form-label">Specializations</label>
                        <div class="d-flex flex-wrap gap-3" id="specializationTiles">
                            @foreach ($specializations as $specialization)
                                <div class="card tile-select" style="width: 150px; cursor: pointer;">
                                    <div class="card-body text-center p-2">
                                        <input type="checkbox" name="specializations[]" value="{{ $specialization->id }}" id="spec_{{ $specialization->id }}" class="d-none">
                                        <label for="spec_{{ $specialization->id }}" class="tile-label">
                                            {{ $specialization->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('specializations')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #11849B; border-color: #11849B;">Create Doctor</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('profile_image');
        const fileName = document.getElementById('fileName');
        const browseButton = document.getElementById('browseButton');

        // Drag and drop functionality for profile image
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.backgroundColor = '#0f6d81';
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.style.backgroundColor = '#11849B';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.backgroundColor = '#11849B';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                fileName.textContent = files[0].name;
            }
        });

        browseButton.addEventListener('click', () => {
            imageInput.click();
        });

        imageInput.addEventListener('change', (e) => {
            if (imageInput.files && imageInput.files[0]) {
                fileName.textContent = imageInput.files[0].name;
            }
        });

        // Tile selection functionality
        document.querySelectorAll('.tile-select').forEach(tile => {
            tile.addEventListener('click', () => {
                const checkbox = tile.querySelector('input[type="checkbox"]');
                const label = tile.querySelector('.tile-label');
                checkbox.checked = !checkbox.checked;
                tile.style.backgroundColor = checkbox.checked ? '#11849B' : '#ffffff';
                label.style.color = checkbox.checked ? '#ffffff' : '#000000';
            });
        });
    </script>
    <style>
        .tile-select {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .tile-label {
            cursor: pointer;
            font-size: 0.9rem;
            margin: 0;
        }
    </style>
    @endsection