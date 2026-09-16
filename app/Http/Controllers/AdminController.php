<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $studentsCount = DB::table('students')->count();

        $teachersCount = DB::table('teachers')->count();

        $coursesCount = DB::table('courses')->count();

        $booksCount = DB::table('books')->count();

        return view(
            'admin.dashboard',
            compact(
                'studentsCount',
                'teachersCount',
                'coursesCount',
                'booksCount'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENTS
    |--------------------------------------------------------------------------
    */

    public function students()
    {
        $students = DB::table('students')
            ->latest()
            ->get();

        return view(
            'admin.students.index',
            compact('students')
        );
    }


    public function enrolledStudents()
    {
        $students = DB::table('students')
            ->whereNotNull('course')
            ->latest()
            ->get();

        return view(
            'admin.students.enrolled',
            compact('students')
        );
    }


   public function applications()
{
    $students = DB::table('students')
        ->whereNull('course')
        ->latest()
        ->get();

    return view(
        'admin.students.applications',
        compact('students')
    );
}


    /*
    |--------------------------------------------------------------------------
    | DELETE STUDENT
    |--------------------------------------------------------------------------
    */

    public function deleteStudent($id)
    {
        $student = DB::table('students')
            ->where('id', $id)
            ->first();

        if (!$student) {
            return back()->with(
                'error',
                'Student not found.'
            );
        }

        DB::table('students')
            ->where('id', $id)
            ->delete();

        return back()->with(
            'success',
            'Student deleted successfully.'
        );
    }
/*
    |--------------------------------------------------------------------------
    | ADD STUDENTS
    |--------------------------------------------------------------------------
    */
public function createStudent()
{
    return view('admin.students.create');
}

public function storeStudent(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'regex:/^[a-zA-Z\s]+$/',
            'max:255'
        ],
        'email' => [
            'required',
            'email',
            'unique:students,email',
            'max:255'
        ],
        'password' => [
            'required',
            'string',
            'min:6',
            'confirmed'
        ],
        'phone' => [
            'required',
            'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'
        ],
        'gender' => [
            'required',
            'string',
            'in:male,female,other'
        ],
        'course' => [
            'nullable',
            'string',
            'max:255'
        ],
        'guardian_name' => [
            'nullable',
            'string',
            'regex:/^[a-zA-Z\s]+$/',
            'max:255'
        ],
        'guardian_phone' => [
            'nullable',
            'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'
        ],
        'address' => [
            'nullable',
            'string',
            'max:500'
        ],
        'city' => [
            'nullable',
            'string',
            'regex:/^[a-zA-Z\s]+$/',
            'max:100'
        ],
        'country' => [
            'nullable',
            'string',
            'regex:/^[a-zA-Z\s]+$/',
            'max:100'
        ],
        'note' => [
            'nullable',
            'string',
            'max:1000'
        ],
    ], [
        'name.required' => 'Name is required',
        'name.regex' => 'Name must contain only letters',
        'email.required' => 'Email is required',
        'email.unique' => 'This email is already registered',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',
        'password.confirmed' => 'Passwords do not match',
        'phone.required' => 'Phone is required',
        'phone.regex' => 'Enter a valid phone number',
        'gender.required' => 'Please select gender',
    ]);

    $cleanPhone = preg_replace('/[^0-9+]/', '', $validated['phone']);

    $cleanGuardianPhone = !empty($validated['guardian_phone'])
        ? preg_replace('/[^0-9+]/', '', $validated['guardian_phone'])
        : null;

    DB::table('students')->insert([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'user',
        'phone' => $cleanPhone,
        'gender' => $validated['gender'],
        'course' => $validated['course'] ?? null,
        'guardian_name' => $validated['guardian_name'] ?? null,
        'guardian_phone' => $cleanGuardianPhone,
        'address' => $validated['address'] ?? null,
        'city' => $validated['city'] ?? null,
        'country' => $validated['country'] ?? null,
        'note' => $validated['note'] ?? null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('admin.students')
        ->with('success', 'Student added successfully.');
}
    /*
    |--------------------------------------------------------------------------
    | TEACHERS
    |--------------------------------------------------------------------------
    */

    public function teachers()
    {
        $teachers = DB::table('teachers')
            ->latest()
            ->get();

        return view(
            'admin.teachers.index',
            compact('teachers')
        );
    }


    public function createTeacher()
    {
        return view('admin.teachers.create');
    }


    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:teachers,email',

            'password' => 'required|min:6|confirmed',
        ]);


        DB::table('teachers')->insert([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'created_at' => now(),

            'updated_at' => now(),

        ]);


        return redirect()
            ->route('admin.teachers')
            ->with(
                'success',
                'Teacher added successfully.'
            );
    }
