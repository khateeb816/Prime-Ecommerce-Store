@extends('frontend.layouts.app')

@section('title', 'Prime - Login')
@section('description', 'Login to your Prime account')
@section('keywords', 'login, account, Prime')

@section('content')
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-brand-blue text-white text-center">
                        <h4 class="mb-0">Login to Your Account</h4>
                    </div>
                    <div class="card-body p-4">
                        <form>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 btn-lg mb-3">Login</button>
                            <div class="text-center">
                                <a href="#" class="text-decoration-none">Forgot Password?</a>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Register Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

