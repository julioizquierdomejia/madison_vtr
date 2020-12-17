<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoStatus;
use App\Models\Objective;
use App\Models\VideoObjective;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['superadmin', 'admin']);
        
        $videos = Video::join('video_types', 'video_types.id', '=', 'videos.video_type_id')
            ->join('video_status', 'video_status.id', '=', 'videos.video_status_id')
            ->select('videos.*', 'video_types.name as video_type', 'video_status.name as status', 'videos.video_status_id')
            //->where('enabled', 1)
            ->orderBy('id', 'desc')
            ->get();

        $objectives = Objective::where('enabled', 1)->get();

        $status = VideoStatus::all();

        return view('admin.videos.index', compact('videos', 'status', 'objectives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = array(
            'video'       => 'required|mimes:mp4,mov,ogg,qt | max:1000000',
            'name'      => 'required|string',
            'part'      => 'required|integer|in:1,2,3,4',
            'objective'      => 'required|integer',
            //'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        $file = $request->file('video');
        $ext = $file->extension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$file->getClientOriginalName());

        $video = new Video();
        $video->name = $request->get('name');
        $video->file = $uniqueFileName;
        $video->description = $uniqueFileName;
        $video->part = $request->get('part');
        $video->objective_id = $request->get('objective');
        $video->format = $file->getMimeType();
        $video->video_type_id = 1; //Subido
        $video->video_status_id = 1; //Subido
        $video->enabled = 1;
        $video->save();

        $file->move(public_path('uploads/videos'), $uniqueFileName);

        $videos = Video::join('video_types', 'video_types.id', '=', 'videos.video_type_id')
            ->join('video_status', 'video_status.id', '=', 'videos.video_status_id')
            ->select('videos.*', 'video_types.name as video_type', 'video_status.name as status', 'videos.video_status_id')
            ->where('enabled', 1)
            ->orderBy('id', 'desc')
            ->get();

        return redirect('videos')->with('videos');
    }

    public function ajaxstore(Request $request)
    {
        $rules = array(
            'video'       => 'required|mimes:mp4,avi,qt | max:1000000',
            'name'      => 'required|string',
            'parte'      => 'required|integer|in:1,2,3,4',
            'objetivo'      => 'required|integer',
            //'enabled'      => 'boolean|required',
        );
        $messages = array(
            'video.required'       => 'El vídeo es requerido',
            'parte.required'      => 'La parte del vídeo es requerida',
            'objetivo.required'      => 'El objetivo es requerido',
            'name.required'      => 'El nombre es requerido',
        );
        $this->validate($request, $rules, $messages);

        $file = $request->file('video');
        $ext = $file->extension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$file->getClientOriginalName());

        $video = new Video();
        $video->name = $request->get('name');
        $video->file = $uniqueFileName;
        $video->description = $uniqueFileName;
        $video->part = $request->get('parte');
        $video->enabled = 1;
        $video->format = $file->getMimeType();
        $video->video_type_id = 1; //Subido
        $video->video_status_id = 1; //Subido
        $video->save();

        $video_objective = new VideoObjective();
        $video_objective->objective_id = $request->get('objetivo');
        $video_objective->video_id = $video->id;
        $video_objective->save();

        $file->move(public_path('uploads/videos'), $uniqueFileName);

        $videos = Video::join('video_types', 'video_types.id', '=', 'videos.video_type_id')
            ->join('video_status', 'video_status.id', '=', 'videos.video_status_id')
            ->join('video_objectives', 'video_objectives.video_id', '=', 'videos.id')
            ->join('objectives', 'objectives.id', '=', 'video_objectives.objective_id')
            ->select('videos.*', 'video_types.name as video_type', 'video_status.name as status', 'videos.video_status_id', 'objectives.id as objective_id', 'objectives.name as objective')
            //->where('enabled', 1)
            ->orderBy('id', 'desc')
            ->get();
        
        return response()->json(['data'=>json_encode($videos),'success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $video = Video::findOrFail($id);

        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
        $video = Video::findOrFail($id);
        return view('videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
        
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required|string|unique:videos,name,'.$id,
            'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        // update
        $video = Video::findOrFail($id);
        $original_data = $video->toArray();

        $video->name       = $request->get('name');
        $video->enabled    = $request->get('enabled');
        $video->save();

        activitylog('videos', 'update', $original_data, $video->toArray());

        // redirect
        \Session::flash('message', 'Successfully updated video!');
        return redirect('videos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['superadmin', 'admin']);
        $video = Video::findOrFail($id);
        $video->enabled = 0;
        $video->save();

        return response()->json(['status'=>"success", 'data'=>$video]);
    }
}
