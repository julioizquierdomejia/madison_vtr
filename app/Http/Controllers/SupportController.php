<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\SupportType;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

        $role = \Auth::user()->roles->first()->name;
        
        //$supports = Support::all();
        $support_types = SupportType::all();
        return view('admin.soporte.index', compact(/*'supports',*/ 'support_types', 'role'));
    }

    public function list(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

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

        $totalRecords = Support::select('count(*) as allcount')->count();

        $totalRecordswithFilter = Support::select('count(*) as allcount')
                ->where(function($query) use ($searchValue) {
                    $query->where('supports.message', 'like', '%'.$searchValue.'%');
                })
                ->orwhereHas('type', function($query) use ($searchValue) {
                    $query->where('support_types.name', 'like', '%'.$searchValue.'%');
                })
                ->orwhereHas('user', function($query) use ($searchValue) {
                    $query->where('users.name', 'like', '%'.$searchValue.'%');
                })
                ->count();

        $records = Support::select('supports.*')
                    ->skip($start)
                    ->take($rowperpage)
                    ->where(function($query) use ($searchValue) {
                        $query->where('supports.message', 'like', '%'.$searchValue.'%');
                    })
                    ->orwhereHas('type', function($query) use ($searchValue) {
                    $query->where('support_types.name', 'like', '%'.$searchValue.'%');
                })
                ->orwhereHas('user', function($query) use ($searchValue) {
                    $query->where('users.name', 'like', '%'.$searchValue.'%');
                })
                    ->orderBy($columnName, $columnSortOrder)
                    ->get();

        $items_array = [];

        foreach ($records as $key => $item) {
            $created_at = $item->created_at->format('d-m-Y');

            $items_array[] = array(
              "created_at" => $created_at,
              "type" => $item->type->name,
              "user" => $item->user->name,
              "message" => $item->message,
            );
        };

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

        return view('soporte.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->user()->authorizeRoles(['superadmin', 'admin', 'editor']);
        $rules = array(
            'soporte'       => 'integer|required',
            'mensaje'      => 'string|required|min:10',
        );
        $this->validate($request, $rules);

        $support = new Support();
        
        $support->support_type_id = $request->input('soporte');
        $support->message = $request->input('mensaje');
        $support->user_id = \Auth::id();
        $support->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Support  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

        $support = Support::findOrFail($id);

        return view('support.show', compact('support'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

        $support = Support::where('enabled', 1)->get();
        return view('soporte.edit', compact('support'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Support  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
        
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required|string|unique:support,name,'.$id,
            'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        // update
        $area = Support::findOrFail($id);
        $original_data = $area->toArray();

        $area->name       = $request->get('name');
        $area->enabled    = $request->get('enabled');
        $area->save();

        activitylog('support', 'update', $original_data, $area->toArray());

        // redirect
        \Session::flash('message', 'Successfully updated area!');
        return redirect('soporte');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Support  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Support $area)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }
}
