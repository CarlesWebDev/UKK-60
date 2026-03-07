<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, StudentController};

Route::get('/auth-redirect', function () {
    $intendedUrl = session()->get('url.intended');

    if ($intendedUrl && str_contains($intendedUrl, '/admin')) {
        return redirect()->route('admin.login.form');
    }
    return redirect()->route('student.login.form');
})->name('login');



// Guest Login
Route::view('/', 'LandingPage');

Route::get('/admin/login', [AdminController::class, 'ShowLoginForm'])->name('admin.login.index');
Route::get('/admin/Login', [AdminController::class, 'ShowLoginForm'])->name('admin.login.form');
Route::post('/Login', [AdminController::class, 'Login'])->name('admin.login');

Route::get('/student/login', [StudentController::class, 'showLoginStudent'])->name('student.login.form');
Route::post('/student/Login', [StudentController::class, 'Login'])->name('student.login');


// Student
Route::middleware('auth:student')->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/createaspiration', [StudentController::class, 'createaspiration'])->name('create.aspiration');
    Route::post('/storeaspirations', [StudentController::class, 'storeaspirations'])->name('storeaspirations');
    Route::delete('/aspirations/{id}', [StudentController::class, 'deleteaspirations'])->name('delete.aspirations');
    Route::get('/aspirations/{id}/edit', [StudentController::class, 'editaspiration'])->name('edit.aspiration');
    Route::put('/aspirations/{id}', [StudentController::class, 'updateaspiration'])->name('update.aspiration');
    Route::get('/aspirations/{id}', [StudentController::class, 'showhistoryaspirations'])->name('show.history.aspiration');
    Route::get('/history', [StudentController::class, 'history'])->name('history');
    Route::post('/logout', [StudentController::class, 'logout'])->name('logout');
});


// Admin
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/user-management', [AdminController::class, 'UserManagement'])->name('user.management');

    Route::get('/createstudents', [AdminController::class, 'createstudent'])->name('create.student');
    Route::post('/students', [AdminController::class, 'storestudent'])->name('store.student');
    Route::get('/students/{id}/edit', [AdminController::class, 'editstudent'])->name('edit.student');
    Route::put('/students/{id}', [AdminController::class, 'updatestudent'])->name('update.student');
    Route::delete('/students/{id}', [AdminController::class, 'deletestudent'])->name('delete.student');


    Route::get('/category-management', [AdminController::class, 'CategoryManagement'])->name('category.management');
    Route::post('/categories', [AdminController::class, 'storecategory'])->name('store.category');
    Route::get('/categories/create', [AdminController::class, 'createcategory'])->name('create.category');
    Route::put('/categories/{id}', [AdminController::class, 'updatecategory'])->name('update.category');
    route::delete('/categories/{id}', [AdminController::class, 'deletecategory'])->name('delete.category');


    Route::get('/aspirations-management', [AdminController::class, 'ManagementAspirations'])->name('management.aspiration');
    Route::get('/aspirations/{id}', [AdminController::class, 'showaspirations'])->name('show.aspirations');
    Route::post('/management/aspirations/{id}/feedback', [AdminController::class, 'storeFeedback'])->name('aspirations.feedback');
    // Route::delete('/management/aspirations/{id}', [AdminController::class, 'deleteaspiration'])->name('delete.aspiration');
    Route::get('/history/aspirations/{id}', [AdminController::class, 'showhistoryaspiration'])->name('show.history.aspiration');

    Route::get('/history', [AdminController::class, 'history'])->name('history');


    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});







// Demo

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\{AdminController, StudentController};

// Route::get('/auth-redirect', function () {
//     $intendedUrl = session()->get('url.intended');

//     if ($intendedUrl && str_contains($intendedUrl, '/admin')) {
//         return redirect()->route('admin.login.form');
//     }
//     return redirect()->route('student.login.form');
// })->name('login');


// // Guest Login
// Route::view('/', 'LandingPage');

// Route::get('/admin/login', [AdminController::class, 'ShowLoginForm'])->name('admin.login.index');
// Route::get('/admin/Login', [AdminController::class, 'ShowLoginForm'])->name('admin.login.form');
// Route::post('/Login', [AdminController::class, 'Login'])->name('admin.login');

// Route::get('/student/login', [StudentController::class, 'showLoginStudent'])->name('student.login.form');
// Route::post('/student/Login', [StudentController::class, 'Login'])->name('student.login');


// // Student (DEMO VERSION: No Middleware)
// Route::prefix('student')->name('student.')->group(function () {
//     Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
//     Route::get('/createaspiration', [StudentController::class, 'createaspiration'])->name('create.aspiration');
//     Route::post('/storeaspirations', [StudentController::class, 'storeaspirations'])->name('storeaspirations');
//     Route::delete('/aspirations/{id}', [StudentController::class, 'deleteaspirations'])->name('delete.aspirations');
//     Route::get('/history', [StudentController::class, 'history'])->name('history');
//     Route::post('/logout', [StudentController::class, 'logout'])->name('logout');
// });


// // Admin (DEMO VERSION: No Middleware)
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//     Route::get('/user-management', [AdminController::class, 'UserManagement'])->name('user.management');

//     Route::get('/createstudents', [AdminController::class, 'createstudent'])->name('create.student');
//     Route::post('/students', [AdminController::class, 'storestudent'])->name('store.student');
//     Route::get('/students/{id}/edit', [AdminController::class, 'editstudent'])->name('edit.student');
//     Route::put('/students/{id}', [AdminController::class, 'updatestudent'])->name('update.student');
//     Route::delete('/students/{id}', [AdminController::class, 'deletestudent'])->name('delete.student');

//     Route::get('/category-management', [AdminController::class, 'CategoryManagement'])->name('category.management');
//     Route::post('/categories', [AdminController::class, 'storecategory'])->name('store.category');
//     Route::get('/categories/create', [AdminController::class, 'createcategory'])->name('create.category');
//     Route::put('/categories/{id}', [AdminController::class, 'updatecategory'])->name('update.category');
//     Route::delete('/categories/{id}', [AdminController::class, 'deletecategory'])->name('delete.category');

//     Route::get('/aspirations-management', [AdminController::class, 'ManagementAspirations'])->name('management.aspiration');

//     Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
// });
