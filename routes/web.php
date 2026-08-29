<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Models\Pricing;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $pricings = Pricing::all();

    return view('welcome', compact('pricings'));

})->name('home');


/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/apply', function () {
    return view('apply');
})->name('apply');

Route::get('/about', [AboutController::class, 'index'])
    ->name('about');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [StudentController::class, 'store'])
    ->name('register.store');

Route::get('/login', [StudentController::class, 'loginPage'])
    ->name('login');

Route::post('/login', [StudentController::class, 'loginSubmit'])
    ->name('login.post');

Route::get('/logout', [StudentController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| LOGIN REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/login-redirect', function () {

    $url = request('url');

    if ($url) {
        session()->put('intended_url', $url);
    }

    return redirect()->route('login');

})->name('login.redirect');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
|
| Only authenticated users with admin role can access these routes.
|
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        // Courses Management
        Route::resource('courses', CourseController::class);

        // Books Management
        Route::resource('books', BookController::class);
    });


/*
|--------------------------------------------------------------------------
| BOOKS
|--------------------------------------------------------------------------
|
| Books are accessible only to logged-in students/users.
|
*/

Route::middleware('student.auth')->group(function () {

    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::get('/books/{slug}', [BookController::class, 'show'])
        ->name('books.show');

    Route::get('/books/search', [BookController::class, 'search'])
        ->name('books.search');
});


/*
|--------------------------------------------------------------------------
| COURSES
|--------------------------------------------------------------------------
*/

Route::get('/courses', [CourseController::class, 'index'])
    ->name('courses.index');

Route::get('/courses/{slug}', [CourseController::class, 'show'])
    ->name('courses.show');


/*
|--------------------------------------------------------------------------
| LESSON PDF
|--------------------------------------------------------------------------
|
| Only logged-in students/users can access lesson PDFs.
|
*/

Route::middleware('student.auth')->group(function () {

    Route::get('/lesson-pdf/{file}', function ($file) {

        $path = public_path('pdfs/' . $file);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);

    })->name('lesson.pdf');

});


/*
|--------------------------------------------------------------------------
| COURSE REVIEW
|--------------------------------------------------------------------------
*/

Route::post('/course-review', [CourseController::class, 'review'])
    ->name('course.review');


/*
|--------------------------------------------------------------------------
| PRICING
|--------------------------------------------------------------------------
*/

Route::get('/pricing', [PricingController::class, 'index'])
    ->name('pricing');


/*
|--------------------------------------------------------------------------
| BLOG
|--------------------------------------------------------------------------
*/

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/search', [BlogController::class, 'search'])
    ->name('blog.search');

Route::get('/blog/{slug}', [BlogController::class, 'show'])
    ->name('blog.show');