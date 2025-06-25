@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-3">{{ $blog->title }}</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="fw-medium">Description</h6>
                        <p class="border p-3 rounded" style="background-color: #f8f9fa;">{!! nl2br(e($blog->description)) !!}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="fw-medium">Feature Image</h6>
                            @if ($blog->feature_image)
                                <img src="{{ Storage::url($blog->feature_image) }}" alt="{{ $blog->title }}" class="img-fluid" style="max-width: 300px; border-radius: 4px;">
                            @else
                                <p>No image available.</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-medium">Description Image 1</h6>
                            @if ($blog->description_image_1)
                                <img src="{{ Storage::url($blog->description_image_1) }}" alt="Description Image 1" class="img-fluid" style="max-width: 300px; border-radius: 4px;">
                            @else
                                <p>No image uploaded.</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-medium">Description Image 2</h6>
                            @if ($blog->description_image_2)
                                <img src="{{ Storage::url($blog->description_image_2) }}" alt="Description Image 2" class="img-fluid" style="max-width: 300px; border-radius: 4px;">
                            @else
                                <p>No image uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary px-4">Back to List</a>
                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-primary px-4" style="background-color: #11849B; border-color: #11849B;">Edit Blog</a>
                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">Delete Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
        }
    </style>
@endsection