<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ritual;
use App\Models\Objective;
use App\Models\RitualObjective;
use App\Models\RitualStatus;
use App\Models\RitualType;
use App\Models\RitualVideo;

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
        $objectives = Objective::where('enabled', 1)->get();
        $rituales = Ritual::join('ritual_status', 'ritual_status.id', '=', 'rituals.status_id')
            ->join('ritual_types', 'ritual_types.id', '=', 'rituals.type_id')
            ->select('rituals.*', 'ritual_status.name as status', 'rituals.status_id');
        $status = RitualStatus::all();

        return view('admin.rituales.index', compact('rituales', 'objectives', 'status', 'ritual_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function ajaxstore(Request $request)
    {
        $role = \Auth::user()->roles->first()->name;

        $rules = array(
            'name'      => 'required|string',
            'ritual_type_id'      => 'required|integer|in:1,2,3,4',
            'objetivo'      => 'required|integer',
            'published_at'      => 'date|required',
            'video1'    => 'required|integer|exists:videos,id',
            'video2'    => 'required|integer|exists:videos,id',
            'video3'    => 'required|integer|exists:videos,id',
            'video4'    => 'required|integer|exists:videos,id',
        );
        $messages = array(
            'video.required'       => 'El vídeo es requerido',
            'ritual_type_id.required'      => 'El tipo de ritual es requerido',
            'objetivo.required'      => 'El objetivo es requerido',
            'name.required'      => 'El nombre es requerido',
            'published_at.required'      => 'La fecha es requerida',
            'video1.required'      => 'El primer vídeo es requerido',
            'video2.required'      => 'El segundo vídeo es requerido',
            'video3.required'      => 'El tercer vídeo es requerido',
            'video4.required'      => 'El vídeo final es requerido',
        );
        $this->validate($request, $rules, $messages);

        $file = $request->file('video');
        $ext = $file->extension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$file->getClientOriginalName());

        $ritual = new Ritual();
        $ritual->name = $request->get('name');
        $ritual->file = $uniqueFileName;
        $ritual->description = $uniqueFileName;
        $ritual->type_id = $request->get('ritual_type_id');
        $ritual->status_id = 1;
        $ritual->published = $request->get('published_at');
        $ritual->user_id = \Auth::id();
        $ritual->enabled = 1;
        $ritual->save();

        $ritual_objective = new RitualObjective();
        $ritual_objective->objective_id = $request->get('objetivo');
        $ritual_objective->ritual_id = $ritual->id;
        $ritual_objective->save();

        $ritual_video1 = new RitualVideo();
        $ritual_video1->video_id = $request->get('video1');
        $ritual_video1->ritual_id = $ritual->id;
        $ritual_video1->save();
        $ritual_video2 = new RitualVideo();
        $ritual_video2->video_id = $request->get('video2');
        $ritual_video2->ritual_id = $ritual->id;
        $ritual_video2->save();
        $ritual_video3 = new RitualVideo();
        $ritual_video3->video_id = $request->get('video3');
        $ritual_video3->ritual_id = $ritual->id;
        $ritual_video3->save();
        $ritual_video4 = new RitualVideo();
        $ritual_video4->video_id = $request->get('video4');
        $ritual_video4->ritual_id = $ritual->id;
        $ritual_video4->save();

        $file->move(public_path('uploads/rituals'), $uniqueFileName);

        if ($role == 'superadmin') {
            $rituals = Ritual::join('ritual_types', 'ritual_types.id', '=', 'rituals.type_id')
                ->join('ritual_status', 'ritual_status.id', '=', 'rituals.ritual_status_id')
                ->join('ritual_objectives', 'ritual_objectives.ritual_id', '=', 'rituals.id')
                ->join('objectives', 'objectives.id', '=', 'ritual_objectives.objective_id')
                ->select('rituals.*', 'ritual_types.name as rituak_type', 'ritual_status.name as status', 'rituals.ritual_status_id', 'objectives.id as objective_id', 'objectives.name as objective')
                //->where('enabled', 1)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $rituals = Ritual::join('ritual_types', 'ritual_types.id', '=', 'rituals.type_id')
                ->join('ritual_status', 'ritual_status.id', '=', 'rituals.ritual_status_id')
                ->join('ritual_objectives', 'ritual_objectives.ritual_id', '=', 'rituals.id')
                ->join('objectives', 'objectives.id', '=', 'ritual_objectives.objective_id')
                ->select('rituals.*', 'ritual_types.name as ritual_type', 'ritual_status.name as status', 'rituals.ritual_status_id', 'objectives.id as objective_id', 'objectives.name as objective')
                //->where('enabled', 1)
                ->where('user_id', \Auth::id())
                ->orderBy('id', 'desc')
                ->get();
        }
        
        return response()->json(['data'=>json_encode($rituals),'success'=>true]);
    }
}
