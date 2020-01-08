<li class="nav-item {{ Request::is('books*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('books.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Books</span>
    </a>
</li>
<li class="nav-item {{ Request::is('authors*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('authors.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Authors</span>
    </a>
</li>
<li class="nav-item {{ Request::is('pelanggans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pelanggans.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Pelanggans</span>
    </a>
</li>
<li class="nav-item {{ Request::is('tokos*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tokos.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Tokos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('data*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('data.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Data</span>
    </a>
</li>
<li class="nav-item {{ Request::is('databukus*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('databukus.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Databukus</span>
    </a>
</li>

<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('users.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
