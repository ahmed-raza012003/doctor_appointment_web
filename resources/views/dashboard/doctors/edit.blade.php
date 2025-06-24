@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-3">Edit Doctor</h5>
                <form method="POST" action="{{ route('admin.doctors.update', $doctor->id) }}" enctype="multipart/form-data" id="doctorForm">
                    @csrf
                    @method('PUT')
                    <!-- Doctor's Details Section -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="row g-3">
                                <!-- First Column -->
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="name" class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $doctor->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label fw-medium">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $doctor->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="phone_number" class="form-label fw-medium">Phone Number</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $doctor->phone_number) }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="experience" class="form-label fw-medium">Experience (years) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience', $doctor->experience) }}" required>
                                        @error('experience')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="patients_satisfied" class="form-label fw-medium">Patients Satisfied <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('patients_satisfied') is-invalid @enderror" id="patients_satisfied" name="patients_satisfied" value="{{ old('patients_satisfied', $doctor->patients_satisfied) }}" required>
                                        @error('patients_satisfied')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="qualifications" class="form-label fw-medium">Qualifications</label>
                                        <textarea class="form-control @error('qualifications') is-invalid @enderror" id="qualifications" name="qualifications" rows="4">{{ old('qualifications', $doctor->qualifications) }}</textarea>
                                        @error('qualifications')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="description" class="form-label fw-medium">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $doctor->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="bio" class="form-label fw-medium">Bio</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio', $doctor->bio) }}</textarea>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="experience_details" class="form-label fw-medium">Experience Details</label>
                                        <textarea class="form-control @error('experience_details') is-invalid @enderror" id="experience_details" name="experience_details" rows="4">{{ old('experience_details', $doctor->experience_details) }}</textarea>
                                        @error('experience_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="activism" class="form-label fw-medium">Activism</label>
                                        <textarea class="form-control @error('activism') is-invalid @enderror" id="activism" name="activism" rows="4">{{ old('activism', $doctor->activism) }}</textarea>
                                        @error('activism')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="special_interests" class="form-label fw-medium">Special Interests</label>
                                        <textarea class="form-control @error('special_interests') is-invalid @enderror" id="special_interests" name="special_interests" rows="4">{{ old('special_interests', $doctor->special_interests) }}</textarea>
                                        @error('special_interests')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category Filter Section -->
                    <div class="row g-3 mt-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="category" class="form-label fw-medium">Filter Specializations by Category</label>
                                <select id="category" class="form-select">
                                    <option value="all">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Specializations Section -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="specializations" class="form-label fw-medium">Specializations</label>
                                <p class="text-muted small mb-2">Select one or more specializations by clicking the tiles below (e.g., Cardiology, Neurology).</p>
                                <div class="d-flex flex-wrap gap-2" id="specializationTiles">
                                    @foreach ($specializations as $specialization)
                                        <div class="card tile-select border-0 shadow-sm" style="width: 130px; cursor: pointer;" data-category="{{ $specialization->category_id }}">
                                            <div class="card-body text-center p-2">
                                                <input type="checkbox" name="specializations[]" value="{{ $specialization->id }}" id="spec_{{ $specialization->id }}" class="d-none" {{ $doctor->specializations->contains($specialization->id) ? 'checked' : '' }}>
                                                <label for="spec_{{ $specialization->id }}" class="tile-label small mb-0">{{ $specialization->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('specializations')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Profile Image Section -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="profile_image" class="form-label fw-medium">Profile Image</label>
                                <div class="drop-zone text-center p-2" id="dropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 4px; color: #ffffff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="small mb-1">Drag & Drop or</p>
                                    <button type="button" class="btn btn-light btn-sm px-2 py-0" id="browseButton">Browse</button>
                                    <span id="fileName" class="text-white small mt-1 d-block">{{ $doctor->profile_image ? basename($doctor->profile_image) : 'No file chosen' }}</span>
                                    <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*">
                                </div>
                                @if ($doctor->profile_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="{{ $doctor->name }}" style="max-width: 100px; height: auto; border-radius: 4px;">
                                    </div>
                                @endif
                                @error('profile_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #11849B; border-color: #11849B;">Update Doctor</button>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary px-4 ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('profile_image');
        const fileName = document.getElementById('fileName');
        const browseButton = document.getElementById('browseButton');

        // Drag and drop functionality
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

        browseButton.addEventListener('click', () => imageInput.click());

        imageInput.addEventListener('change', () => {
            if (imageInput.files[0]) {
                fileName.textContent = imageInput.files[0].name;
            }
        });

        // Tile selection with pre-selected specializations
        document.querySelectorAll('.tile-select').forEach(tile => {
            const checkbox = tile.querySelector('input[type="checkbox"]');
            if (checkbox.checked) {
                tile.style.backgroundColor = '#11849B';
                tile.querySelector('.tile-label').style.color = '#ffffff';
            }
            tile.addEventListener('click', () => {
                checkbox.checked = !checkbox.checked;
                tile.style.backgroundColor = checkbox.checked ? '#11849B' : '#ffffff';
                tile.querySelector('.tile-label').style.color = checkbox.checked ? '#ffffff' : '#000000';
            });
        });

        // Category filter
        document.getElementById('category').addEventListener('change', function() {
            const selectedCategory = this.value;
            const tiles = document.querySelectorAll('.tile-select');
            tiles.forEach(tile => {
                if (selectedCategory === 'all' || tile.getAttribute('data-category') === selectedCategory) {
                    tile.style.display = 'block';
                } else {
                    tile.style.display = 'none';
                }
            });
        });
    </script>

    <style>
        .tile-select {
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .tile-label {
            cursor: pointer;
            line-height: 1.2;
        }
        .drop-zone:hover {
            background-color: #0f6d81 !important;
        }
        .card {
            border: none;
        }
        .form-label {
            font-size: 0.95rem;
        }
    </style>
@endsection