<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\Plan;
use App\Models\Role;
use App\Models\UserPlan;
use App\Models\RoleUser;

class ClientController extends Controller
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

        /*if (\Auth::user()->roles->first()->name == 'admin') {
            $clientes = User::join('info_users', 'info_users.user_id', 'users.id')
                        ->where('info_users.parent_id', \Auth::user()->id)
                        ->where('users.id', '<>', 1)
                        ->get();
        } else {
            $clientes = User::where('users.id', '<>', 1)->get();
        }*/

        return view('admin.clientes.index', compact('role'/*, 'clientes'*/));
    }

    public function list(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

        $counter = 0;
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

        if (\Auth::user()->roles->first()->name == 'admin') {
            $user_id = \Auth::id();
            $totalRecords = User::join('user_information', 'user_information.user_id', 'users.id')
                ->where('user_information.parent_id', $user_id)
                ->where('users.id', '<>', 1)
                ->count();

            $totalRecordswithFilter = User::select('count(*) as allcount')
                    ->join('user_information', 'user_information.user_id', 'users.id')
                    ->select('users.name', 'users.email', 'user_information.cargo', 'user_information.empresa', 'user_information.photo')
                    ->where(function($query) use ($searchValue) {
                        $query->where('users.name', 'like', '%'.$searchValue.'%')
                            ->orWhere('users.email', 'like', '%'.$searchValue.'%')
                            ->orWhere('user_information.cargo', 'like', '%'.$searchValue.'%')
                            ->orWhere('user_information.empresa', 'like', '%'.$searchValue.'%');
                    })
                    ->where('user_information.parent_id', $user_id)
                    ->where('users.id', '<>', 1)
                    ->count();

            $records = User::join('user_information', 'user_information.user_id', 'users.id')
                        ->select('users.name', 'users.email', 'user_information.cargo', 'user_information.empresa', 'user_information.photo')
                        ->skip($start)
                        ->take($rowperpage)
                        ->where(function($query) use ($searchValue) {
                            $query->where('users.name', 'like', '%'.$searchValue.'%')
                                ->orWhere('users.email', 'like', '%'.$searchValue.'%')
                                ->orWhere('user_information.cargo', 'like', '%'.$searchValue.'%')
                                ->orWhere('user_information.empresa', 'like', '%'.$searchValue.'%');
                        })
                        ->where('user_information.parent_id', $user_id)
                        ->where('users.id', '<>', 1)
                        ->orderBy($columnName, $columnSortOrder)
                        ->get();
        } else {
            $totalRecords = User::join('user_information', 'user_information.user_id', 'users.id')
                ->where('users.id', '<>', 1)
                ->count();

            $totalRecordswithFilter = User::select('count(*) as allcount')
                    ->join('user_information', 'user_information.user_id', 'users.id')
                    ->select('users.name', 'users.email', 'user_information.cargo', 'user_information.empresa', 'user_information.photo')
                    ->where(function($query) use ($searchValue) {
                        $query->where('users.name', 'like', '%'.$searchValue.'%')
                            ->orWhere('users.email', 'like', '%'.$searchValue.'%')
                            ->orWhere('user_information.cargo', 'like', '%'.$searchValue.'%')
                            ->orWhere('user_information.empresa', 'like', '%'.$searchValue.'%');
                    })
                    ->where('users.id', '<>', 1)
                    ->count();

            $records = User::join('user_information', 'user_information.user_id', 'users.id')
                        ->select('users.*', 'user_information.cargo', 'user_information.empresa', 'user_information.photo')
                        ->skip($start)
                        ->take($rowperpage)
                        ->where(function($query) use ($searchValue) {
                            $query->where('users.name', 'like', '%'.$searchValue.'%')
                                ->orWhere('users.email', 'like', '%'.$searchValue.'%')
                                ->orWhere('user_information.cargo', 'like', '%'.$searchValue.'%')
                                ->orWhere('user_information.empresa', 'like', '%'.$searchValue.'%');
                        })
                        ->where('users.id', '<>', 1)
                        ->orderBy($columnName, $columnSortOrder)
                        ->get();
        }

        $rows_array = [];

        foreach ($records as $key => $client) {
            if ($client->photo) {
                $photo = '<div class="card-image text-center bg-light card-img-top"><div class="embed-responsive embed-responsive-16by9 card-img-top" style="background-image: url(/uploads/photos/'.$client->id.'/'.$client->photo.'); background-size: cover;background-repeat: no-repeat;background-position: center;">
                </div></div>';
            } else {
                $photo = '<div class="card-image text-center bg-light card-img-top"><div class="embed-responsive embed-responsive-16by9 card-img-top">
                <div class="embed-responsive-item d-flex align-items-center"><i class="far fa-user fa-3x w-100"></i></div>
                </div></div>';
            }
            $role = '';
            if ($client->roles->count()) {
                if ($client->roles->first()->id == 2) {
                  $role = '<span class="badge badge-primary px-3 py-1">'.$client->roles->first()->name.'</span>';
                } else {
                  $role = '<span class="badge badge-success px-3 py-1">'.$client->roles->first()->name.'</span>';
                }
            }

            $rows_array[] = array(
              "photo" => $photo,
              "empresa" => $client->empresa,
              "name" => $client->name,
              "email" => $client->email,
              "role" => $role,
            );
        };

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $rows_array
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

        $planes = Plan::all();
        $roles = Role::where('id', '>', 2)->get(); //obviar superadmin y admin

        return view('admin.clientes.create', compact('planes', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);

        $superadmin = \Auth::user()->roles->first()->name == 'superadmin';
        $admin = \Auth::user()->roles->first()->name == 'admin';

        $rules = array(
            'empresa' => 'required|min:3',
            'cargo' => 'nullable|min:3',
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:users',
            'plan_id' => 'required|exists:plans,id',
        );
        if ($superadmin) {
            $rules['roles'] = 'sometimes|integer';
        } else {
            $rules['roles'] = 'required|integer';
        }

        $this->validate($request, $rules);

        $roles = $request->get('roles');

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt('12345678');
        $user->save();
        
        $user_info = new UserInformation;
        $user_info->user_id = $user->id;
        $user_info->empresa = $request->get('empresa');
        $user_info->cargo = $request->get('cargo');
        if ($admin) {
            $user_info->parent_id = \Auth::user()->id;
        }
        $user_info->save();

        $plan_user = new UserPlan;
        $plan_user->user_id = $user->id;
        $plan_user->plan_id = $request->get('plan_id');
        $plan_user->save();

        if ($superadmin) {
            $role_user = new RoleUser();
            $role_user->user_id = $user->id;
            $role_user->role_id = 2;
            $role_user->save();
        } else {
            $role_user = new RoleUser();
            $role_user->user_id = $user->id;
            $role_user->role_id = $roles;
            $role_user->save();
        }

        return redirect()->route('clientes.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }
}
