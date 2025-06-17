@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<style>
    /* Container Styling */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* Heading Styling */
.container h1 {
    font-size: 2.5rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;
}

.container h2 {
    font-size: 1.8rem;
    margin-top: 30px;
    margin-bottom: 20px;
    font-weight: bold;
    color: #333;
}

/* Form Styling */
form {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    font-size: 1rem;
    color: #555;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
}

/* Button Styling */
button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

button.btn-danger {
    background-color: #dc3545;
}

button.btn-danger:hover {
    background-color: #a71d2a;
}

/* Section Divider */
hr {
    border: none;
    height: 1px;
    background-color: #ddd;
    margin: 20px 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    button {
        width: 100%;
        padding: 12px;
    }
}

</style>
<div class="container">
    <h1>Account Settings</h1>

    <!-- Profile Update Form -->
    <form action="{{ route('settings.updateProfile') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <hr>

    <!-- Password Change Section -->
    <h2>Change Password</h2>
    <form action="{{ route('settings.changePassword') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>

    <hr>

    <!-- Delete Account Section -->
    <h2>Delete Account</h2>
    <form action="{{ route('settings.deleteAccount') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Account</button>
    </form>
</div>
@endsection
