@extends('backend.layouts.app')

@section('title', 'Users | Prime Admin')
@section('page-title', 'Users')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">All Users</h3>
                    <a href="{{ route('backend.users.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New User
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Orders</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 20; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div>
                                                <strong>User {{ $i }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>user{{ $i }}@example.com</td>
                                    <td>+92 300 {{ str_pad($i, 7, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ rand(0, 20) }}</td>
                                    <td>
                                        @if($i % 4 == 0)
                                            <span class="badge bg-danger">Inactive</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{ now()->subDays(rand(1, 365))->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.users.show', $i) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('backend.users.edit', $i) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $i }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            // Handle deletion
            console.log('Deleting user:', id);
        }
    }
</script>
@endpush

