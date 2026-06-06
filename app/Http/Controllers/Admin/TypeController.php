<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:types',
        ], [
            'name.required' => 'Il nome della tipologia è obbligatorio.',
            'name.unique' => 'Questa tipologia esiste già.',
            'name.max' => 'Il nome non può superare i 50 caratteri.',
        ]);

        // slug dal nome
        $data['slug'] = Str::slug($data['name'], '-');

        // salva nel database
        Type::create($data);

        return redirect()->route('admin.types.index')->with('success', 'Tipologia creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type')); // ha senso usarla? 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        // Validazione escluso l'id corrente per il controllo unique
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:types,name,' . $type->id,
        ], [
            'name.required' => 'Il nome della tipologia è obbligatorio.',
            'name.unique' => 'Questa tipologia esiste già.',
            'name.max' => 'Il nome non può superare i 50 caratteri.',
        ]);

        $data['slug'] = Str::slug($data['name'], '-');

        $type->update($data);

        return redirect()->route('admin.types.index')->with('success', 'Tipologia modificata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipologia eliminata con successo!');
    }
}
