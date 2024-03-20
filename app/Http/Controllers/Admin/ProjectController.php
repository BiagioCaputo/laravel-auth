<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('updated_at')->orderByDesc('created_at')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ], 
        [
            'title.required' => 'Il progetto deve avere un titolo',
            'description.required' => 'Il progetto deve avere una descrizione',
            'image.url' => 'L\'url dell\'immagine del progetto non è funzionante',
        ]);

        $data = $request->all();
        
        $project = new Project();

        $project->fill($data);

        $project->slug = Str::slug($project->title);

        $project->save();

        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('message', 'Progetto creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'description' => 'required|string',
            'image' => 'nullable|url',
        ], 
        [
            'title.required' => 'Il progetto deve avere un titolo',
            'description.required' => 'Il progetto deve avere una descrizione',
            'image.url' => 'L\'url dell\'immagine del progetto non è funzionante',
        ]);
    
        $data = $request->all();

        $data['slug'] = Str::slug($data['title']);
    
        $project->update($data);

    
        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('message', 'Progetto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')
        ->with('toast-button-type', 'danger')
        ->with('toast-message', 'Progetto eliminato')
        ->with('toast-label', config('app.name'))
        ->with('toast-method', 'PATCH')
        ->with('toast-route', route('admin.projects.restore', $project->id))
        ->with('toast-button-label', 'ANNULLA');
    }


    //Rotte Soft delete

    public function trash() {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(Project $project){

        $project->restore();

        return to_route('admin.projects.index')->with('type', 'success')->with('message', 'Progetto ripristinato con successo');
    }

    public function drop(Project $project){

        $project->forceDelete();

        return to_route('admin.projects.trash')->with('type', 'warning')->with('message', 'Progetto eliminato con successo');
    }
}
