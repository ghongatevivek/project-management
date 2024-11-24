<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        // Apply authorization for all methods
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $user = Auth::user();
        $projects = Project::with([
            'manager' => fn($q) => $q->select('id', 'name')
        ])->when($user->role === 'manager', function ($query) use ($user) {
            // If the user is a manager, fetch only their projects
            $query->where('manager_id', $user->id);
        })->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $employees = User::all();
        return view('projects.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'employees' => 'required|array', // Ensure employees is an array
                'employees.*' => 'exists:users,id', // Validate each employee ID
            ]);
    
            // Create the project
            $project = Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'manager_id' => auth()->id()
            ]);
    
            // Attach employees to the project with 'assigned_by'
            $managerId = auth()->id(); // Logged-in manager's ID
            $prgEmployeeArr = [];
            foreach ($request->employees as $employeeId) {
    
                $prgEmployeeArr[] = [
                    'project_id' => $project->id,
                    'user_id' => $employeeId,
                    'assigned_by' => $managerId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
    
            if(!empty($prgEmployeeArr)){
                ProjectUser::insert($prgEmployeeArr);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('projects.index')->with('error', 'Something went wrong!');
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Project $project)
    {
        $this->authorize('view', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
