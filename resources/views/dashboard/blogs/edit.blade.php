@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-3">Edit Blog</h5>
                <form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data" id="blogForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- First Column -->
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="title" class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="category_id" class="form-label fw-medium">Category <span class="text-danger">*</span></label>
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="" disabled>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="description_card" class="form-label fw-medium">Description Card <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description_card') is-invalid @enderror" id="description_card" name="description_card" rows="4">{{ old('description_card', $blog->description_card) }}</textarea>
                                @error('description_card')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="description_page" class="form-label fw-medium">Description Page <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description_page') is-invalid @enderror" id="description_page" name="description_page" rows="4">{{ old('description_page', $blog->description_page) }}</textarea>
                                @error('description_page')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Second Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="feature_image" class="form-label fw-medium">Feature Image <span class="text-danger">*</span></label>
                                <div class="drop-zone text-center p-2" id="featureDropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 4px; color: #ffffff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="small mb-1">Drag & Drop or</p>
                                    <button type="button" class="btn btn-light btn-sm px-2 py-0" id="featureBrowseButton">Browse</button>
                                    <span id="featureFileName" class="text-white small mt-1 d-block">{{ $blog->feature_image ? basename($blog->feature_image) : 'No file chosen' }}</span>
                                    <input type="file" id="feature_image" name="feature_image" class="d-none" accept="image/*">
                                </div>
                                @error('feature_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @if ($blog->feature_image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($blog->feature_image) }}" alt="{{ $blog->title }}" style="max-width: 100px; height: auto; border-radius: 4px;">
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description_image_1" class="form-label fw-medium">Description Image 1</label>
                                <div class="drop-zone text-center p-2" id="desc1DropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 4px; color: #ffffff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="small mb-1">Drag & Drop or</p>
                                    <button type="button" class="btn btn-light btn-sm px-2 py-0" id="desc1BrowseButton">Browse</button>
                                    <span id="desc1FileName" class="text-white small mt-1 d-block">{{ $blog->description_image_1 ? basename($blog->description_image_1) : 'No file chosen' }}</span>
                                    <input type="file" id="description_image_1" name="description_image_1" class="d-none" accept="image/*">
                                </div>
                                @error('description_image_1')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @if ($blog->description_image_1)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($blog->description_image_1) }}" alt="Description Image 1" style="max-width: 100px; height: auto; border-radius: 4px;">
                                        <div>
                                            <input type="checkbox" id="remove_description_image_1" name="remove_description_image_1">
                                            <label for="remove_description_image_1">Remove Image</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description_image_2" class="form-label fw-medium">Description Image 2</label>
                                <div class="drop-zone text-center p-2" id="desc2DropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 4px; color: #ffffff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="small mb-1">Drag & Drop or</p>
                                    <button type="button" class="btn btn-light btn-sm px-2 py-0" id="desc2BrowseButton">Browse</button>
                                    <span id="desc2FileName" class="text-white small mt-1 d-block">{{ $blog->description_image_2 ? basename($blog->description_image_2) : 'No file chosen' }}</span>
                                    <input type="file" id="description_image_2" name="description_image_2" class="d-none" accept="image/*">
                                </div>
                                @error('description_image_2')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @if ($blog->description_image_2)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($blog->description_image_2) }}" alt="Description Image 2" style="max-width: 100px; height: auto; border-radius: 4px;">
                                        <div>
                                            <input type="checkbox" id="remove_description_image_2" name="remove_description_image_2">
                                            <label for="remove_description_image_2">Remove Image</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #11849B; border-color: #11849B;">Update Blog</button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Feature Image Drop Zone
        const featureDropZone = document.getElementById('featureDropZone');
        const featureImageInput = document.getElementById('feature_image');
        const featureFileName = document.getElementById('featureFileName');
        const featureBrowseButton = document.getElementById('featureBrowseButton');

        featureDropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            featureDropZone.style.backgroundColor = '#0f6d81';
        });

        featureDropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            featureDropZone.style.backgroundColor = '#11849B';
        });

        featureDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            featureDropZone.style.backgroundColor = '#11849B';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                featureImageInput.files = files;
                featureFileName.textContent = files[0].name;
            }
        });

        featureBrowseButton.addEventListener('click', () => featureImageInput.click());

        featureImageInput.addEventListener('change', () => {
            if (featureImageInput.files[0]) {
                featureFileName.textContent = featureImageInput.files[0].name;
            }
        });

        // Description Image 1 Drop Zone
        const desc1DropZone = document.getElementById('desc1DropZone');
        const desc1ImageInput = document.getElementById('description_image_1');
        const desc1FileName = document.getElementById('desc1FileName');
        const desc1BrowseButton = document.getElementById('desc1BrowseButton');

        desc1DropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            desc1DropZone.style.backgroundColor = '#0f6d81';
        });

        desc1DropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            desc1DropZone.style.backgroundColor = '#11849B';
        });

        desc1DropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            desc1DropZone.style.backgroundColor = '#11849B';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                desc1ImageInput.files = files;
                desc1FileName.textContent = files[0].name;
            }
        });

        desc1BrowseButton.addEventListener('click', () => desc1ImageInput.click());

        desc1ImageInput.addEventListener('change', () => {
            if (desc1ImageInput.files[0]) {
                desc1FileName.textContent = desc1ImageInput.files[0].name;
            }
        });

        // Description Image 2 Drop Zone
        const desc2DropZone = document.getElementById('desc2DropZone');
        const desc2ImageInput = document.getElementById('description_image_2');
        const desc2FileName = document.getElementById('desc2FileName');
        const desc2BrowseButton = document.getElementById('desc2BrowseButton');

        desc2DropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            desc2DropZone.style.backgroundColor = '#0f6d81';
        });

        desc2DropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            desc2DropZone.style.backgroundColor = '#11849B';
        });

        desc2DropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            desc2DropZone.style.backgroundColor = '#11849B';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                desc2ImageInput.files = files;
                desc2FileName.textContent = files[0].name;
            }
        });

        desc2BrowseButton.addEventListener('click', () => desc2ImageInput.click());

        desc2ImageInput.addEventListener('change', () => {
            if (desc2ImageInput.files[0]) {
                desc2FileName.textContent = desc2ImageInput.files[0].name;
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