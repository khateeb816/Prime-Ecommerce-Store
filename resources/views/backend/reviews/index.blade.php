@extends('backend.layouts.app')

@section('title', 'Reviews | Prime Admin')
@section('page-title', 'Reviews')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box p-4 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title mb-0">All Reviews</h3>
                    <div class="d-flex gap-3 align-items-center">
                        <form action="{{ route('backend.reviews.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                            <label class="mb-0 small fw-bold text-nowrap">Show on Home:</label>
                            <select name="homepage" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                                <option value="">All Reviews</option>
                                <option value="yes" {{ request('homepage') == 'yes' ? 'selected' : '' }}>Showing on Home</option>
                                <option value="no" {{ request('homepage') == 'no' ? 'selected' : '' }}>Not Showing</option>
                            </select>
                            @if(request()->has('homepage'))
                                <a href="{{ route('backend.reviews.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                            @endif
                        </form>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Home?</th>
                                <th>Reply</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->user ? $review->user->name : 'Deleted User' }}</td>
                                    <td>{{ $review->product ? $review->product->name : 'Deleted Product' }}</td>
                                    <td>
                                        @for($i = 0; $i < $review->rating; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor
                                    </td>
                                    <td>{{ Str::limit($review->comment, 50) }}</td>
                                    <td>
                                        @if($review->show_on_homepage)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($review->reply)
                                            <span class="badge bg-primary">Replied</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $review->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.reviews.edit', $review->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('backend.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($reviews->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">No reviews found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
