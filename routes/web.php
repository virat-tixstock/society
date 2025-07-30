<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\BookingFacilityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CommonBillController;
use App\Http\Controllers\ComplaintCategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceTypeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberDetailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ParkingSlotController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UtilityBillController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\VisitorTypeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

// Route::get('/', [HomeController::class, 'index'])->middleware(
//     [

//         'XSS',
//     ]
// );

Route::get('home', [AuthenticatedSessionController::class, 'create'])->name('home')->middleware(
    [

        'XSS',
    ]
);

Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware(
    [

        'XSS',
    ]
);

//-------------------------------User-------------------------------------------

Route::resource('users', UserController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('login/otp', [OTPController::class, 'show'])->name('otp.show')->middleware(
    [
        'XSS',
    ]
);

Route::post('login/otp', [OTPController::class, 'check'])->name('otp.check')->middleware(
    [
        'XSS',
    ]
);

Route::get('login/2fa/disable', [OTPController::class, 'disable'])->name('2fa.disable')->middleware(['XSS',]);

//-------------------------------Subscription-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::resource('subscriptions', SubscriptionController::class);
        Route::get('coupons/history', [CouponController::class, 'history'])->name('coupons.history');
        Route::delete('coupons/history/{id}/destroy', [CouponController::class, 'historyDestroy'])->name('coupons.history.destroy');
        Route::get('coupons/apply', [CouponController::class, 'apply'])->name('coupons.apply');
        Route::resource('coupons', CouponController::class);
        Route::get('subscription/transaction', [SubscriptionController::class, 'transaction'])->name('subscription.transaction');
    }
);

//-------------------------------Subscription Payment-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::post('subscription/{id}/stripe/payment', [SubscriptionController::class, 'stripePayment'])->name('subscription.stripe.payment');
    }
);

//-------------------------------Settings-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::get('settings', [SettingController::class, 'index'])->name('setting.index');

        Route::post('settings/account', [SettingController::class, 'accountData'])->name('setting.account');
        Route::delete('settings/account/delete', [SettingController::class, 'accountDelete'])->name('setting.account.delete');
        Route::post('settings/password', [SettingController::class, 'passwordData'])->name('setting.password');
        Route::post('settings/general', [SettingController::class, 'generalData'])->name('setting.general');
        Route::post('settings/smtp', [SettingController::class, 'smtpData'])->name('setting.smtp');
        Route::get('settings/smtp-test', [SettingController::class, 'smtpTest'])->name('setting.smtp.test');
        Route::post('settings/smtp-test', [SettingController::class, 'smtpTestMailSend'])->name('setting.smtp.testing');
        Route::post('settings/payment', [SettingController::class, 'paymentData'])->name('setting.payment');
        Route::post('settings/site-seo', [SettingController::class, 'siteSEOData'])->name('setting.site.seo');
        Route::post('settings/google-recaptcha', [SettingController::class, 'googleRecaptchaData'])->name('setting.google.recaptcha');
        Route::post('settings/company', [SettingController::class, 'companyData'])->name('setting.company');
        Route::post('settings/2fa', [SettingController::class, 'twofaEnable'])->name('setting.twofa.enable');

        Route::get('footer-setting', [SettingController::class, 'footerSetting'])->name('footerSetting');
        Route::post('settings/footer', [SettingController::class, 'footerData'])->name('setting.footer');

        Route::get('language/{lang}', [SettingController::class, 'lanquageChange'])->name('language.change');
        Route::post('theme/settings', [SettingController::class, 'themeSettings'])->name('theme.settings');
    }
);

//-------------------------------Role & Permissions-------------------------------------------
Route::resource('permission', PermissionController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Role-------------------------------------------
Route::resource('role', RoleController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Note-------------------------------------------
Route::resource('note', NoticeBoardController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Contact-------------------------------------------
Route::resource('contact', ContactController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------logged History-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::get('logged/history', [UserController::class, 'loggedHistory'])->name('logged.history');
        Route::get('logged/{id}/history/show', [UserController::class, 'loggedHistoryShow'])->name('logged.history.show');
        Route::delete('logged/{id}/history', [UserController::class, 'loggedHistoryDestroy'])->name('logged.history.destroy');
    }
);

//-------------------------------Plan Payment-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::post('subscription/{id}/bank-transfer', [PaymentController::class, 'subscriptionBankTransfer'])->name('subscription.bank.transfer');
        Route::get('subscription/{id}/bank-transfer/action/{status}', [PaymentController::class, 'subscriptionBankTransferAction'])->name('subscription.bank.transfer.action');
        Route::post('subscription/{id}/paypal', [PaymentController::class, 'subscriptionPaypal'])->name('subscription.paypal');
        Route::get('subscription/{id}/paypal/{status}', [PaymentController::class, 'subscriptionPaypalStatus'])->name('subscription.paypal.status');
        Route::post('subscription/{id}/{user_id}/manual-assign-package', [PaymentController::class, 'subscriptionManualAssignPackage'])->name('subscription.manual_assign_package');
        Route::get('subscription/flutterwave/{sid}/{tx_ref}', [PaymentController::class, 'subscriptionFlutterwave'])->name('subscription.flutterwave');
    }
);

