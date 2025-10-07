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
                <li class="nav-item @if (request()->path() == 'admin/dashboard') active @endif">
                    <a href="{{ route('admin.dashboard') }}">
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

                @if (empty($admin->role) || (!empty($permissions) && in_array('Packages', $permissions)))
                    <li
                        class="nav-item
                    @if (request()->path() == 'admin/packages') active
                    @elseif(request()->is('admin/package/*/edit')) active
                    @elseif(request()->path() == 'admin/coupon') active
                    @elseif(request()->routeIs('admin.coupon.edit')) active @endif">
                        <a data-toggle="collapse" href="#packageManagement">
                            <i class="fas fa-receipt"></i>
                            <p>{{ __('Package Management') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
                        @if (request()->path() == 'admin/packages') show
                        @elseif(request()->is('admin/package/*/edit')) show
                        @elseif(request()->path() == 'admin/coupon') show
                        @elseif(request()->routeIs('admin.coupon.edit')) show @endif"
                            id="packageManagement">
                            <ul class="nav nav-collapse">
                                <li
                                    class="@if (request()->path() == 'admin/coupon') active
                                @elseif(request()->routeIs('admin.coupon.edit')) active @endif">
                                    <a href="{{ route('admin.coupon.index') }}">
                                        <span class="sub-item">Coupons</span>
                                    </a>
                                </li>
                                <li
                                    class="@if (request()->path() == 'admin/packages') active
                                @elseif(request()->is('admin/package/*/edit')) active @endif">
                                    <a href="{{ route('admin.package.index') }}">
                                        <span class="sub-item">{{ __('Packages') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (empty($admin->role) || (!empty($permissions) && in_array('Payment Log', $permissions)))
                    <li class="nav-item
                    @if (request()->path() == 'admin/payment-log') active @endif">
                        <a href="{{ route('admin.payment-log.index') }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>{{ __('Payment Log') }}</p>
                        </a>
                    </li>
                @endif

                @if (empty($admin->role) || (!empty($permissions) && in_array('Payment Gateways', $permissions)))
                    <li
                        class="nav-item
                        @if (request()->path() == 'admin/gateways') active
                        @elseif(request()->path() == 'admin/offline/gateways') active @endif">
                        <a data-toggle="collapse" href="#gateways">
                            <i class="la flaticon-paypal"></i>
                            <p>{{ __('Payment Gateways') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
                        @if (request()->path() == 'admin/gateways') show
                        @elseif(request()->path() == 'admin/offline/gateways') show @endif"
                            id="gateways">
                            <ul class="nav nav-collapse">
                                <li class="@if (request()->path() == 'admin/gateways') active @endif">
                                    <a href="{{ route('admin.gateway.index') }}">
                                        <span class="sub-item">{{ __('Online Gateways') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->path() == 'admin/offline/gateways') active @endif">
                                    <a href="{{ route('admin.gateway.offline') }}">
                                        <span class="sub-item">{{ __('Offline Gateways') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (empty($admin->role) || (!empty($permissions) && in_array('Registered Users', $permissions)))
                    <li
                        class="nav-item
                    @if (request()->path() == 'admin/register/users') active
                    @elseif(request()->is('admin/register/user/details/*')) active
                    @elseif (request()->routeIs('register.user.changePass')) active @endif">
                        <a href="{{ route('admin.register.user') }}">
                            <i class="la flaticon-users"></i>
                            <p>{{ __('Registered Users') }}</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.tenant.index') }}">
                        <i class="la flaticon-users"></i>
                        <p>{{ __('Tenants Management') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.fileupload.index') }}">
                        <i class="la flaticon-file"></i>
                        <p>{{ __('File Uploader') }}</p>
                    </a>
                </li>

                {{-- @if (empty($admin->role) || (!empty($permissions) && in_array('Payment Gateways', $permissions))) --}}
                    <li
                        class="nav-item
                        @if (request()->path() == 'admin/slots') active
                        @elseif(request()->path() == 'admin/booking/calendar') active
                        @elseif(request()->path() == 'admin/bookings') active @endif">
                        <a data-toggle="collapse" href="#schedules">
                            <i class="la flaticon-calendar"></i>
                            <p>{{ __('Schedules') }}</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
                        @if (request()->path() == 'admin/slots') show
                        @elseif(request()->path() == 'admin/booking/calendar') show
                        @elseif(request()->path() == 'admin/bookings') show @endif"
                            id="schedules">
                            <ul class="nav nav-collapse">
                                <li class="@if (request()->path() == 'admin/slots') active @endif">
                                    <a href="{{ route('admin.slots.index') }}">
                                        <span class="sub-item">{{ __('Slots') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->path() == 'admin/booking/calendar') active @endif">
                                    <a href="{{ route('admin.booking.calendar') }}">
                                        <span class="sub-item">{{ __('Booking Calendar') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->path() == 'admin/bookings') active @endif">
                                    <a href="{{ route('admin.booking.index') }}">
                                        <span class="sub-item">{{ __('All Bookings') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                {{-- @endif --}}

            </ul>
        </div>
    </div>
</div>
