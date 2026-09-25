<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Trainer;
use App\Models\TrainingSession;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    /**
     * Display training sessions.
     */
    public function index()
    {
        $sessions = TrainingSession::with([
            'batch.course',
            'trainer'
        ])
        ->latest('session_date')
        ->latest('start_time')
        ->paginate(10);

        return view(
            'super-admin.training-sessions.index',
            compact('sessions')
        );
    }

    /**
     * Create session.
     */
    public function create()
    {
        $batches = Batch::with('course')
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->orderBy('start_date')
            ->get();

        $trainers = Trainer::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.training-sessions.create',
            compact(
                'batches',
                'trainers'
            )
        );
    }

    /**
     * Store session.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'batch_id' =>
                'required|exists:batches,id',

            'trainer_id' =>
                'nullable|exists:trainers,id',

            'title' =>
                'required|string|max:255',

            'session_code' =>
                'required|string|max:100|unique:training_sessions,session_code',

            'topic' =>
                'nullable|string',

            'session_date' =>
                'required|date',

            'start_time' =>
                'required|date_format:H:i',

            'end_time' =>
                'required|date_format:H:i|after:start_time',

            'training_mode' =>
                'required|in:online,offline,hybrid',

            'room' =>
                'nullable|string|max:255',

            'location' =>
                'nullable|string|max:500',

            'meeting_platform' =>
                'nullable|string|max:100',

            'meeting_link' =>
                'nullable|url|max:2048',

            'recording_link' =>
                'nullable|url|max:2048',

            'notes' =>
                'nullable|string',

            'status' =>
                'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        TrainingSession::create($validated);

        return redirect()
            ->route(
                'super-admin.training-sessions.index'
            )
            ->with(
                'success',
                'Training session created successfully.'
            );
    }

    /**
     * Edit session.
     */
    public function edit(
        TrainingSession $trainingSession
    ) {
        $batches = Batch::with('course')
            ->whereNotIn(
                'status',
                ['completed', 'cancelled']
            )
            ->orderBy('start_date')
            ->get();

        $trainers = Trainer::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.training-sessions.edit',
            compact(
                'trainingSession',
                'batches',
                'trainers'
            )
        );
    }

    /**
     * Update session.
     */
    public function update(
        Request $request,
        TrainingSession $trainingSession
    ) {
        $validated = $request->validate([

            'batch_id' =>
                'required|exists:batches,id',

            'trainer_id' =>
                'nullable|exists:trainers,id',

            'title' =>
                'required|string|max:255',

            'session_code' =>
                'required|string|max:100|unique:training_sessions,session_code,' .
                $trainingSession->id,

            'topic' =>
                'nullable|string',

            'session_date' =>
                'required|date',

            'start_time' =>
                'required|date_format:H:i',

            'end_time' =>
                'required|date_format:H:i|after:start_time',

            'training_mode' =>
                'required|in:online,offline,hybrid',

            'room' =>
                'nullable|string|max:255',

            'location' =>
                'nullable|string|max:500',

            'meeting_platform' =>
                'nullable|string|max:100',

            'meeting_link' =>
                'nullable|url|max:2048',

            'recording_link' =>
                'nullable|url|max:2048',

            'notes' =>
                'nullable|string',

            'status' =>
                'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        $trainingSession->update(
            $validated
        );

        return redirect()
            ->route(
                'super-admin.training-sessions.index'
            )
            ->with(
                'success',
                'Training session updated successfully.'
            );
    }

    /**
     * Delete session.
     */
    public function destroy(
        TrainingSession $trainingSession
    ) {
        $trainingSession->delete();

        return redirect()
            ->route(
                'super-admin.training-sessions.index'
            )
            ->with(
                'success',
                'Training session deleted successfully.'
            );
    }
}