public function assignedCourses()
{
    $teachers = DB::table('teachers')->latest()->get();

    $allCourses = DB::table('courses')->get();

    $teachersWithCourses = $teachers->map(function ($teacher) use ($allCourses) {

        $teacherNameClean = strtolower(trim($teacher->name));

        $courses = $allCourses->filter(function ($course) use ($teacherNameClean) {

            $courseTeacherClean = strtolower(trim($course->teacher ?? ''));

            return $courseTeacherClean === $teacherNameClean;

        })->values();

        $teacher->courses = $courses;

        return $teacher;

    });

    return view(
        'admin.teachers.assigned',
        ['teachers' => $teachersWithCourses]
    );
}
    /*
    |--------------------------------------------------------------------------
    | DELETE TEACHER
    |--------------------------------------------------------------------------
    */

    public function deleteTeacher($id)
    {
        $teacher = DB::table('teachers')
            ->where('id', $id)
            ->first();

        if (!$teacher) {
            return back()->with(
                'error',
                'Teacher not found.'
            );
        }

        DB::table('teachers')
            ->where('id', $id)
            ->delete();

        return back()->with(
            'success',
            'Teacher deleted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | COURSES
    |--------------------------------------------------------------------------
    */

    public function courses()
    {
        $courses = DB::table('courses')
            ->latest()
            ->get();

        return view(
            'admin.courses.index',
            compact('courses')
        );
    }


    public function createCourse()
    {
        return view('admin.courses.create');
    }
public function storeCourse(Request $request)
{
    $validated = $request->validate([

        'title' => 'required|string|max:255',
        'short_title' => 'nullable|string|max:255',
        'category' => 'nullable|string|max:255',
        'duration' => 'nullable|string|max:100',
        'level' => 'nullable|string|max:50',
        'language' => 'nullable|string|max:100',
        'status' => 'nullable|integer',
        'overview' => 'nullable|string',
        'teacher' => 'nullable|string|max:255',
        'teacher_designation' => 'nullable|string|max:255',
        'teacher_bio' => 'nullable|string',
        'featured' => 'nullable|boolean',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'teacher_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'lessons' => 'nullable|array',
        'lessons.*.title' => 'nullable|string|max:255',
        'lessons.*.pdf_file' => 'nullable|mimes:pdf|max:10240',

    ]);

    $slug = Str::slug($validated['title']);

    $imagePath = '';
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('courses/images', 'public');
    }

    $teacherImagePath = '';
    if ($request->hasFile('teacher_image')) {
        $teacherImagePath = $request->file('teacher_image')->store('courses/teachers', 'public');
    }

    $courseId = DB::table('courses')->insertGetId([

        'status' => $validated['status'] ?? 1,
        'title' => $validated['title'],
        'slug' => $slug,
        'short_title' => $validated['short_title'] ?? '',
        'image' => $imagePath,
        'overview' => $validated['overview'] ?? null,
        'teacher' => $validated['teacher'] ?? null,
        'teacher_designation' => $validated['teacher_designation'] ?? null,
        'teacher_bio' => $validated['teacher_bio'] ?? null,
        'teacher_image' => $teacherImagePath,
        'category' => $validated['category'] ?? null,
        'duration' => $validated['duration'] ?? null,
        'level' => $validated['level'] ?? null,
        'language' => $validated['language'] ?? null,
        'students' => 0,
        'lectures' => 0,
        'quizzes' => 0,
        'featured' => $request->has('featured') ? 1 : 0,
        'created_at' => now(),
        'updated_at' => now(),

    ]);

    /*
    |--------------------------------------------------------------------------
    | Save Lessons (Curriculum)
    |--------------------------------------------------------------------------
    */

    if ($request->has('lessons')) {

        foreach ($request->lessons as $index => $lesson) {

            if (empty($lesson['title'])) {
                continue;
            }

            $pdfPath = null;

            if ($request->hasFile("lessons.$index.pdf_file")) {
                $pdfPath = $request->file("lessons.$index.pdf_file")
                    ->store('courses/lessons', 'public');
            }

            DB::table('course_lessons')->insert([
                'course_id' => $courseId,
                'title' => $lesson['title'],
                'pdf' => $pdfPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }

    }

    return redirect()
        ->route('admin.courses')
        ->with('success', 'Course added successfully.');
}
    /*
    |--------------------------------------------------------------------------
    | DELETE COURSE
    |--------------------------------------------------------------------------
    */

    public function deleteCourse($id)
    {
        $course = DB::table('courses')
            ->where('id', $id)
            ->first();

        if (!$course) {
            return back()->with(
                'error',
                'Course not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Course Image
        |--------------------------------------------------------------------------
        */

        if (!empty($course->image)) {

            if (Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }

        }


        /*
        |--------------------------------------------------------------------------
        | Delete Teacher Image
        |--------------------------------------------------------------------------
        */

        if (!empty($course->teacher_image)) {

            if (Storage::disk('public')->exists($course->teacher_image)) {
                Storage::disk('public')->delete(
                    $course->teacher_image
                );
            }

        }


        /*
        |--------------------------------------------------------------------------
        | Delete Course
        |--------------------------------------------------------------------------
        */

        DB::table('courses')
            ->where('id', $id)
            ->delete();


        return back()->with(
            'success',
            'Course deleted successfully.'
        );
    }


    public function curriculum()
    {
        $courses = DB::table('courses')
            ->latest()
            ->get();

        return view(
            'admin.courses.curriculum',
            compact('courses')
        );
    }


    public function courseStudents()
    {
        $students = DB::table('students')
            ->whereNotNull('course')
            ->latest()
            ->get();

        return view(
            'admin.courses.students',
            compact('students')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BOOKS
    |--------------------------------------------------------------------------
    */

    public function books()
    {
        $books = DB::table('books')
            ->latest()
            ->get();

        return view(
            'admin.books.index',
            compact('books')
        );
    }


    public function createBook()
    {
        return view('admin.books.create');
    }


    public function storeBook(Request $request)
    {
        $validated = $request->validate([

            'title' =>
                'required|string|max:255',

            'author' =>
                'nullable|string|max:255',

            'category' =>
                'nullable|string|max:255',

            'image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'pdf' =>
                'nullable|mimes:pdf|max:10240',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug(
            $validated['title']
        );


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'books/images',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Upload PDF
        |--------------------------------------------------------------------------
        */

        $pdfPath = null;

        if ($request->hasFile('pdf')) {

            $pdfPath = $request
                ->file('pdf')
                ->store(
                    'books/pdfs',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Save Book
        |--------------------------------------------------------------------------
        */

        DB::table('books')->insert([

            'title' =>
                $validated['title'],

            'slug' =>
                $slug,

            'image' =>
                $imagePath,

            'category' =>
                $validated['category'] ?? null,

            'pdf' =>
                $pdfPath,

            'author' =>
                $validated['author'] ?? null,

            'created_at' =>
                now(),

            'updated_at' =>
                now(),

        ]);


        return redirect()
            ->route('admin.books')
            ->with(
                'success',
                'Book added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE BOOK
    |--------------------------------------------------------------------------
    */

    public function deleteBook($id)
    {
        $book = DB::table('books')
            ->where('id', $id)
            ->first();

        if (!$book) {
            return back()->with(
                'error',
                'Book not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Book Image
        |--------------------------------------------------------------------------
        */

        if (!empty($book->image)) {

            if (Storage::disk('public')->exists($book->image)) {

                Storage::disk('public')->delete(
                    $book->image
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Delete Book PDF
        |--------------------------------------------------------------------------
        */

        if (!empty($book->pdf)) {

            if (Storage::disk('public')->exists($book->pdf)) {

                Storage::disk('public')->delete(
                    $book->pdf
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Delete Book From Database
        |--------------------------------------------------------------------------
        */

        DB::table('books')
            ->where('id', $id)
            ->delete();


        return back()->with(
            'success',
            'Book deleted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USERS / ROLE MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function users()
    {
        $students = DB::table('students')
            ->latest()
            ->get();

        return view(
            'admin.users.index',
            compact('students')
        );
    }


    public function updateRole(
        Request $request,
        $id
    ) {
        $request->validate([
            'role' =>
                'required|in:user,teacher,admin',
        ]);


        DB::table('students')
            ->where('id', $id)
            ->update([
                'role' => $request->role,
                'updated_at' => now(),
            ]);


        return back()->with(
            'success',
            'User role updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | OTHER ADMIN PAGES
    |--------------------------------------------------------------------------
    */

public function pricing()
{
    $pricings = DB::table('pricings')
        ->orderBy('sort_order')
        ->get();

    return view(
        'admin.pricing',
        compact('pricings')
    );
}


public function createPricing()
{
    return view('admin.pricing-create');
}


public function storePricing(Request $request)
{
    $validated = $request->validate([
        'plan_name' => 'required|string|max:255',
        'days_per_week' => 'required|integer|min:1|max:7',
        'days_per_week_text' => 'nullable|string|max:255',
        'free_trial_days' => 'nullable|integer|min:0',
        'minutes_per_day' => 'nullable|integer|min:0',
        'age_gender' => 'nullable|string|max:255',
        'support' => 'nullable|string|max:255',
        'class_type' => 'nullable|string|max:255',
        'sort_order' => 'nullable|integer',
    ]);

    DB::table('pricings')->insert([
        'plan_name' => $validated['plan_name'],
        'days_per_week' => $validated['days_per_week'],
        'days_per_week_text' => $validated['days_per_week_text'] ?? null,
        'free_trial_days' => $validated['free_trial_days'] ?? 0,
        'minutes_per_day' => $validated['minutes_per_day'] ?? 0,
        'age_gender' => $validated['age_gender'] ?? null,
        'support' => $validated['support'] ?? null,
        'class_type' => $validated['class_type'] ?? null,
        'sort_order' => $validated['sort_order'] ?? 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('admin.pricing')
        ->with('success', 'Pricing plan added successfully.');
}


public function editPricing($id)
{
    $plan = DB::table('pricings')
        ->where('id', $id)
        ->first();

    if (!$plan) {
        return redirect()
            ->route('admin.pricing')
            ->with('error', 'Pricing plan not found.');
    }

    return view(
        'admin.pricing-edit',
        compact('plan')
    );
}


public function updatePricing(Request $request, $id)
{
    $validated = $request->validate([
        'plan_name' => 'required|string|max:255',
        'days_per_week' => 'required|integer|min:1|max:7',
        'days_per_week_text' => 'nullable|string|max:255',
        'free_trial_days' => 'nullable|integer|min:0',
        'minutes_per_day' => 'nullable|integer|min:0',
        'age_gender' => 'nullable|string|max:255',
        'support' => 'nullable|string|max:255',
        'class_type' => 'nullable|string|max:255',
        'sort_order' => 'nullable|integer',
    ]);

    DB::table('pricings')
        ->where('id', $id)
        ->update([
            'plan_name' => $validated['plan_name'],
            'days_per_week' => $validated['days_per_week'],
            'days_per_week_text' => $validated['days_per_week_text'] ?? null,
            'free_trial_days' => $validated['free_trial_days'] ?? 0,
            'minutes_per_day' => $validated['minutes_per_day'] ?? 0,
            'age_gender' => $validated['age_gender'] ?? null,
            'support' => $validated['support'] ?? null,
            'class_type' => $validated['class_type'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('admin.pricing')
        ->with('success', 'Pricing plan updated successfully.');
}


public function deletePricing($id)
{
    $plan = DB::table('pricings')
        ->where('id', $id)
        ->first();

    if (!$plan) {
        return back()->with('error', 'Pricing plan not found.');
    }

    DB::table('pricings')
        ->where('id', $id)
        ->delete();

    return back()->with('success', 'Pricing plan deleted successfully.');
}


   public function contactMessages()
{
    $contacts = Contact::latest()->get();

    return view('admin.contact.index', compact('contacts'));
}


    public function aboutContent()
    {
        return view('admin.about.content');
    }
public function destroyContact(Contact $contact)
{
    $contact->delete();

    return redirect()->route('admin.contact-messages')
        ->with('success', 'Message deleted successfully.');
}
  public function certificates()
{
    $certificates = DB::table('certificates')
        ->latest()
        ->get();

    return view(
        'admin.certificates.index',
        compact('certificates')
    );
}

public function storeCertificate(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('images'), $filename);

    DB::table('certificates')->insert([
        'title' => $validated['title'],
        'image' => 'images/' . $filename,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('admin.about.certificates')
        ->with('success', 'Certificate added successfully.');
}


public function deleteCertificate($id)
{
    $certificate = DB::table('certificates')
        ->where('id', $id)
        ->first();

    if (!$certificate) {
        return back()->with('error', 'Certificate not found.');
    }

    $filePath = public_path($certificate->image);

    if (!empty($certificate->image) && file_exists($filePath)) {
        unlink($filePath);
    }

    DB::table('certificates')
        ->where('id', $id)
        ->delete();

    return back()->with('success', 'Certificate deleted successfully.');
}
public function settings()
{
    $settings = DB::table('settings')->pluck('value', 'key');

    $admin = DB::table('admins')
        ->where('id', session('student_id'))
        ->first();

    $teachers = DB::table('teachers')->orderBy('name')->get();

    $students = DB::table('students')->orderBy('name')->get();

    return view(
        'admin.settings',
        compact('settings', 'admin', 'teachers', 'students')
    );
}

public function updateAccount(Request $request)
{
    $admin = DB::table('admins')
        ->where('id', session('student_id'))
        ->first();

    if (!$admin) {
        return back()->with('error', 'Admin account not found.');
    }

    $validated = $request->validate([
        'email' => 'required|email|unique:admins,email,' . $admin->id,
        'current_password' => 'required',
        'new_password' => 'nullable|min:6|confirmed',
    ]);

    if (!Hash::check($validated['current_password'], $admin->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $updateData = [
        'email' => $validated['email'],
        'updated_at' => now(),
    ];

    if (!empty($validated['new_password'])) {
        $updateData['password'] = Hash::make($validated['new_password']);
    }

    DB::table('admins')
        ->where('id', $admin->id)
        ->update($updateData);

    session(['student_email' => $validated['email']]);

    return back()->with('success', 'Account updated successfully.');
}


public function updateGeneralSettings(Request $request)
{
    $validated = $request->validate([
        'site_name' => 'required|string|max:255',
        'contact_email' => 'nullable|email|max:255',
        'contact_phone' => 'nullable|string|max:50',
        'address' => 'nullable|string|max:500',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $this->saveSetting('site_name', $validated['site_name']);
    $this->saveSetting('contact_email', $validated['contact_email'] ?? '');
    $this->saveSetting('contact_phone', $validated['contact_phone'] ?? '');
    $this->saveSetting('address', $validated['address'] ?? '');

    if ($request->hasFile('logo')) {

        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('images'), $filename);

        $this->saveSetting('site_logo', 'images/' . $filename);
    }

    return back()->with('success', 'General settings updated successfully.');
}


private function saveSetting($key, $value)
{
    DB::table('settings')->updateOrInsert(
        ['key' => $key],
        [
            'value' => $value,
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );
}
public function manageTeacherAccount()
{
    $teachers = DB::table('teachers')->latest()->get();

    return view('admin.teachers.manage', compact('teachers'));
}

public function updateTeacherAccount(Request $request)
{
    $validated = $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'email' => 'required|email',
        'new_password' => 'nullable|min:6|confirmed',
    ]);

    $data = ['email' => $validated['email'], 'updated_at' => now()];

    if (!empty($validated['new_password'])) {
        $data['password'] = Hash::make($validated['new_password']);
    }

    DB::table('teachers')->where('id', $validated['teacher_id'])->update($data);

    return back()->with('success', 'Teacher account updated successfully.');
}

public function manageStudentAccount()
{
    $students = DB::table('students')->latest()->get();

    return view('admin.students.manage', compact('students'));
}

public function updateStudentAccount(Request $request)
{
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'email' => 'required|email',
        'new_password' => 'nullable|min:6|confirmed',
    ]);

    $data = ['email' => $validated['email'], 'updated_at' => now()];

    if (!empty($validated['new_password'])) {
        $data['password'] = Hash::make($validated['new_password']);
    }

    DB::table('students')->where('id', $validated['student_id'])->update($data);

    return back()->with('success', 'Student account updated successfully.');
}
}