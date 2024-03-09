<?php

use App\Http\Controllers\Admin\{
    AdminController,
    UserController,
    ACL\PermissionController,
    ACL\RoleController,
    AgencyController,
    CategoryController,
    ChangelogController,
    ClientController,
    ClientFunnelController,
    DifferentialController,
    ExperienceController,
    PropertyController,
    StepController,
    TypeController,
};
use App\Http\Controllers\Web\{
    ContactController,
    FilterController,
    HomeController,
    PolicyController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.home');
    Route::prefix('admin')->name('admin.')->group(function () {
        /** Chart home */
        Route::get('/chart', [AdminController::class, 'chart'])->name('home.chart');

        /** Users */
        Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::resource('users', UserController::class)->except('show');

        /** Agencies */
        Route::resource('agencies', AgencyController::class)->except('show');

        /** Clients */
        Route::get('/clients/timeline/{id}', [ClientController::class, 'timeline']);
        Route::resource('clients', ClientController::class)->except('show');

        /** Clients Funnel */
        Route::post('clients-funnel-updateKanban', [ClientFunnelController::class, 'updateKanban'])->name('clients.updateKanban');

        Route::resource('clients-funnel', ClientFunnelController::class);

        /** Properties */
        Route::resource('properties', PropertyController::class)->except('show');
        Route::post('/properties/images-order', [PropertyController::class, 'imagesOrder'])->name('properties.images-order');
        Route::post('/properties/image-delete', [PropertyController::class, 'imageDelete'])->name('properties.image-delete');

        /** Steps */
        Route::resource('steps', StepController::class)->except('show');

        /** Categories */
        Route::resource('categories', CategoryController::class)->except('show');

        /** Types */
        Route::resource('types', TypeController::class)->except('show');

        /** Types */
        Route::resource('differentials', DifferentialController::class)->except('show');

        /** Experiences */
        Route::resource('experiences', ExperienceController::class)->except('show');

        /**
         * ACL
         * */
        /** Permissions */
        Route::resource('permission', PermissionController::class);

        /** Roles */
        Route::get('role/{role}/permission', [RoleController::class, 'permissions'])->name('role.permissions');
        Route::put('role/{role}/permission/sync', [RoleController::class, 'permissionsSync'])->name('role.permissionsSync');
        Route::resource('role', RoleController::class);

        /** Changelog */
        Route::get('/changelog', [ChangelogController::class, 'index'])->name('changelog');
    });
});

/** Web */
Route::group(['middleware' => ['log']], function () {
    Route::name('web.')->group(function () {
        /** Home */
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/contato', [ContactController::class, 'index'])->name('contact');
        Route::get('/politica-de-privacidade', [PolicyController::class, 'index'])->name('policy');
        Route::get('/quero-comprar', [FilterController::class, 'sale'])->name('sale');
        Route::get('/quero-alugar', [FilterController::class, 'rent'])->name('rent');
        Route::get('/experiencias/{slug}', [FilterController::class, 'experience'])->name('experience');
        Route::get('/filtro', [FilterController::class, 'filter'])->name('filter');

        /** Cookie */
        // Route::post("/cookie-consent", [CookieController::class, 'index'])->name('cookie.consent');
    });
});

Auth::routes([
    'register' => false,
]);
