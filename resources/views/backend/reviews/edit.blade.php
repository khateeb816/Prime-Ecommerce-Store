@extends('backend.layouts.app')

@section('title', 'Manage Review | Prime Admin')
@section('page-title', 'Manage Review')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <h3 class="box-title mb-4">Manage Review #{{ $review->id }}</h3>
                
                <div class="mb-4 p-3 bg-light rounded">
                    <p><strong>Product:</strong> {{ $review->product ? $review->product->name : 'N/A' }}</p>
                    <p><strong>User:</strong> {{ $review->user ? $review->user->name : 'N/A' }}</p>
                    <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
                    <p><strong>Comment:</strong></p>
                    <blockquote class="blockquote fs-6">
                        {{ $review->comment }}
                    </blockquote>
                </div>

                <form action="{{ route('backend.reviews.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="reply" class="form-label">Admin Reply</label>
                        <textarea class="form-control" id="reply" name="reply" rows="3">{{ old('reply', $review->reply) }}</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="show_on_homepage" name="show_on_homepage" {{ $review->show_on_homepage ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_on_homepage">Show High on Homepage (Testimonial)</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Review</button>
                    <a href="{{ route('backend.reviews.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
