<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{route('admin.event')}}" class="nav-link {{ (request()->is('admin/event')) ? 'active' : '' }}" aria-current="page" href="#">
                    <span data-feather="calendar"></span>
                    Events
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.user')}}" class="nav-link {{ (request()->is('admin/user')) ? 'active' : '' }}" aria-current="page" href="#">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
        </ul>
    </div>
</nav>