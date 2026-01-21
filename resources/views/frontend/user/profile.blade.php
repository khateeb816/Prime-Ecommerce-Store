@extends('frontend.layouts.app')

@section('title', 'Prime - My Profile')
@section('description', 'Update your profile information')
@section('keywords', 'profile, account, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            @include('frontend.user.partials.sidebar')

            <!-- Profile Content -->
            <div class="col-lg-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold">Personal Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Full Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required readonly>
                                    <small class="text-muted">Email cannot be changed.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="+92 300 1234567">
                                </div>
                                <div class="col-md-6">
                                     <label class="form-label text-muted small text-uppercase fw-bold">Birthday</label>
                                    <input type="date" class="form-control" name="birthday" value="{{ auth()->user()->birthday ?? '' }}">
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold">Security</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('user.profile.password') }}" method="POST">
                             @csrf
                             @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-muted small text-uppercase fw-bold">New Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Confirm New</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-outline-primary px-4">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

