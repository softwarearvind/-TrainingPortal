<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $trainers = Trainer::withCount('courses')
            ->latest()
            ->paginate(10);

        return view(
            'super-admin.trainers.index',
            compact('trainers')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.trainers.create',
            compact('courses')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

   public function store(Request $request)
{
    $validated = $request->validate([

        'name' => [
            'required',
            'string',
            'max:255'
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:trainers,email'
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed'
        ],

        'phone' => [
            'nullable',
            'string',
            'max:20'
        ],

        'qualification' => [
            'nullable',
            'string',
            'max:255'
        ],

        'experience' => [
            'nullable',
            'string',
            'max:100'
        ],

        'specialization' => [
            'nullable',
            'string',
            'max:255'
        ],

        'bio' => [
            'nullable',
            'string'
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

        'courses' => [
            'nullable',
            'array'
        ],

        'courses.*' => [
            'exists:courses,id'
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | Trainer Data
    |--------------------------------------------------------------------------
    */

    $data = [
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'qualification' => $validated['qualification'] ?? null,
        'experience' => $validated['experience'] ?? null,
        'specialization' => $validated['specialization'] ?? null,
        'bio' => $validated['bio'] ?? null,
        'status' => $validated['status'],
    ];


    /*
    |--------------------------------------------------------------------------
    | Image Upload
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {

        $folder = public_path(
            'uploads/trainers'
        );

        if (!File::exists($folder)) {

            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }

        $image = $request->file('image');

        $imageName =
            time() . '_' .
            Str::random(10) . '.' .
            $image->getClientOriginalExtension();

        $image->move(
            $folder,
            $imageName
        );

        $data['image'] =
            'uploads/trainers/' . $imageName;
    }


    /*
    |--------------------------------------------------------------------------
    | Create User + Trainer
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use (
        $validated,
        $data,
        &$trainer
    ) {

        /*
        |--------------------------------------------------------------------------
        | Create Login User
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
        | Assign Trainer Role
        |--------------------------------------------------------------------------
        */

        $user->assignRole('Trainer');


        /*
        |--------------------------------------------------------------------------
        | Connect User with Trainer
        |--------------------------------------------------------------------------
        */

        $data['user_id'] = $user->id;


        /*
        |--------------------------------------------------------------------------
        | Create Trainer Profile
        |--------------------------------------------------------------------------
        */

        $trainer = Trainer::create($data);


        /*
        |--------------------------------------------------------------------------
        | Assign Courses
        |--------------------------------------------------------------------------
        */

        $trainer->courses()->sync(
            $validated['courses'] ?? []
        );
    });


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('super-admin.trainers.index')
        ->with(
            'success',
            'Trainer created successfully. Login account also created.'
        );
}

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Trainer $trainer)
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $trainerCourseIds = $trainer
            ->courses()
            ->pluck('courses.id')
            ->toArray();

        return view(
            'super-admin.trainers.edit',
            compact(
                'trainer',
                'courses',
                'trainerCourseIds'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Trainer $trainer
    ) {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:trainers,email,' .
                $trainer->id
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            'qualification' => [
                'nullable',
                'string',
                'max:255'
            ],

            'experience' => [
                'nullable',
                'string',
                'max:100'
            ],

            'specialization' => [
                'nullable',
                'string',
                'max:255'
            ],

            'bio' => [
                'nullable',
                'string'
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

            'courses' => [
                'nullable',
                'array'
            ],

            'courses.*' => [
                'exists:courses,id'
            ],
        ]);


        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'qualification' =>
                $validated['qualification'] ?? null,
            'experience' =>
                $validated['experience'] ?? null,
            'specialization' =>
                $validated['specialization'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'status' => $validated['status'],
        ];


        /*
        |--------------------------------------------------------------------------
        | New Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $trainer->image &&
                File::exists(
                    public_path($trainer->image)
                )
            ) {
                File::delete(
                    public_path($trainer->image)
                );
            }


            $folder = public_path(
                'uploads/trainers'
            );

            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }


            $image = $request->file('image');

            $imageName =
                time() . '_' .
                Str::random(10) . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                $folder,
                $imageName
            );

            $data['image'] =
                'uploads/trainers/' . $imageName;
        }


        $trainer->update($data);


        /*
        |--------------------------------------------------------------------------
        | Update Courses
        |--------------------------------------------------------------------------
        */

        $trainer->courses()->sync(
            $validated['courses'] ?? []
        );


        return redirect()
            ->route('super-admin.trainers.index')
            ->with(
                'success',
                'Trainer updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(Trainer $trainer)
    {
        if (
            $trainer->image &&
            File::exists(
                public_path($trainer->image)
            )
        ) {
            File::delete(
                public_path($trainer->image)
            );
        }


        $trainer->delete();


        return redirect()
            ->route('super-admin.trainers.index')
            ->with(
                'success',
                'Trainer deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        Trainer $trainer
    ) {
        $trainer->update([
            'status' => !$trainer->status
        ]);


        return back()->with(
            'success',
            'Trainer status updated successfully.'
        );
    }
}
