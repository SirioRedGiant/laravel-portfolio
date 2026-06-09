<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Restituisce la lista dei progetti in formato JSON
     */
    public function index()
    {
        // Carichiamo type e technologies per evitare il problema N+1 anche nelle API!
        $projects = Project::with(['type', 'technologies'])->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    /**
     * Restituisce un singolo progetto in formato JSON o un errore 404
     */
    public function show($slug)
    {
        $project = Project::with(['type', 'technologies'])->where('slug', $slug)->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'error' => 'Progetto non trovato'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'project' => $project
        ]);
    }
}
