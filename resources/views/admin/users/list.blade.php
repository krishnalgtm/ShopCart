@extends('layouts.admin')

@section('content')
<style>
    /* General Styles */
    body {
        font-family: 'Inter', sans-serif;
        background-color: black;
        
    }
    .card {
        background: white;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
    }
    .card:hover {
        box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.12);
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
        font-size: 18px;
    }
    thead {
        background: #f3f4f6;
        color: #1f2937;
        font-weight: bold;
        text-transform: uppercase;
    }
    th, td {
        padding: 16px;
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
        gap: 12px;
    }
    .edit-btn {
        font-size: 16px;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        background: #3b82f6;
        color: white;
        transition: 0.3s;
        display: inline-block;
        text-decoration: none;
    }
    .edit-btn:hover {
        background: #2563eb;
        transform: scale(1.05);
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

<div class="max-w-7xl mx-auto py-10">
    <div class="card">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
        <h1 class="display-4 fw-bold text-dark text-center w-100">
    👥 User Management
</h1>

            <a href="{{ route('admin.users.create') }}" class="btn btn-primary fw-bold fs-4"> Create User
</a>


        </div>

        <x-message></x-message>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Created</th>
                        @can('edit users')
                            <th class="text-center">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            @can('edit users')
                                <td class="text-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="edit-btn">
                                        ✏️ Edit
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 text-lg">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
