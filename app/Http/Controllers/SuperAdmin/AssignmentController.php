<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with([
            'course',
            'batch'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.assignments.index',
            compact('assignments')
        );
    }


    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $batches = Batch::with('course')
            ->where('status', '!=', 'completed')
            ->orderBy('start_date')
            ->get();

        return view(
            'super-admin.assignments.create',
            compact(
                'courses',
                'batches'
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

            'batch_id' => [
                'required',
                'exists:batches,id'
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

            'instructions' => [
                'nullable',
                'string'
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip',
                'max:20480'
            ],

            'total_marks' => [
                'required',
                'numeric',
                'min:0'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

            'allow_late_submission' => [
                'nullable',
                'boolean'
            ],

            'late_penalty' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'in:draft,published,closed'
            ],
        ]);


        $validated['slug'] =
            $this->generateUniqueSlug(
                $validated['title']
            );


        $validated['allow_late_submission'] =
            $request->boolean(
                'allow_late_submission'
            );


        /*
        |--------------------------------------------------------------------------
        | Attachment Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachment')) {

            $directory =
                public_path(
                    'uploads/assignments'
                );

            if (!File::exists($directory)) {

                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('attachment');

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


            $validated['attachment'] =
                'uploads/assignments/' .
                $fileName;

            $validated['attachment_name'] =
                $originalName;

            $validated['attachment_size'] =
                $fileSize;
        }


        Assignment::create(
            $validated
        );


        return redirect()
            ->route(
                'super-admin.assignments.index'
            )
            ->with(
                'success',
                'Assignment created successfully.'
            );
    }


    public function edit(
        Assignment $assignment
    ) {

        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $batches = Batch::with('course')
            ->where('status', '!=', 'completed')
            ->orderBy('start_date')
            ->get();

        return view(
            'super-admin.assignments.edit',
            compact(
                'assignment',
                'courses',
                'batches'
            )
        );
    }


    public function update(
        Request $request,
        Assignment $assignment
    ) {

        $validated = $request->validate([

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'batch_id' => [
                'required',
                'exists:batches,id'
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

            'instructions' => [
                'nullable',
                'string'
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip',
                'max:20480'
            ],

            'total_marks' => [
                'required',
                'numeric',
                'min:0'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

            'allow_late_submission' => [
                'nullable',
                'boolean'
            ],

            'late_penalty' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'in:draft,published,closed'
            ],
        ]);


        $validated['slug'] =
            $this->generateUniqueSlug(
                $validated['title'],
                $assignment->id
            );


        $validated['allow_late_submission'] =
            $request->boolean(
                'allow_late_submission'
            );


        /*
        |--------------------------------------------------------------------------
        | Replace Attachment
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachment')) {

            if (
                $assignment->attachment &&
                File::exists(
                    public_path(
                        $assignment->attachment
                    )
                )
            ) {

                File::delete(
                    public_path(
                        $assignment->attachment
                    )
                );
            }


            $directory =
                public_path(
                    'uploads/assignments'
                );

            if (!File::exists($directory)) {

                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('attachment');

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


            $validated['attachment'] =
                'uploads/assignments/' .
                $fileName;

            $validated['attachment_name'] =
                $originalName;

            $validated['attachment_size'] =
                $fileSize;
        }


        $assignment->update(
            $validated
        );


        return redirect()
            ->route(
                'super-admin.assignments.index'
            )
            ->with(
                'success',
                'Assignment updated successfully.'
            );
    }


    public function destroy(
        Assignment $assignment
    ) {

        if (
            $assignment->attachment &&
            File::exists(
                public_path(
                    $assignment->attachment
                )
            )
        ) {

            File::delete(
                public_path(
                    $assignment->attachment
                )
            );
        }


        $assignment->delete();


        return redirect()
            ->route(
                'super-admin.assignments.index'
            )
            ->with(
                'success',
                'Assignment deleted successfully.'
            );
    }


    public function toggleStatus(
        Assignment $assignment
    ) {

        $nextStatus = match (
            $assignment->status
        ) {

            'draft' =>
                'published',

            'published' =>
                'closed',

            default =>
                'draft',
        };


        $assignment->update([
            'status' => $nextStatus
        ]);


        return back()->with(
            'success',
            'Assignment status updated.'
        );
    }


    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $slug =
            Str::slug($title);

        $originalSlug =
            $slug;

        $counter = 1;


        while (
            Assignment::where(
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
