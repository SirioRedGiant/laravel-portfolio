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
            'description' => 'nullable|string|min:10',
            'image' => 'nullable|url|max:255',
            'link_github' => 'nullable|url|max:255',
            'link_website' => 'nullable|url|max:255',
        ], [
            // notifiche personalizzate
            'title.required' => 'Hai dimenticato di inserire il titolo! È un campo obbligatorio.',
            'title.unique' => 'Questo titolo è già stato utilizzato per un altro progetto.',
            'title.max' => 'Il titolo è troppo lungo, usa massimo 150 caratteri.',
            'description.min' => 'La descrizione deve contenere almeno 10 caratteri.',
            'image.url' => 'L\'indirizzo dell\'immagine non è valido. Deve iniziare con http:// o https://',
            'image.max' => 'L\'indirizzo del link fornito è troppo lungo, usa massimo 255 caratteri',
            'link_github.url' => 'L\'indirizzo del link non è valido. Deve iniziare con http:// o https://',
            'link_github.max' => 'L\'indirizzo del link fornito è troppo lungo, usa massimo 255 caratteri',
            'link_website.url' => 'L\'indirizzo del link non è valido. Deve iniziare con http:// o https://',
            'link_website.max' => 'L\'indirizzo del link fornito è troppo lungo, usa massimo 255 caratteri',
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
