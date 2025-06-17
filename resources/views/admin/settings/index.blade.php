@extends('layouts.admin')

@section('content')
    <div class="container" style="max-width: 600px; margin-top: 50px;">
        <h1 class="text-center">Settings</h1>

        @if ($message = Session::get('error'))
    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <p>{{ $message }}</p>
    </div>
@endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form action="{{ route('settings.updateDefaultRole') }}" method="POST" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
            @csrf
            <div class="form-group">
                <label for="default_role" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Select Default Role:</label>
                <select name="default_role" id="default_role" class="form-control" style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ced4da;">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ isset($defaultRole) && $role->name == $defaultRole->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; padding: 10px 20px; font-size: 16px; border-radius: 5px;">Save</button>
            </div>
        </form>

        @if (session('success'))
            <p style="color: green; margin-top: 20px; text-align: center;">{{ session('success') }}</p>
        @endif
    </div>

    <style>
        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
        }

        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .alert {
            font-size: 16px;
            border-radius: 5px;
            padding: 10px;
        }

        .alert p {
            margin: 0;
        }
    </style>
@endsection
