@extends('frontend.layouts.app')

@section('title', 'Prime - Search Results')
@section('description', 'Search results for ' . $query)
@section('keywords', 'search, products, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
        </div>
    </nav>

    <!-- Search Results Section -->
    <section class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h2 fw-bold mb-2">Search Results</h1>
                <p class="text-muted">Found <strong>12</strong> results for "<strong>{{ $query }}</strong>"</p>
            </div>
        </div>

        <div class="row g-4">
            @for($i = 1; $i <= 12; $i++)
                <div class="col-md-3 col-sm-6">
                    <x-product-card
                        name="Search Result Product {{ $i }}"
                        price="35000"
                        oldPrice="45000"
                        discount="22"
                    />
                </div>
            @endfor
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </section>
@endsection

