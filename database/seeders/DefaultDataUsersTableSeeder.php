<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

class DefaultDataUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName != 'LaravelUpdater::database') {

            // Default All Permission
            $allPermission = [
                [
                    'name' => 'manage user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage logged history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete logged history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'buy pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage pricing transation',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage coupon history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete coupon history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage account settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage password settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage general settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage company settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage email settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage payment settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage seo settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage google recaptcha settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage notification',
                    'gaurd_name' => 'web',
                ],
                [
                    'name' => 'edit notification',
                    'gaurd_name' => 'web',
                ],
                [
                    'name' => 'manage FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage home page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit home page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage footer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit footer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage 2FA settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage auth page',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage building',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create building',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit building',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete building',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show building',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage floor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create floor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit floor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete floor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show floor',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show unit',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage member',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create member',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit member',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete member',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show member',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage parking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create parking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit parking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete parking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show parking',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage complaint',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create complaint',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit complaint',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete complaint',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show complaint',
                    'guard_name' => 'web',
                ],

               
                [
                    'name' => 'manage event',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create event',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit event',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete event',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show event',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage calendar',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage facility',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create facility',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit facility',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete facility',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show facility',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage inventory',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create inventory',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit inventory',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete inventory',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show inventory',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage visitor type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create visitor type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit visitor type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete visitor type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show visitor type',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage visitor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create visitor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit visitor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete visitor',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show visitor',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage expense type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create expense type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit expense type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete expense type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show expense type',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage complaint category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create complaint category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit complaint category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete complaint category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show complaint category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage tax',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create tax',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit tax',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete tax',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show tax',
                    'guard_name' => 'web',
                ],



                [
                    'name' => 'manage expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage parking slot',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create parking slot',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit parking slot',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete parking slot',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show parking slot',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage booking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create booking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit booking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete booking',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show booking',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage maintenance type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create maintenance type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit maintenance type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete maintenance type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show maintenance type',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage maintenance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create maintenance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit maintenance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete maintenance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show maintenance',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage attendance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create attendance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit attendance',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete attendance',
                    'guard_name' => 'web',
                ]
            ];
            Permission::insert($allPermission);

