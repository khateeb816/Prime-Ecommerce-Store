@extends('frontend.layouts.app')

@section('title', 'Prime - Register')
@section('description', 'Create a new Prime account')
@section('keywords', 'register, sign up, Prime')

@section('content')
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-brand-blue text-white text-center">
                        <h4 class="mb-0">Create New Account</h4>
                    </div>
                    <div class="card-body p-4">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">Create Account</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

