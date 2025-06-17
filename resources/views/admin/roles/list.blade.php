@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center border-b pb-6 mb-6">
<h2 class="display-4 fw-bold text-dark text-center w-100">👥 Role Management</h2>
    @can('create roles')
        <a href="{{route('admin.roles.create')}}" class="btn btn-primary fw-bold fs-4">Create Role</a>
    @endcan
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f5f7;
        color: #1f2937;
    }

    .card {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 1.3rem;
    }

    thead {
        background:rgb(142, 141, 164);
        color: white;
    }

    th, td {
        padding: 1.2rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    tbody tr:hover {
        background-color: #eef2ff;
    }

    .edit-btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        color: white;
        background:rgb(197, 68, 48);
        text-decoration: none;
        transition: all 0.3s;
    }

    .edit-btn:hover {
        background:rgb(164, 42, 42);
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

    .btn:hover {
        background: linear-gradient(to right, #4f46e5, #3730a3);
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .card {
            padding: 2rem;
        }
        table {
            width: 100%;
    border-collapse: separate;
    border-spacing: 0 5px; /* पंक्तियों के बीच अधिक स्पेस */
    font-size: 1.4rem;
        }
        th, td {
            padding: 1rem;
        }
        .edit-btn, .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="py-14">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card">
            <div class="text-gray-900">
                <x-message></x-message>
                <div class="table-container">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td class="font-bold text-gray-800">{{ $role->name }}</td>
                                    <td class="text-gray-600">{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                    <td class="text-gray-600">{{ \Carbon\Carbon::parse($role->created_at)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="edit-btn">Edit</a>
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
