@extends('layouts.admin')
@section('content')

<style>
    /* General Styles */
    body {
        font-family: 'Inter', sans-serif;
        background: #f9fafb;
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
    label {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
    }
    input {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
    }
    input:focus {
        border-color: #3b82f6;
        box-shadow: 0px 0px 8px rgba(59, 130, 246, 0.3);
    }
    .btn-primary {
        background: #3b82f6;
        color: white;
        font-size: 16px;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: #2563eb;
        transform: scale(1.05);
    }
    .back-btn {
        background: #6b7280;
        padding: 10px 16px;
        font-size: 14px;
        color: white;
        border-radius: 6px;
        transition: 0.3s;
    }
    .back-btn:hover {
        background: #4b5563;
    }
</style>

<div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="card">
            <div class="flex justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">✏ Edit User</h2>
                <a href="{{ route('admin.users.index') }}" class="back-btn">⬅ Back</a>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')

                {{-- Name Input --}}
                <div class="mb-4">
                    <label for="name">Name</label>
                    <input value="{{ old('name', $user->name) }}" name="name" id="name" type="text" placeholder="Enter Name">
                    @error('name')
                        <p class="text-red-500 text-sm font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Input --}}
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input value="{{ old('email', $user->email) }}" name="email" id="email" type="text" placeholder="Enter Email">
                    @error('email')
                        <p class="text-red-500 text-sm font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Roles Checkbox --}}
                <div class="mb-4">
                    <label>Assign Roles</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-2">
                        @foreach ($roles as $role)
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" id="role-{{ $role->id }}"
                                    name="roles[]" value="{{ $role->name }}"
                                    class="rounded border-gray-300"
                                    {{ isset($hasRoles) && $hasRoles->contains($role->id) ? 'checked' : '' }}>
                                <label for="role-{{ $role->id }}" class="ml-2">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-primary">💾 Update</button>

            </form>
        </div>
    </div>
</div>

@endsection
