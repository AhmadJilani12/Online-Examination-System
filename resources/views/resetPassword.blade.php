@extends('layout/layout-common')

@section('space-work')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="text-center mb-5 mr-3">
        <h2 class="fw-bold text-primary">Online Examination System</h2>
    </div>
    <div class="card shadow p-4 rounded" style="width: 100%; max-width: 400px;">
        
        <h1 class="text-center mb-4">Reset Password</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    <p class="mb-0">{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('resetPassword') }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $user[0]['id'] }}">

            <div class="form-group mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" style="border-bottom:2px solid black" class="form-control shadow-sm bg-white" name="password" placeholder="Please enter your new password" required />
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" style="border-bottom: 2px solid black" class="form-control shadow-sm bg-white" name="password_confirmation" placeholder="Please confirm your new password" required />
            </div>

            <button type="submit" class="btn btn-primary w-100 shadow">Reset Password</button>
        </form>

    </div>
</div>

@endsection
