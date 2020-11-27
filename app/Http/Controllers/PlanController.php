<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    //

     public function index()
    {

    	$planes = Plan::all();

        return view('admin.planes.index', compact('planes'));
    }
}
