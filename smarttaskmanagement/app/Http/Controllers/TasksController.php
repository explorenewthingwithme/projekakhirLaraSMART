<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Tasks::with('user')->latest()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'difficulty_level' => 'required|string|in:easy,medium,hard',
            'importance' => 'required|string|in:low,medium,high',
            'estimated_time' => 'required|integer|min:0',
            'task_type' => 'required|string|in:individual,group',
            'additional_notes' => 'nullable|string',
        ]);

        $task = new Tasks();
        $task->task_name = $validated['task_name'];
        $task->course_name = $validated['course_name'];
        $task->start_date = $validated['start_date'];
        $task->deadline = $validated['deadline'];
        $task->difficulty_level = $validated['difficulty_level'];
        $task->importance = $validated['importance'];
        $task->estimated_time = $validated['estimated_time'];
        $task->task_type = $validated['task_type'];
        $task->additional_notes = $validated['additional_notes'];
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
