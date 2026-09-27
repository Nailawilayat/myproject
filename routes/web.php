<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentPanelController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $pricings = \App\Models\Pricing::all();

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


Route::match(['get', 'post'], '/logout', [StudentController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| LOGIN REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/login-redirect', function () {

    $url = request('url');

    if ($url) {

        session()->put(
            'intended_url',
            $url
        );

    }

    return redirect()->route('login');

})->name('login.redirect');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
|
| Admin middleware protects all admin routes.
|
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['admin'])
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminController::class, 'dashboard']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/students',
            [AdminController::class, 'students']
        )->name('students');


        Route::get(
            '/students/enrolled',
            [AdminController::class, 'enrolledStudents']
        )->name('students.enrolled');


      


        Route::delete(
            '/students/{id}',
            [AdminController::class, 'deleteStudent']
        )->name('students.delete');


        Route::get(
            '/students/create',
            [AdminController::class, 'createStudent']
        )->name('students.create');


        Route::post(
            '/students',
            [AdminController::class, 'storeStudent']
        )->name('students.store');


        Route::get(
            '/students/manage',
            [AdminController::class, 'manageStudentAccount']
        )->name('students.manage');


        Route::put(
            '/students/manage',
            [AdminController::class, 'updateStudentAccount']
        )->name('students.manage.update');


        /*
        |--------------------------------------------------------------------------
        | Teachers
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/teachers',
            [AdminController::class, 'teachers']
        )->name('teachers');


        Route::get(
            '/teachers/create',
            [AdminController::class, 'createTeacher']
        )->name('teachers.create');


        Route::post(
            '/teachers',
            [AdminController::class, 'storeTeacher']
        )->name('teachers.store');


        Route::delete(
            '/teachers/{id}',
            [AdminController::class, 'deleteTeacher']
        )->name('teachers.delete');


        Route::get(
            '/teachers/assigned-courses',
            [AdminController::class, 'assignedCourses']
        )->name('teachers.assigned');


        Route::get(
            '/teachers/manage',
            [AdminController::class, 'manageTeacherAccount']
        )->name('teachers.manage');


        Route::put(
            '/teachers/manage',
            [AdminController::class, 'updateTeacherAccount']
        )->name('teachers.manage.update');


        /*
        |--------------------------------------------------------------------------
        | Courses
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/courses',
            [AdminController::class, 'courses']
        )->name('courses');


        Route::get(
            '/courses/create',
            [AdminController::class, 'createCourse']
        )->name('courses.create');


        Route::post(
            '/courses',
            [AdminController::class, 'storeCourse']
        )->name('courses.store');


        Route::delete(
            '/courses/{id}',
            [AdminController::class, 'deleteCourse']
        )->name('courses.delete');


        Route::get(
            '/courses/curriculum',
            [AdminController::class, 'curriculum']
        )->name('courses.curriculum');


        Route::get(
            '/courses/students',
            [AdminController::class, 'courseStudents']
        )->name('courses.students');


        Route::get(
            '/courses/{courseId}/curriculum/create',
            [AdminController::class, 'createCurriculumItem']
        )->name('curriculum.create');


        Route::post(
            '/courses/{courseId}/curriculum',
            [AdminController::class, 'storeCurriculumItem']
        )->name('curriculum.store');


        Route::delete(
            '/curriculum/{id}',
            [AdminController::class, 'deleteCurriculumItem']
        )->name('curriculum.delete');


        /*
        |--------------------------------------------------------------------------
        | Books
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/books',
            [AdminController::class, 'books']
        )->name('books');


        Route::get(
            '/books/create',
            [AdminController::class, 'createBook']
        )->name('books.create');


        Route::post(
            '/books',
            [AdminController::class, 'storeBook']
        )->name('books.store');


        Route::delete(
            '/books/{id}',
            [AdminController::class, 'deleteBook']
        )->name('books.delete');


        /*
        |--------------------------------------------------------------------------
        | Users / Role Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/users',
            [AdminController::class, 'users']
        )->name('users');


        Route::put(
            '/users/{id}/role',
            [AdminController::class, 'updateRole']
        )->name('users.role');


        /*
        |--------------------------------------------------------------------------
        | Pricing
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/pricing',
            [AdminController::class, 'pricing']
        )->name('pricing');


        Route::get(
            '/pricing/create',
            [AdminController::class, 'createPricing']
        )->name('pricing.create');


        Route::post(
            '/pricing',
            [AdminController::class, 'storePricing']
        )->name('pricing.store');


        Route::get(
            '/pricing/{id}/edit',
            [AdminController::class, 'editPricing']
        )->name('pricing.edit');


        Route::put(
            '/pricing/{id}',
            [AdminController::class, 'updatePricing']
        )->name('pricing.update');


        Route::delete(
            '/pricing/{id}',
            [AdminController::class, 'deletePricing']
        )->name('pricing.delete');


        /*
        |--------------------------------------------------------------------------
        | Contact Messages
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/contact-messages',
            [AdminController::class, 'contactMessages']
        )->name('contact-messages');


        Route::delete(
            '/contact-messages/{contact}',
            [AdminController::class, 'destroyContact']
        )->name('contact-messages.destroy');


        /*
        |--------------------------------------------------------------------------
        | Certificates
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/certificates',
            [AdminController::class, 'certificates']
        )->name('certificates');


        Route::post(
            '/certificates',
            [AdminController::class, 'storeCertificate']
        )->name('certificates.store');


        Route::delete(
            '/certificates/{id}',
            [AdminController::class, 'deleteCertificate']
        )->name('certificates.delete');


        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/settings',
            [AdminController::class, 'settings']
        )->name('settings');


        Route::put(
            '/settings/account',
            [AdminController::class, 'updateAccount']
        )->name('settings.account');


      

    });


/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/

Route::middleware(['role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [TeacherController::class, 'dashboard']
        )->name('dashboard');


        Route::get(
            '/my-courses',
            [TeacherController::class, 'myCourses']
        )->name('courses');


        Route::get(
            '/my-students',
            [TeacherController::class, 'myStudents']
        )->name('students');


        Route::get(
            '/books',
            [TeacherController::class, 'books']
        )->name('books');


        Route::get(
            '/live-classes',
            [TeacherController::class, 'liveClasses']
        )->name('live-classes');


        Route::get(
            '/live-classes/create',
            [TeacherController::class, 'createLiveClass']
        )->name('live-classes.create');


        Route::post(
            '/live-classes',
            [TeacherController::class, 'storeLiveClass']
        )->name('live-classes.store');


        Route::delete(
            '/live-classes/{id}',
            [TeacherController::class, 'deleteLiveClass']
        )->name('live-classes.delete');

    });


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [StudentPanelController::class, 'dashboard']
        )->name('dashboard');


        Route::get(
            '/my-course',
            [StudentPanelController::class, 'myCourse']
        )->name('course');


        Route::get(
            '/books',
            [StudentPanelController::class, 'books']
        )->name('books');


        Route::get(
            '/live-classes',
            [StudentPanelController::class, 'liveClasses']
        )->name('live-classes');

    });


/*
|--------------------------------------------------------------------------
| BOOKS
|--------------------------------------------------------------------------
|
| Logged-in students/users can access books.
|
*/

