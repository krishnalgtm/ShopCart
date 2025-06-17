@extends('layouts.admin')

@section('content')

<style>
    body {
    font-family: 'Inter', sans-serif;
    background: #f3f4f6;
    color: #1f2937;
}

/* Container */
.container {
    max-width: 900px;
    margin: auto;
    padding: 20px;
}

/* Card Style */
.card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}
.card:hover {
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
}

/* Input Field Styling */
input[type="text"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

input[type="text"]:focus {
    border-color: #6366f1;
    box-shadow: 0px 0px 8px rgba(99, 102, 241, 0.3);
}

/* Button Styling */
.button-primary {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    color: white;
    font-size: 18px;
    font-weight: 600;
    border-radius: 8px;
    padding: 12px 20px;
    display: inline-block;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}

.button-primary:hover {
    background: linear-gradient(135deg, #4338ca, #4f46e5);
    transform: scale(1.05);
}

/* Permissions Grid */
.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    .permissions-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
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
}

</style>
    <x-slot name="header">
    <div class="flex justify-between" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Roles / Create
        </h2>
        <a href="{{route('admin.permissions.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 ">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action=" {{route('admin.roles.store')}}" method="post">
                        @csrf
                    <div> 
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3" >
                                <input value="{{old('name')}}" name="name"  placeholder="Enter Name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" id="">
                            @error('name')
                                <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <div class="mt-3">
                                                <input type="checkbox" id="permission-{{ $permission->id }}"
                                                    class="rounded" name="permission[]" value="{{ $permission->name }}">
                                                <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md text-black px-5 py-3 "> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
