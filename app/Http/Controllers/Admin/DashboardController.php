<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        // per poter passare il count dei progetti e tipologie
        $projectsCount = Project::count();
        $typesCount = Type::count();

        // passo le variabili alla vista admin.dashboard
        return view("admin.dashboard", compact('projectsCount', 'typesCount'));
    }

    public function profile()
    {
        return "pagina profile backoffice";
    }
}
