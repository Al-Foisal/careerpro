<?php

use App\Http\Controllers\Backend\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Backend\Auth\AdminLoginController;
use App\Http\Controllers\Backend\Auth\AdminRegistrationController;
use App\Http\Controllers\Backend\Auth\AdminResetPasswordController;
use App\Http\Controllers\Backend\Auth\BackendManagementController;
use App\Http\Controllers\Backend\BackendInstructorController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\MainMenu\CategoryController;
use App\Http\Controllers\Backend\MainMenu\SubcategoryController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\User\UserCourseController;
use App\Http\Controllers\Frontend\User\UserDashboardController;
use App\Http\Controllers\Frontend\User\UserJobController;
use App\Http\Controllers\Frontend\User\UserProfileController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\ExamController;
use App\Http\Controllers\Instructor\InstructorDashboardController;
use App\Http\Controllers\Instructor\InstructorForgotPasswordController;
use App\Http\Controllers\Instructor\InstructorLoginController;
use App\Http\Controllers\Instructor\InstructorRegisterController;
use App\Http\Controllers\Instructor\InstructorResetPasswordController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\HelpController;
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
 Route::get('/cc', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>All Config cleared</h1>';
});
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');

    Route::get('/job', 'job')->name('job');
    Route::get('/job/{id}', 'jobDetails')->name('jobDetails');
    Route::post('/job/application/store/{id}', 'storeApplication')->name('storeApplication');
    
    Route::get('/courses/{category}/{sub?}', 'categoryCourses')->name('categoryCourses');
    Route::get('/course-details/{slug}', 'courseDetails')->name('courseDetails');

    Route::get('/search/', 'search')->name('search');
    Route::get('/criteria/{page}', 'page')->name('page');

    Route::get('/instructor', 'instructor')->name('instructor');
    Route::get('/instructor/details/{id}', 'instructorDetails')->name('instructorDetails');
    
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'blogDetails')->name('blogDetails');
    
    Route::get('/help', 'help')->name('help');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/offer', 'offer')->name('offer');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/store/contact', 'storeContact')->name('storeContact');
});

Route::controller(CartController::class)->group(function () {
    //cart
    Route::get('/cart', 'cart')->name('cart');
    Route::post('/add-to-cart', 'addToCart');
    Route::post('/update-cart', 'updateCart')->name('updateCart');
    Route::get('/remove-from-cart/{rowId}', 'removeFromCart')->name('removeFromCart');
    Route::get('/destroy-cart', 'destroyCart')->name('destroyCart');

    //coupon
    Route::post('/apply-coupon', 'applyCoupon')->name('applyCoupon');
    Route::get('/remove-coupon', 'removeCoupon')->name('removeCoupon');
});

Route::middleware('auth')->prefix('/user')->as('user.')->group(function () {
    Route::controller(UserJobController::class)->prefix('/job')->as('job.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    Route::controller(UserCourseController::class)->prefix('/courses')->as('courses.')->group(function () {
        Route::get('/', 'courses')->name('courses');
        Route::get('/assignment', 'assignment')->name('assignment');
        Route::post('/store/assignment', 'storeAssignment')->name('storeAssignment');

        Route::get('/exam', 'exam')->name('exam');
        Route::get('/exam/{slug}', 'examFlow')->name('examFlow');
        Route::post('/exam/store', 'storeExamFlow')->name('storeExamFlow');
        Route::get('/result', 'result')->name('result');
        Route::post('/certificate', 'certificate')->name('certificate');
    });
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');

    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/order-details/{id}', [UserDashboardController::class, 'orderDetails'])->name('orderDetails');
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [UserProfileController::class, 'update'])->name('profile.update');

});

require __DIR__ . '/auth.php';

