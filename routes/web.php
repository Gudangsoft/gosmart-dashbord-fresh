<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdmindashboardController;
use App\Http\Controllers\Advertisement;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\VoucherController;
use App\Http\Controllers\Backend\CreationController as CreationBackend;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ChanelController;
use App\Http\Controllers\ClassCategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\EventRegistedController;
use App\Http\Controllers\Frontend\JobStreet;
use App\Http\Controllers\Frontend\Users\CertificateController;
use App\Http\Controllers\Frontend\Users\PaymentController;
use App\Http\Controllers\Frontend\Users\CreationController;
use App\Http\Controllers\Frontend\Users\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ListchanelController;
use App\Http\Controllers\LiveStreaming;
use App\Http\Controllers\PageDetailController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WithdrawController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::get('/password-default/{user_id}', [SettingController::class, 'defaultPassword']);
Route::get('/reset-password', [SettingController::class, 'resetPassword']);
Route::post('reset-password', [SettingController::class, 'updatePassword'])->name('reset-password');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/announcement/{slug}', [DetailController::class, 'announcementDetail']);

Route::get('/certificate/download/{code}', [CertificateController::class, 'download'])->name('download-certificate');
Route::get('/certificate/{user_id}/{class_id}', [CertificateController::class, 'GenerateCertificate']);
Route::get('/certificate_print/{user_id}/{class_id}', [CertificateController::class, 'PrintCertificate']);

Route::get('/logout', [HomeController::class, 'logout'])->name('logout.get');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', [AdmindashboardController::class, 'test']);

/*
|--------------------------------------------------------------------------
| Cart & Order Routes
|--------------------------------------------------------------------------
*/
Route::post('order', [CartsController::class, 'order'])->name('cart.order');
Route::get('order', [CartsController::class, 'orderPage'])->name('cart.order-page');
Route::get('reorder/{cid}', [CartsController::class, 'reorder'])->name('cart.reorder-page');
Route::post('checkout', [CartsController::class, 'checkout'])->name('carts.checkout');
Route::post('redeem', [CartsController::class, 'redeem'])->name('carts.redeem');
Route::post('voucher-code', [CartsController::class, 'voucherCode'])->name('carts.voucher');
Route::post('carts', [CartsController::class, 'store'])->name('carts.store');
Route::get('/carts', [CartsController::class, 'index'])->name('carts.index');
Route::get('/cart-cancel/{id}', [CartsController::class, 'cancel'])->name('carts.cancel');

/*
|--------------------------------------------------------------------------
| Learning / Member Routes
|--------------------------------------------------------------------------
*/
Route::get('/learning/tags/{slug}', [SearchController::class, 'tags']);
Route::get('/learning/page/{slug}', [PageDetailController::class, 'index']);
Route::post('/learning/search', [SearchController::class, 'index']);
Route::get('/learning/dashboard/{id}', [LearningController::class, 'dashboard']);
Route::get('/learning/profile/{slug}', [LearningController::class, 'myProfile']);
Route::get('/learning/setting/{id}', [LearningController::class, 'setting']);
Route::get('/learning/tab-menu/{slug}', [LearningController::class, 'profileMenu']);
Route::get('/learning/new_data_profile', [LearningController::class, 'newProfileSetting']);
Route::post('/learning/profile_save', [LearningController::class, 'newProfileSettingSave']);
Route::post('/learning/profile_update', [LearningController::class, 'myProfileSettingUpdate']);
Route::get('/learning/materi/{slug}', [LearningController::class, 'materiDetail']);
Route::get('/learning/last_view/{id}', [LearningController::class, 'lastHistoryPremium']);
Route::get('/learning/start_materi/{id}', [LearningController::class, 'materiStart']);
Route::post('/learning/end_materi/', [LearningController::class, 'materiEnd'])->name('end_materi');
Route::get('/learning/end_materi_rate/{mid}/{cid}', [LearningController::class, 'materiRating']);

