<?php

namespace App\Http\Controllers;

//use App\Models\Support;
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
        //$request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        
        //$support = Support::all();
        return view('admin.soporte.index'/*, compact('support')*/);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);

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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);

        $rules = array(
            'name'       => 'string|required|unique:support',
            'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        $area = new Support();
        
        $area->name = $request->input('name');
        $area->enabled = $request->input('enabled');

        $area->save();

        activitylog('support', 'store', null, $area->toArray());

        $support = Support::where('enabled', 1)->get();
        return redirect('soporte')->with('support');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Support  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $area = Client::findOrFail($id);

        return view('support.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        $support = Support::where('enabled', 1)->get();
        $services = Service::where('enabled', 1)->where('area_id', $id)->get();
        $area = Support::findOrFail($id);
        return view('soporte.edit', compact('area', 'support', 'services'));
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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        
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
