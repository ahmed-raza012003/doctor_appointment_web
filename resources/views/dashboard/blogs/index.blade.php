@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Blogs</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Blog</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Feature Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ Str::limit($blog->title, 50, '...') }}</td>
                                    <td>
                                        @if ($blog->feature_image)
                                            <img src="{{ Storage::url($blog->feature_image) }}" alt="{{ $blog->title }}" style="max-width: 50px; height: auto; border-radius: 4px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-sm btn-outline-primary me-2" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No blogs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $blogs->links() }}
            </div>
        </div>
    </div>

    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-outline-primary, .btn-outline-danger {
            transition: all 0.2s ease-in-out;
            color: #11849B;
            border-color: #11849B;
        }
        .btn-outline-primary:hover {
            background-color: #11849B;
            color: #ffffff;
            border-color: #11849B;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #ffffff;
        }
    </style>
@endsection