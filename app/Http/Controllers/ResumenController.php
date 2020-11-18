<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Ritual;
use App\Models\VideoStatus;
use App\Models\RitualStatus;

class ResumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        
        $videos = Video::all();
        $rituales = Ritual::all();
        $ritual_status = RitualStatus::all();
        $video_status = VideoStatus::all();
        return view('admin.resumen.index', compact('rituales', 'videos', 'ritual_status', 'video_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);

        return view('resumen.create');
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
            'name'       => 'string|required|unique:resumen',
            'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        $area = new Video();
        
        $area->name = $request->input('name');
        $area->enabled = $request->input('enabled');

        $area->save();

        activitylog('resumen', 'store', null, $area->toArray());

        $resumen = Video::where('enabled', 1)->get();
        return redirect('resumen')->with('resumen');
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

        return view('resumen.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        $resumen = Video::where('enabled', 1)->get();
        $services = Service::where('enabled', 1)->where('area_id', $id)->get();
        $area = Video::findOrFail($id);
        return view('resumen.edit', compact('area', 'resumen', 'services'));
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
        $request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required|string|unique:resumen,name,'.$id,
            'enabled'      => 'boolean|required',
        );
        $this->validate($request, $rules);

        // update
        $area = Video::findOrFail($id);
        $original_data = $area->toArray();

        $area->name       = $request->get('name');
        $area->enabled    = $request->get('enabled');
        $area->save();

        activitylog('resumen', 'update', $original_data, $area->toArray());

        // redirect
        \Session::flash('message', 'Successfully updated area!');
        return redirect('resumen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Video $video)
    {
        $request->user()->authorizeRoles(['superadmin', 'admin']);
    }
}
