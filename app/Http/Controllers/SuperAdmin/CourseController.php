<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')
            ->latest()
            ->paginate(10);

        return view(
            'super-admin.courses.index',
            compact('courses')
        );
    }

    public function create()
    {
        $categories = TrainingCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.courses.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:training_categories,id'
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:courses,name'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'training_mode' => [
                'required',
                'in:online,offline,hybrid'
            ],

            'duration' => [
                'nullable',
                'string',
                'max:100'
            ],

            'fee' => [
                'required',
                'numeric',
                'min:0'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ]);

        $data = [
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'training_mode' => $validated['training_mode'],
            'duration' => $validated['duration'] ?? null,
            'fee' => $validated['fee'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' .
                $image->getClientOriginalName();

            $image->move(
                public_path('uploads/courses'),
                $imageName
            );

            $data['image'] =
                'uploads/courses/' . $imageName;
        }

        Course::create($data);

        return redirect()
            ->route('super-admin.courses.index')
            ->with(
                'success',
                'Course created successfully.'
            );
    }

    public function edit(Course $course)
    {
        $categories = TrainingCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.courses.edit',
            compact('course', 'categories')
        );
    }

    public function update(
        Request $request,
        Course $course
    ) {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:training_categories,id'
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:courses,name,' . $course->id
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'training_mode' => [
                'required',
                'in:online,offline,hybrid'
            ],

            'duration' => [
                'nullable',
                'string',
                'max:100'
            ],

            'fee' => [
                'required',
                'numeric',
                'min:0'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ]);

        $data = [
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'training_mode' => $validated['training_mode'],
            'duration' => $validated['duration'] ?? null,
            'fee' => $validated['fee'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' .
                $image->getClientOriginalName();

            $image->move(
                public_path('uploads/courses'),
                $imageName
            );

            $data['image'] =
                'uploads/courses/' . $imageName;
        }

        $course->update($data);

        return redirect()
            ->route('super-admin.courses.index')
            ->with(
                'success',
                'Course updated successfully.'
            );
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('super-admin.courses.index')
            ->with(
                'success',
                'Course deleted successfully.'
            );
    }

    public function toggleStatus(Course $course)
    {
        $course->update([
            'status' => !$course->status
        ]);

        return back()->with(
            'success',
            'Course status updated successfully.'
        );
    }
}
