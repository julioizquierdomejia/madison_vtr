<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoStatus;
use App\Models\RitualObjective;

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
            ->get();

        $objectives = RitualObjective::where('enabled', 1)->get();

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
            //'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        $file = $request->file('video');
        $ext = $file->extension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$file->getClientOriginalName());

        $video = new Video();
        $video->name = str_replace('.'.$ext, "", $uniqueFileName);
        $video->file = $uniqueFileName;
        $video->description = $uniqueFileName;
        $video->enabled = 1;
        $video->format = $file->getMimeType();
        $video->video_type_id = 1; //Subido
        $video->video_status_id = 1; //Subido
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
            'video'       => 'required|mimes:mp4,mov,ogg,qt | max:1000000',
            //'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        $file = $request->file('video');
        $ext = $file->extension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$file->getClientOriginalName());

        $video = new Video();
        $video->name = str_replace('.'.$ext, "", $uniqueFileName);
        $video->file = $uniqueFileName;
        $video->description = $uniqueFileName;
        $video->enabled = 1;
        $video->format = $file->getMimeType();
        $video->video_type_id = 1; //Subido
        $video->video_status_id = 1; //Subido
        $video->save();

        $file->move(public_path('uploads/videos'), $uniqueFileName);

        $videos = Video::join('video_types', 'video_types.id', '=', 'videos.video_type_id')
            ->join('video_status', 'video_status.id', '=', 'videos.video_status_id')
            ->select('videos.*', 'video_types.name as video_type', 'video_status.name as status', 'videos.video_status_id')
            ->where('enabled', 1)
            ->orderBy('id', 'desc')
            ->get();
        
        return response()->json(['data'=>json_encode($videos),'success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $area = Client::findOrFail($id);

        return view('videos.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
        $videos = Video::where('enabled', 1)->get();
        $services = Service::where('enabled', 1)->where('area_id', $id)->get();
        $area = Video::findOrFail($id);
        return view('videos.edit', compact('area', 'videos', 'services'));
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
        $area = Video::findOrFail($id);
        $original_data = $area->toArray();

        $area->name       = $request->get('name');
        $area->enabled    = $request->get('enabled');
        $area->save();

        activitylog('videos', 'update', $original_data, $area->toArray());

        // redirect
        \Session::flash('message', 'Successfully updated area!');
        return redirect('videos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Video $area)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }
}