            // Default Super Admin Role
            $superAdminRoleData =  [
                'name' => 'super admin',
                'parent_id' => 0,
            ];
            $systemSuperAdminRole = Role::create($superAdminRoleData);
            $systemSuperAdminPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'show user'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage pricing packages'],
                ['name' => 'create pricing packages'],
                ['name' => 'edit pricing packages'],
                ['name' => 'delete pricing packages'],
                ['name' => 'manage pricing transation'],
                ['name' => 'manage coupon'],
                ['name' => 'create coupon'],
                ['name' => 'edit coupon'],
                ['name' => 'delete coupon'],
                ['name' => 'manage coupon history'],
                ['name' => 'delete coupon history'],
                ['name' => 'manage account settings'],
                ['name' => 'manage password settings'],
                ['name' => 'manage general settings'],
                ['name' => 'manage email settings'],
                ['name' => 'manage payment settings'],
                ['name' => 'manage seo settings'],
                ['name' => 'manage google recaptcha settings'],
                ['name' => 'manage FAQ'],
                ['name' => 'create FAQ'],
                ['name' => 'edit FAQ'],
                ['name' => 'delete FAQ'],
                ['name' => 'manage Page'],
                ['name' => 'create Page'],
                ['name' => 'edit Page'],
                ['name' => 'delete Page'],
                ['name' => 'show Page'],
                ['name' => 'manage home page'],
                ['name' => 'edit home page'],
                ['name' => 'manage footer'],
                ['name' => 'edit footer'],
                ['name' => 'manage 2FA settings'],
                ['name' => 'manage auth page'],


            ];
            $systemSuperAdminRole->givePermissionTo($systemSuperAdminPermission);
            // Default Super Admin
            $superAdminData =     [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'super admin',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
            ];
            $systemSuperAdmin = User::create($superAdminData);
            $systemSuperAdmin->assignRole($systemSuperAdminRole);
            HomePageSection();
            CustomPage();
            authPage($systemSuperAdmin->id);
            DefaultBankTransferPayment();

            // Default Owner Role
            $ownerRoleData = [
                'name' => 'owner',
                'parent_id' => $systemSuperAdmin->id,
            ];
            $systemOwnerRole = Role::create($ownerRoleData);

            // Default Owner All Permissions
            $systemOwnerPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'manage role'],
                ['name' => 'create role'],
                ['name' => 'edit role'],
                ['name' => 'delete role'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage logged history'],
                ['name' => 'delete logged history'],
                ['name' => 'manage pricing packages'],
                ['name' => 'buy pricing packages'],
                ['name' => 'manage pricing transation'],
                ['name' => 'manage account settings'],
                ['name' => 'manage password settings'],
                ['name' => 'manage general settings'],
                ['name' => 'manage company settings'],
                ['name' => 'manage email settings'],
                ['name' => 'manage notification'],
                ['name' => 'edit notification'],
                ['name' => 'manage 2FA settings'],

                ['name' => 'manage building'],
                ['name' => 'create building'],
                ['name' => 'edit building'],
                ['name' => 'delete building'],
                ['name' => 'show building'],

                ['name' => 'manage floor'],
                ['name' => 'create floor'],
                ['name' => 'edit floor'],
                ['name' => 'delete floor'],
                ['name' => 'show floor'],

                ['name' => 'manage unit'],
                ['name' => 'create unit'],
                ['name' => 'edit unit'],
                ['name' => 'delete unit'],
                ['name' => 'show unit'],

                ['name' => 'manage member'],
                ['name' => 'create member'],
                ['name' => 'edit member'],
                ['name' => 'delete member'],
                ['name' => 'show member'],

                ['name' => 'manage parking'],
                ['name' => 'create parking'],
                ['name' => 'edit parking'],
                ['name' => 'delete parking'],
                ['name' => 'show parking'],

                ['name' => 'manage complaint'],
                ['name' => 'create complaint'],
                ['name' => 'edit complaint'],
                ['name' => 'delete complaint'],
                ['name' => 'show complaint'],

                ['name' => 'manage event'],
                ['name' => 'create event'],
                ['name' => 'edit event'],
                ['name' => 'delete event'],
                ['name' => 'show event'],
                ['name' => 'manage calendar'],

                ['name' => 'manage facility'],
                ['name' => 'create facility'],
                ['name' => 'edit facility'],
                ['name' => 'delete facility'],
                ['name' => 'show facility'],

                ['name' => 'manage inventory'],
                ['name' => 'create inventory'],
                ['name' => 'edit inventory'],
                ['name' => 'delete inventory'],
                ['name' => 'show inventory'],

                ['name' => 'manage tax'],
                ['name' => 'create tax'],
                ['name' => 'edit tax'],
                ['name' => 'delete tax'],
                ['name' => 'show tax'],

                ['name' => 'manage complaint category'],
                ['name' => 'create complaint category'],
                ['name' => 'edit complaint category'],
                ['name' => 'delete complaint category'],
                ['name' => 'show complaint category'],

                ['name' => 'manage expense type'],
                ['name' => 'create expense type'],
                ['name' => 'edit expense type'],
                ['name' => 'delete expense type'],
                ['name' => 'show expense type'],

                ['name' => 'manage visitor type'],
                ['name' => 'create visitor type'],
                ['name' => 'edit visitor type'],
                ['name' => 'delete visitor type'],
                ['name' => 'show visitor type'],

                ['name' => 'manage visitor'],
                ['name' => 'create visitor'],
                ['name' => 'edit visitor'],
                ['name' => 'delete visitor'],
                ['name' => 'show visitor'],

                ['name' => 'manage expense'],
                ['name' => 'create expense'],
                ['name' => 'edit expense'],
                ['name' => 'delete expense'],
                ['name' => 'show expense'],

                ['name' => 'manage parking slot',],
                ['name' => 'create parking slot',],
                ['name' => 'edit parking slot',],
                ['name' => 'delete parking slot',],
                ['name' => 'show parking slot',],

                ['name' => 'manage booking',],
                ['name' => 'create booking',],
                ['name' => 'edit booking',],
                ['name' => 'delete booking',],
                ['name' => 'show booking',],

                ['name' => 'manage maintenance type'],
                ['name' => 'create maintenance type'],
                ['name' => 'edit maintenance type'],
                ['name' => 'delete maintenance type'],
                ['name' => 'show maintenance type'],

                ['name' => 'manage maintenance'],
                ['name' => 'create maintenance'],
                ['name' => 'edit maintenance'],
                ['name' => 'delete maintenance'],
                ['name' => 'show maintenance'],

                ['name' => 'manage attendance'],
                ['name' => 'create attendance'],
                ['name' => 'edit attendance'],
                ['name' => 'delete attendance']

            ];
            $systemOwnerRole->givePermissionTo($systemOwnerPermission);

            // Default Owner Create
            $ownerData =    [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'owner',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
                'subscription' => 1,
                'parent_id' => $systemSuperAdmin->id,
            ];
            $systemOwner = User::create($ownerData);
            // Default Template Assign
            defaultTemplate($systemOwner->id);
            // Default Owner Role Assign
            $systemOwner->assignRole($systemOwnerRole);


            // Default Owner Role
            $managerRoleData =  [
                'name' => 'manager',
                'parent_id' => $systemOwner->id,
            ];
            $systemManagerRole = Role::create($managerRoleData);
            // Default Manager All Permissions
            $systemManagerPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage 2FA settings'],
            ];
            $systemManagerRole->givePermissionTo($systemManagerPermission);

            // Default Manager Create
            $managerData =   [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'manager',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
                'subscription' => 0,
                'parent_id' => $systemOwner->id,
            ];
            $systemManager = User::create($managerData);
            // Default Manager Role Assign
            $systemManager->assignRole($systemManagerRole);


            // Subscription default data
            $subscriptionData = [
                'title' => 'Basic',
                'package_amount' => 0,
                'interval' => 'Unlimited',
                'user_limit' => 10,
                'member_limit' => 10,
                'enabled_logged_history' => 1,
            ];
            \App\Models\Subscription::create($subscriptionData);
        }
    }
}