Route::get('/learning/creation/create', [CreationController::class, 'create']);
Route::post('/learning/creation/store', [CreationController::class, 'store']);
Route::get('/learning/creation/edit/{id}', [CreationController::class, 'edit'])->name('creation.edit');
Route::post('/learning/creation/update', [CreationController::class, 'update'])->name('creation.update');
Route::get('/learning/creation/delete/{id}', [CreationController::class, 'delete'])->name('creation.delete');

Route::get('/learning/class_list', [LearningController::class, 'classMenu'])->name('class_menu');
Route::get('/learning/class_detail/{id}', [LearningController::class, 'classDetail']);
Route::get('/learning/class_learn/{slug}', [LearningController::class, 'classLearn']);
Route::get('/learning/content/{slug}', [LearningController::class, 'contentLearn']);
Route::get('/learning/class_detail/premium/{id}', [LearningController::class, 'classPremium']);
Route::get('/learning/channel_detail/{id}', [LearningController::class, 'channelDetail']);
Route::get('/learning/channel_detail/premium/{id}', [LearningController::class, 'channelPremium']);
Route::get('/learning/get_class/{data}/{class_id}/{user_id}', [LearningController::class, 'startPremiumContent']);
Route::post('/learning/start_class', [LearningController::class, 'startPremiumClass'])->name('start_class');
Route::get('/learning/pay_status/{id}', [PaymentController::class, 'payStatus'])->name('pay_status');
Route::get('/learning/pay_page/{cid}/{uid}', [LearningController::class, 'payPage']);
Route::post('/learning/pay', [LearningController::class, 'payment'])->name('pay');

/*
|--------------------------------------------------------------------------
| Dashboard (non-admin actions)
|--------------------------------------------------------------------------
*/
Route::post('/dashboard/profile_verified', [DashboardController::class, 'profileVerified']);
Route::post('/dashboard/search', [DashboardController::class, 'cari']);
Route::post('/dashboard/code_confirmation', [DashboardController::class, 'codeVerified']);

