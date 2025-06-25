@extends('dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Specialization</h4>
                    <form method="POST" action="{{ route('admin.specializations.update', $specialization->id) }}" enctype="multipart/form-data" id="specializationForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $specialization->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $specialization->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $specialization->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <div class="drop-zone text-center p-4" id="dropZone" style="background-color: #11849B; border: 2px dashed #ffffff; border-radius: 8px; color: #ffffff;">
                                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                <p>Drag & Drop to Upload File</p>
                                <p>OR</p>
                                <button type="button" class="btn btn-light mb-2" id="browseButton">Browse File</button>
                                <span id="fileName">{{ $specialization->image ? basename($specialization->image) : 'No file chosen' }}</span>
                                <input type="file" id="image" name="image" class="d-none" accept="image/*">
                            </div>
                            @if ($specialization->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $specialization->image) }}" alt="{{ $specialization->name }}" style="max-width: 100px; height: auto; border-radius: 4px;">
                                </div>
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #11849B; border-color: #11849B; border-radius: 4px;">Update Specialization</button>
                        <a href="{{ route('admin.specializations.index') }}" class="btn btn-secondary" style="border-radius: 4px;">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const input = document.getElementById('image');
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
                input.files = files;
                fileName.textContent = files[0].name;
            }
        });

        browseButton.addEventListener('click', () => {
            input.click();
        });

        input.addEventListener('change', (e) => {
            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
            }
        });
    </script>
@endsection