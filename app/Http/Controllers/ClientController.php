<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InfoUser;
use App\Models\Plan;
use App\Models\Role;
use App\Models\PlanUser;
use App\Models\RoleUser;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = User::all();

        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $planes = Plan::all();
        $roles = Role::all();

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
        //
        $request->validate([
            'empresa' => 'required|min:3',
            'cargo' => 'required|min:3',
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:users',
            'plan_id' => 'required|exists:plans,id',
            'roles' => 'required|array',
        ]);

        $roles = $request->get('roles');

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt('12345678');
        $user->save();
        
        $user_info = new InfoUser;
        $user_info->user_id = $user->id;
        $user_info->empresa = $request->get('empresa');
        $user_info->cargo = $request->get('cargo');
        $user_info->save();

        $plan_user = new PlanUser;
        $plan_user->user_id = $user->id;
        $plan_user->plan_id = $request->get('plan_id');
        $plan_user->save();

        foreach ($roles as $key => $item) {
            $role_user = new RoleUser();
            $role_user->user_id = $user->id;
            $role_user->role_id = $item;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
