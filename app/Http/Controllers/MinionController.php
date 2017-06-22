<?php

namespace App\Http\Controllers;

use App\Models\Minion;
use Illuminate\Http\Request;

class MinionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $minion = Minion::findOrFail($id);
        return $minion->toJson();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Minion::all()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
         $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'icon2' => 'required',
            'patch' => 'required',
            'name_en' => 'required',
            'name_fr' => 'required',
            'name_de' => 'required',
            'name_ja' => 'required',
            'info1_en' => 'required',
            'info1_fr' => 'required',
            'info1_de' => 'required',
            'info1_ja' => 'required',
            'summon_en' => 'required',
            'summon_fr' => 'required',
            'summon_de' => 'required',
            'summon_ja' => 'required',
            'behavior' => 'required',
        ]);
        
        $minion = new Minion();
        $minion->id = $request->id;
        $minion->name = $request->name;
        $minion->icon_url = $request->icon2;
        $minion->picture_url = $request->icon;
        $minion->patch = $request->patch['number'];
        $minion->name_en = $request->name_en;
        $minion->name_fr = $request->name_fr;
        $minion->name_de = $request->name_de;
        $minion->name_ja = $request->name_ja;
        $minion->description_en = $request->info1_en;
        $minion->description_fr = $request->info1_fr;
        $minion->description_de = $request->info1_de;
        $minion->description_ja = $request->info1_ja;
        $minion->summon_en = $request->summon_en;
        $minion->summon_fr = $request->summon_fr;
        $minion->summon_de = $request->summon_de;
        $minion->summon_ja = $request->summon_ja;
        $minion->behavior = $request->behavior;
        $minion->save();
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}