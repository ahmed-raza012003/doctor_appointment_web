@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-3">Add Category</h5>
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" id="categoryForm">
                    @csrf
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
                                <label for="description" class="form-label fw-medium">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Second Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="picture" class="form-label fw-medium">Category Image</label>
                                <div class="drop-zone text-center p-2" id="dropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 4px; color: #ffffff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="small mb-1">Drag & Drop or</p>
                                    <button type="button" class="btn btn-light btn-sm px-2 py-0" id="browseButton">Browse</button>
                                    <span id="fileName" class="text-white small mt-1 d-block">No file chosen</span>
                                    <input type="file" id="picture" name="picture" class="d-none" accept="image/*">
                                </div>
                                @error('picture')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #11849B; border-color: #11849B;">Create Category</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('picture');
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
    </script>

    <style>
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