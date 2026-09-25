<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TrainingSession;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with([
            'course',
            'trainingSession'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.videos.index',
            compact('videos')
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
            'super-admin.videos.create',
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

            'video_type' => [
                'required',
                'in:youtube,vimeo,external,upload'
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'video_file' => [
                'nullable',
                'file',
                'mimes:mp4,webm,mov',
                'max:51200'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'duration' => [
                'nullable',
                'string',
                'max:50'
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


        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );


        /*
        |--------------------------------------------------------------------------
        | Video Upload
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('video_file')
        ) {

            $videoDirectory =
                public_path('uploads/videos');

            if (!File::exists($videoDirectory)) {
                File::makeDirectory(
                    $videoDirectory,
                    0755,
                    true
                );
            }

            $videoFile =
                $request->file('video_file');

            $videoName =
                time() . '_' .
                Str::random(10) . '.' .
                $videoFile->getClientOriginalExtension();

            $videoFile->move(
                $videoDirectory,
                $videoName
            );

            $validated['video_file'] =
                'uploads/videos/' . $videoName;
        }


        /*
        |--------------------------------------------------------------------------
        | Thumbnail Upload
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('thumbnail')
        ) {

            $thumbnailDirectory =
                public_path('uploads/video-thumbnails');

            if (!File::exists($thumbnailDirectory)) {
                File::makeDirectory(
                    $thumbnailDirectory,
                    0755,
                    true
                );
            }

            $thumbnailFile =
                $request->file('thumbnail');

            $thumbnailName =
                time() . '_' .
                Str::random(10) . '.' .
                $thumbnailFile->getClientOriginalExtension();

            $thumbnailFile->move(
                $thumbnailDirectory,
                $thumbnailName
            );

            $validated['thumbnail'] =
                'uploads/video-thumbnails/' . $thumbnailName;
        }


        Video::create($validated);


        return redirect()
            ->route('super-admin.videos.index')
            ->with(
                'success',
                'Video created successfully.'
            );
    }


    public function edit(Video $video)
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
            'super-admin.videos.edit',
            compact(
                'video',
                'courses',
                'trainingSessions'
            )
        );
    }


    public function update(
        Request $request,
        Video $video
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

            'video_type' => [
                'required',
                'in:youtube,vimeo,external,upload'
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'video_file' => [
                'nullable',
                'file',
                'mimes:mp4,webm,mov',
                'max:51200'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'duration' => [
                'nullable',
                'string',
                'max:50'
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
                $video->id
            );


        /*
        |--------------------------------------------------------------------------
        | Replace Video
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('video_file')) {

            if (
                $video->video_file &&
                File::exists(
                    public_path($video->video_file)
                )
            ) {
                File::delete(
                    public_path($video->video_file)
                );
            }


            $directory =
                public_path('uploads/videos');

            if (!File::exists($directory)) {
                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('video_file');

            $name =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                $directory,
                $name
            );

            $validated['video_file'] =
                'uploads/videos/' . $name;
        }


        /*
        |--------------------------------------------------------------------------
        | Replace Thumbnail
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            if (
                $video->thumbnail &&
                File::exists(
                    public_path($video->thumbnail)
                )
            ) {
                File::delete(
                    public_path($video->thumbnail)
                );
            }


            $directory =
                public_path('uploads/video-thumbnails');

            if (!File::exists($directory)) {
                File::makeDirectory(
                    $directory,
                    0755,
                    true
                );
            }


            $file =
                $request->file('thumbnail');

            $name =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                $directory,
                $name
            );

            $validated['thumbnail'] =
                'uploads/video-thumbnails/' . $name;
        }


        $video->update($validated);


        return redirect()
            ->route('super-admin.videos.index')
            ->with(
                'success',
                'Video updated successfully.'
            );
    }


    public function destroy(Video $video)
    {
        if (
            $video->video_file &&
            File::exists(
                public_path($video->video_file)
            )
        ) {
            File::delete(
                public_path($video->video_file)
            );
        }


        if (
            $video->thumbnail &&
            File::exists(
                public_path($video->thumbnail)
            )
        ) {
            File::delete(
                public_path($video->thumbnail)
            );
        }


        $video->delete();


        return redirect()
            ->route('super-admin.videos.index')
            ->with(
                'success',
                'Video deleted successfully.'
            );
    }


    public function toggleStatus(Video $video)
    {
        $video->update([
            'status' => !$video->status
        ]);


        return back()->with(
            'success',
            'Video status updated.'
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
            Video::where('slug', $slug)
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
}
