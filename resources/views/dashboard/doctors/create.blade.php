@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-3">Add Doctor</h5>
                <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data" id="doctorForm">
                    @csrf
                    <!-- Doctor's Details Section -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="row g-3">
                                <!-- First Column -->
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="name" class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label fw-medium">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="phone_number" class="form-label fw-medium">Phone Number</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="experience" class="form-label fw-medium">Experience (years) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}" required>
                                        @error('experience')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="patients_satisfied" class="form-label fw-medium">Patients Satisfied <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('patients_satisfied') is-invalid @enderror" id="patients_satisfied" name="patients_satisfied" value="{{ old('patients_satisfied') }}" required>
                                        @error('patients_satisfied')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="qualifications" class="form-label fw-medium">Qualifications</label>
                                        <textarea class="form-control @error('qualifications') is-invalid @enderror" id="qualifications" name="qualifications" rows="4">{{ old('qualifications') }}</textarea>
                                        @error('qualifications')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="description" class="form-label fw-medium">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="bio" class="form-label fw-medium">Bio</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio') }}</textarea>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="experience_details" class="form-label fw-medium">Experience Details</label>
                                        <textarea class="form-control @error('experience_details') is-invalid @enderror" id="experience_details" name="experience_details" rows="4">{{ old('experience_details') }}</textarea>
                                        @error('experience_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="activism" class="form-label fw-medium">Activism</label>
                                        <textarea class="form-control @error('activism') is-invalid @enderror" id="activism" name="activism" rows="4">{{ old('activism') }}</textarea>
                                        @error('activism')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="special_interests" class="form-label fw-medium">Special Interests</label>
                                        <textarea class="form-control @error('special_interests') is-invalid @enderror" id="special_interests" name="special_interests" rows="4">{{ old('special_interests') }}</textarea>
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
                                <label for="category" class="form-label fw-medium">Filter Specializations and Services by Category</label>
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
                                <label for="specializations" class="form-label fw-medium">Specializations <span class="text-danger">*</span></label>
                                <p class="text-muted small mb-2">Select one or more specializations by clicking the tiles below (e.g., Cardiology, Neurology).</p>
                                <div class="d-flex flex-wrap gap-2" id="specializationTiles">
                                    @foreach ($specializations as $specialization)
                                        <div class="card tile-select border-0 shadow-sm" style="width: 130px; cursor: pointer;" data-category="{{ $specialization->category_id }}">
                                            <div class="card-body text-center p-2">
                                                <input type="checkbox" name="specializations[]" value="{{ $specialization->id }}" id="spec_{{ $specialization->id }}" class="d-none" {{ in_array($specialization->id, old('specializations', [])) ? 'checked' : '' }}>
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
                    <!-- Services Section -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="services" class="form-label fw-medium">Services <span class="text-danger">*</span></label>
                                <p class="text-muted small mb-2">Select one or more services by clicking the tiles below (e.g., Extraction, Implants).</p>
                                <div class="d-flex flex-wrap gap-2" id="serviceTiles">
                                    @foreach ($services as $service)
                                        <div class="card tile-select border-0 shadow-sm" style="width: 130px; cursor: pointer;" data-category="{{ $service->category_id }}">
                                            <div class="card-body text-center p-2">
                                                <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" class="d-none" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                                                <label for="service_{{ $service->id }}" class="tile-label small mb-0">{{ $service->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('services')
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
                                    <span id="fileName" class="text-white small mt-1 d-block">No file chosen</span>
                                    <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*">
                                </div>
                                @error('profile_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #11849B; border-color: #11849B;">Create Doctor</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Drag and drop for profile image
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('profile_image');
        const fileName = document.getElementById('fileName');
        const browseButton = document.getElementById('browseButton');

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

        // Tile selection for specializations and services
        document.querySelectorAll('.tile-select').forEach(tile => {
            tile.addEventListener('click', () => {
                const checkbox = tile.querySelector('input[type="checkbox"]');
                const label = tile.querySelector('.tile-label');
                checkbox.checked = !checkbox.checked;
                tile.style.backgroundColor = checkbox.checked ? '#11849B' : '#ffffff';
                label.style.color = checkbox.checked ? '#ffffff' : '#000000';
            });
        });

        // Category filter for specializations and services
        document.getElementById('category').addEventListener('change', function() {
            const selectedCategory = this.value;

            // Filter Specialization Tiles
            const specTiles = document.querySelectorAll('#specializationTiles .tile-select');
            specTiles.forEach(tile => {
                if (selectedCategory === 'all' || tile.getAttribute('data-category') === selectedCategory) {
                    tile.style.display = 'block';
                } else {
                    tile.style.display = 'none';
                }
            });

            // Filter Service Tiles
            const serviceTiles = document.querySelectorAll('#serviceTiles .tile-select');
            serviceTiles.forEach(tile => {
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