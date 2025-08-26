<div class="sidebar">
    <h4>Admin Book Store</h4>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
        Manage Books
    </a>
    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        Categories
    </a>
    <form action="{{ route('logout') }}" method="POST" class="logout-btn">
        @csrf
        <button type="submit" class="btn btn-danger w-100">Logout</button>
    </form>
</div>