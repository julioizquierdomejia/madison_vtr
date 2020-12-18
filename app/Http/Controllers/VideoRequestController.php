<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoRequest;
use App\Models\RequestService;
use App\Models\VideoRequestService;

class VideoRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
       
    }

    public function ajaxstore(Request $request)
    {
        $rules = array(
            'services'      => 'required|array',
            'topic'     => 'required|string',
            'type'      => 'required|string',
            'avatar'    => 'required|string',
            'comments'  => 'nullable|string',
            'speech'    => 'required|mimes:pdf|max:50000',
        );
        $this->validate($request, $rules);

        $services = $request->get('services');
        $speech = $request->file('speech');
        $ext = $speech->getClientOriginalExtension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$speech->getClientOriginalName());

        $video_request = new VideoRequest();
        $video_request->topic = $request->get('topic');
        $video_request->type = $request->get('type');
        $video_request->avatar = $request->get('avatar');
        $video_request->comments = $request->get('comments');
        $video_request->speech = $uniqueFileName;
        $video_request->user_id = \Auth::id();
        $video_request->status_id = 1; //Subido
        $video_request->save();

        foreach ($services as $key => $item) {
            $video_service = new VideoRequestService();
            $video_service->video_request_id = $video_request->id;
            $video_service->request_service_id = $item;
            $video_service->save();
        }

        $speech->move(public_path('uploads/requests/'.$video_request->id), $uniqueFileName);

        $video_requests = VideoRequest::orderBy('id', 'desc')
            ->get();

        return response()->json(['data'=>json_encode($video_requests),'success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    public function getVideoList(Request $request, $objective, $part)
    {
        $videos = VideoRequest::join('video_request_status', 'video_request_status.id', '=', 'video_requests.status_id')
            ->select('video_requests.*', 'video_types.name as video_type', 'video_request_status.name as status', 'video_requests.video_status_id')
            ->whereHas('objective', function ($query) use ($objective) {
                $query->where("video_objectives.objective_id", "=", $objective);
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json(['status'=>"success", 'data'=>$videos]);
    }
}