//instructor
Route::prefix('/instructor')->as('instructor.')->middleware('guest:instructor')->group(function () {
    Route::get('/register', [InstructorRegisterController::class, 'register'])->name('register');
    Route::post('/register', [InstructorRegisterController::class, 'storeRegister']);

    Route::get('/login', [InstructorLoginController::class, 'login'])->name('login');
    Route::post('/login', [InstructorLoginController::class, 'storeLogin']);

    Route::get('/forgot-password', [InstructorForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [InstructorForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [InstructorResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [InstructorResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/instructor')->as('instructor.')->middleware('auth:instructor')->group(function () {
    Route::get('/profile', [InstructorRegisterController::class, 'profile'])->name('profile');
    Route::put('/profile/update/{id}', [InstructorRegisterController::class, 'profileUpdate'])->name('profileUpdate');
    Route::post('/logout', [InstructorLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [InstructorDashboardController::class, 'dashboard'])->name('dashboard');

    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'courses')->name('courses');
        Route::get('/courses/create', 'create')->name('courses.create');
        Route::post('/courses/store', 'store')->name('courses.store');
        Route::get('/courses/edit/{slug}', 'edit')->name('courses.edit');
        Route::put('/courses/update/{slug}', 'update')->name('courses.update');
        Route::post('/courses/active/{id}', 'active')->name('courses.active');
        Route::post('/courses/inactive/{id}', 'inactive')->name('courses.inactive');
        Route::delete('/courses/delete/{slug}', 'delete')->name('courses.delete');

        //assignment and assesment route
        Route::get('/courses/assignment/{slug}', 'assignment')->name('courses.assignment');
        Route::post('/courses/assignment/{slug}', 'assignmentStore');
        Route::get('/courses/submitted-assesment', 'submittedAssesment')->name('courses.submittedAssesment');
        Route::get('/courses/unsubmitted-assesment', 'unsubmittedAssesment')->name('courses.unsubmittedAssesment');
        Route::put('/courses/submit-assesment/{id}', 'submitAssesment')->name('courses.submitAssesment');
    });

    Route::controller(ExamController::class)->prefix('/exam')->as('exam.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{slug}', 'show')->name('show');
        Route::get('/edit/{slug}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::delete('/delete/{slug}', 'delete')->name('delete');

        Route::get('/quiz/create/{id}', 'createQuiz')->name('createQuiz');
        Route::post('/quiz/store', 'storeQuiz')->name('storeQuiz');
        Route::delete('/quiz/delete/{id}', 'deleteQuiz')->name('deleteQuiz');
    });
});

//--instructor

//backend
Route::prefix('/admin')->as('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/store-login', [AdminLoginController::class, 'storeLogin'])->name('storeLogin');

    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AdminResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //admin management
    // ->middleware('admin_user')
    Route::controller(AdminRegistrationController::class)->group(function () {
        Route::get('/admin-list', 'adminList')->name('adminList');
        Route::get('/create-admin', 'createAdmin')->name('createAdmin');
        Route::post('/store-admin', 'storeAdmin')->name('storeAdmin');
        Route::get('/edit-admin/{admin}', 'editAdmin')->name('editAdmin');
        Route::post('/update-admin/{admin}', 'updateAdmin')->name('updateAdmin');
        Route::post('/admin/active-admin/{admin}', 'activeAdmin')->name('activeAdmin');
        Route::post('/admin/inactive-admin/{admin}', 'inactiveAdmin')->name('inactiveAdmin');
        Route::delete('/delete-admin/{admin}', 'deleteAdmin')->name('deleteAdmin');

    });
    Route::controller(BackendManagementController::class)->group(function () {

        Route::get('/customer-list', 'customerList')->name('customerList');
        Route::get('/instructor-list', 'instructorList')->name('instructorList');
        Route::post('/admin/active-instructor/{instructor}', 'activeInstructor')->name('activeInstructor');
        Route::post('/admin/inactive-instructor/{instructor}', 'inactiveInstructor')->name('inactiveInstructor');
    });

    // Route::middleware('main_menu')->group(function () {
    //slider
    Route::controller(SliderController::class)->group(function () {
        Route::get('/slider', 'allSlider')->name('allSlider');
        Route::get('/create-slider', 'createSlider')->name('createSlider');
        Route::post('/store-slider', 'storeSlider')->name('storeSlider');
        Route::get('/edit-slider/{slider}', 'editSlider')->name('editSlider');
        Route::put('/update-slider/{slider}', 'updateSlider')->name('updateSlider');
        Route::delete('/delete-slider/{slider}', 'deleteSlider')->name('deleteSlider');
    });

    //main menu
    //category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'category')->name('category');
        Route::get('/create-category', 'createCategory')->name('createCategory');
        Route::post('/store-category', 'storeCategory')->name('storeCategory');
        Route::get('/edit-category/{id}', 'editCategory')->name('editCategory');
        Route::patch('/update-category/{id}', 'updateCategory')->name('updateCategory');
        Route::post('/active-category/{id}', 'activeCategory')->name('activeCategory');
        Route::post('/inactive-category/{id}', 'inactiveCategory')->name('inactiveCategory');
        Route::post('/on-front-category/{id}', 'onFrontCategory')->name('onFrontCategory');
        Route::post('/remove-on-front-category/{id}', 'removeOnFrontCategory')->name('removeOnFrontCategory');
        Route::post('/on-front-page-category/{id}', 'onFrontPageCourseCategory')->name('onFrontPageCourseCategory');
        Route::post('/remove-on-front-page-category/{id}', 'removeOnFrontPageCourseCategory')->name('removeOnFrontPageCourseCategory');
    });

    //subcategory
    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('/subcategory', 'subcategory')->name('subcategory');
        Route::get('/create-subcategory', 'createSubcategory')->name('createSubcategory');
        Route::post('/store-subcategory', 'storeSubcategory')->name('storeSubcategory');
        Route::get('/edit-subcategory/{id}', 'editSubcategory')->name('editSubcategory');
        Route::patch('/update-subcategory/{id}', 'updateSubcategory')->name('updateSubcategory');
        Route::post('/active-subcategory/{id}', 'activeSubcategory')->name('activeSubcategory');
        Route::post('/inactive-subcategory/{id}', 'inactiveSubcategory')->name('inactiveSubcategory');
        Route::post('/on-front-subcategory/{id}', 'onFrontSubcategory')->name('onFrontSubcategory');
        Route::post('/remove-on-front-subcategory/{id}', 'removeOnFrontSubcategory')->name('removeOnFrontSubcategory');
    });
    // });

    // instructor deeds
    Route::controller(BackendInstructorController::class)->prefix('/instructor-deed/courses')->as('instructor.')->group(function () {
        Route::get('/', 'allCourses')->name('allCourses');
        Route::get('/create', 'createCourses')->name('createCourses');
        Route::post('/store', 'storeCourses')->name('storeCourses');
        Route::get('/edit/{slug}', 'editCourses')->name('editCourses');
        Route::put('/update/{slug}', 'updateCourses')->name('updateCourses');

        Route::post('/approve/{id}', 'approveCourse')->name('approveCourse');
        Route::post('/dyny/{id}', 'denyCourse')->name('denyCourse');
        Route::delete('/delete/{slug}', 'delete')->name('delete');
    });
    Route::resource('/coupons', CouponController::class);

    Route::controller(JobController::class)->prefix('/job')->as('job.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    
    Route::resource('/blogs',BlogController::class);
    Route::resource('/faqs',FAQController::class);
    Route::resource('/helps',HelpController::class);
    Route::get('/contact',[DashboardController::class,'contact'])->name('contact');
    Route::delete('/contact/{id}',[DashboardController::class,'destroy'])->name('contact.destroy');

    // Route::middleware('company')->group(function () {
    //company info
    Route::controller(CompanyInfoController::class)->group(function () {
        Route::get('/company-info', 'showCompanyInfo')->name('showCompanyInfo');
        Route::post('/store-company-info', 'storeCompanyInfo')->name('storeCompanyInfo');
    });
    //pages
    Route::controller(PageController::class)->group(function () {
        Route::get('/pages', 'pageList')->name('pageList');
        Route::get('/create-pages', 'pageCreate')->name('pageCreate');
        Route::post('/store-pages', 'pageStore')->name('pageStore');
        Route::get('/edit-pages/{page}', 'pageEdit')->name('pageEdit');
        Route::put('/update-pages/{page}', 'pageUpdate')->name('pageUpdate');
        Route::delete('/delete-pages/{page}', 'pageDelete')->name('pageDelete');
        Route::post('/active-pages/{page}', 'pageActive')->name('pageActive');
        Route::post('/inactive-pages/{page}', 'pageInactive')->name('pageInactive');
    });
    // });
});

Route::get('/get-subcategory/{id}', [GeneralController::class, 'getSubcategory']);