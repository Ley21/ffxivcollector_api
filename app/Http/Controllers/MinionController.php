<?php

namespace App\Http\Controllers;

use App\Models\Minion;
use App\Models\Verminion;
use App\Models\MinionMethod;
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
        
        
        $verminion = new Verminion();
        $verminion->id = $request->id;
        $verminion->race = $request->race;
        $verminion->cost = $request->cost;
        $verminion->hp = $request->hp;
        $verminion->attack = $request->attack;
        $verminion->defense = $request->defense;
        $verminion->attack = $request->attack;
        $verminion->speed = $request->speed;
        $verminion->skill_cost = $request->skill_cost;
        $verminion->skill_type = $request->minion_skill_type;
        $verminion->action_en = $request->action_en;
        $verminion->action_fr = $request->action_fr;
        $verminion->action_de = $request->action_de;
        $verminion->action_ja = $request->action_ja;
        $verminion->strength_arcana = $request->strength_arcana;
        $verminion->strength_eye = $request->strength_eye;
        $verminion->strength_gate = $request->strength_gate;
        $verminion->strength_shield = $request->strength_shield;
        $verminion->help_en = $request->help_en;
        $verminion->help_fr = $request->help_fr;
        $verminion->help_de = $request->help_de;
        $verminion->help_ja = $request->help_ja;
        
        $minion->save();
        $verminion->save();
    }
    
    public function storeMethod(Request $request)
    {
        
         $this->validate($request, [
            'id' => 'required',
            'methodes' => 'required',
        ]);
        
        foreach($request->methodes as $method){
            $method_object = new MinionMethod();
            $method_object->minion_id = $request->id;
            $method_object->method_name = $method['method'];
            $method_object->available = $method['available'];
            $method_object->description_en = $method['method_description_en'] ?? "";
            $method_object->description_fr = $method['method_description_fr'] ?? "";
            $method_object->description_de = $method['method_description_de'] ?? "";
            $method_object->description_ja = $method['method_description_ja'] ?? "";
            $method_object->save();
        }
    }
    
    public function updateMethodes(Request $request)
    {
        
         $this->validate($request, [
            'id' => 'required',
            'methodes' => 'required',
        ]);
        
        foreach($request->methodes as $method){
            $method_object = MinionMethod::where('minion_id',$request->id)->where('method_name',$method['method'])->first();
            $method_object->available = $method['available'];
            $method_object->description_en = $method['method_description_en'] ?? "";
            $method_object->description_fr = $method['method_description_fr'] ?? "";
            $method_object->description_de = $method['method_description_de'] ?? "";
            $method_object->description_ja = $method['method_description_ja'] ?? "";
            $method_object->save();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        $minion = Minion::find($id);
        $verminion = Verminion::find($id);
        
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
        
        
        $verminion->id = $request->id;
        $verminion->race = $request->race;
        $verminion->cost = $request->cost;
        $verminion->hp = $request->hp;
        $verminion->attack = $request->attack;
        $verminion->defense = $request->defense;
        $verminion->attack = $request->attack;
        $verminion->speed = $request->speed;
        $verminion->skill_cost = $request->skill_cost;
        $verminion->skill_type = $request->minion_skill_type;
        $verminion->action_en = $request->action_en;
        $verminion->action_fr = $request->action_fr;
        $verminion->action_de = $request->action_de;
        $verminion->action_ja = $request->action_ja;
        $verminion->strength_arcana = $request->strength_arcana;
        $verminion->strength_eye = $request->strength_eye;
        $verminion->strength_gate = $request->strength_gate;
        $verminion->strength_shield = $request->strength_shield;
        $verminion->help_en = $request->help_en;
        $verminion->help_fr = $request->help_fr;
        $verminion->help_de = $request->help_de;
        $verminion->help_ja = $request->help_ja;
        
        $minion->save();
        $verminion->save();
    }

}