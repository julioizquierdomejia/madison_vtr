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
use App\Models\Video;

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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor', 'user']);

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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor', 'user']);
        
        $role = \Auth::user()->roles->first()->name;

        $rules = array(
            'name'            => 'required|string',
            'ritual_type_id'  => 'required|integer|in:1,2,3,4',
            'objetivo'        => 'required|integer',
            'published_at'    => 'date|required',
            'video1'    => 'required|integer|exists:videos,id',
            'video2'    => 'required|integer|exists:videos,id',
            'video3'    => 'required|integer|exists:videos,id',
            'video4'    => 'required|integer|exists:videos,id',
        );
        $messages = array(
            'name.required'           => 'El nombre es requerido',
            'ritual_type_id.required' => 'El tipo de ritual es requerido',
            'objetivo.required'       => 'El objetivo es requerido',
            'published_at.required'   => 'La fecha es requerida',
            'video1.required'      => 'El primer vídeo es requerido',
            'video2.required'      => 'El segundo vídeo es requerido',
            'video3.required'      => 'El tercer vídeo es requerido',
            'video4.required'      => 'El vídeo final es requerido',
        );
        $this->validate($request, $rules, $messages);

        $video1 = $request->get('video1');
        $video2 = $request->get('video2');
        $video3 = $request->get('video3');
        $video4 = $request->get('video4');

        $video_path = public_path('uploads/videos/');
        $path = public_path('uploads/rituals/');

        $video_1 = $video_path.Video::findOrFail($video1)->file;
        $video_2 = $video_path.Video::findOrFail($video2)->file;
        $video_3 = $video_path.Video::findOrFail($video3)->file;
        $video_4 = $video_path.Video::findOrFail($video4)->file;

        /*$video_content = $video_1 .'|'. $video_2 .'|'. $video_3 .'|'. $video_4;
        $command = 'ffmpeg -i "concat:'.$video_content.'" -c copy '.$path.'output.mp4';
        system($command);*/

        $video_txt = "file " .$video_1 . "\nfile " . $video_2 ."\nfile " . $video_3 ."\nfile " . $video_4;
        $output = uniqid().'_'."output.mp4";
        $video_content = file_put_contents($path."mylist.txt", $video_txt);
        $command = "ffmpeg -f concat -i ".$path."mylist.txt -c copy ".$path.$output;
        system($command);

        $ritual = new Ritual();
        $ritual->name = $request->get('name');
        $ritual->file = $output;
        $ritual->type_id = $request->get('ritual_type_id');
        $ritual->status_id = 1;
        $ritual->published_at = $request->get('published_at');
        $ritual->user_id = \Auth::id();
        $ritual->objective_id = $request->get('objetivo');
        $ritual->enabled = 1;
        $ritual->save();

        /*$ritual_objective = new RitualObjective();
        $ritual_objective->objective_id = $request->get('objetivo');
        $ritual_objective->ritual_id = $ritual->id;
        $ritual_objective->save();*/

        $ritual_video1 = new RitualVideo();
        $ritual_video1->video_id = $video1;
        $ritual_video1->ritual_id = $ritual->id;
        $ritual_video1->save();
        $ritual_video2 = new RitualVideo();
        $ritual_video2->video_id = $video2;
        $ritual_video2->ritual_id = $ritual->id;
        $ritual_video2->save();
        $ritual_video3 = new RitualVideo();
        $ritual_video3->video_id = $video3;
        $ritual_video3->ritual_id = $ritual->id;
        $ritual_video3->save();
        $ritual_video4 = new RitualVideo();
        $ritual_video4->video_id = $video4;
        $ritual_video4->ritual_id = $ritual->id;
        $ritual_video4->save();

        if ($role == 'superadmin') {
            $rituals = Ritual::join('ritual_types', 'ritual_types.id', '=', 'rituals.type_id')
                ->join('ritual_status', 'ritual_status.id', '=', 'rituals.status_id')
                ->select('rituals.*', 'ritual_types.name as ritual_type', 'ritual_status.name as status', 'rituals.status_id')
                //->where('enabled', 1)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $rituals = Ritual::join('ritual_types', 'ritual_types.id', '=', 'rituals.type_id')
                ->join('ritual_status', 'ritual_status.id', '=', 'rituals.status_id')
                ->select('rituals.*', 'ritual_types.name as ritual_type', 'ritual_status.name as status', 'rituals.status_id')
                //->where('enabled', 1)
                ->where('user_id', \Auth::id())
                ->orderBy('id', 'desc')
                ->get();
        }
        
        return response()->json(['data'=>json_encode($rituals),'success'=>true]);
    }
}
