<div class="sidebar sidebar-style-2" @if (request()->cookie('admin-theme') == 'dark') data-background-color="dark2" @endif>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (!empty(Auth::guard('admin')->user()->image))
                        <img src="{{ asset('assets/admin/img/propics/' . Auth::guard('admin')->user()->image) }}"
                            alt="..." class="avatar-img rounded">
                    @else
                        <img src="{{ asset('assets/admin/img/propics/blank_user.jpg') }}" alt="..."
                            class="avatar-img rounded">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::guard('admin')->user()->first_name }}
                            <span class="user-level">Admin</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('admin.edit.profile') }}">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.change.password') }}">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item @if(request()->path() == 'admin/dashboard') active @endif">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="la flaticon-paint-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (empty($admin->role) || (!empty($permissions) && in_array('Role Management', $permissions)))
                    <li
                        class="nav-item
                      @if (request()->path() == 'admin/roles') active
                      @elseif(request()->is('admin/role/*/permissions/manage')) active @endif">
                        <a href="{{ route('admin.role.index') }}">
                            <i class="la flaticon-multimedia-2"></i>
                            <p>{{ __('Role Management') }}</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.tenant.index') }}">
                        <i class="la flaticon-users"></i>
                        <p>{{ __('Tenants Management') }}</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
