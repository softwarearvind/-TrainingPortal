<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    /**
     * Display students.
     */
    public function index()
    {
        $students = Student::with([
            'user',
            'courses'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.students.index',
            compact('students')
        );
    }

    /**
     * Create student form.
     */
    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.students.create',
            compact('courses')
        );
    }

    /**
     * Store student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email',

            'password' => 'required|string|min:8|confirmed',

            'admission_no' => 'required|string|max:100|unique:students,admission_no',

            'phone' => 'nullable|string|max:20',

            'date_of_birth' => 'nullable|date',

            'gender' => 'nullable|in:male,female,other',

            'qualification' => 'nullable|string|max:255',

            'address' => 'nullable|string',

            'city' => 'nullable|string|max:100',

            'state' => 'nullable|string|max:100',

            'pincode' => 'nullable|string|max:10',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|boolean',

            'courses' => 'nullable|array',

            'courses.*' => 'exists:courses,id',
        ]);

        DB::transaction(function () use ($request, $validated) {

            /*
            |--------------------------------------------------------------------------
            | Create User
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'status' => $validated['status'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Assign Student Role
            |--------------------------------------------------------------------------
            */

            $studentRole = Role::firstOrCreate([
                'name' => 'Student',
                'guard_name' => 'web',
            ]);

            $user->assignRole($studentRole);

            /*
            |--------------------------------------------------------------------------
            | Upload Image
            |--------------------------------------------------------------------------
            */

            $imagePath = null;

            if ($request->hasFile('image')) {

                $directory = public_path(
                    'uploads/students'
                );

                if (!File::exists($directory)) {
                    File::makeDirectory(
                        $directory,
                        0755,
                        true
                    );
                }

                $imageName = time() . '_' .
                    Str::slug($validated['name']) . '.' .
                    $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(
                    $directory,
                    $imageName
                );

                $imagePath = 'uploads/students/' . $imageName;
            }

            /*
            |--------------------------------------------------------------------------
            | Create Student Profile
            |--------------------------------------------------------------------------
            */

            $student = Student::create([

                'user_id' => $user->id,

                'admission_no' =>
                    $validated['admission_no'],

                'phone' =>
                    $validated['phone'] ?? null,

                'date_of_birth' =>
                    $validated['date_of_birth'] ?? null,

                'gender' =>
                    $validated['gender'] ?? null,

                'qualification' =>
                    $validated['qualification'] ?? null,

                'address' =>
                    $validated['address'] ?? null,

                'city' =>
                    $validated['city'] ?? null,

                'state' =>
                    $validated['state'] ?? null,

                'pincode' =>
                    $validated['pincode'] ?? null,

                'image' => $imagePath,

                'status' =>
                    $validated['status'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Course Enrollment
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['courses'])) {

                $enrollments = [];

                foreach ($validated['courses'] as $courseId) {

                    $enrollments[$courseId] = [
                        'enrolled_at' => now(),
                    ];
                }

                $student->courses()->sync(
                    $enrollments
                );
            }
        });

        return redirect()
            ->route('super-admin.students.index')
            ->with(
                'success',
                'Student created successfully.'
            );
    }

    /**
     * Edit student.
     */
    public function edit(Student $student)
    {
        $student->load([
            'user',
            'courses'
        ]);

        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $studentCourseIds = $student
            ->courses
            ->pluck('id')
            ->toArray();

        return view(
            'super-admin.students.edit',
            compact(
                'student',
                'courses',
                'studentCourseIds'
            )
        );
    }

    /**
     * Update student.
     */
    public function update(
        Request $request,
        Student $student
    ) {
        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' =>
                'required|email|max:255|unique:users,email,' .
                $student->user_id,

            'admission_no' =>
                'required|string|max:100|unique:students,admission_no,' .
                $student->id,

            'phone' => 'nullable|string|max:20',

            'date_of_birth' => 'nullable|date',

            'gender' =>
                'nullable|in:male,female,other',

            'qualification' =>
                'nullable|string|max:255',

            'address' =>
                'nullable|string',

            'city' =>
                'nullable|string|max:100',

            'state' =>
                'nullable|string|max:100',

            'pincode' =>
                'nullable|string|max:10',

            'image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' =>
                'required|boolean',

            'courses' =>
                'nullable|array',

            'courses.*' =>
                'exists:courses,id',
        ]);

        DB::transaction(function () use (
            $request,
            $validated,
            $student
        ) {

            /*
            |--------------------------------------------------------------------------
            | Update User
            |--------------------------------------------------------------------------
            */

            $student->user->update([
                'name' =>
                    $validated['name'],

                'email' =>
                    $validated['email'],

                'status' =>
                    $validated['status'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Image
            |--------------------------------------------------------------------------
            */

            $imagePath = $student->image;

            if ($request->hasFile('image')) {

                if (
                    $imagePath &&
                    File::exists(public_path($imagePath))
                ) {
                    File::delete(
                        public_path($imagePath)
                    );
                }

                $directory =
                    public_path('uploads/students');

                if (!File::exists($directory)) {

                    File::makeDirectory(
                        $directory,
                        0755,
                        true
                    );
                }

                $imageName =
                    time() . '_' .
                    Str::slug($validated['name']) . '.' .
                    $request->file('image')
                        ->getClientOriginalExtension();

                $request->file('image')->move(
                    $directory,
                    $imageName
                );

                $imagePath =
                    'uploads/students/' . $imageName;
            }

            /*
            |--------------------------------------------------------------------------
            | Update Student
            |--------------------------------------------------------------------------
            */

            $student->update([

                'admission_no' =>
                    $validated['admission_no'],

                'phone' =>
                    $validated['phone'] ?? null,

                'date_of_birth' =>
                    $validated['date_of_birth'] ?? null,

                'gender' =>
                    $validated['gender'] ?? null,

                'qualification' =>
                    $validated['qualification'] ?? null,

                'address' =>
                    $validated['address'] ?? null,

                'city' =>
                    $validated['city'] ?? null,

                'state' =>
                    $validated['state'] ?? null,

                'pincode' =>
                    $validated['pincode'] ?? null,

                'image' =>
                    $imagePath,

                'status' =>
                    $validated['status'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Sync Courses
            |--------------------------------------------------------------------------
            */

            $enrollments = [];

            foreach (
                ($validated['courses'] ?? [])
                as $courseId
            ) {

                $enrollments[$courseId] = [
                    'enrolled_at' => now(),
                ];
            }

            $student->courses()->sync(
                $enrollments
            );
        });

        return redirect()
            ->route('super-admin.students.index')
            ->with(
                'success',
                'Student updated successfully.'
            );
    }

    /**
     * Delete student.
     */
    public function destroy(Student $student)
    {
        if (
            $student->image &&
            File::exists(
                public_path($student->image)
            )
        ) {
            File::delete(
                public_path($student->image)
            );
        }

        $student->delete();

        return redirect()
            ->route('super-admin.students.index')
            ->with(
                'success',
                'Student deleted successfully.'
            );
    }

    /**
     * Toggle status.
     */
    public function toggleStatus(Student $student)
    {
        $student->update([
            'status' => !$student->status,
        ]);

        $student->user->update([
            'status' => $student->status,
        ]);

        return back()->with(
            'success',
            'Student status updated.'
        );
    }
}
