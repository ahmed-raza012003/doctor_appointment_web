@extends('dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Specializations</h4>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <a href="{{ route('admin.specializations.create') }}" class="btn btn-primary mb-3" style="background-color: #11849B; border-color: #11849B;">
                        Add Specialization
                    </a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specializations as $specialization)
                                    <tr>
                                        <td>{{ $specialization->id }}</td>
                                        <td>{{ $specialization->name }}</td>
                                        <td>{{ $specialization->description ?? '-' }}</td>
                                        <td>
                                            @if ($specialization->image)
                                                <img src="{{ Storage::url($specialization->image) }}" alt="{{ $specialization->name }}" style="max-width: 50px; height: auto; border-radius: 4px;">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection