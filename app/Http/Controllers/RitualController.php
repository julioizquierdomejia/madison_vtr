<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ritual;
use App\Models\RitualObjective;
use App\Models\RitualStatus;
use App\Models\RitualType;

class RitualController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ritual_types = RitualType::all();
        $objectives = RitualObjective::where('enabled', 1)->get();
        $rituales = Ritual::join('ritual_status', 'ritual_status.id', '=', 'rituals.ritual_status_id')
            ->join('ritual_types', 'ritual_types.id', '=', 'rituals.ritual_type_id')
            ->join('ritual_objectives', 'ritual_objectives.id', '=', 'rituals.ritual_objective_id')
            ->select('rituals.*', 'ritual_status.name as status', 'rituals.ritual_status_id', 'ritual_objectives.name as objective');
        $status = RitualStatus::all();

        return view('admin.rituales.index', compact('rituales', 'objectives', 'status', 'ritual_types'));
    }
}
