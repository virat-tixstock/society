<?php
    $admin_logo = getSettingsValByName('company_logo');
    $ids = parentId();
    $authUser = \App\Models\User::find($ids);
    $subscription = \App\Models\Subscription::find($authUser->subscription);
    $routeName = \Request::route()->getName();
    $pricing_feature_settings = getSettingsValByIdName(1, 'pricing_feature');
?>
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="<?php echo e(asset(Storage::url('upload/logo/')) . '/' . (isset($admin_logo) && !empty($admin_logo) ? $admin_logo : 'logo.png')); ?>"
                    alt="" class="logo logo-lg" style="max-width:300px !important" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label><?php echo e(__('Home')); ?></label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item <?php echo e(in_array($routeName, ['dashboard', 'home', '']) ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext"><?php echo e(__('Dashboard')); ?></span>
                    </a>
                </li>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <?php if(Gate::check('manage user')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['users.index', 'users.show']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('users.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Customers')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage logged history')): ?>
                        <li
                            class="pc-item pc-hasmenu <?php echo e(in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'pc-trigger active' : ''); ?>">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="pc-mtext"><?php echo e(__('Staff Management')); ?></span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: <?php echo e(in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'block' : 'none'); ?>">
                                <?php if(Gate::check('manage user')): ?>
                                    <li class="pc-item <?php echo e(in_array($routeName, ['users.index']) ? 'active' : ''); ?>">
                                        <a class="pc-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage role')): ?>
                                    <li
                                        class="pc-item  <?php echo e(in_array($routeName, ['role.index', 'role.create', 'role.edit']) ? 'active' : ''); ?>">
                                        <a class="pc-link" href="<?php echo e(route('role.index')); ?>"><?php echo e(__('Roles')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($pricing_feature_settings == 'off' || $subscription->enabled_logged_history == 1): ?>
                                    <?php if(Gate::check('manage logged history')): ?>
                                        <li
                                            class="pc-item  <?php echo e(in_array($routeName, ['logged.history']) ? 'active' : ''); ?>">
                                            <a class="pc-link"
                                                href="<?php echo e(route('logged.history')); ?>"><?php echo e(__('Logged History')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(Gate::check('manage contact') ||
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
                        Gate::check('manage parking') || Gate::check('manage booking') || Gate::check('manage maintenance') || Gate::check('manage attendance')): ?>
                    <li class="pc-item pc-caption">
                        <label><?php echo e(__('Business Management')); ?></label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                     <?php if(Gate::check('manage building') || Gate::check('manage floor') || Gate::check('manage unit')): ?>
                        <li
                            class="pc-item pc-hasmenu <?php echo e(in_array($routeName, ['building.index', 'floor.index', 'unit.index']) ? 'active' : ''); ?>">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-building"></i>
                                </span>
                                <span class="pc-mtext"><?php echo e(__('Society')); ?></span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: <?php echo e(in_array($routeName, ['building.index', 'floor.index', 'unit.index']) ? 'block' : 'none'); ?>">
                                <?php if(Gate::check('manage building')): ?>
                                    <li
                                        class="pc-item <?php echo e(in_array($routeName, ['building.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('building.index')); ?>"
                                            class="pc-link"><?php echo e(__('Building')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage floor')): ?>
                                    <li class="pc-item <?php echo e(in_array($routeName, ['floor.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('floor.index')); ?>" class="pc-link"><?php echo e(__('Floor')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage unit')): ?>
                                    <li class="pc-item <?php echo e(in_array($routeName, ['unit.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('unit.index')); ?>" class="pc-link"><?php echo e(__('Unit')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage member')): ?>
                        <li
                            class="pc-item <?php echo e(in_array($routeName, ['member.index', 'member.show']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('member.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Member')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                   
                    <?php if(Gate::check('manage parking')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['parking.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('parking.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-columns"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Parking')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage visitor')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['visitor.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('visitor.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-accessible"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Visitor')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage event')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['event.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('event.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-brand-asana"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Event')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php if(Gate::check('manage calendar')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['event.calendar']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('event.calendar')); ?>" class="pc-link">
                                <span class="pc-micon"><i data-feather="calendar"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Calendar')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php if(Gate::check('manage booking')): ?>
                        <li
                            class="pc-item <?php echo e(in_array($routeName, ['booking-facility.index', 'booking-facility.create', 'booking-facility.edit', 'booking-facility.show']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('booking-facility.index')); ?>" class="pc-link">
                                <span class="pc-micon"> <i class="ti ti-contrast"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Booking Facility')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage maintenance')): ?>
                        <li
                            class="pc-item <?php echo e(in_array($routeName, ['maintenance.index', 'maintenance.create', 'maintenance.edit', 'maintenance.show']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('maintenance.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-world-latitude"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Maintenance')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage inventory')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['inventory.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-atom-2"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Inventory')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage attendance')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['attendance.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('attendance.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-circle-check"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Attendance')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage expense')): ?>
                        <li
                            class="pc-item <?php echo e(in_array($routeName, ['expense.index', 'expense.create', 'expense.show', 'expense.edit']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('expense.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-report-money"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Expense')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage complaint')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['complaint.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('complaint.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-file-report"></i></span>
                                <span class="pc-mtext"><?php echo e(__('complaint')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage contact')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['contact.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('contact.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-phone-call"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Contact Diary')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage note')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['note.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('note.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-notebook"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Notice Board')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Gate::check('manage notification') || Gate::check('manage complaint category') || Gate::check('manage facility') ||
                        Gate::check('manage expense type') || Gate::check('manage maintenance type') || Gate::check('manage visitor type') || Gate::check('manage tax') || Gate::check('manage parking slot') || Gate::check('manage parking slot')): ?>
                    <li class="pc-item pc-caption">
                        <label><?php echo e(__('System Configuration')); ?></label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                    <?php if(Gate::check('manage complaint category')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['complaint-category.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('complaint-category.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-panorama-horizontal"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Complaint Category')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php if(Gate::check('manage maintenance type')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['maintenance-type.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('maintenance-type.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-mask"></i></span>
                                <span class="pc-mtext"><?php echo e(__('maintenance type')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage facility')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['facility.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('facility.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-marquee-2"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Facility')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage expense type')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['expense-type.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('expense-type.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-perspective"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Expense Type')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage visitor type')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['visitor-type.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('visitor-type.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-caret-right"></i></span>
                                <span class="pc-mtext"><?php echo e(__('visitor Type')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage tax')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['tax.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('tax.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-wand"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Tax')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage parking slot')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['parking-slot.index']) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('parking-slot.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-brand-sketch"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Parking Slot')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage notification')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['notification.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('notification.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-bell"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Email Notification')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(Gate::check('manage pricing packages') ||
                        Gate::check('manage pricing transation') ||
                        Gate::check('manage account settings') ||
                        Gate::check('manage password settings') ||
                        Gate::check('manage general settings') ||
                        Gate::check('manage email settings') ||
                        Gate::check('manage payment settings') ||
                        Gate::check('manage company settings') ||
                        Gate::check('manage seo settings') ||
                        Gate::check('manage google recaptcha settings')): ?>
                    <li class="pc-item pc-caption">
                        <label><?php echo e(__('System Settings')); ?></label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                    <?php if(Gate::check('manage FAQ') || Gate::check('manage Page')): ?>
                        <li
                            class="pc-item pc-hasmenu <?php echo e(in_array($routeName, ['homepage.index', 'FAQ.index', 'pages.index', 'footerSetting']) ? 'active' : ''); ?>">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-layout-rows"></i>
                                </span>
                                <span class="pc-mtext"><?php echo e(__('CMS')); ?></span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: <?php echo e(in_array($routeName, ['homepage.index', 'FAQ.index', 'pages.index', 'footerSetting']) ? 'block' : 'none'); ?>">
                                <?php if(Gate::check('manage home page')): ?>
                                    <li
                                        class="pc-item <?php echo e(in_array($routeName, ['homepage.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('homepage.index')); ?>"
                                            class="pc-link"><?php echo e(__('Home Page')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage Page')): ?>
                                    <li class="pc-item <?php echo e(in_array($routeName, ['pages.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('pages.index')); ?>"
                                            class="pc-link"><?php echo e(__('Custom Page')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage FAQ')): ?>
                                    <li class="pc-item <?php echo e(in_array($routeName, ['FAQ.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('FAQ.index')); ?>" class="pc-link"><?php echo e(__('FAQ')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage footer')): ?>
                                    <li
                                        class="pc-item <?php echo e(in_array($routeName, ['footerSetting']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('footerSetting')); ?>"
                                            class="pc-link"><?php echo e(__('Footer')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage auth page')): ?>
                                    <li
                                        class="pc-item <?php echo e(in_array($routeName, ['authPage.index']) ? 'active' : ''); ?> ">
                                        <a href="<?php echo e(route('authPage.index')); ?>"
                                            class="pc-link"><?php echo e(__('Auth Page')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(Auth::user()->type == 'super admin' || $pricing_feature_settings == 'on'): ?>
                        <?php if(Gate::check('manage pricing packages') || Gate::check('manage pricing transation')): ?>
                            <li
                                class="pc-item pc-hasmenu <?php echo e(in_array($routeName, ['subscriptions.index', 'subscriptions.show', 'subscription.transaction']) ? 'pc-trigger active' : ''); ?>">
                                <a href="#!" class="pc-link">
                                    <span class="pc-micon">
                                        <i class="ti ti-package"></i>
                                    </span>
                                    <span class="pc-mtext"><?php echo e(__('Pricing')); ?></span>
                                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="pc-submenu"
                                    style="display: <?php echo e(in_array($routeName, ['subscriptions.index', 'subscriptions.show', 'subscription.transaction']) ? 'block' : 'none'); ?>">
                                    <?php if(Gate::check('manage pricing packages')): ?>
                                        <li
                                            class="pc-item <?php echo e(in_array($routeName, ['subscriptions.index', 'subscriptions.show']) ? 'active' : ''); ?>">
                                            <a class="pc-link"
                                                href="<?php echo e(route('subscriptions.index')); ?>"><?php echo e(__('Packages')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage pricing transation')): ?>
                                        <li
                                            class="pc-item <?php echo e(in_array($routeName, ['subscription.transaction']) ? 'active' : ''); ?>">
                                            <a class="pc-link"
                                                href="<?php echo e(route('subscription.transaction')); ?>"><?php echo e(__('Transactions')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(Gate::check('manage coupon') || Gate::check('manage coupon history')): ?>
                        <li
                            class="pc-item pc-hasmenu <?php echo e(in_array($routeName, ['coupons.index', 'coupons.history']) ? 'active' : ''); ?>">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-shopping-cart-discount"></i>
                                </span>
                                <span class="pc-mtext"><?php echo e(__('Coupons')); ?></span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: <?php echo e(in_array($routeName, ['coupons.index', 'coupons.history']) ? 'block' : 'none'); ?>">
                                <?php if(Gate::check('manage coupon')): ?>
                                    <li
                                        class="pc-item <?php echo e(in_array($routeName, ['coupons.index']) ? 'active' : ''); ?>">
                                        <a class="pc-link"
                                            href="<?php echo e(route('coupons.index')); ?>"><?php echo e(__('All Coupon')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage coupon history')): ?>
                                    <li
                                        class="pc-item <?php echo e(in_array($routeName, ['coupons.history']) ? 'active' : ''); ?>">
                                        <a class="pc-link"
                                            href="<?php echo e(route('coupons.history')); ?>"><?php echo e(__('Coupon History')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage account settings') ||
                            Gate::check('manage password settings') ||
                            Gate::check('manage general settings') ||
                            Gate::check('manage email settings') ||
                            Gate::check('manage payment settings') ||
                            Gate::check('manage company settings') ||
                            Gate::check('manage seo settings') ||
                            Gate::check('manage google recaptcha settings')): ?>
                        <li class="pc-item <?php echo e(in_array($routeName, ['setting.index']) ? 'active' : ''); ?> ">
                            <a href="<?php echo e(route('setting.index')); ?>" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-settings"></i></span>
                                <span class="pc-mtext"><?php echo e(__('Settings')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <div class="w-100 text-center">
                <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\wamp64\www\society\resources\views/admin/menu.blade.php ENDPATH**/ ?>