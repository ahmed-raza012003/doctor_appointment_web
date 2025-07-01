@extends('dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-theme text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Add New Doctor</h5>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-light btn-sm">Back to Doctors</a>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data" id="doctorForm">
                @csrf
                <!-- Accordion for Form Sections -->
                <div class="accordion" id="doctorFormAccordion">
                    <!-- Personal Details Section -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#personalDetails" aria-expanded="true" aria-controls="personalDetails">
                                Personal Details
                            </button>
                        </h2>
                        <div id="personalDetails" class="accordion-collapse collapse show" data-bs-parent="#doctorFormAccordion">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-medium">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number" class="form-label fw-medium">Phone Number</label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="experience" class="form-label fw-medium">Experience (years) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}" required>
                                            @error('experience')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="patients_satisfied" class="form-label fw-medium">Patients Satisfied <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('patients_satisfied') is-invalid @enderror" id="patients_satisfied" name="patients_satisfied" value="{{ old('patients_satisfied') }}" required>
                                            @error('patients_satisfied')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="qualifications" class="form-label fw-medium">Qualifications</label>
                                            <textarea class="form-control @error('qualifications') is-invalid @enderror" id="qualifications" name="qualifications" rows="3">{{ old('qualifications') }}</textarea>
                                            @error('qualifications')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Education Section -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#education" aria-expanded="false" aria-controls="education">
                                Education
                            </button>
                        </h2>
                        <div id="education" class="accordion-collapse collapse" data-bs-parent="#doctorFormAccordion">
                            <div class="accordion-body">
                                <div id="educationFields" class="mb-3">
                                    <!-- Dynamic education fields will be added here -->
                                </div>
                                <button type="button" class="btn btn-outline-theme btn-sm" id="addEducation"><i class="fas fa-plus me-1"></i> Add Education</button>
                                @error('education')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Professional Details Section -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#professionalDetails" aria-expanded="false" aria-controls="professionalDetails">
                                Professional Details
                            </button>
                        </h2>
                        <div id="professionalDetails" class="accordion-collapse collapse" data-bs-parent="#doctorFormAccordion">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-medium">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="bio" class="form-label fw-medium">Bio</label>
                                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio') }}</textarea>
                                            @error('bio')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="experience_details" class="form-label fw-medium">Experience Details</label>
                                            <textarea class="form-control @error('experience_details') is-invalid @enderror" id="experience_details" name="experience_details" rows="3">{{ old('experience_details') }}</textarea>
                                            @error('experience_details')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="activism" class="form-label fw-medium">Activism</label>
                                            <textarea class="form-control @error('activism') is-invalid @enderror" id="activism" name="activism" rows="3">{{ old('activism') }}</textarea>
                                            @error('activism')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="special_interests" class="form-label fw-medium">Special Interests</label>
                                            <textarea class="form-control @error('special_interests') is-invalid @enderror" id="special_interests" name="special_interests" rows="3">{{ old('special_interests') }}</textarea>
                                            @error('special_interests')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Specializations and Services Section -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#specializations" aria-expanded="false" aria-controls="specializations">
                                Specializations and Services
                            </button>
                        </h2>
                        <div id="specializations" class="accordion-collapse collapse" data-bs-parent="#doctorFormAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label fw-medium">Filter by Category</label>
                                    <select id="category" class="form-select">
                                        <option value="all">All</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="specializations" class="form-label fw-medium">Specializations <span class="text-danger">*</span></label>
                                    <p class="text-muted small mb-2">Select one or more specializations (e.g., Cardiology, Neurology).</p>
                                    <div class="d-flex flex-wrap gap-2" id="specializationTiles">
                                        @foreach ($specializations as $specialization)
                                            <div class="card tile-select border-0 shadow-sm w-25" data-category="{{ $specialization->category_id }}">
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
                                <div class="mb-3">
                                    <label for="services" class="form-label fw-medium">Services <span class="text-danger">*</span></label>
                                    <p class="text-muted small mb-2">Select one or more services (e.g., Extraction, Implants).</p>
                                    <div class="d-flex flex-wrap gap-2" id="serviceTiles">
                                        @foreach ($services as $service)
                                            <div class="card tile-select border-0 shadow-sm w-25" data-category="{{ $service->category_id }}">
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
                    </div>
                    <!-- Profile Image Section -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profileImage" aria-expanded="false" aria-controls="profileImage">
                                Profile Image
                            </button>
                        </h2>
                        <div id="profileImage" class="accordion-collapse collapse" data-bs-parent="#doctorFormAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="profile_image" class="form-label fw-medium">Profile Image</label>
                                    <div class="drop-zone text-center p-3 bg-light border border-2 border-dashed border-theme rounded" id="dropZone">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-theme mb-2"></i>
                                        <p class="small mb-2 text-muted">Drag & Drop your image here or</p>
                                        <button type="button" class="btn btn-outline-theme btn-sm" id="browseButton">Browse Files</button>
                                        <span id="fileName" class="text-muted small mt-2 d-block">No file chosen</span>
                                        <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*">
                                    </div>
                                    @error('profile_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-theme px-4"><i class="fas fa-save me-1"></i> Create Doctor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded for add_doctor.blade.php');

    // Initialize Bootstrap tooltips
    try {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        console.log('Tooltips initialized');
    } catch (error) {
        console.error('Error initializing tooltips:', error);
    }

    // Image upload functionality
    const browseButton = document.getElementById('browseButton');
    const imageInput = document.getElementById('profile_image');
    const fileName = document.getElementById('fileName');
    const dropZone = document.getElementById('dropZone');

    if (!browseButton || !imageInput || !fileName || !dropZone) {
        console.error('Image upload elements missing:', {
            browseButton: !!browseButton,
            imageInput: !!imageInput,
            fileName: !!fileName,
            dropZone: !!dropZone
        });
        return;
    }

    // Browse button click
    browseButton.addEventListener('click', () => {
        console.log('Browse button clicked');
        try {
            imageInput.click();
        } catch (error) {
            console.error('Error triggering file input click:', error);
        }
    });

    // File input change
    imageInput.addEventListener('change', () => {
        console.log('File input changed');
        if (imageInput.files && imageInput.files.length > 0) {
            const file = imageInput.files[0];
            if (file.type.startsWith('image/')) {
                fileName.textContent = file.name;
                console.log('Selected file:', file.name);
            } else {
                fileName.textContent = 'Invalid file type';
                imageInput.value = ''; // Reset input
                console.warn('Invalid file type selected');
            }
        } else {
            fileName.textContent = 'No file chosen';
            console.log('No file selected');
        }
    });

    // Drag and drop events
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.add('bg-theme', 'bg-opacity-10');
        console.log('Drag over drop zone');
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.remove('bg-theme', 'bg-opacity-10');
        console.log('Drag left drop zone');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.remove('bg-theme', 'bg-opacity-10');
        console.log('File dropped');
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            imageInput.files = files;
            fileName.textContent = files[0].name;
            console.log('Dropped file:', files[0].name);
        } else {
            fileName.textContent = 'Invalid file type';
            console.warn('Invalid file type dropped');
        }
    });

    // Tile selection for specializations and services
    document.querySelectorAll('.tile-select').forEach(tile => {
        tile.addEventListener('click', () => {
            const checkbox = tile.querySelector('input[type="checkbox"]');
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                tile.classList.toggle('bg-theme', checkbox.checked);
                tile.classList.toggle('text-white', checkbox.checked);
                tile.classList.toggle('bg-white', !checkbox.checked);
                tile.classList.toggle('text-dark', !checkbox.checked);
                console.log(`Tile ${checkbox.id} toggled to ${checkbox.checked}`);
            } else {
                console.error('Checkbox not found in tile:', tile);
            }
        });
    });

    // Category filter for specializations and services
    const categorySelect = document.getElementById('category');
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            const specTiles = document.querySelectorAll('#specializationTiles .tile-select');
            const serviceTiles = document.querySelectorAll('#serviceTiles .tile-select');

            specTiles.forEach(tile => {
                const display = (selectedCategory === 'all' || tile.getAttribute('data-category') === selectedCategory) ? 'block' : 'none';
                tile.style.display = display;
                console.log(`Specialization tile display set to ${display}`);
            });

            serviceTiles.forEach(tile => {
                const display = (selectedCategory === 'all' || tile.getAttribute('data-category') === selectedCategory) ? 'block' : 'none';
                tile.style.display = display;
                console.log(`Service tile display set to ${display}`);
            });
        });
    } else {
        console.error('Category select element not found');
    }

    // Dynamic Education Fields
    const educationFields = document.getElementById('educationFields');
    const addEducationButton = document.getElementById('addEducation');
    let educationCount = 0;

    function addEducationField(degree = '', institution = '', year = '') {
        educationCount++;
        const educationDiv = document.createElement('div');
        educationDiv.className = 'education-entry mb-3 p-3 border rounded bg-light';
        educationDiv.innerHTML = `
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="education_degree_${educationCount}" class="form-label fw-medium">Degree <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="education_degree_${educationCount}" name="education[${educationCount}][degree]" value="${degree}" required>
                    <div class="invalid-feedback">Please enter a degree.</div>
                </div>
                <div class="col-md-4">
                    <label for="education_institution_${educationCount}" class="form-label fw-medium">Institution <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="education_institution_${educationCount}" name="education[${educationCount}][institution]" value="${institution}" required>
                    <div class="invalid-feedback">Please enter an institution.</div>
                </div>
                <div class="col-md-2">
                    <label for="education_year_${educationCount}" class="form-label fw-medium">Year</label>
                    <input type="number" class="form-control" id="education_year_${educationCount}" name="education[${educationCount}][year]" value="${year}">
                    <div class="invalid-feedback">Please enter a valid year (1900-${new Date().getFullYear()}).</div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-education" data-bs-toggle="tooltip" title="Remove this education entry"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
        educationFields.appendChild(educationDiv);

        // Initialize tooltip for remove button
        try {
            const removeButton = educationDiv.querySelector('.remove-education');
            new bootstrap.Tooltip(removeButton);
            console.log('Tooltip initialized for remove button');
        } catch (error) {
            console.error('Error initializing tooltip for remove button:', error);
        }

        // Add event listener for remove button
        const removeButton = educationDiv.querySelector('.remove-education');
        removeButton.addEventListener('click', () => {
            educationDiv.remove();
            console.log('Education entry removed');
            // Reindex education fields
            reindexEducationFields();
        });

        // Rebind validation for new fields
        bindValidation();
    }

    // Reindex education fields to maintain consistent naming
    function reindexEducationFields() {
        const educationEntries = document.querySelectorAll('.education-entry');
        educationEntries.forEach((entry, index) => {
            const degreeInput = entry.querySelector('input[name*="[degree]"]');
            const institutionInput = entry.querySelector('input[name*="[institution]"]');
            const yearInput = entry.querySelector('input[name*="[year]"]');
            degreeInput.name = `education[${index}][degree]`;
            institutionInput.name = `education[${index}][institution]`;
            yearInput.name = `education[${index}][year]`;
        });
        console.log('Education fields reindexed');
    }

    // Client-side form validation for education fields
    function bindValidation() {
        const educationEntries = document.querySelectorAll('.education-entry');
        educationEntries.forEach((entry, index) => {
            const degreeInput = entry.querySelector(`input[name="education[${index}][degree]"]`);
            const institutionInput = entry.querySelector(`input[name="education[${index}][institution]"]`);
            const yearInput = entry.querySelector(`input[name="education[${index}][year]"]`);

            if (degreeInput) {
                degreeInput.addEventListener('input', () => {
                    degreeInput.classList.toggle('is-invalid', !degreeInput.value.trim());
                });
            }
            if (institutionInput) {
                institutionInput.addEventListener('input', () => {
                    institutionInput.classList.toggle('is-invalid', !institutionInput.value.trim());
                });
            }
            if (yearInput) {
                yearInput.addEventListener('input', () => {
                    const year = yearInput.value;
                    yearInput.classList.toggle('is-invalid', year && (year < 1900 || year > new Date().getFullYear()));
                });
            }
        });
        console.log('Validation bound to education fields');
    }

    // Form submission validation
    const doctorForm = document.getElementById('doctorForm');
    if (doctorForm) {
        doctorForm.addEventListener('submit', function(e) {
            let hasError = false;
            const educationEntries = document.querySelectorAll('.education-entry');
            educationEntries.forEach((entry, index) => {
                const degree = entry.querySelector(`input[name="education[${index}][degree]"]`).value.trim();
                const institution = entry.querySelector(`input[name="education[${index}][institution]"]`).value.trim();
                const year = entry.querySelector(`input[name="education[${index}][year]"]`).value;
                if (!degree) {
                    hasError = true;
                    entry.querySelector(`input[name="education[${index}][degree]"]`).classList.add('is-invalid');
                }
                if (!institution) {
                    hasError = true;
                    entry.querySelector(`input[name="education[${index}][institution]"]`).classList.add('is-invalid');
                }
                if (year && (year < 1900 || year > new Date().getFullYear())) {
                    hasError = true;
                    entry.querySelector(`input[name="education[${index}][year]"]`).classList.add('is-invalid');
                }
            });

            // Validate specializations and services
            const specializations = document.querySelectorAll('#specializationTiles input:checked');
            const services = document.querySelectorAll('#serviceTiles input:checked');
            if (specializations.length === 0) {
                hasError = true;
                document.querySelector('#specializationTiles').nextElementSibling.classList.add('d-block');
            }
            if (services.length === 0) {
                hasError = true;
                document.querySelector('#serviceTiles').nextElementSibling.classList.add('d-block');
            }

            if (hasError) {
                e.preventDefault();
                console.log('Form submission blocked due to validation errors');
            } else {
                console.log('Form validation passed, submitting');
            }
        });
    } else {
        console.error('Doctor form not found');
    }

    // Initialize education field and addEducation button
    if (educationFields && addEducationButton) {
        addEducationField(); // Add initial education field
        addEducationButton.addEventListener('click', () => {
            addEducationField();
            console.log('Add Education button clicked, new field added');
        });
    } else {
        console.error('Education fields or add button not found:', {
            educationFields: !!educationFields,
            addEducationButton: !!addEducationButton
        });
    }
});
</script>

<style>
.bg-theme {
    background-color: #0f6d81 !important;
}
.text-theme {
    color: #0f6d81 !important;
}
.border-theme {
    border-color: #0f6d81 !important;
}
.btn-theme {
    background-color: #0f6d81 !important;
    border-color: #0f6d81 !important;
    color: #ffffff !important;
}
.btn-theme:hover {
    background-color: #0a5a6a !important;
    border-color: #0a5a6a !important;
}
.btn-outline-theme {
    color: #0f6d81 !important;
    border-color: #0f6d81 !important;
}
.btn-outline-theme:hover {
    background-color: #0f6d81 !important;
    color: #ffffff !important;
}
.tile-select {
    transition: all 0.3s ease;
    cursor: pointer;
}
.tile-label {
    cursor: pointer;
    font-size: 0.9rem;
}
@media (max-width: 576px) {
    .tile-select {
        width: 100% !important;
    }
}
</style>
@endsection