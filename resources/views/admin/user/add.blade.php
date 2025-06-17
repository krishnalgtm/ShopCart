@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Add New User</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New User</h5>

                    <form action="" method="post">
                        {{csrf_field()}}

                        <!-- Name Field -->
                        <div class="row mb-3">
                            <label for="inputName" class="col-sm-12 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="inputName" name="name" value="{{old('name')}}" required class="form-control" placeholder="Enter User Name">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" id="inputEmail" name="email" value="{{old('email')}}" required class="form-control" placeholder="Enter Email Address">
                                <div class="text-danger">{{$errors->first('email')}}</div>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Password</label>
                            <div class="col-sm-12">
                                <input type="password" id="inputPassword" name="password" required class="form-control" placeholder="Enter Password">
                            </div>
                        </div>

                        <!-- Role Field -->
                        <div class="row mb-3">
                            <label for="inputRole" class="col-sm-12 col-form-label">Role</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="inputRole" name="role_id" required>
                                    <option value="">Select Role</option>
                                    @foreach ($getRole as $value)
                                        <option {{(old('role_id')==$value->id) ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-3">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

    <style> 
    /* Page Title */
.pagetitle h1 {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2C3E50;
    text-align: center;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 14px;
    background: #ffffff;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    padding: 25px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.18);
}

/* Input Fields */
.form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 14px;
    font-size: 1rem;
    background: #f8f9fa;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #4A90E2;
    box-shadow: 0 0 10px rgba(74, 144, 226, 0.3);
    outline: none;
}

/* Labels */
label.col-form-label {
    font-size: 1rem;
    font-weight: 600;
    color: #34495E;
    margin-bottom: 5px;
}

/* Placeholder Styling */
::placeholder {
    color: #999;
    font-style: italic;
}

/* Dropdown Styling */
select.form-control {
    appearance: none;
    background: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3E%3Cpath fill='%23000' d='M2 0l2 2H0z'/%3E%3C/svg%3E") no-repeat right 12px center;
    background-size: 12px 12px;
    cursor: pointer;
}

/* Submit Button */
.btn-primary {
    background: linear-gradient(135deg, #4A90E2, #4ECDC4);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 14px 25px;
    font-size: 1.1rem;
    font-weight: bold;
    text-transform: uppercase;
    transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4ECDC4, #4A90E2);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
}

/* Error Messages */
.text-danger {
    font-size: 0.85rem;
    margin-top: 5px;
    color: #D9534F;
}

/* Drag & Drop Upload Box */
.upload-box {
    border: 2px dashed #4A90E2;
    border-radius: 10px;
    background: #f8f9fa;
    text-align: center;
    padding: 25px;
    font-size: 1rem;
    color: #555;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.upload-box:hover {
    background: rgba(74, 144, 226, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-control {
        font-size: 1rem;
        padding: 12px;
    }

    .btn-lg {
        padding: 12px 18px;
        font-size: 1rem;
    }

    .pagetitle h1 {
        font-size: 2rem;
    }
}

    </style>

