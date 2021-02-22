<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Status;
use App\Models\Objective;
use App\Models\VideoObjective;
use App\Models\VideoStatus;
use App\Models\Service;
use App\Models\OrderStatus;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);

        $role = \Auth::user()->roles->first()->name;
        /*if ($role == 'superadmin') {
            $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                //->where('enabled', 1)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                ->where('user_id', \Auth::id())
                ->orderBy('id', 'desc')
                ->get();
        }*/
        $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                //->with('statuses')
                ->where('user_id', \Auth::id())
                ->orderBy('id', 'desc')
                ->get();

        $objectives = Objective::where('enabled', 1)->get();
        $request_services = Service::all();

        $status = Status::all();

        return view('admin.videos.index', compact('videos', 'status', 'objectives', 'request_services', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);

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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);

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
        $video->type_id = 1;
        //$video->status_id = 1;
        $video->user_id = \Auth::id();
        $video->enabled = 1;
        $video->save();

        $file->move(public_path('uploads/videos'), $uniqueFileName);

        $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
            ->select('videos.*', 'video_types.name as video_type')
            ->where('user_id', \Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return redirect('videos')->with('videos');
    }

    public function ajaxstore(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);

        $role = \Auth::user()->roles->first()->name;

        $rules = array(
            'video'       => 'required|mimes:mp4,avi,qt | max:1000000',
            'name'      => 'required|string',
            'parte'      => 'required|integer|in:1,2,3,4',
            'objetivo'      => 'required|integer',
            'user_id'      => 'nullable|integer|exists:users,id',
            'request_id'      => 'nullable|integer|exists:orders,id',
            //'enabled'      => 'boolean|required',
        );
        $messages = array(
            'video.required'       => 'El vídeo es requerido',
            'parte.required'      => 'La parte del vídeo es requerida',
            'objetivo.required'      => 'El objetivo es requerido',
            'name.required'      => 'El nombre es requerido',
        );
        $this->validate($request, $rules, $messages);

        $demand_user_id = $request->get('user_id');
        $request_id = $request->get('request_id');
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
        $video->type_id = 1;
        //$video->status_id = 1;
        $video->user_id = $demand_user_id ? $demand_user_id : \Auth::id();
        $video->save();

        $video_objective = new VideoObjective();
        $video_objective->objective_id = $request->get('objetivo');
        $video_objective->video_id = $video->id;
        $video_objective->save();

        $file->move(public_path('uploads/videos'), $uniqueFileName);

        if ($role == 'superadmin') {
            $video_status = new VideoStatus();
            $video_status->video_id = $video->id;
            $video_status->status_id = 1;
            $video_status->save();

            $video_status = new VideoStatus();
            $video_status->video_id = $video->id;
            $video_status->status_id = 2;
            $video_status->save();
        } else {
            $video_status = new VideoStatus();
            $video_status->video_id = $video->id;
            $video_status->status_id = 1;
            $video_status->save();

            $video_status = new VideoStatus();
            $video_status->video_id = $video->id;
            $video_status->status_id = 2;
            $video_status->save();
        }

        if ($request_id) {
            $request_status = new OrderStatus();
            $request_status->order_id = $request_id;
            $request_status->status_id = 2;
            $request_status->save();
        }
        
        return response()->json(['success'=>true]);
    }

    public function getVideos(Request $request, $show_statuses = false)
    {
        $roles = \Auth::user()->roles->first();
        $role = '';
        if($roles) {
            $role = $roles->name;
        }
        $user_id = \Auth::id();
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Video::select('count(*) as allcount')
                ->where('user_id', $user_id)
                //->with('statuses')
                ->where('enabled', 1)
                ->count();
        $totalRecordswithFilter = Video::select('count(*) as allcount')
                ->join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->where('user_id', $user_id)
                //->with('statuses')
                ->where(function($query) use ($searchValue) {
                    $query->where('videos.name', 'like', '%'.$searchValue.'%')
                        ->orWhere('videos.part', 'like', '%'.$searchValue.'%')
                        ->orWhere('video_types.name', 'like', '%'.$searchValue.'%');
                })
                ->where('enabled', 1)
                ->count();

        $records = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                ->where('user_id', $user_id)
                //->with('statuses')
                ->skip($start)
                ->take($rowperpage)
                ->where(function($query) use ($searchValue) {
                    $query->where('videos.name', 'like', '%'.$searchValue.'%')
                        ->orWhere('videos.part', 'like', '%'.$searchValue.'%')
                        ->orWhere('video_types.name', 'like', '%'.$searchValue.'%');
                })
                /*->whereHas('objectives', function($q) use ($searchValue) {
                    if ($searchValue) {
                        $q->where('objectives.name', $searchValue);
                    }
                })*/
                ->orderBy('created_at', $columnSortOrder)
                ->where('enabled', 1)
                ->get();

        $items_array = [];

        foreach($records as $item) {
            $objective = $item->objectives->count() ? $item->objectives[0]->name : '';
            $status = $item->statuses->count() ? $item->statuses->last() : [];
            if ($role == 'superadmin') {
                $video = '<div class="video bg-dark" style="height: 60px;width: 60px;">
                        <div class="embed-responsive embed-responsive-16by9 h-100">
                            <video class="embed-responsive-item item-video">
                                <source src="/uploads/videos/'.$item->file.'">
                            </video>
                        </div>
                    </div>';
                $details = '<h6 class="mb-1 video-title">'.$item->name.' </h6>
                        <p class="mb-0"><span class="align-middle">'.date('d-m-Y', strtotime($item->created_at)).'</span> <span class="badge badge-primary align-middle px-2">'. $objective .' - Parte '.$item->part.'</span></p>';
                $tools = '<div class="buttons-group"><button class="btn py-2 btn-success shadow-sm h-100" data-toggle="modal" data-target="#modalVideo" data-video="/uploads/videos/' .$item->file .'" title="Ver"><i class="fas fa-eye d-block"></i></button>
                    <button class="btn btn-danger py-2 shadow-sm h-100 btn-delete" data-id="'.$item->id.'" title="Eliminar"><i class="fas fa-trash d-block"></i></button></div>';
            } else {
                $video = '<div class="video bg-dark" style="height: 60px;width: 60px;">
                        <div class="embed-responsive embed-responsive-16by9 h-100">
                            <video class="embed-responsive-item item-video">
                                <source src="/uploads/videos/'.$item->file.'">
                            </video>
                        </div>
                    </div>';
                $details = '<h6 class="mb-1">'.date('d-m-Y', strtotime($item->created_at)).' <span class="badge badge-primary align-middle" style="font-size:14px;padding-top:2px">'.$objective.'</span></h6>
                    <p class="mb-0"><span class="align-middle">'.$item->name.' </span></p>';
                /*if ($show_statuses) {
                    if ($status) {
                        if ($status->id != 1) {
                            $tools = '<div class="buttons-group"><button class="btn '.$status->class.' col btn-block shadow-sm h-100"><i class="fas '.$status->class.' fa-2x text-warning d-block"></i> '.$status->name.'</button></div>';
                        } else {
                            $tools = '<div class="buttons-group"><div class="btn-group"><button class="btn btn-success py-2 shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button> <button class="btn btn-danger py-2 shadow-sm h-100">hacer <br>cambios</button></div>';
                        }
                    }
                } else {
                    $tools = '<div class="buttons-group"><button class="btn btn-success py-2 shadow-sm h-100" data-toggle="modal" data-target="#modalVideo" data-video="/uploads/videos/' .$item->file .'"><i class="fas fa-eye d-block"></i> Ver</button>
                    <button class="btn btn-danger py-2 shadow-sm h-100"><i class="fas fa-pen-square d-block"></i> Solicitar cambios</button></div>';
                }*/
                $tools = '<div class="buttons-group"><button class="btn btn-success py-2 shadow-sm h-100" data-toggle="modal" data-target="#modalVideo" data-video="/uploads/videos/' .$item->file .'" title="Ver"><i class="fas fa-eye d-block"></i></button>
                    <button class="btn btn-danger py-2 shadow-sm h-100 btn-delete" data-id="'.$item->id.'" title="Eliminar"><i class="fas fa-trash d-block"></i></button></div>';
            }

            $items_array[] = array(
                "video" => $video,
                "objective" => $objective,
                "details" => $details,
                "tools" => $tools
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $items_array
        );

        echo json_encode($response);
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);

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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);
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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);
        
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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);

        $video = Video::findOrFail($id);
        $video->enabled = 0;
        $video->save();

        if (DIRECTORY_SEPARATOR === '/') {
            // unix, linux, mac
            $filename = env('FILES_PATH').'/uploads/videos/'.$video->file;
            if (is_file($filename)) {
                \File::delete($filename);
            } else {
                $filename = public_path('/uploads/videos/'.$video->file);
                if (is_file($filename)) {
                    \File::delete($filename);
                }
            }
        } else {
            $filename = public_path('/uploads/videos/'.$video->file);
            if (is_file($filename)) {
                \File::delete($filename);
            }
        }

        return response()->json(['status'=>"success", 'data'=>$video]);
    }

    public function getVideoList(Request $request, $objective, $part, $type)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);
        
        $role = \Auth::user()->roles->first()->name;
        $user_id = \Auth::id();

        if ($type == 1) { //Sugerir
            if ($part == 4) {
                //Lista de videos subidos solo por el usuario
                $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                ->where('videos.part', '=', $part)
                ->whereHas('objectives', function ($query) use ($objective) {
                    $query->where("video_objectives.objective_id", $objective);
                })
                ->whereDoesntHave('statuses', function ($query) {
                    $query->where("statuses.id", "=", 1);
                    $query->where("statuses.id", "=", 3);
                })
                ->with('objectives')
                ->orderBy('id', 'desc')
                ->where('user_id', $user_id)
                ->where('enabled', 1)
                ->limit(10)
                ->get();
            } else {
                $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                ->where('videos.part', '=', $part)
                ->whereHas('objectives', function ($query) use ($objective) {
                    $query->where("video_objectives.objective_id", $objective);
                })
                ->whereDoesntHave('statuses', function ($query) {
                    $query->where("statuses.id", "=", 1);
                    $query->where("statuses.id", "=", 3);
                })
                ->with('objectives')
                ->orderBy('id', 'desc')
                //->where('user_id', $user_id) //no debe ir
                ->where('enabled', 1)
                ->limit(10)
                ->get();
            }
        } else {
            if ($part == 4) {
                //Lista de videos subidos solo por el usuario
                $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                ->where('videos.part', '=', $part)
                ->whereHas('objectives', function ($query) use ($objective) {
                    $query->where("video_objectives.objective_id", $objective);
                })
                ->whereDoesntHave('statuses', function ($query) {
                    $query->where("statuses.id", "=", 1);
                    $query->where("statuses.id", "=", 3);
                })
                ->with('objectives')
                ->orderBy('id', 'desc')
                ->where('user_id', $user_id)
                ->where('enabled', 1)
                ->limit(10)
                ->get();
            } else {
                $videos = Video::join('video_types', 'video_types.id', '=', 'videos.type_id')
                ->select('videos.*', 'video_types.name as video_type')
                ->where('videos.part', '=', $part)
                ->whereHas('objectives', function ($query) use ($objective) {
                    $query->where("video_objectives.objective_id", $objective);
                })
                ->whereDoesntHave('statuses', function ($query) {
                    $query->where("statuses.id", "=", 1);
                    $query->where("statuses.id", "=", 3);
                })
                ->with('objectives')
                ->orderBy('id', 'desc')
                //->where('user_id', $user_id) //no debe ir
                ->where('enabled', 1)
                ->limit(10)
                ->get();
            }
        }

        return response()->json(['status'=>"success", 'data'=>$videos]);
    }
}
