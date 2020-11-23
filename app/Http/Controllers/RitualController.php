<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ritual;
use App\Models\RitualObjective;
use App\Models\RitualStatus;
use App\Models\RitualType;

class RitualController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ritual_types = RitualType::all();
        $objectives = RitualObjective::where('enabled', 1)->get();
        $rituales = Ritual::join('ritual_status', 'ritual_status.id', '=', 'rituals.ritual_status_id')
            ->join('ritual_types', 'ritual_types.id', '=', 'rituals.ritual_type_id')
            ->join('ritual_objectives', 'ritual_objectives.id', '=', 'rituals.ritual_objective_id')
            ->select('rituals.*', 'ritual_status.name as status', 'rituals.ritual_status_id', 'ritual_objectives.name as objective');
        $status = RitualStatus::all();

        return view('admin.rituales.index', compact('rituales', 'objectives', 'status', 'ritual_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->user()->authorizeRoles(['superadmin', 'admin', 'reception']);
        //
        $rules = [
            'client_id' => 'required|integer',
            //'fecha_creacion' => 'required',
            'guia_cliente' => 'string|nullable',
            'solped' => 'string|nullable',
            'descripcion_motor' => 'string|nullable',
            'codigo_motor' => 'string|nullable',
            'marca_id' => 'integer|nullable',
            'modelo_id' => 'integer|nullable',
            'numero_potencia' => 'string|nullable',
            'medida_potencia' => 'string|nullable',
            'voltaje' => 'string|nullable',
            'velocidad' => 'string|nullable',
            'enabled' => 'required|boolean',
        ];

        $messages = [
            //'ruc.required' => 'Agrega el nombre del estudiante.',
        ];

        $this->validate($request, $rules);

        //creamos una variable que es un objeto de nuesta instancia de nuestro modelo
        $ot = new Ot();
        
        $ot->client_id = $request->input('client_id');
        //$ot->fecha_creacion = $request->input('fecha_creacion');
        $ot->guia_cliente = $request->input('guia_cliente');
        $ot->solped = $request->input('solped');
        $ot->descripcion_motor = $request->input('descripcion_motor');
        $ot->codigo_motor = $request->input('codigo_motor');
        $ot->marca_id = $request->input('marca_id');
        $ot->modelo_id = $request->input('modelo_id');
        $ot->numero_potencia = $request->input('numero_potencia');
        $ot->medida_potencia = $request->input('medida_potencia');
        $ot->voltaje = $request->input('voltaje');
        $ot->velocidad = $request->input('velocidad');
        $ot->enabled = $request->input('enabled');

        $ot->save();

        $status = Status::where('id', 1)->first();
        if ($status) {
            \DB::table('status_ot')->insert([
                'status_id' => $status->id,
                'ot_id' => $ot->id,
            ]);
        }

        activitylog('ots', 'store', null, $ot->toArray());

        return redirect('ordenes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['client']);
        
        $orden = Ot::join('motor_brands', 'motor_brands.id', '=', 'ots.marca_id')
                    ->select('ots.*', 'motor_brands.name as marca')
                    ->where('ots.enabled', 1)
                    ->findOrFail($id);

        $ordenes = Ot::where('ots.id', '<>', $id)
                    ->join('motor_brands', 'motor_brands.id', '=', 'ots.marca_id')
                    ->select('ots.*', 'motor_brands.name as marca')
                    ->where('ots.enabled', 1)
                    ->get();

        return view('procesovirtual.show', compact('orden', 'ordenes'));
    }
}
