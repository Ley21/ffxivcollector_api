<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Player extends Model  
{
public $timestamps = false;

    public function mounts(){
            $mounts = $this->hasMany('App\Models\PlayerMount', 'player_id', 'id')->get()->toArray();
            $mounts = array_map(function($m){
                return $m["mount_id"];
            },$mounts);
            return $mounts;
    }
    
    public function minions(){
            $minions = $this->hasMany('App\Models\PlayerMinion', 'player_id', 'id')->get()->toArray();
            
            $minions = array_map(function($m){
                return $m["minion_id"];
            },$minions);
            return $minions;
            
    }
}