<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Order;
use App\Models\Status;
use App\Models\OrderStatus;
use App\Models\OrderService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    public function getList(Request $request)
    {
        $role = \Auth::user()->roles->first()->name;
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

        $totalRecords = Order::select('count(*) as allcount')
            /*->whereHas('statuses', function ($query) {
                $query->where("status.id", "=", 1)
                    ->orWhere("status.id", "=", 2);
            })*/
            ->where(function($query) use ($role, $user_id) {
                if ($role != 'superadmin') {
                    $query->where('user_id', $user_id);
                }
            })
            ->count();

        $totalRecordswithFilter = Order::select('count(*) as allcount')
            ->where(function($query) use ($searchValue) {
                $query->where('orders.topic', 'like', '%'.$searchValue.'%')
                    ->orWhere('orders.type', 'like', '%'.$searchValue.'%')
                    ->orWhere('orders.avatar', 'like', '%'.$searchValue.'%');
            })
            ->where(function($query) use ($role, $user_id) {
                if ($role != 'superadmin') {
                    $query->where('user_id', $user_id);
                }
            })
            /*->whereHas('statuses', function ($query) {
                $query->where("status.id", "=", 1)
                    ->orWhere("status.id", "=", 2);
            })*/
            ->count();

        $video_requests = Order::select('orders.*')
            ->skip($start)
            ->take($rowperpage)
            ->where(function($query) use ($searchValue, $role) {
                $query->where('orders.topic', 'like', '%'.$searchValue.'%')
                    ->orWhere('orders.type', 'like', '%'.$searchValue.'%')
                    ->orWhere('orders.avatar', 'like', '%'.$searchValue.'%');
            })
            /*->whereHas('statuses', function ($query) {
                $query->where("status.id", "=", 1)
                    ->orWhere("status.id", "=", 2);
            })*/
            ->where(function($query) use ($role, $user_id) {
                if ($role != 'superadmin') {
                    $query->where('user_id', $user_id);
                }
            })
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $items_array = [];

        foreach ($video_requests as $key => $row) {
            $empresa = $row->user->info->empresa;
            $alias = '';
            $status = ' <button class="btn btn-light py-2 shadow-sm" style="font-size:12px">En cola</button>';
            $video = $row->video;
            if ($video) {
                $row_video = [
                    'id' => $video->id,
                    'name' => $video->name,
                    'part' => $video->part,
                    'objective_id' => $video->objective_id,
                ];
                $last_status = $video->statuses->last();
                if ($last_status) {
                    $alias = $last_status->alias;
                    if ($alias == 'approved' || $alias == 'published') {
                        $totalRecords> 0 ? $totalRecords-- : $totalRecords;
                        $totalRecordswithFilter> 0 ? $totalRecordswithFilter-- : $totalRecordswithFilter;
                        continue;
                    }
                    if ($role == 'superadmin') {
                        $status = ' <button class="btn shadow-sm" style="font-size:12px"><i class="fas '.$last_status->class.' '.$last_status->color.' text-warning d-block"></i> '.$last_status->name.'</button> ';
                    } else {
                        if ($alias == 'changing' || $alias == 'approved') {
                            $status = ' <button class="btn shadow-sm" style="font-size:12px"><i class="fas '.$last_status->class.' '.$last_status->color.' text-warning d-block"></i> '.$last_status->name.'</button> ';
                        } else {
                            $status = ' <button class="btn btn-success py-2 shadow-sm btn-changestatus" data-id="'.$row->video->id.'" data-type="approved" style="font-size:12px"><i class="fas fa-check d-block"></i> aprobar</button> <button class="btn btn-danger py-2 shadow-sm btn-changestatus" data-id="'.$row->video->id.'"  data-type="changing" style="font-size:12px;line-height:15px">hacer <br>cambios</button> ';
                        }
                    }
                }
            }
            $topic = '<h6 class="mb-1 video-title">'.$row->topic.' <span class="align-middle badge badge-primary" style="font-size: 16px">'.date('d/m/Y', strtotime($row->created_at)) .'</span></h6><p class="mb-0">'.$row->comments ?? '-'.'</p>';
            if ($role == 'superadmin') {
                if ($alias == 'reviewing') {
                    $tools = '';
                } else {
                    if ($alias == 'changing') {
                        $tools = '<button class="btn btn-warning shadow-sm btn-solvideo" data-oid="'.$row->objective_id.'" data-video="'.htmlspecialchars(json_encode($row->video->statuses), ENT_QUOTES, 'UTF-8').'" data-uid="'.$row->user_id.'" data-rid="'.$row->id.'" data-type="edit" title="Editar vídeo"><i class="fas fa-edit"></i></button> ';
                    } else {
                        $tools = '<button class="btn btn-warning shadow-sm btn-solvideo" data-oid="'.$row->objective_id.'" data-uid="'.$row->user_id.'" data-rid="'.$row->id.'" data-type="upload" title="Subir vídeo"><i class="fas fa-upload"></i></button> ';
                    }
                }
                $user = '<span class="badge badge-success uname-name">'.$empresa.'</span>';
            } else {
                $tools = '';
                $user = '';
            }

            $tools .= '<a class="btn btn-primary shadow-sm" href="'.route('request_video.show', $row->id).'"><i class="far fa-eye"></i></a>';

            $items_array[] = array(
                "topic" => $topic,
                "user" => $user,
                "status" => $status,
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
            'services'      => 'nullable|array',
            'tema'     => 'required|string',
            'tipo'      => 'required|string',
            'avatar'    => 'required|string',
            'comments'  => 'nullable|string',
            'objetivo'  => 'required|integer|exists:objectives,id',
            'speech'    => 'required|mimes:pdf|max:50000',
        );
        $this->validate($request, $rules);

        $services = $request->get('services') ?? [];
        $speech = $request->file('speech');
        $ext = $speech->getClientOriginalExtension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$speech->getClientOriginalName());

        $video_request = new Order();
        $video_request->topic = $request->get('tema');
        $video_request->type = $request->get('tipo');
        $video_request->avatar = $request->get('avatar');
        $video_request->comments = $request->get('comments');
        $video_request->speech = $uniqueFileName;
        $video_request->user_id = \Auth::id();
        $video_request->objective_id = $request->get('objetivo');
        //$video_request->status_id = 1; //Subido
        $video_request->save();

        /*$request_status = new OrderStatus();
        $request_status->order_id = $video_request->id;
        $request_status->status_id = 1;
        $request_status->save();*/

        foreach ($services as $key => $item) {
            $video_service = new OrderService();
            $video_service->order_id = $video_request->id;
            $video_service->service_id = $item;
            $video_service->save();
        }

        $speech->move(public_path('uploads/requests/'.$video_request->id), $uniqueFileName);

        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $role = \Auth::user()->roles->first()->name;
        if ($role == 'superadmin') {
            $video_request = Order::findOrFail($id);
        } else {
            $video_request = Order::where('user_id', \Auth::id())->findOrFail($id);
        }

        return view('admin.solicitar-videos.show', compact('role', 'video_request'));
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
        return view('solicitar-videos.edit', compact('video'));
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
