@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manage Services</h5>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">Add Service</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ Str::limit($service->title, 50, '...') }}</td>
                                    <td>
                                        @if ($service->image)
                                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" style="max-width: 50px; height: auto; border-radius: 4px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                       
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                                    <td colspan="4" class="text-center">No services found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $services->links() }}
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