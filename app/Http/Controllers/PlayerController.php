<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
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


    public static function search($world,$name)
    {
        $players = Player::all();
        $player = $players->where("name",$name)->where("world",$world);
        return $player->toJson();
    }
    
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $player = Player::findOrFail($id);
        return $player->toJson();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Player::all()->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lodestone_id' => 'required',
            'name' => 'required',
            'server' => 'required',
        ]);
        $api = new \Lodestone\Api;
        $lodestone = (object)$api->getCharacter($request->lodestone_id);
        
        $player = new Player();
        $player->id = $request->lodestone_id;
        $player->name = $request->name;
        
        if(!property_exists($request,"data")){
            $player->world = $lodestone->server;
            $player->title = $lodestone->title;
            $player->portrait = $lodestone->portrait;
            $player->race = $lodestone->race;
            $player->clan = $lodestone->clan;
            $player->gender = $lodestone->gender;
            $player->nameday = $lodestone->nameday;
            $player->guardian = $lodestone->guardian['name'];
            if($lodestone->grand_company != null){
                $player->grand_company = $lodestone->grand_company['name'];
            }
            $player->last_update_date = date("Y-m-d H:i:s");
        }else{
            
            $player->world = $request->data['server'];
            $player->title = $request->data['title'];
            $player->portrait = $request->data['portrait'];
            $player->race = $request->data['race'];
            $player->clan = $request->data['clan'];
            $player->gender = $request->data['gender'];
            $player->nameday = $request->data['nameday'];
            $player->guardian = $request->data['guardian']['name'];
            $player->grand_company = $request->data['grand_company']['name'];
            
            //$date = DateTime::createFromFormat('Y-m-d H:i:s', $request->last_updated);
            $player->last_update_date = $request->last_updated;
        }
        // Workaround - For FreeCompany
        if($lodestone->free_company != null){
            $fc_id = $lodestone->free_company;
            
            $player->free_company_id = $fc_id;
            $fc = (object)$api->getFreeCompany($fc_id);
            
            $player->free_company = $fc->name;
            
        }
        $player->save();
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $this->validate($request, [
            'lodestone_id' => 'required',
            'name' => 'required',
            'server' => 'required',
            'data' => 'required',
        ]);
        $api = new \Lodestone\Api;
        $lodestone = (object)$api->getCharacter($request->lodestone_id);
        
        $player = Player::find($id);
        
        // Check if a update is required.
        $source_date = strtotime(explode(" ",$request->last_updated)[0]);
        $db_date = strtotime($player->last_update_date);
        if($db_date >= $source_date)
        {
            return "No update required.";
        }
        
        $player->name = $request->name;
        $player->world = $request->data['server'];
        $player->title = $request->data['title'];
        $player->portrait = $request->data['portrait'];
        $player->race = $request->data['race'];
        $player->clan = $request->data['clan'];
        $player->gender = $request->data['gender'];
        $player->nameday = $request->data['nameday'];
        $player->guardian = $request->data['guardian']['name'];
        $player->grand_company = $request->data['grand_company']['name'];
        $player->last_update_date = $request->last_updated;
        
        // Workaround - For FreeCompany
        if($lodestone->free_company != null){
            $fc_id = $lodestone->free_company;
            
            $player->free_company_id = $fc_id;
            $fc = (object)$api->getFreeCompany($fc_id);
            
            $player->free_company = $fc->name;
            
        }
        
        $player->save();
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