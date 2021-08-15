<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img style="height: 40px; width: 40px;"  src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::user()->profile_url }}" class="img-circle" alt="" />
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
{{--    <div class="form-inline">--}}
{{--        <div class="input-group" data-widget="sidebar-search">--}}
{{--            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-sidebar">--}}
{{--                    <i class="fas fa-search fa-fw"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

<!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if(\Illuminate\Support\Facades\Auth::user()->is_verified == 1 && \Illuminate\Support\Facades\Auth::user()->is_payment_confirmed == 1)
                <li class="nav-item">
                    <a href="{{ route('portal') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('messages.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Messages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contacts.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="nav-link">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>
                            Contacts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('call_logs.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="nav-link">
                        <i class="nav-icon fa fa-phone"></i>
                        <p>
                            Call Logs
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('images.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="nav-link">
                        <i class="nav-icon fa fa-images"></i>
                        <p>
                            Images
                        </p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('profile.view', \Illuminate\Support\Facades\Auth::user()->id) }}" class="nav-link">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                        My Profile
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.edit', \Illuminate\Support\Facades\Auth::user()->id) }}" class="nav-link">
                    <i class="nav-icon fa fa-edit"></i>
                    <p>
                        Edit Profile
                    </p>
                </a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->is_client == 1)
                <li class="nav-item">
                    <a href="{{ route('setup') }}" class="nav-link">
                        <i class="nav-icon fa fa-wrench"></i>
                        <p>
                            Setup
                        </p>
                    </a>
                </li>
            @endif
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p class="text">Important</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Warning</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Informational</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
