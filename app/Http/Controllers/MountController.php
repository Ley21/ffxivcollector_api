<?php

namespace App\Http\Controllers;

use App\Models\Mount;
use App\Models\MountMethod;
use Illuminate\Http\Request;

class MountController extends Controller
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
        $mount = Mount::findOrFail($id);
        return $mount->toJson();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Mount::all()->toJson();
    }
    
    public function indexLatest()
    {
        $patches = Mount::select('patch')->groupBy('patch')->get()->toArray();
        $patch_decimal = array();
        foreach($patches as $patch){
            $patch_decimal[] = $patch['patch'];
        }
        $latest_patch = max($patch_decimal);
        $latest_minions = Mount::where('patch',$latest_patch)->get();
        return $latest_minions->toJson();
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
            'can_fly' => 'required',
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
        ]);
        
        $mount = new Mount();
        $mount->id = $request->id;
        $mount->name = $request->name;
        $mount->icon_url = $request->icon2;
        $mount->picture_url = $request->icon;
        $mount->can_fly = $request->can_fly;
        $mount->patch = $request->patch['number'];
        $mount->name_en = $request->name_en;
        $mount->name_fr = $request->name_fr;
        $mount->name_de = $request->name_de;
        $mount->name_ja = $request->name_ja;
        $mount->description_en = $request->info1_en;
        $mount->description_fr = $request->info1_fr;
        $mount->description_de = $request->info1_de;
        $mount->description_ja = $request->info1_ja;
        $mount->summon_en = $request->summon_en;
        $mount->summon_fr = $request->summon_fr;
        $mount->summon_de = $request->summon_de;
        $mount->summon_ja = $request->summon_ja;
        
        $mount->save();
    }
    
    public function storeMethod(Request $request)
    {
        
         $this->validate($request, [
            'id' => 'required',
            'methodes' => 'required',
        ]);
        
        foreach($request->methodes as $method){
            $method_object = new MountMethod();
            $method_object->mount_id = $request->id;
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
            $method_object = MountMethod::where('mount_id',$request->id)->where('method_name',$method['method'])->first();
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
        $mount = Mount::find($id);
        
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
        ]);
        
        $mount->name = $request->name;
        $mount->icon_url = $request->icon2;
        $mount->picture_url = $request->icon;
        $mount->can_fly = $request->can_fly;
        $mount->patch = $request->patch['number'];
        $mount->name_en = $request->name_en;
        $mount->name_fr = $request->name_fr;
        $mount->name_de = $request->name_de;
        $mount->name_ja = $request->name_ja;
        $mount->description_en = $request->info1_en;
        $mount->description_fr = $request->info1_fr;
        $mount->description_de = $request->info1_de;
        $mount->description_ja = $request->info1_ja;
        $mount->summon_en = $request->summon_en;
        $mount->summon_fr = $request->summon_fr;
        $mount->summon_de = $request->summon_de;
        $mount->summon_ja = $request->summon_ja;
        
        $mount->save();
    }

}