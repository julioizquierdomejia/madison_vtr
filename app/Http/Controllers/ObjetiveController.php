<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objective;

class ObjetiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin']);

        $objetivos = Objective::all();
        return view('admin.objetivos.index', compact('objetivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin']);
        
        return view('admin.objetivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin']);
        
        $request->validate([
            'name' => 'required',
        ]);

        if($request->enabled == 'on'){
            $enabled = 1;
        }else{
            $enabled = 0;
        }

        Objective::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'enabled' => $enabled
        ]);

        //return redirect()->route('admin.objetivos.index');
        $objetivos = Objective::all();
        return view('admin.objetivos.index', compact('objetivos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request->user()->authorizeRoles(['superadmin']);
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
        $objetivo = Objective::findorFail($id);
        return view('admin.objetivos.edit', compact('objetivo'));
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
        $request->user()->authorizeRoles(['superadmin']);

        $objetivo = Objective::findorFail($id);
        $request->validate([
            'name' => 'required',
        ]);

        if($request->enabled == 'on'){
            $enabled = 1;
        }else{
            $enabled = 0;
        }

        $objetivo->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'enabled' => $enabled
        ]);

        //return redirect()->route('admin.objetivos.index');
        $objetivos = Objective::all();
        return view('admin.objetivos.index', compact('objetivos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request->user()->authorizeRoles(['superadmin']);
        return ('hola');
    }
}
