@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Specializations</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.specializations.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Specialization</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($specializations as $specialization)
                                <tr>
                                    <td>{{ $specialization->id }}</td>
                                    <td>{{ $specialization->name }}</td>
                                    <td>{{ $specialization->category->name ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($specialization->description, 50) }}</td>
                                    <td>
                                        @if ($specialization->image)
                                            <img src="{{ asset('storage/' . $specialization->image) }}" alt="{{ $specialization->name }}" style="max-width: 50px; height: auto; border-radius: 4px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.specializations.edit', $specialization->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.specializations.destroy', $specialization->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this specialization?');">
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
                                    <td colspan="6" class="text-center">No specializations found.</td>
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