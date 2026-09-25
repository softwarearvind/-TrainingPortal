<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudyMaterial;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::with([
            'course',
            'trainingSession'
        ])
        ->orderBy('sort_order')
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.study-materials.index',
            compact('materials')
        );
    }


    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $trainingSessions = TrainingSession::with('batch.course')
            ->whereIn('status', [
                'scheduled',
                'ongoing',
                'completed'
            ])
            ->latest('session_date')
            ->get();

        return view(
            'super-admin.study-materials.create',
            compact(
                'courses',
                'trainingSessions'
            )
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'training_session_id' => [
                'nullable',
                'exists:training_sessions,id'
            ],

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'material_type' => [
                'required',
                'in:pdf,document,presentation,spreadsheet,zip,external'
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip',
                'max:20480'
            ],

            'external_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ]);


        $validated['slug'] =
            $this->generateUniqueSlug(
                $validated['title']
            );


        /*
        |--------------------------------------------------------------------------
        | File Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('file')) {

            $directory =
                public_path('uploads/study-materials');

            if (!File::exists($directory)) {

                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('file');

            $originalName =
                $file->getClientOriginalName();

            $fileSize =
                $this->formatFileSize(
                    $file->getSize()
                );

            $fileName =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();


            $file->move(
                $directory,
                $fileName
            );


            $validated['file_path'] =
                'uploads/study-materials/' .
                $fileName;

            $validated['file_name'] =
                $originalName;

            $validated['file_size'] =
                $fileSize;
        }


        /*
        |--------------------------------------------------------------------------
        | Thumbnail Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            $directory =
                public_path(
                    'uploads/material-thumbnails'
                );

            if (!File::exists($directory)) {

                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('thumbnail');

            $fileName =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();


            $file->move(
                $directory,
                $fileName
            );


            $validated['thumbnail'] =
                'uploads/material-thumbnails/' .
                $fileName;
        }


        StudyMaterial::create(
            $validated
        );


        return redirect()
            ->route(
                'super-admin.study-materials.index'
            )
            ->with(
                'success',
                'Study material created successfully.'
            );
    }


    public function edit(
        StudyMaterial $studyMaterial
    ) {

        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $trainingSessions = TrainingSession::with('batch.course')
            ->whereIn('status', [
                'scheduled',
                'ongoing',
                'completed'
            ])
            ->latest('session_date')
            ->get();

        return view(
            'super-admin.study-materials.edit',
            compact(
                'studyMaterial',
                'courses',
                'trainingSessions'
            )
        );
    }


    public function update(
        Request $request,
        StudyMaterial $studyMaterial
    ) {

        $validated = $request->validate([

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'training_session_id' => [
                'nullable',
                'exists:training_sessions,id'
            ],

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'material_type' => [
                'required',
                'in:pdf,document,presentation,spreadsheet,zip,external'
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip',
                'max:20480'
            ],

            'external_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ]);


        $validated['slug'] =
            $this->generateUniqueSlug(
                $validated['title'],
                $studyMaterial->id
            );


        /*
        |--------------------------------------------------------------------------
        | Replace File
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('file')) {

            if (
                $studyMaterial->file_path &&
                File::exists(
                    public_path(
                        $studyMaterial->file_path
                    )
                )
            ) {

                File::delete(
                    public_path(
                        $studyMaterial->file_path
                    )
                );
            }


            $directory =
                public_path(
                    'uploads/study-materials'
                );

            if (!File::exists($directory)) {

                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('file');

            $originalName =
                $file->getClientOriginalName();

            $fileSize =
                $this->formatFileSize(
                    $file->getSize()
                );

            $fileName =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();


            $file->move(
                $directory,
                $fileName
            );


            $validated['file_path'] =
                'uploads/study-materials/' .
                $fileName;

            $validated['file_name'] =
                $originalName;

            $validated['file_size'] =
                $fileSize;
        }


        /*
        |--------------------------------------------------------------------------
        | Replace Thumbnail
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            if (
                $studyMaterial->thumbnail &&
                File::exists(
                    public_path(
                        $studyMaterial->thumbnail
                    )
                )
            ) {

                File::delete(
                    public_path(
                        $studyMaterial->thumbnail
                    )
                );
            }


            $directory =
                public_path(
                    'uploads/material-thumbnails'
                );

            if (!File::exists($directory)) {

                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('thumbnail');

            $fileName =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();


            $file->move(
                $directory,
                $fileName
            );


            $validated['thumbnail'] =
                'uploads/material-thumbnails/' .
                $fileName;
        }


        $studyMaterial->update(
            $validated
        );


        return redirect()
            ->route(
                'super-admin.study-materials.index'
            )
            ->with(
                'success',
                'Study material updated successfully.'
            );
    }


    public function destroy(
        StudyMaterial $studyMaterial
    ) {

        if (
            $studyMaterial->file_path &&
            File::exists(
                public_path(
                    $studyMaterial->file_path
                )
            )
        ) {

            File::delete(
                public_path(
                    $studyMaterial->file_path
                )
            );
        }


        if (
            $studyMaterial->thumbnail &&
            File::exists(
                public_path(
                    $studyMaterial->thumbnail
                )
            )
        ) {

            File::delete(
                public_path(
                    $studyMaterial->thumbnail
                )
            );
        }


        $studyMaterial->delete();


        return redirect()
            ->route(
                'super-admin.study-materials.index'
            )
            ->with(
                'success',
                'Study material deleted successfully.'
            );
    }


    public function toggleStatus(
        StudyMaterial $studyMaterial
    ) {

        $studyMaterial->update([
            'status' => !$studyMaterial->status
        ]);


        return back()->with(
            'success',
            'Study material status updated.'
        );
    }


    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($title);

        $originalSlug = $slug;

        $counter = 1;


        while (
            StudyMaterial::where(
                'slug',
                $slug
            )
            ->when(
                $ignoreId,
                fn ($query) =>
                    $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
            )
            ->exists()
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter++;

        }


        return $slug;
    }


    private function formatFileSize(
        int $bytes
    ): string {

        if ($bytes >= 1048576) {

            return round(
                $bytes / 1048576,
                2
            ) . ' MB';
        }

        if ($bytes >= 1024) {

            return round(
                $bytes / 1024,
                2
            ) . ' KB';
        }

        return $bytes . ' Bytes';
    }
}
