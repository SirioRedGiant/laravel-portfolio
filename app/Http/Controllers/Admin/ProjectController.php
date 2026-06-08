<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str; // la classe Str che serve per generare lo slug automaticamente dal titolo --> strumento per lo slug
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
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
        $types = Type::all();
        $technologies = Technology::orderBy('name')->get();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validazione dei dati in ingresso
        $data = $request->validate([
            'title' => 'required|string|max:150|unique:projects',
            'description' => 'nullable|string|min:10',
            'image' => 'nullable|url|max:255',
            'link_github' => 'nullable|url|max:255',
            'link_website' => 'nullable|url|max:255',
            'type_id' => 'nullable|exists:types,id', // exists:types,id --> evita che qualcuno manometta il form inviando ID inventati
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
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
            'type_id.exists' => 'La tipologia selezionata non è valida o è stata manomessa.',
            'technologies.array' => 'Il formato delle tecnologie selezionate non è valido.',
            'technologies.*.exists' => 'Una o più tecnologie selezionate non sono valide.',
        ]);

        // ricava tutti i dati dal form
        // $data = $request->all();

        // per generare lo slug in automatico partendo dal titolo
        $data['slug'] = Str::slug($data['title'], '-');

        // salva nel database usando i dati fillable
        $project = Project::create($data);

        // se l'utente ha selezionato delle tecnologie --> le collega nella tabella pivot
        if (isset($data['technologies'])) {
            $project->technologies()->attach($data['technologies']);
        }

        // reindirizzamento pagina tabella
        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project) // utilizzo della Dependency Injection
    {
        //note senza caricare in anticipo le relazioni --> Laravel dovrà fare una query al database per ogni singola tecnologia trovata nel ciclo foreach "il famoso problema N+1" e di consegueza rallenta la pagina.
        // EAGER LOADING ==>  Carica in anticipo tipologia e tecnologie per ottimizzare le query
        $project->load(['type', 'technologies']);

        // passa il singolo progetto alla vista "show"
        return view('admin.projects.show', compact('project'));
    }

    /**
     *  Show the form for editing the specified resource
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::orderBy('name')->get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // validazione identica allo store, ad eccezione per il titolo!
        $data = $request->validate([
            // il titolo deve essere unico, ma ignora quello del progetto che sto modificando => $project->id
            'title' => 'required|string|max:150|unique:projects,title,' . $project->id,
            'description' => 'nullable|string|min:10',
            'image' => 'nullable|url|max:255',
            'link_github' => 'nullable|url|max:255',
            'link_website' => 'nullable|url|max:255',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
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
            'type_id.exists' => 'La tipologia selezionata non è valida o è stata manomessa.',
            'technologies.array' => 'Il formato delle tecnologie selezionate non è valido.',
            'technologies.*.exists' => 'Una o più tecnologie selezionate non sono valide.',
        ]);

        // così si prendono tutti i data, ma c'è la possibilità che vengano passati dati malevoli
        // $data = $request->all();

        // ricalcolo dello slug dato il titolo appena validato
        $data['slug'] = Str::slug($data['title'], '-');

        // aggiorna l'oggetto --> cioè aggiorna i dati del progetto
        $project->update($data);


        // sincronizza la tabella pivot. Se l'utente deseleziona tutto, $data['technologies'] non esisterà, quindi gli dò un array vuoto [] per fare pulizia.
        $project->technologies()->sync($request->technologies ?? []);

        return redirect()->route('admin.projects.index')->with('success', 'Progetto modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo!');
    }
}
