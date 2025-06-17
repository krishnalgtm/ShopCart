@extends('layouts.admin')

@section('content')


<div class="max-w-7xl mx-auto py-10">
    <div class="card">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 class="display-4 fw-bold text-dark text-center w-100">🔒 Permissions</h2>

            @can('create permissions')
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary fw-bold fs-4">
    Create Permission
</a>

            @endcan
        </div>
        <style>
    /* General Styles */
    body {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        background:rgb(0, 0, 0);
        color: #1f2937;
    }
    .card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    }
    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        background: white;
    }
    
    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 18px; /* Bigger Font */
    }
    thead {
        background: #f3f4f6;
        color: #1f2937;
        font-weight: bold;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #e5e7eb;
    }
    tbody tr:hover {
        background: #f9fafb;
        transition: 0.3s;
    }

    /* Buttons */
    .action-btn {
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    .edit-btn, .delete-btn {
        font-size: 16px;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
        text-align: center;
        display: inline-block;
    }
    .edit-btn {
        background: #3b82f6;
        color: white;
    }
    .edit-btn:hover {
        background: #2563eb;
    }
    .delete-btn {
        background: #dc2626;
        color: white;
        border: none;
        cursor: pointer;
    }
    .delete-btn:hover {
        background: #b91c1c;
    }
        .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        background: linear-gradient(to right,rgb(180, 180, 190), #4f46e5);
        color: white;
    }
        
    

</style>

        <x-message></x-message>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="action-btn">
                                    @can('edit permissions')
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="edit-btn">
                                            ✏️ Edit
                                        </a>
                                    @endcan
                                    @can('delete permissions')
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500 text-lg">No permissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $permissions->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
