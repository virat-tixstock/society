@php
    $admin_logo = getSettingsValByName('company_logo');
    $ids = parentId();
    $authUser = \App\Models\User::find($ids);
    $subscription = \App\Models\Subscription::find($authUser->subscription);
    $routeName = \Request::route()->getName();
    $pricing_feature_settings = getSettingsValByIdName(1, 'pricing_feature');
@endphp
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="{{ asset(Storage::url('upload/logo/')) . '/' . (isset($admin_logo) && !empty($admin_logo) ? $admin_logo : 'logo.png') }}"
                    alt="" class="logo logo-lg" style="max-width:300px !important" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>{{ __('Home') }}</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item {{ in_array($routeName, ['dashboard', 'home', '']) ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @if (\Auth::user()->type == 'super admin')
                    @if (Gate::check('manage user'))
                        <li class="pc-item {{ in_array($routeName, ['users.index', 'users.show']) ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                                <span class="pc-mtext">{{ __('Customers') }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    @if (Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage logged history'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'pc-trigger active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="pc-mtext">{{ __('Staff Management') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage user'))
                                    <li class="pc-item {{ in_array($routeName, ['users.index']) ? 'active' : '' }}">
                                        <a class="pc-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage role'))
                                    <li
                                        class="pc-item  {{ in_array($routeName, ['role.index', 'role.create', 'role.edit']) ? 'active' : '' }}">
                                        <a class="pc-link" href="{{ route('role.index') }}">{{ __('Roles') }} </a>
                                    </li>
                                @endif
                                @if ($pricing_feature_settings == 'off' || $subscription->enabled_logged_history == 1)
                                    @if (Gate::check('manage logged history'))
                                        <li
                                            class="pc-item  {{ in_array($routeName, ['logged.history']) ? 'active' : '' }}">
                                            <a class="pc-link"
                                                href="{{ route('logged.history') }}">{{ __('Logged History') }}</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif
                @if (Gate::check('manage contact') ||
                        Gate::check('manage note') ||
                        Gate::check('manage member') ||
                        Gate::check('manage building') ||
                        Gate::check('manage floor') ||
                        Gate::check('manage unit') ||
                        Gate::check('manage complaint') ||
                        Gate::check('manage visitor') ||
                        Gate::check('manage event') ||
                        Gate::check('manage inventory') ||
                        Gate::check('manage expense') ||
                        Gate::check('manage calendar') ||
                        Gate::check('manage parking') || Gate::check('manage booking') || Gate::check('manage maintenance') || Gate::check('manage attendance'))
                    <li class="pc-item pc-caption">
                        <label>{{ __('Business Management') }}</label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                     @if (Gate::check('manage building') || Gate::check('manage floor') || Gate::check('manage unit'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['building.index', 'floor.index', 'unit.index']) ? 'active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-building"></i>
                                </span>
                                <span class="pc-mtext">{{ __('Society') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['building.index', 'floor.index', 'unit.index']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage building'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['building.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('building.index') }}"
                                            class="pc-link">{{ __('Building') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage floor'))
                                    <li class="pc-item {{ in_array($routeName, ['floor.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('floor.index') }}" class="pc-link">{{ __('Floor') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage unit'))
                                    <li class="pc-item {{ in_array($routeName, ['unit.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('unit.index') }}" class="pc-link">{{ __('Unit') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Gate::check('manage member'))
                        <li
                            class="pc-item {{ in_array($routeName, ['member.index', 'member.show']) ? 'active' : '' }}">
                            <a href="{{ route('member.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                                <span class="pc-mtext">{{ __('Member') }}</span>
                            </a>
                        </li>
                    @endif
                   
                    @if (Gate::check('manage parking'))
                        <li class="pc-item {{ in_array($routeName, ['parking.index']) ? 'active' : '' }}">
                            <a href="{{ route('parking.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-columns"></i></span>
                                <span class="pc-mtext">{{ __('Parking') }}</span>
                            </a>
                        </li>
                    @endif

                    @if (Gate::check('manage visitor'))
                        <li class="pc-item {{ in_array($routeName, ['visitor.index']) ? 'active' : '' }}">
                            <a href="{{ route('visitor.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-accessible"></i></span>
                                <span class="pc-mtext">{{ __('Visitor') }}</span>
                            </a>
                        </li>
                    @endif

                    @if (Gate::check('manage event'))
                        <li class="pc-item {{ in_array($routeName, ['event.index']) ? 'active' : '' }}">
                            <a href="{{ route('event.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-brand-asana"></i></span>
                                <span class="pc-mtext">{{ __('Event') }}</span>
                            </a>
                        </li>
                    @endif


                    @if (Gate::check('manage calendar'))
                        <li class="pc-item {{ in_array($routeName, ['event.calendar']) ? 'active' : '' }}">
                            <a href="{{ route('event.calendar') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="calendar"></i></span>
                                <span class="pc-mtext">{{ __('Calendar') }}</span>
                            </a>
                        </li>
                    @endif


                    @if (Gate::check('manage booking'))
                        <li
                            class="pc-item {{ in_array($routeName, ['booking-facility.index', 'booking-facility.create', 'booking-facility.edit', 'booking-facility.show']) ? 'active' : '' }}">
                            <a href="{{ route('booking-facility.index') }}" class="pc-link">
                                <span class="pc-micon"> <i class="ti ti-contrast"></i></span>
                                <span class="pc-mtext">{{ __('Booking Facility') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage maintenance'))
                        <li
                            class="pc-item {{ in_array($routeName, ['maintenance.index', 'maintenance.create', 'maintenance.edit', 'maintenance.show']) ? 'active' : '' }}">
                            <a href="{{ route('maintenance.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-world-latitude"></i></span>
                                <span class="pc-mtext">{{ __('Maintenance') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage inventory'))
                        <li class="pc-item {{ in_array($routeName, ['inventory.index']) ? 'active' : '' }}">
                            <a href="{{ route('inventory.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-atom-2"></i></span>
                                <span class="pc-mtext">{{ __('Inventory') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage attendance'))
                        <li class="pc-item {{ in_array($routeName, ['attendance.index']) ? 'active' : '' }}">
                            <a href="{{ route('attendance.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-circle-check"></i></span>
                                <span class="pc-mtext">{{ __('Attendance') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage expense'))
                        <li
                            class="pc-item {{ in_array($routeName, ['expense.index', 'expense.create', 'expense.show', 'expense.edit']) ? 'active' : '' }}">
                            <a href="{{ route('expense.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-report-money"></i></span>
                                <span class="pc-mtext">{{ __('Expense') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage complaint'))
                        <li class="pc-item {{ in_array($routeName, ['complaint.index']) ? 'active' : '' }}">
                            <a href="{{ route('complaint.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-file-report"></i></span>
                                <span class="pc-mtext">{{ __('complaint') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage contact'))
                        <li class="pc-item {{ in_array($routeName, ['contact.index']) ? 'active' : '' }}">
                            <a href="{{ route('contact.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-phone-call"></i></span>
                                <span class="pc-mtext">{{ __('Contact Diary') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage note'))
                        <li class="pc-item {{ in_array($routeName, ['note.index']) ? 'active' : '' }} ">
                            <a href="{{ route('note.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-notebook"></i></span>
                                <span class="pc-mtext">{{ __('Notice Board') }}</span>
                            </a>
                        </li>
                    @endif
                @endif

                @if (Gate::check('manage notification') || Gate::check('manage complaint category') || Gate::check('manage facility') ||
                        Gate::check('manage expense type') || Gate::check('manage maintenance type') || Gate::check('manage visitor type') || Gate::check('manage tax') || Gate::check('manage parking slot') || Gate::check('manage parking slot'))
                    <li class="pc-item pc-caption">
                        <label>{{ __('System Configuration') }}</label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                    @if (Gate::check('manage complaint category'))
                        <li class="pc-item {{ in_array($routeName, ['complaint-category.index']) ? 'active' : '' }} ">
                            <a href="{{ route('complaint-category.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-panorama-horizontal"></i></span>
                                <span class="pc-mtext">{{ __('Complaint Category') }}</span>
                            </a>
                        </li>
                    @endif


                    @if (Gate::check('manage maintenance type'))
                        <li class="pc-item {{ in_array($routeName, ['maintenance-type.index']) ? 'active' : '' }} ">
                            <a href="{{ route('maintenance-type.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-mask"></i></span>
                                <span class="pc-mtext">{{ __('maintenance type') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage facility'))
                        <li class="pc-item {{ in_array($routeName, ['facility.index']) ? 'active' : '' }} ">
                            <a href="{{ route('facility.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-marquee-2"></i></span>
                                <span class="pc-mtext">{{ __('Facility') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage expense type'))
                        <li class="pc-item {{ in_array($routeName, ['expense-type.index']) ? 'active' : '' }} ">
                            <a href="{{ route('expense-type.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-perspective"></i></span>
                                <span class="pc-mtext">{{ __('Expense Type') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage visitor type'))
                        <li class="pc-item {{ in_array($routeName, ['visitor-type.index']) ? 'active' : '' }} ">
                            <a href="{{ route('visitor-type.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-caret-right"></i></span>
                                <span class="pc-mtext">{{ __('visitor Type') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage tax'))
                        <li class="pc-item {{ in_array($routeName, ['tax.index']) ? 'active' : '' }}">
                            <a href="{{ route('tax.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-wand"></i></span>
                                <span class="pc-mtext">{{ __('Tax') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage parking slot'))
                        <li class="pc-item {{ in_array($routeName, ['parking-slot.index']) ? 'active' : '' }}">
                            <a href="{{ route('parking-slot.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-brand-sketch"></i></span>
                                <span class="pc-mtext">{{ __('Parking Slot') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage notification'))
                        <li class="pc-item {{ in_array($routeName, ['notification.index']) ? 'active' : '' }} ">
                            <a href="{{ route('notification.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-bell"></i></span>
                                <span class="pc-mtext">{{ __('Email Notification') }}</span>
                            </a>
                        </li>
                    @endif
                @endif
                @if (Gate::check('manage pricing packages') ||
                        Gate::check('manage pricing transation') ||
                        Gate::check('manage account settings') ||
                        Gate::check('manage password settings') ||
                        Gate::check('manage general settings') ||
                        Gate::check('manage email settings') ||
                        Gate::check('manage payment settings') ||
                        Gate::check('manage company settings') ||
                        Gate::check('manage seo settings') ||
                        Gate::check('manage google recaptcha settings'))
                    <li class="pc-item pc-caption">
                        <label>{{ __('System Settings') }}</label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                    @if (Gate::check('manage FAQ') || Gate::check('manage Page'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['homepage.index', 'FAQ.index', 'pages.index', 'footerSetting']) ? 'active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-layout-rows"></i>
                                </span>
                                <span class="pc-mtext">{{ __('CMS') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['homepage.index', 'FAQ.index', 'pages.index', 'footerSetting']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage home page'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['homepage.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('homepage.index') }}"
                                            class="pc-link">{{ __('Home Page') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage Page'))
                                    <li class="pc-item {{ in_array($routeName, ['pages.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('pages.index') }}"
                                            class="pc-link">{{ __('Custom Page') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage FAQ'))
                                    <li class="pc-item {{ in_array($routeName, ['FAQ.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('FAQ.index') }}" class="pc-link">{{ __('FAQ') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage footer'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['footerSetting']) ? 'active' : '' }} ">
                                        <a href="{{ route('footerSetting') }}"
                                            class="pc-link">{{ __('Footer') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage auth page'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['authPage.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('authPage.index') }}"
                                            class="pc-link">{{ __('Auth Page') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->type == 'super admin' || $pricing_feature_settings == 'on')
                        @if (Gate::check('manage pricing packages') || Gate::check('manage pricing transation'))
                            <li
                                class="pc-item pc-hasmenu {{ in_array($routeName, ['subscriptions.index', 'subscriptions.show', 'subscription.transaction']) ? 'pc-trigger active' : '' }}">
                                <a href="#!" class="pc-link">
                                    <span class="pc-micon">
                                        <i class="ti ti-package"></i>
                                    </span>
                                    <span class="pc-mtext">{{ __('Pricing') }}</span>
                                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="pc-submenu"
                                    style="display: {{ in_array($routeName, ['subscriptions.index', 'subscriptions.show', 'subscription.transaction']) ? 'block' : 'none' }}">
                                    @if (Gate::check('manage pricing packages'))
                                        <li
                                            class="pc-item {{ in_array($routeName, ['subscriptions.index', 'subscriptions.show']) ? 'active' : '' }}">
                                            <a class="pc-link"
                                                href="{{ route('subscriptions.index') }}">{{ __('Packages') }}</a>
                                        </li>
                                    @endif
                                    @if (Gate::check('manage pricing transation'))
                                        <li
                                            class="pc-item {{ in_array($routeName, ['subscription.transaction']) ? 'active' : '' }}">
                                            <a class="pc-link"
                                                href="{{ route('subscription.transaction') }}">{{ __('Transactions') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif
                    @if (Gate::check('manage coupon') || Gate::check('manage coupon history'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['coupons.index', 'coupons.history']) ? 'active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-shopping-cart-discount"></i>
                                </span>
                                <span class="pc-mtext">{{ __('Coupons') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['coupons.index', 'coupons.history']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage coupon'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['coupons.index']) ? 'active' : '' }}">
                                        <a class="pc-link"
                                            href="{{ route('coupons.index') }}">{{ __('All Coupon') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage coupon history'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['coupons.history']) ? 'active' : '' }}">
                                        <a class="pc-link"
                                            href="{{ route('coupons.history') }}">{{ __('Coupon History') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Gate::check('manage account settings') ||
                            Gate::check('manage password settings') ||
                            Gate::check('manage general settings') ||
                            Gate::check('manage email settings') ||
                            Gate::check('manage payment settings') ||
                            Gate::check('manage company settings') ||
                            Gate::check('manage seo settings') ||
                            Gate::check('manage google recaptcha settings'))
                        <li class="pc-item {{ in_array($routeName, ['setting.index']) ? 'active' : '' }} ">
                            <a href="{{ route('setting.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-settings"></i></span>
                                <span class="pc-mtext">{{ __('Settings') }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
            <div class="w-100 text-center">
                <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
            </div>
        </div>
    </div>
</nav>
