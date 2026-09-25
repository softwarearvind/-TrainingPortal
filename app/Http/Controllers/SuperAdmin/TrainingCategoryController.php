<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrainingCategoryController extends Controller
{
    /**
     * Display all categories.
     */
    public function index()
    {
        $categories = TrainingCategory::latest()
            ->paginate(10);

        return view(
            'super-admin.training-categories.index',
            compact('categories')
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view(
            'super-admin.training-categories.create'
        );
    }


    /**
     * Store category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:training_categories,name',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);


        $data = [

            'name' => $validated['name'],

            'slug' => Str::slug(
                $validated['name']
            ),

            'description' =>
                $validated['description'] ?? null,

            'status' =>
                $validated['status'],

        ];


        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName =
                time() . '_' .
                $image->getClientOriginalName();

            $image->move(
                public_path('uploads/categories'),
                $imageName
            );

            $data['image'] =
                'uploads/categories/' . $imageName;
        }


        TrainingCategory::create($data);


        return redirect()
            ->route(
                'super-admin.training-categories.index'
            )
            ->with(
                'success',
                'Training category created successfully.'
            );
    }


    /**
     * Show edit form.
     */
    public function edit(
        TrainingCategory $trainingCategory
    ) {

        return view(
            'super-admin.training-categories.edit',
            compact('trainingCategory')
        );
    }


    /**
     * Update category.
     */
    public function update(
        Request $request,
        TrainingCategory $trainingCategory
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:training_categories,name,' .
                    $trainingCategory->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);


        $data = [

            'name' => $validated['name'],

            'slug' => Str::slug(
                $validated['name']
            ),

            'description' =>
                $validated['description'] ?? null,

            'status' =>
                $validated['status'],

        ];


        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName =
                time() . '_' .
                $image->getClientOriginalName();

            $image->move(
                public_path('uploads/categories'),
                $imageName
            );

            $data['image'] =
                'uploads/categories/' . $imageName;
        }


        $trainingCategory->update($data);


        return redirect()
            ->route(
                'super-admin.training-categories.index'
            )
            ->with(
                'success',
                'Training category updated successfully.'
            );
    }


    /**
     * Delete category.
     */
    public function destroy(
        TrainingCategory $trainingCategory
    ) {

        $trainingCategory->delete();


        return redirect()
            ->route(
                'super-admin.training-categories.index'
            )
            ->with(
                'success',
                'Training category deleted successfully.'
            );
    }


    /**
     * Toggle status.
     */
    public function toggleStatus(
        TrainingCategory $trainingCategory
    ) {

        $trainingCategory->update([

            'status' =>
                !$trainingCategory->status,

        ]);


        return back()
            ->with(
                'success',
                'Category status updated successfully.'
            );
    }
}
