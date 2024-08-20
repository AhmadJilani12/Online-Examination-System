@extends('layout/layout-common')

@section('space-work')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="text-center mb-5 mr-3">
        <h2 class="fw-bold text-primary">Online Examination System</h2>
    </div>
    <div class="card shadow p-4 rounded" style="width: 100%; max-width: 400px;">
        
        <h1 class="text-center mb-4">Register</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    <p class="mb-0">{{ $err }}</p>
                @endforeach
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <form action="{{ route('studentRegister') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" style="border-bottom:2px solid black" class="form-control shadow-sm bg-white" name="name" placeholder="Enter your name" required />
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"  style="border-bottom:2px solid black" class="form-control shadow-sm bg-white" name="email" placeholder="Please enter your email" required />
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"  style="border-bottom:2px solid black" class="form-control shadow-sm bg-white" name="password" placeholder="Please enter your password" required />
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password"  style="border-bottom:2px solid black" class="form-control shadow-sm bg-white" name="password_confirmation" placeholder="Confirm password" required />
            </div>

            <button type="submit" class="btn btn-primary w-100 shadow">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="/" class="text-decoration-none">Login?</a>
            
        </div>

    </div>
</div>

@endsection