/*
|--------------------------------------------------------------------------
| Admin / Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['role:admin,teacher'])->group(function () {

    Route::get('/', [DashboardController::class, 'home']);
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/dashboard/allmateri', [DashboardController::class, 'allmateri'])->name('videopage');
    Route::get('/data-upload', [AdmindashboardController::class, 'admin'])->name('data-upload');
    Route::get('/data-upload/create', [AdmindashboardController::class, 'create']);
    Route::get('/data-upload/edit/{id}', [AdmindashboardController::class, 'edit']);
    Route::post('/data-upload/update', [AdmindashboardController::class, 'updateview']);
    Route::get('/data-upload/delete/{id}', [AdmindashboardController::class, 'delete_video']);
    Route::get('/list-chanel', [ListchanelController::class, 'chanel'])->name('list-chanel');
    Route::get('/add-chanel', [ChanelController::class, 'addPage'])->name('add-chanel');
    Route::get('/dashboard/user_materi/{id}', [DashboardController::class, 'user_materi']);
    Route::get('/dashboard/video_detail/{name}/{id}', [DashboardController::class, 'videoDetail']);
    Route::get('/dashboard/materi_add/{id}', [DashboardController::class, 'materi_add']);

    // Channel
    Route::get('/dashboard/channel/{id}', [DashboardController::class, 'channel']);
    Route::get('/dashboard/channel_add/{id}', [DashboardController::class, 'channelAdd']);
    Route::post('/dashboard/add_chanel', [ChanelController::class, 'addchanel']);
    Route::get('/dashboard/channel_detail/{id}', [ChanelController::class, 'channelDetail']);
    Route::get('/dashboard/add_to_channel/{id}', [ChanelController::class, 'AddDataChannel']);
    Route::get('/dashboard/channel/video_delete/{id}', [ChanelController::class, 'deleteContent']);

    // Tools / Materi
    Route::get('/dashboard/tools_materi/', [DetailController::class, 'toolsMateri']);
    Route::get('/dashboard/tools_materi/{id}', [DashboardController::class, 'toolsMateriUpdate']);
    Route::get('/dashboard/tools_materi_delete/{id}', [DashboardController::class, 'toolsMateriDelete']);
    Route::post('/dashboard/tools_materi_save', [DashboardController::class, 'toolsMateriSave']);

    // Certificate
    Route::get('/dashboard/certificate', [DashboardController::class, 'certificateList']);
    Route::get('/dashboard/certificate_add', [DashboardController::class, 'certificateAdd']);
    Route::post('/dashboard/certificate_save', [DashboardController::class, 'certificateSave']);

    // Class
    Route::get('/dashboard/class/detail/{id}', [DashboardController::class, 'classDetail']);
    Route::get('/dashboard/class_add/{id}', [DashboardController::class, 'classAdd']);
    Route::get('/dashboard/class_delete/{id}', [DashboardController::class, 'classDelete']);
    Route::post('/dashboard/class_save', [DashboardController::class, 'classSave']);
    Route::post('/dashboard/class_filter', [SearchController::class, 'classFilter']);
    Route::get('/dashboard/class_list', [ClassController::class, 'classList']);
    Route::get('/dashboard/class-status/{id}/{s}', [ClassController::class, 'classAction']);
    Route::post('/dashboard/join_class', [ClassController::class, 'joinClass']);
    Route::get('/dashboard/join_class_list', [ClassController::class, 'joinClassList']);

    // Class Category
    Route::get('/dashboard/class-category', [ClassCategoryController::class, 'index'])->name('category.index');
    Route::get('/dashboard/class-category/{id}', [ClassCategoryController::class, 'edit'])->name('category.edit');
    Route::get('/dashboard/class-category-delete/{id}', [ClassCategoryController::class, 'destroy'])->name('category.delete');
    Route::get('/dashboard/class-category-status/{id}/{type}', [ClassCategoryController::class, 'changeStatus'])->name('category.status');
    Route::post('/dashboard/class-category-store', [ClassCategoryController::class, 'store'])->name('category.store');
    Route::post('/dashboard/class-category-update', [ClassCategoryController::class, 'update'])->name('category.update');

    // Profile & Video
    Route::get('/dashboard/profile/{id}', [DashboardController::class, 'profileDetail'])->where('id', '[0-9]+');
    Route::post('/dashboard/profile_setting', [DashboardController::class, 'profileSettingSave']);
    Route::post('/dashboard/video_add', [DashboardController::class, 'videoUpdate']);
    Route::get('/dashboard/video_status/{id}/{s}', [DashboardController::class, 'setStatus']);
    Route::get('/dashboard/video_delete/{id}', [DashboardController::class, 'videoDelete']);

    // Users
    Route::get('/dashboard/list_user', [DashboardController::class, 'userList']);
    Route::get('/dashboard/user/detail/{id}', [AdminController::class, 'detailUser']);
    Route::get('/dashboard/user/{data}/{id}', [AdminController::class, 'action']);
    Route::get('/dashboard/role_change/{data}/{id}', [AdminController::class, 'roleChange']);
    Route::get('/dashboard/confirmation_class', [DashboardController::class, 'premiumConfirm']);
    Route::get('/dashboard/premium_change/{data}/{d}', [DashboardController::class, 'premiumChange']);
    Route::post('/dashboard/skill_add', [DashboardController::class, 'skillSave']);
    Route::get('/dashboard/skill_reset', [DashboardController::class, 'skillReset']);

    // Live Streaming
    Route::get('/dashboard/livestream', [LiveStreaming::class, 'index'])->name('Streaming');
    Route::get('/dashboard/livestream/{id}', [LiveStreaming::class, 'create']);
    Route::get('/dashboard/livestream_status/{id}/{s}', [LiveStreaming::class, 'setStatus']);
    Route::get('/dashboard/livestream_delete/{id}', [LiveStreaming::class, 'destroy']);
    Route::post('/dashboard/livestream_save', [LiveStreaming::class, 'save']);

    // Reviews
    Route::get('/dashboard/delete_review/{id}', [DashboardController::class, 'reviewDelete']);
    Route::get('/dashboard/show_review/{id}', [DashboardController::class, 'showReview']);

    // Partner
    Route::get('/dashboard/admin/partner', [AdminController::class, 'partner']);
    Route::get('/dashboard/partner_add/{id}', [AdminController::class, 'partnerAdd']);
    Route::get('/dashboard/partner_update/{id}', [AdminController::class, 'partnerAdd']);
    Route::get('/dashboard/partner_status/{id}/{action}', [AdminController::class, 'partnerStatus']);
    Route::get('/dashboard/partner_delete/{id}', [AdminController::class, 'partnerDelete']);
    Route::post('/dashboard/partner_save', [AdminController::class, 'partnerSave']);

    // Admin Settings
    Route::get('/dashboard/admin/setting', [AdminController::class, 'view']);
    Route::get('/dashboard/admin/materi', [AdminController::class, 'materiData']);
    Route::post('/dashboard/admin/setting/appname', [AdminController::class, 'appName']);
    Route::post('/dashboard/admin/setting/level_add', [AdminController::class, 'addLevel']);
    Route::get('/dashboard/admin/setting/level_delete/{id}', [AdminController::class, 'deleteLevel']);
    Route::get('/dashboard/setting/video_status/{id}/{s}', [AdminController::class, 'setStatus']);

    // Advertisement
    Route::post('/dashboard/advertisement_save', [Advertisement::class, 'AdvertisementSave']);
    Route::get('/dashboard/advertisement/{slug}', [Advertisement::class, 'Advertisement']);

    // Announcements
    Route::get('/dashboard/announcement', [PagesController::class, 'index'])->name('announcement');
    Route::get('/dashboard/announcement/create', [PagesController::class, 'create'])->name('announcement-created');
    Route::get('/dashboard/announcement/detail/{slug}', [PagesController::class, 'create'])->name('announcement-detail');
    Route::get('/dashboard/announcement/edit/{id}', [PagesController::class, 'edit'])->name('announcement-edit');
    Route::get('/dashboard/announcement/delete/{id}', [PagesController::class, 'destroy'])->name('announcement-delete');
    Route::post('/dashboard/announcement', [PagesController::class, 'store'])->name('announcement-save');
    Route::post('/dashboard/announcement/update', [PagesController::class, 'update'])->name('announcement-update');

    // Withdraw
    Route::get('/dashboard/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
    Route::get('/dashboard/withdraw-confirm', [AdminController::class, 'Withdraw'])->name('withdraw.admin');
    Route::get('/dashboard/withdraw-accept/{id}', [AdminController::class, 'WithdrawAccept'])->name('withdraw.admin.accept');
    Route::get('/dashboard/withdraw-cancel/{id}', [AdminController::class, 'WithdrawCancel'])->name('withdraw.admin.cancel');
    Route::get('/dashboard/withdraw-delete/{id}', [AdminController::class, 'WithdrawDelete'])->name('withdraw.admin.delete');
    Route::post('/dashboard/withdraw/store', [WithdrawController::class, 'store'])->name('withdraw.store');
    Route::post('/dashboard/withdraw/{id}', [WithdrawController::class, 'store'])->name('withdraw.show');

    // Voucher
    Route::post('/dashboard/voucher', [VoucherController::class, 'store'])->name('voucher.store');
    Route::post('/dashboard/voucher-custom', [VoucherController::class, 'custom'])->name('voucher.custom');
    Route::post('/dashboard/voucher-update', [VoucherController::class, 'update'])->name('voucher.update');
    Route::get('/dashboard/voucher-delete/{id}', [VoucherController::class, 'destroy'])->name('voucher.delete');

    // Events & Creation
    Route::prefix('dashboard')->group(function () {
        Route::get('events', [EventController::class, 'index'])->name('events.index');
        Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
        Route::get('event-register-delete/{id}', [EventController::class, 'destroy'])->name('eventregister.delete');
        Route::get('creation', [CreationBackend::class, 'index'])->name('creation.index');
    });
});
