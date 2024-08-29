<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\FAQController;
use App\Http\Controllers\Dashboard\BlogsController;
use App\Http\Controllers\Dashboard\AboutUsController;
use App\Http\Controllers\Dashboard\PartnersController;
use App\Http\Controllers\Dashboard\ProjectsController;
use App\Http\Controllers\Dashboard\ServicesController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\TestimonialsController;
use App\Http\Controllers\Dashboard\DashboardController as AdminDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WebsiteController::class, 'index'])->name('welcome');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::group(['prefix' => 'services', 'as' => 'services.'], function(){
    Route::get('/', [WebsiteController::class, 'services'])->name('index');
    Route::get('/{title}', [WebsiteController::class, 'viewService'])->name('view');
});
Route::group(['prefix' => 'portfolios', 'as' => 'portfolios.'], function(){
    Route::get('/', [WebsiteController::class, 'portfolios'])->name('index');
    Route::get('/{name}', [WebsiteController::class, 'viewProject'])->name('view');
});
Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function(){
    Route::get('/', [WebsiteController::class, 'blogs'])->name('index');
    Route::get('/{title}', [WebsiteController::class, 'viewBlog'])->name('view');
});
Route::get('/FAQs', [WebsiteController::class, 'FAQs'])->name('FAQs');
Route::group(['prefix' => 'contact', 'as' => 'contact.'], function(){
    Route::get('/', [WebsiteController::class, 'contact'])->name('page');
    Route::post('/contact', [WebsiteController::class, 'send_contact'])->name('post');
});