//-------------------------------Notification-------------------------------------------
Route::resource('notification', NotificationController::class)->middleware(
    [
        'auth',
        'XSS',

    ]
);

Route::get('email-verification/{token}', [VerifyEmailController::class, 'verifyEmail'])->name('email-verification')->middleware(
    [
        'XSS',
    ]
);

//-------------------------------FAQ-------------------------------------------
Route::resource('FAQ', FAQController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Home Page-------------------------------------------
Route::resource('homepage', HomePageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------FAQ-------------------------------------------
Route::resource('pages', PageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Auth page-------------------------------------------
Route::resource('authPage', AuthPageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('page/{slug}', [PageController::class, 'page'])->name('page');

//-------------------------------FAQ-------------------------------------------
Route::impersonate();

//-------------------------------Building-------------------------------------------
Route::resource('building', BuildingController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Floor-------------------------------------------
Route::resource('floor', FloorController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Member-------------------------------------------
Route::resource('member', MemberController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('member-detail/{id}/create', [MemberDetailController::class, 'create'])->name('member-detail.create');
Route::post('member-detail/{id}/store', [MemberDetailController::class, 'store'])->name('member-detail.store');
Route::get('member-detail/{id}/edit/{detail_id}', [MemberDetailController::class, 'edit'])->name('member-detail.edit');
Route::put('member-detail/{id}/update/{detail_id}', [MemberDetailController::class, 'update'])->name('member-detail.update');
Route::delete('member-detail/{id}/destroy', [MemberDetailController::class, 'destroy'])->name('member-detail.destroy');


//-------------------------------Unit-------------------------------------------
Route::resource('unit', UnitController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Common Bill-------------------------------------------
Route::resource('common-bill', CommonBillController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Parking-------------------------------------------
Route::resource('parking', ParkingController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Complaint-------------------------------------------
Route::resource('complaint', ComplaintController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Visitor-------------------------------------------
Route::resource('visitor', VisitorController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Visitor type-------------------------------------------
Route::resource('visitor-type', VisitorTypeController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Utility Bill-------------------------------------------
Route::resource('utility-bill', UtilityBillController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::get('event/calendar', [EventController::class, 'calendar'])->name('event.calendar');
//-------------------------------Event-------------------------------------------
Route::resource('event', EventController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Facility-------------------------------------------
Route::resource('facility', FacilityController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Inventory-------------------------------------------
Route::resource('inventory', InventoryController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);



//-------------------------------Complaint Category-------------------------------------------
Route::resource('complaint-category', ComplaintCategoryController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
); //-------------------------------Expense Type-------------------------------------------
Route::resource('expense-type', ExpenseTypeController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Expense-------------------------------------------
Route::resource('expense', ExpenseController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Invoice-------------------------------------------
Route::resource('invoice', InvoiceController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Tax-------------------------------------------
Route::resource('tax', TaxController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Parking Slot-------------------------------------------
Route::resource('parking-slot', ParkingSlotController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('get-floor', [MemberController::class, 'getFloor'])->name('get.floor')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('get-unit', [MemberController::class, 'getUnit'])->name('get.unit')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('get-member', [BookingFacilityController::class, 'getMember'])->name('get.member')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('get-facility-cost', [BookingFacilityController::class, 'getFacilityCost'])->name('get.facility.cost')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('get-type-cost', [MaintenanceController::class, 'getTypeCost'])->name('get.type.cost')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('building-parking', [ParkingController::class, 'buildingUnit'])->name('building.unit')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('get-slot', [ParkingController::class, 'getSlot'])->name('get.slot')->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Booking Facility-------------------------------------------
Route::resource('booking-facility', BookingFacilityController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Maintenance Type-------------------------------------------
Route::resource('maintenance-type', MaintenanceTypeController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Maintenance-------------------------------------------
Route::resource('maintenance', MaintenanceController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Attendance-------------------------------------------
Route::resource('attendance', AttendanceController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
