<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerMount;
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


    public function indexMounts($id)
    {
        $player = Player::findOrFail($id);
        return $player->mounts()->toJson();
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
        
        if($request->data){
            echo "XIVDB update";
            $player = PlayerController::set_player_model($player,(object)$request->data);
            PlayerController::set_mounts($player->id,$request->data['mounts']);
        }else{
            echo "Lodestone update";
            $player = PlayerController::set_player_model($player,$lodestone);
        }
        
        $player->last_update_date = date("Y-m-d H:i:s");
        
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
        ]);
        $api = new \Lodestone\Api;
        $lodestone = (object)$api->getCharacter($request->lodestone_id);
        
        $player = Player::find($id);
        
        // Check if a update is required.
        $source_date = strtotime(explode(" ",$request->last_updated)[0]);
        $db_date = strtotime($player->last_update_date);
        
        
        $player->name = $request->name;
        
        if($request->data){
            echo "XIVDB update";
            $player = PlayerController::set_player_model($player,(object)$request->data);
            PlayerController::set_mounts($player->id,$request->data['mounts']);
        }else{
            echo "Lodestone update";
            $player = PlayerController::set_player_model($player,$lodestone);
        }
        
        $player->last_update_date = date("Y-m-d H:i:s");
        
        // Workaround - For FreeCompany
        if($lodestone->free_company != null){
            $fc_id = $lodestone->free_company;
            
            $player->free_company_id = $fc_id;
            $fc = (object)$api->getFreeCompany($fc_id);
            
            $player->free_company = $fc->name;
            
        }
        
        $player->save();
        
        
    }

    private static function set_player_model($player,$data){
        $player->world = $data->server;
        $player->title = $data->title;
        $player->portrait = $data->portrait;
        $player->race = $data->race;
        $player->clan = $data->clan;
        $player->gender = $data->gender;
        $player->nameday = $data->nameday;
        $player->guardian = $data->guardian['name'];
        if($data->grand_company != null){
            $player->grand_company = $data->grand_company['name'];
        }
        
        return $player;
    }
    
    private static function set_mounts($player_id,$mounts){
        foreach($mounts as $obj){
            $mount = (object)$obj;
            $player_mount = PlayerMount::where("player_id",$player_id)->where("mount_id",$mount->id)->get()->first();
            //var_dump($player_mount);
            if(empty($player_mount)){
                $player_mount = new PlayerMount();
                $player_mount->player_id = $player_id;
                $player_mount->mount_id = $mount->id;
                $player_mount->save();
            }
        }
    }
}