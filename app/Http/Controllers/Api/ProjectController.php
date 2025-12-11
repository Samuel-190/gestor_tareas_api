<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        $projects = $request->user()
            ->projects()
            ->with('tasks')
            ->get()
            ->map(function ($project) {

                $total = $project->tasks->count();
                $completed = $project->tasks
                    ->where('is_completed', true)
                    ->count();

                $project->tasks_total = $total;
                $project->tasks_completed = $completed;
                $project->progress = $total > 0
                    ? round(($completed / $total) * 100)
                    : 0;

                return $project;
            });

        return response()->json($projects, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $project = $request->user()->projects()->create($data);

        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project) {

        $this->authorizeProject($project);

        $project->load('tasks');

        $total = $project->tasks->count();
        $completed = $project->tasks
            ->where('is_completed', true)
            ->count();

        $project->tasks_total = $total;
        $project->tasks_completed = $completed;
        $project->progress = $total > 0
            ? round(($completed / $total) * 100)
            : 0;

        return response()->json($project, 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project) {

        $this->authorizeProject($project);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_archived' => 'boolean'
        ]);

        $project->update($data);

        return response()->json($project, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project) {

        $this->authorizeProject($project);

        $project->delete();

        return response()->json(null, 204);
    }

    protected function authorizeProject(Project $project) {

        if (auth()->id() !== $project->user_id) {
            abort(403, 'No tienes permiso para acceder a este proyecto');
        }
    }

}
