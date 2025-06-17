@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>User</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Add User Button -->
                     @if (!empty($PermissionAdd))
                    
                    <a class="btn btn-primary mb-3 btn-add" href="{{ url('admin/user/add') }}">Add User</a>
 
                    @endif
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">SNo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Date</th>
                                    @if (!empty($PermissionEdit) || !empty($PermissionDelete))
                                    <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if($getRecord->count() > 0)
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->role_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
                                            <td>
                                            @dd($PermissionEdit, $PermissionDelete);
                                                @if (!empty($PermissionEdit))
                                                    <a href="{{ url('admin/user/edit/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @endif

                                                @if (!empty($PermissionDelete))
                                                    <form action="{{ url('admin/user/delete/'.$value->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                      
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No users found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- End table-responsive -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<style>
/* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 20px;
    color: #333;
}

/* Page Title */
.pagetitle {
    margin-bottom: 20px;
    text-align: center;
}

.pagetitle h1 {
    font-size: 24px;
    font-weight: bold;
    color: #222;
}

/* Card Styles */
.card {
    border: none;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Button Styles */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease-in-out;
    padding: 8px 15px;
}

.btn-primary {
    background-color: #4CAF50;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #43a047;
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.btn-danger {
    background-color: #f44336;
    color: #fff;
    border: none;
}

.btn-danger:hover {
    background-color: #e53935;
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Table Styles */
.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
}

.table thead {
    background-color: #4CAF50;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

.table tbody tr {
    transition: background-color 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f9f9f9;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Responsive Styles */
.table-responsive {
    overflow-x: auto;
}

@media (max-width: 768px) {
    .table th, .table td {
        font-size: 12px;
        padding: 10px;
    }

    .btn {
        padding: 6px 10px;
        font-size: 12px;
    }

    .pagetitle h1 {
        font-size: 18px;
    }
}
</style>

