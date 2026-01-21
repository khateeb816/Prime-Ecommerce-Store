<div class="col-lg-3 mb-4">
    <div class="card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body text-center p-4">
             <div class="avatar-placeholder mb-3 mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
            <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <div class="list-group shadow-sm border-0 rounded-3 overflow-hidden">
        <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action border-0 p-3 {{ Route::is('user.dashboard') ? 'active fw-bold bg-primary text-white' : '' }}">
            <i class="bi bi-speedometer2 me-2 {{ Route::is('user.dashboard') ? '' : 'text-muted' }}"></i> Dashboard
        </a>
        <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action border-0 p-3 {{ Route::is('user.orders') ? 'active fw-bold bg-primary text-white' : '' }}">
            <i class="bi bi-bag-check me-2 {{ Route::is('user.orders') ? '' : 'text-muted' }}"></i> My Orders
        </a>
        <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action border-0 p-3 {{ Route::is('user.profile') ? 'active fw-bold bg-primary text-white' : '' }}">
            <i class="bi bi-person me-2 {{ Route::is('user.profile') ? '' : 'text-muted' }}"></i> Profile Settings
        </a>
        <a href="{{ route('user.wishlist') }}" class="list-group-item list-group-item-action border-0 p-3 {{ Route::is('user.wishlist') ? 'active fw-bold bg-primary text-white' : '' }}">
            <i class="bi bi-heart me-2 {{ Route::is('user.wishlist') ? '' : 'text-muted' }}"></i> Wishlist
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action border-0 p-3 text-danger">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
        </form>
    </div>
</div>