Route::middleware('student.auth')->group(function () {

    Route::get(
        '/books',
        [BookController::class, 'index']
    )->name('books.index');


    Route::get(
        '/books/search',
        [BookController::class, 'search']
    )->name('books.search');


    Route::get(
        '/books/{slug}',
        [BookController::class, 'show']
    )->name('books.show');

});


/*
|--------------------------------------------------------------------------
| COURSES
|--------------------------------------------------------------------------
*/

Route::get(
    '/courses',
    [CourseController::class, 'index']
)->name('courses.index');


Route::get(
    '/courses/{slug}',
    [CourseController::class, 'show']
)->name('courses.show');


/*
|--------------------------------------------------------------------------
| LESSON PDF
|--------------------------------------------------------------------------
*/

Route::middleware('student.auth')->group(function () {

    Route::get(
        '/lesson-pdf/{file}',
        function ($file) {

            $path = public_path(
                'pdfs/' . $file
            );

            if (!file_exists($path)) {

                abort(404);

            }

            return response()->file($path);

        }
    )->name('lesson.pdf');

});


/*
|--------------------------------------------------------------------------
| COURSE REVIEW
|--------------------------------------------------------------------------
*/

Route::post(
    '/course-review',
    [CourseController::class, 'review']
)->name('course.review');


/*
|--------------------------------------------------------------------------
| PRICING
|--------------------------------------------------------------------------
*/

Route::get(
    '/pricing',
    [PricingController::class, 'index']
)->name('pricing');


/*
|--------------------------------------------------------------------------
| BLOG
|--------------------------------------------------------------------------
*/

Route::get(
    '/blog',
    [BlogController::class, 'index']
)->name('blog.index');


Route::get(
    '/blog/search',
    [BlogController::class, 'search']
)->name('blog.search');


Route::get(
    '/blog/{slug}',
    [BlogController::class, 'show']
)->name('blog.show');