Route::namespace('Admin')->group(function() {
    Route::group(['prefix' => 'control'], function(){

        Route::namespace('Auth')->group(function() {
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
            Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
            Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
        });

        Route::group(['middleware' => 'auth:web', 'namespace' => 'Dashboard', 'prefix' => 'dashboard', 'as' => 'admin.'], function(){

            Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

            // settings Routes
            Route::group(['prefix' => 'settings', 'as' => 'settings.'], function(){
                Route::get('/system', [SettingsController::class, 'system'])->name('system');
                Route::get('/account', [SettingsController::class, 'account'])->name('account');
                Route::post('/system/save', [SettingsController::class, 'updateSystemSettings'])->name('system.save');
                Route::post('/account/save', [SettingsController::class, 'updateAccountSettings'])->name('account.save');
                Route::post('/password/save', [SettingsController::class, 'updatePassword'])->name('password.save');
                // Route::post('/activate', [CategoryController::class, 'activate'])->name('activate');
                // Route::post('/delete', [CategoryController::class, 'delete'])->name('delete');
            });

             // portfolios Routes
             Route::group(['prefix' => 'portfolios', 'as' => 'portfolios.'], function(){
                Route::get('/', [ProjectsController::class, 'index'])->name('manage');
                Route::post('/add', [ProjectsController::class, 'add'])->name('add');
                Route::get('/view/{project}', [ProjectsController::class, 'view'])->name('view');
                Route::post('/update', [ProjectsController::class, 'update'])->name('update');
                // Route::post('/deactivate', [BrandsController::class, 'deactivate'])->name('deactivate');
                // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                Route::post('/delete', [ProjectsController::class, 'delete'])->name('delete');
            });

             // blogs Routes
             Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function(){
                Route::get('/', [BlogsController::class, 'index'])->name('manage');
                // Route::get('/view/{brand}', [BrandsController::class, 'view'])->name('view');
                // Route::post('/save', [BrandsController::class, 'create'])->name('create');
                // Route::post('/update', [BrandsController::class, 'update'])->name('update');
                // Route::post('/deactivate', [BrandsController::class, 'deactivate'])->name('deactivate');
                // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                // Route::post('/delete', [BrandsController::class, 'delete'])->name('delete');
            });

             // testimonials Routes
             Route::group(['prefix' => 'testimonials', 'as' => 'testimonials.'], function(){
                Route::get('/', [TestimonialsController::class, 'index'])->name('manage');
                Route::post('/add', [TestimonialsController::class, 'add'])->name('add');
                Route::get('/view/{project}', [TestimonialsController::class, 'view'])->name('view');
                Route::post('/update', [TestimonialsController::class, 'update'])->name('update');
                // Route::post('/deactivate', [BrandsController::class, 'deactivate'])->name('deactivate');
                // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                Route::post('/delete', [TestimonialsController::class, 'delete'])->name('delete');
            });

             // services Routes
             Route::group(['prefix' => 'services', 'as' => 'services.'], function(){
                Route::get('/', [ServicesController::class, 'index'])->name('manage');
                // Route::get('/view/{brand}', [BrandsController::class, 'view'])->name('view');
                Route::post('/add', [ServicesController::class, 'add'])->name('add');
                Route::get('/view/{service}', [ServicesController::class, 'view'])->name('view');
                Route::post('/update', [ServicesController::class, 'update'])->name('update');
                // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                Route::post('/delete', [ServicesController::class, 'delete'])->name('delete');
            });
             // partners Routes
             Route::group(['prefix' => 'partners', 'as' => 'partners.'], function(){
                Route::get('/', [PartnersController::class, 'index'])->name('manage');
                // Route::get('/view/{brand}', [BrandsController::class, 'view'])->name('view');
                Route::post('/add', [PartnersController::class, 'add'])->name('add');
                Route::get('/view/{partner}', [PartnersController::class, 'view'])->name('view');
                Route::post('/update', [PartnersController::class, 'update'])->name('update');
                // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                Route::post('/delete', [PartnersController::class, 'delete'])->name('delete');
            });
             // faq Routes
             Route::group(['prefix' => 'faqs', 'as' => 'faqs.'], function(){
                Route::get('/', [FAQController::class, 'index'])->name('manage');
                // Route::get('/view/{brand}', [BrandsController::class, 'view'])->name('view');
                Route::post('/add', [FAQController::class, 'add'])->name('add');
                Route::get('/view/{faq}', [FAQController::class, 'view'])->name('view');
                Route::post('/update', [FAQController::class, 'update'])->name('update');
                // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                Route::post('/delete', [fAQController::class, 'delete'])->name('delete');
            });
             // about Routes
             Route::group(['prefix' => 'about', 'as' => 'about.'], function(){
                Route::get('/', [AboutUsController::class, 'index'])->name('manage');
                Route::post('/add', [AboutUsController::class, 'add'])->name('add');
                Route::post('/update', [AboutUsController::class, 'update'])->name('update');
            });
            // blogs Routes
            Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function(){
                Route::get('/', [BlogsController::class, 'index'])->name('manage');
                // Route::get('/view/{brand}', [BrandsController::class, 'view'])->name('view');
                Route::get('/add', [BlogsController::class, 'add'])->name('add');
                Route::post('/create', [BlogsController::class, 'create'])->name('create');
                Route::get('/view/{blog}', [BlogsController::class, 'view'])->name('view');
                Route::post('/update', [BlogsController::class, 'update'])->name('update');
                Route::get('/edit/{code}', [BlogsController::class, 'edit'])->name('edit');
                Route::post('/delete', [BlogsController::class, 'delete'])->name('delete');
            });
            //categories routes
            Route::group(['prefix' => 'categories', 'as' => 'categories.'], function(){
                Route::get('/', [BlogCategoryController::class, 'index'])->name('manage');
                // Route::get('/view/{brand}', [BrandsController::class, 'view'])->name('view');
                Route::post('/add', [BlogCategoryController::class, 'create'])->name('add');
                // Route::post('/create', [BlogsController::class, 'create'])->name('create');
                Route::get('/view/{category}', [BlogCategoryController::class, 'view'])->name('view');
                Route::post('/update', [BlogCategoryController::class, 'update'])->name('update');
                // // Route::post('/activate', [BrandsController::class, 'activate'])->name('activate');
                Route::post('/delete', [BlogCategoryController::class, 'delete'])->name('delete');
            });
        });
    });
});
