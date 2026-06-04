<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str; // la classe Str che serve per generare lo slug automaticamente dal titolo
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // prende tutti i progetti dal database
        $projects = Project::all();

        // passa i progetti alla vista "index"
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validazione dei dati in ingresso
        $request->validate([
            'title' => 'required|string|max:150|unique:projects',
            'description' => 'nullable|string',
            'image' => 'nullable|url|max:255',
            'link_github' => 'nullable|url|max:255',
            'link_website' => 'nullable|url|max:255',
        ]);

        // ricava tutti i dati dal form
        $data = $request->all();

        // per generare lo slug in automatico partendo dal titolo
        $data['slug'] = Str::slug($data['title'], '-');

        // salva nel database usando i dati fillable
        $project = Project::create($data);

        // reindirizzamento pagina tabella
        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project) // utilizzo della Dependency Injection
    {
        // passa il singolo progetto alla vista "show"
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
