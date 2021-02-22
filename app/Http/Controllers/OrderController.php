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
            ->count();

        $totalRecordswithFilter = Order::select('count(*) as allcount')
            ->where(function($query) use ($searchValue) {
                $query->where('orders.topic', 'like', '%'.$searchValue.'%')
                    ->orWhere('orders.type', 'like', '%'.$searchValue.'%')
                    ->orWhere('orders.avatar', 'like', '%'.$searchValue.'%');
            })
            /*->whereHas('statuses', function ($query) {
                $query->where("status.id", "=", 1)
                    ->orWhere("status.id", "=", 2);
            })*/
            ->count();

        $video_requests = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*', 'users.name as user')
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
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $items_array = [];

        foreach ($video_requests as $key => $request) {
            $topic = '<h6 class="mb-1 video-title">'.$request->topic.' <span class="align-middle badge badge-primary" style="font-size: 16px">'.date('d/m/Y', strtotime($request->created_at)) .'</span></h6>
                <p class="mb-0">'.$request->comments ?? '-'.'</p>';
            if ($role == 'superadmin') {
                $tools = '<button class="btn btn-warning shadow-sm btn-supload" data-uid="'.$request->user_id.'" data-rid="'.$request->id.'" title="Subir vídeo"><i class="fas fa-upload"></i></button> ';
                $user = '<span class="badge badge-success uname-name">'.$request->user.'</span>';
            } else {
                $tools = '';
                $user = '';
            }

            $tools .= '<a class="btn btn-primary shadow-sm" href="'.route('request_video.show', $request->id).'"><i class="far fa-eye"></i></a>';

            $items_array[] = array(
                "topic" => $topic,
                "user" => $user,
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
            'topic'     => 'required|string',
            'type'      => 'required|string',
            'avatar'    => 'required|string',
            'comments'  => 'nullable|string',
            'speech'    => 'required|mimes:pdf|max:50000',
        );
        $this->validate($request, $rules);

        $services = $request->get('services') ?? [];
        $speech = $request->file('speech');
        $ext = $speech->getClientOriginalExtension();
        $uniqueFileName = preg_replace('/\s+/', "-", uniqid().'_'.$speech->getClientOriginalName());

        $video_request = new Order();
        $video_request->topic = $request->get('topic');
        $video_request->type = $request->get('type');
        $video_request->avatar = $request->get('avatar');
        $video_request->comments = $request->get('comments');
        $video_request->speech = $uniqueFileName;
        $video_request->user_id = \Auth::id();
        //$video_request->status_id = 1; //Subido
        $video_request->save();

        $request_status = new OrderStatus();
        $request_status->order_id = $video_request->id;
        $request_status->status_id = 1;
        $request_status->save();

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
        $video_request = Order::findOrFail($id);

        return view('admin.solicitar-videos.show', compact('video_request'));
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
