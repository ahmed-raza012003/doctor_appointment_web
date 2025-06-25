@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Categories</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Category</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description, 50, '...') }}</td>
                                    <td>
                                        @if ($category->picture)
                                            <img src="{{ Storage::url($category->picture) }}" alt="{{ $category->name }}" style="max-width: 50px; height: auto; border-radius: 4px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                                    <td colspan="5" class="text-center">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-outline-primary, .btn-outline-danger {
            transition: all 0.2s ease-in-out;
  color:#11849B;
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